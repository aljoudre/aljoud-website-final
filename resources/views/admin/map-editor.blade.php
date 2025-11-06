<div wire:ignore id="map-editor-container">
    <div class="space-y-4">
        <div class="border rounded-lg overflow-hidden" style="height: 500px;">
            <div id="map-editor" style="height: 100%; width: 100%;"></div>
        </div>
        
        <div class="text-sm text-gray-600" id="map-instructions">
            <p id="marker-instruction" style="display: none;">Click on the map to place a marker</p>
            <p id="polygon-instruction" style="display: none;">Use the draw controls in the top-right corner to create a polygon. Click to add points, finish by clicking the first point.</p>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-draw@1.0.4/dist/leaflet.draw.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-draw@1.0.4/dist/leaflet.draw.js"></script>

<script>
(function() {
    'use strict';
    
    let map, marker, polygon, drawControl, drawnItems;
    let initialized = false;
    
    // Initialize immediately when script runs
    function init() {
        if (initialized) return;
        
        const container = document.getElementById('map-editor-container');
        if (!container) {
            // Retry if container not ready
            setTimeout(init, 200);
            return;
        }
        
        // Wait for Leaflet to load
        function waitForLibraries(callback, attempts = 30) {
            if (typeof L !== 'undefined' && L.map && typeof L.Control !== 'undefined' && typeof L.Control.Draw !== 'undefined') {
                callback();
            } else if (attempts > 0) {
                setTimeout(() => waitForLibraries(callback, attempts - 1), 100);
            } else {
                console.error('Failed to load Leaflet or Leaflet Draw');
                document.getElementById('polygon-instruction').innerHTML = 
                    '<span style="color: red;">Error: Map libraries failed to load. Please refresh the page.</span>';
            }
        }
        
        waitForLibraries(() => {
            setTimeout(() => {
                const mapType = getMapTypeFromForm();
                console.log('Initializing map with type:', mapType);
                initMap(mapType || 'marker');
                watchLogoUploads();
                watchFormChanges();
                initialized = true;
            }, 500);
        });
    }
    
    // Start initialization
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
    
    function getMapTypeFromForm() {
        const selectors = [
            'select[name="data[map_type]"]',
            'select[wire\\:model*="map_type"]',
            'select[id*="map_type"]'
        ];
        
        for (const sel of selectors) {
            const select = document.querySelector(sel);
            if (select && select.value) {
                return select.value;
            }
        }
        return 'marker';
    }
    
    function refreshMarkerLogo() {
        if (marker && map) {
            const lat = marker.getLatLng().lat;
            const lng = marker.getLatLng().lng;
            placeMarker(lat, lng);
        }
    }
    
    function watchLogoUploads() {
        setTimeout(() => {
            const logoImgs = document.querySelectorAll('img[data-collection="marker_logo"], img[data-collection="project_logo"], [data-slot="preview"] img');
            logoImgs.forEach(img => {
                if (img.closest('[data-collection="marker_logo"]') || img.closest('[data-collection="project_logo"]')) {
                    img.addEventListener('load', refreshMarkerLogo);
                    if (img.complete) {
                        refreshMarkerLogo();
                    }
                }
            });
        }, 500);
        
        const observer = new MutationObserver(function(mutations) {
            let shouldRefresh = false;
            mutations.forEach(function(mutation) {
                mutation.addedNodes.forEach(function(node) {
                    if (node.nodeType === 1) {
                        const imgs = node.querySelectorAll ? node.querySelectorAll('img') : [];
                        imgs.forEach(img => {
                            const parent = img.closest('[data-collection="marker_logo"]') || 
                                         img.closest('[data-collection="project_logo"]');
                            if (parent) {
                                shouldRefresh = true;
                                img.addEventListener('load', refreshMarkerLogo);
                            }
                        });
                    }
                });
            });
            if (shouldRefresh) {
                setTimeout(refreshMarkerLogo, 300);
            }
        });
        
        observer.observe(document.body, {
            childList: true,
            subtree: true,
            attributes: true,
            attributeFilter: ['src']
        });
    }
    
    function watchFormChanges() {
        // Watch for map type changes
        const selectors = [
            'select[name="data[map_type]"]',
            'select[wire\\:model*="map_type"]',
            'select[id*="map_type"]'
        ];
        
        selectors.forEach(sel => {
            const select = document.querySelector(sel);
            if (select) {
                select.addEventListener('change', function() {
                    console.log('Map type changed to:', this.value);
                    switchMapType(this.value);
                });
            }
        });
        
        // Watch for Livewire updates
        if (window.Livewire) {
            document.addEventListener('livewire:update', () => {
                setTimeout(() => {
                    const mapType = getMapTypeFromForm();
                    if (map && mapType) {
                        console.log('Livewire update - switching to:', mapType);
                        switchMapType(mapType);
                    }
                }, 500);
            });
            
            // Also watch for component updates
            document.addEventListener('livewire:load', () => {
                setTimeout(() => {
                    const mapType = getMapTypeFromForm();
                    if (map && mapType) {
                        switchMapType(mapType);
                    }
                }, 500);
            });
        }
    }
    
    function initMap(mapType) {
        // Clean up existing map
        if (map) {
            try {
                map.remove();
            } catch(e) {}
            map = null;
        }
        
        const savedLat = parseFloat(document.querySelector('input[name="data[marker_lat]"]')?.value) || 24.7136;
        const savedLng = parseFloat(document.querySelector('input[name="data[marker_lng]"]')?.value) || 46.6753;
        
        map = L.map('map-editor', {
            center: [savedLat, savedLng],
            zoom: 13
        });
        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);
        
        drawnItems = new L.FeatureGroup();
        map.addLayer(drawnItems);
        
        if (mapType === 'marker') {
            setupMarkerMode();
        } else {
            setupPolygonMode();
        }
    }
    
    function setupMarkerMode() {
        console.log('Setting up marker mode');
        const markerInst = document.getElementById('marker-instruction');
        const polygonInst = document.getElementById('polygon-instruction');
        if (markerInst) markerInst.style.display = 'block';
        if (polygonInst) polygonInst.style.display = 'none';
        
        // Remove draw control
        if (drawControl) {
            map.removeControl(drawControl);
            drawControl = null;
        }
        
        // Remove polygon
        if (polygon) {
            map.removeLayer(polygon);
            polygon = null;
        }
        
        // Remove existing click handlers
        map.off('click');
        
        const latInput = document.querySelector('input[name="data[marker_lat]"]');
        const lngInput = document.querySelector('input[name="data[marker_lng]"]');
        
        const savedLat = parseFloat(latInput?.value);
        const savedLng = parseFloat(lngInput?.value);
        
        if (savedLat && savedLng) {
            placeMarker(savedLat, savedLng);
        }
        
        map.on('click', function(e) {
            placeMarker(e.latlng.lat, e.latlng.lng);
        });
    }
    
    function placeMarker(lat, lng) {
        if (marker) {
            map.removeLayer(marker);
        }
        
        // Get logo URL
        let logoUrl = null;
        
        // Check for marker_logo or project_logo in various places
        const checks = [
            () => {
                const img = document.querySelector('img[data-collection="marker_logo"]');
                return img ? img.src : null;
            },
            () => {
                const img = document.querySelector('img[data-collection="project_logo"]');
                return img ? img.src : null;
            },
            () => {
                const previews = document.querySelectorAll('[data-slot="preview"] img');
                for (const img of previews) {
                    const parent = img.closest('[data-collection="marker_logo"]') || 
                                 img.closest('[data-collection="project_logo"]');
                    if (parent) return img.src;
                }
                return null;
            }
        ];
        
        for (const check of checks) {
            const url = check();
            if (url && url !== 'data:image/svg+xml') {
                logoUrl = url;
                break;
            }
        }
        
        let icon;
        if (logoUrl) {
            icon = L.divIcon({
                html: `<img src="${logoUrl}" style="width: 50px; height: 50px; border-radius: 50%; border: 3px solid #005A58; object-fit: cover; background: white;" />`,
                className: 'custom-marker-logo',
                iconSize: [50, 50],
                iconAnchor: [25, 25]
            });
        } else {
            icon = L.icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41]
            });
        }
        
        marker = L.marker([lat, lng], { icon, draggable: true }).addTo(map);
        
        updateMarkerFields(lat, lng);
        
        marker.on('dragend', function(e) {
            const pos = e.target.getLatLng();
            updateMarkerFields(pos.lat, pos.lng);
        });
    }
    
    function updateMarkerFields(lat, lng) {
        const selectors = [
            'input[name="data[marker_lat]"]',
            'input[wire\\:model*="marker_lat"]',
            'input[id*="marker_lat"]',
        ];
        
        let latInput = null, lngInput = null;
        
        selectors.forEach(sel => {
            if (!latInput) latInput = document.querySelector(sel);
        });
        
        const lngSelectors = [
            'input[name="data[marker_lng]"]',
            'input[wire\\:model*="marker_lng"]',
            'input[id*="marker_lng"]',
        ];
        
        lngSelectors.forEach(sel => {
            if (!lngInput) lngInput = document.querySelector(sel);
        });
        
        if (latInput) {
            latInput.value = lat;
            latInput.dispatchEvent(new Event('input', { bubbles: true }));
            latInput.dispatchEvent(new Event('change', { bubbles: true }));
        }
        if (lngInput) {
            lngInput.value = lng;
            lngInput.dispatchEvent(new Event('input', { bubbles: true }));
            lngInput.dispatchEvent(new Event('change', { bubbles: true }));
        }
    }
    
    function setupPolygonMode() {
        console.log('Setting up polygon mode');
        const markerInst = document.getElementById('marker-instruction');
        const polygonInst = document.getElementById('polygon-instruction');
        if (markerInst) markerInst.style.display = 'none';
        if (polygonInst) polygonInst.style.display = 'block';
        
        // Remove marker
        if (marker) {
            map.removeLayer(marker);
            marker = null;
        }
        
        map.off('click');
        
        // Get color
        const colorSelectors = [
            'input[name="data[polygon_color]"]',
            'input[wire\\:model*="polygon_color"]',
            'input[id*="polygon_color"]'
        ];
        let colorInput = null;
        colorSelectors.forEach(sel => {
            if (!colorInput) colorInput = document.querySelector(sel);
        });
        const color = colorInput ? colorInput.value : '#005A58';
        
        // Remove existing draw control
        if (drawControl) {
            map.removeControl(drawControl);
            drawControl = null;
        }
        
        // Verify Leaflet Draw is loaded
        if (typeof L.Control === 'undefined' || typeof L.Control.Draw === 'undefined') {
            console.error('Leaflet Draw not loaded!');
            const instructionEl = document.getElementById('polygon-instruction');
            if (instructionEl) {
                instructionEl.innerHTML = 
                    '<span style="color: red;">Error: Leaflet Draw library not loaded. Please refresh the page.</span>';
            }
            return;
        }
        
        console.log('Creating draw control...');
        
        // Create draw control
        drawControl = new L.Control.Draw({
            draw: {
                polygon: {
                    allowIntersection: false,
                    showArea: true,
                    shapeOptions: {
                        color: color,
                        fillColor: color,
                        fillOpacity: 0.3,
                        weight: 2
                    }
                },
                marker: false,
                circle: false,
                rectangle: false,
                polyline: false,
                circlemarker: false
            },
            edit: {
                featureGroup: drawnItems,
                remove: true
            }
        });
        
        map.addControl(drawControl);
        console.log('Draw control added to map');
        
        // Remove old event listeners
        map.off(L.Draw.Event.CREATED);
        map.off(L.Draw.Event.DELETED);
        map.off(L.Draw.Event.EDITED);
        
        // Load existing polygon
        const coordsSelectors = [
            'textarea[name="data[polygon_coordinates]"]',
            'input[name="data[polygon_coordinates]"]',
            'textarea[wire\\:model*="polygon_coordinates"]',
            'input[wire\\:model*="polygon_coordinates"]'
        ];
        
        let coordsInput = null;
        coordsSelectors.forEach(sel => {
            if (!coordsInput) coordsInput = document.querySelector(sel);
        });
        
        if (coordsInput && coordsInput.value) {
            try {
                const coords = JSON.parse(coordsInput.value);
                if (Array.isArray(coords) && coords.length > 0) {
                    loadPolygon(coords, color);
                }
            } catch (e) {
                console.error('Error parsing polygon coordinates:', e);
            }
        }
        
        // Add event listeners
        map.on(L.Draw.Event.CREATED, function(e) {
            console.log('Polygon created');
            const layer = e.layer;
            drawnItems.clearLayers();
            drawnItems.addLayer(layer);
            polygon = layer;
            
            const coords = layer.getLatLngs()[0].map(ll => [ll.lat, ll.lng]);
            updatePolygonFields(coords);
        });
        
        map.on(L.Draw.Event.DELETED, function() {
            console.log('Polygon deleted');
            drawnItems.clearLayers();
            polygon = null;
            updatePolygonFields(null);
        });
        
        map.on(L.Draw.Event.EDITED, function(e) {
            console.log('Polygon edited');
            const layers = e.layers;
            layers.eachLayer(function(layer) {
                const coords = layer.getLatLngs()[0].map(ll => [ll.lat, ll.lng]);
                polygon = layer;
                updatePolygonFields(coords);
            });
        });
        
        // Watch color changes
        if (colorInput) {
            colorInput.addEventListener('input', function() {
                if (polygon) {
                    polygon.setStyle({
                        color: this.value,
                        fillColor: this.value,
                        fillOpacity: 0.3
                    });
                }
            });
        }
    }
    
    function loadPolygon(coords, color) {
        const latlngs = coords.map(c => [c[0], c[1]]);
        polygon = L.polygon(latlngs, {
            color: color,
            fillColor: color,
            fillOpacity: 0.3,
            weight: 2
        });
        drawnItems.addLayer(polygon);
        map.fitBounds(polygon.getBounds());
    }
    
    function updatePolygonFields(coords) {
        const selectors = [
            'textarea[name="data[polygon_coordinates]"]',
            'input[name="data[polygon_coordinates]"]',
            'textarea[wire\\:model*="polygon_coordinates"]',
            'input[wire\\:model*="polygon_coordinates"]',
            'textarea[id*="polygon_coordinates"]',
            'input[id*="polygon_coordinates"]',
        ];
        
        let input = null;
        selectors.forEach(sel => {
            if (!input) input = document.querySelector(sel);
        });
        
        if (input) {
            const value = coords ? JSON.stringify(coords) : '';
            input.value = value;
            input.dispatchEvent(new Event('input', { bubbles: true }));
            input.dispatchEvent(new Event('change', { bubbles: true }));
        }
    }
    
    function switchMapType(mapType) {
        if (!map) {
            console.warn('Map not initialized');
            return;
        }
        
        console.log('Switching map type to:', mapType);
        if (mapType === 'marker') {
            setupMarkerMode();
        } else if (mapType === 'polygon') {
            setupPolygonMode();
        }
    }
})();
</script>

<style>
.custom-marker-logo {
    background: transparent;
    border: none;
}
</style>

<!-- Leaflet Map for Project -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
(function() {
    function waitForLeaflet(callback, attempts = 30) {
        if (typeof L !== 'undefined' && L.map) {
            callback();
        } else if (attempts > 0) {
            setTimeout(() => waitForLeaflet(callback, attempts - 1), 100);
        } else {
            console.error('Leaflet failed to load');
        }
    }
    
    function initProjectMap() {
        const mapContainer = document.getElementById('project-map');
        if (!mapContainer) {
            setTimeout(initProjectMap, 100);
            return;
        }
        
        waitForLeaflet(() => {
            let map;
            let hasMarker = false;
            
            @php
                $markerLogo = null;
                try {
                    $logoMedia = $project->getFirstMedia('marker_logo');
                    if (!$logoMedia) {
                        $logoMedia = $project->getFirstMedia('project_logo');
                    }
                    if ($logoMedia) {
                        $markerLogo = $logoMedia->getUrl();
                    }
                } catch (\Exception $e) {}
            @endphp
            
            @if($project->map_type === 'marker' && $project->marker_lat && $project->marker_lng)
                // Marker mode - has coordinates
                map = L.map('project-map').setView([{{ $project->marker_lat }}, {{ $project->marker_lng }}], 15);
                hasMarker = true;
            @elseif($project->map_type === 'polygon' && $project->polygon_coordinates && is_array($project->polygon_coordinates) && count($project->polygon_coordinates) > 0)
                // Polygon mode - has coordinates
                const coords = @json($project->polygon_coordinates);
                const latlngs = coords.map(c => [c[0], c[1]]);
                
                const polygon = L.polygon(latlngs, {
                    color: '{{ $project->polygon_color ?? '#005A58' }}',
                    fillColor: '{{ $project->polygon_color ?? '#005A58' }}',
                    fillOpacity: 0.4,
                    weight: 3
                });
                
                const bounds = polygon.getBounds();
                map = L.map('project-map').fitBounds(bounds);
                
                polygon.addTo(map);
                
                // Store polygon center for "Open in Map" button
                const center = bounds.getCenter();
                window.projectMarkerCoords = {
                    lat: center.lat,
                    lng: center.lng
                };
                
                @if($markerLogo)
                    // Add logo at polygon center
                    const logoImg = new Image();
                    logoImg.onload = function() {
                        const logoIcon = L.divIcon({
                            html: `<img src="{{ $markerLogo }}" style="width: 80px; height: 80px; border-radius: 50%; border: 5px solid white; object-fit: cover; box-shadow: 0 6px 20px rgba(0,0,0,0.4);" />`,
                            className: 'custom-polygon-logo',
                            iconSize: [80, 80],
                            iconAnchor: [40, 40]
                        });
                        L.marker(center, { icon: logoIcon }).addTo(map);
                    };
                    logoImg.onerror = function() {
                        // Logo failed, don't show logo marker
                    };
                    logoImg.src = '{{ $markerLogo }}';
                @endif
            @else
                // Default: Show map centered on Riyadh (default location)
                // If project has location data, we'll try to geocode it, otherwise use default
                map = L.map('project-map').setView([24.7136, 46.6753], 13);
                hasMarker = false;
            @endif
            
            // Add OpenStreetMap tile layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors',
                maxZoom: 19
            }).addTo(map);
            
            @if($project->map_type === 'marker' && $project->marker_lat && $project->marker_lng)
                // Add marker with logo (with error handling)
                let icon;
                let marker;
                
                @if($markerLogo)
                    // Try to load logo, fallback to default marker if it fails
                    const logoImg = new Image();
                    logoImg.onload = function() {
                        // Logo loaded successfully
                        icon = L.divIcon({
                            html: `<img src="{{ $markerLogo }}" style="width: 60px; height: 60px; border-radius: 50%; border: 4px solid #005A58; object-fit: cover; box-shadow: 0 4px 12px rgba(0,0,0,0.3); background: white;" />`,
                            className: 'custom-marker-logo',
                            iconSize: [60, 60],
                            iconAnchor: [30, 30]
                        });
                        marker = L.marker([{{ $project->marker_lat }}, {{ $project->marker_lng }}], { icon }).addTo(map);
                        @if($project->translate('location'))
                            marker.bindPopup('{{ $project->translate('location') }}').openPopup();
                        @endif
                    };
                    logoImg.onerror = function() {
                        // Logo failed to load, use default marker
                        icon = L.icon({
                            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
                            iconSize: [25, 41],
                            iconAnchor: [12, 41],
                            popupAnchor: [0, -41]
                        });
                        marker = L.marker([{{ $project->marker_lat }}, {{ $project->marker_lng }}], { icon }).addTo(map);
                        @if($project->translate('location'))
                            marker.bindPopup('{{ $project->translate('location') }}').openPopup();
                        @endif
                    };
                    logoImg.src = '{{ $markerLogo }}';
                @else
                    // No logo, use default marker
                    icon = L.icon({
                        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
                        iconSize: [25, 41],
                        iconAnchor: [12, 41],
                        popupAnchor: [0, -41]
                    });
                    marker = L.marker([{{ $project->marker_lat }}, {{ $project->marker_lng }}], { icon }).addTo(map);
                    
                    // Add popup with location info
                    @if($project->translate('location'))
                        marker.bindPopup('{{ $project->translate('location') }}').openPopup();
                    @endif
                @endif
                
                // Store coordinates for "Open in Map" button
                window.projectMarkerCoords = {
                    lat: {{ $project->marker_lat }},
                    lng: {{ $project->marker_lng }}
                };
            @else
                // Default coordinates for "Open in Map" button
                window.projectMarkerCoords = {
                    lat: 24.7136,
                    lng: 46.6753
                };
            @endif
        });
    }
    
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initProjectMap);
    } else {
        setTimeout(initProjectMap, 100);
    }
    
    // Handle "Open in Map" button click
    document.addEventListener('DOMContentLoaded', function() {
        const openInMapBtn = document.getElementById('openInMapBtn');
        if (openInMapBtn) {
            openInMapBtn.addEventListener('click', function() {
                if (window.projectMarkerCoords) {
                    const url = `https://www.openstreetmap.org/?mlat=${window.projectMarkerCoords.lat}&mlon=${window.projectMarkerCoords.lng}&zoom=15`;
                    window.open(url, '_blank');
                } else {
                    // Fallback to Google Maps
                    const location = encodeURIComponent('{{ $project->translate('location') ?? 'Riyadh' }}');
                    window.open(`https://www.google.com/maps/search/?api=1&query=${location}`, '_blank');
                }
            });
        }
    });
})();
</script>

<style>
.custom-marker-logo, .custom-polygon-logo {
    background: transparent;
    border: none;
}
</style>


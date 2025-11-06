<!-- Location & Nearby Places Section -->
<section class="py-12 md:py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 md:px-8">
        <h2 class="text-3xl md:text-5xl font-bold text-[#005A58] mb-8 text-center">{{ isset($uiTexts['project.location']) ? $uiTexts['project.location']->translate() : 'الموقع' }}</h2>
        <div class="grid md:grid-cols-2 gap-8">
            <!-- Map Side -->
            <div class="bg-gray-100 rounded-2xl overflow-hidden relative" style="height: 500px;">
                <div id="project-map" style="height: 100%; width: 100%;"></div>
                <!-- Open in Map Button -->
                <button id="openInMapBtn" class="absolute bottom-4 left-4 bg-white hover:bg-gray-50 text-[#005A58] font-semibold px-6 py-3 rounded-lg shadow-lg transition-all flex items-center gap-2 z-[1000]" style="z-index: 1000;">
                    <i class="fas fa-external-link-alt"></i>
                    <span>{{ isset($uiTexts['button.open_in_map']) ? $uiTexts['button.open_in_map']->translate() : 'فتح في الخريطة' }}</span>
                </button>
            </div>
            
            <!-- Nearby Places List -->
            <div>
                <h3 class="text-2xl font-bold text-[#005A58] mb-6">{{ isset($uiTexts['project.nearby_places']) ? $uiTexts['project.nearby_places']->translate() : 'الأماكن القريبة' }}</h3>
                @if($project->nearPlaces->count() > 0)
                    <div class="space-y-3">
                        @foreach($project->nearPlaces as $place)
                            <div class="bg-white rounded-lg p-4 shadow-sm hover:shadow-md transition-shadow border border-gray-100">
                                <div class="flex items-center justify-between gap-4">
                                    <div class="flex-1">
                                        <h4 class="font-semibold text-gray-900 text-base leading-relaxed">{{ $place->translate('name') }}</h4>
                                        @if($place->translate('description'))
                                            <p class="text-sm text-gray-600 mt-1">{{ $place->translate('description') }}</p>
                                        @endif
                                    </div>
                                    <div class="flex-shrink-0">
                                        <div class="w-16 h-16 rounded-full bg-[#005A58] flex items-center justify-center shadow-md">
                                            <div class="text-center">
                                                <p class="text-white font-bold text-lg leading-tight">{{ $place->time ?? 5 }}</p>
                                                <p class="text-white text-xs leading-tight">{{ isset($uiTexts['project.minutes']) ? $uiTexts['project.minutes']->translate() : 'دقيقة' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="py-8 text-center bg-white rounded-lg p-6">
                        <p class="text-gray-600">لا توجد أماكن قريبة محددة</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>


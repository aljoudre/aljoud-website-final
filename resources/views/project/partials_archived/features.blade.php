<!-- Features Section (Always show) -->
<section id="features" class="py-12 md:py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 md:px-8">
        <h2 class="text-3xl md:text-5xl font-bold text-center text-[#005A58] mb-12">المرافق والخدمات</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8">
            @php
                // Default icons mapping for smart icon detection
                $defaultIcons = [
                    'استقبال فندقي' => 'fa-concierge-bell',
                    'Hotel Reception' => 'fa-concierge-bell',
                    'حدائق مفتوحة' => 'fa-tree',
                    'Open Gardens' => 'fa-tree',
                    'نادي رياضي' => 'fa-dumbbell',
                    'Fitness Club' => 'fa-dumbbell',
                    'أنظمة أمن خاصة' => 'fa-shield-alt',
                    'Private Security Systems' => 'fa-shield-alt',
                    'مجلس ضيافة' => 'fa-users',
                    'Hospitality Lounge' => 'fa-users',
                    'مواقف قبو' => 'fa-car',
                    'Basement Parking' => 'fa-car',
                    'بيئة ذكية' => 'fa-lightbulb',
                    'Smart Environment' => 'fa-lightbulb',
                    'ألعاب أطفال' => 'fa-child',
                    'Children\'s Play Area' => 'fa-child',
                ];
            @endphp
            
            @if($project->features->count() > 0)
                {{-- Show database amenities/features --}}
                @foreach($project->features as $feature)
                    @php
                        $iconUrl = null;
                        try {
                            $iconMedia = $feature->getFirstMedia('icon');
                            if ($iconMedia) {
                                $iconUrl = $iconMedia->getUrl();
                            }
                        } catch (\Exception $e) {}
                        
                        $featureName = $feature->translate('name');
                        $defaultIcon = $defaultIcons[$featureName] ?? 'fa-star';
                    @endphp
                    <div class="amenity-card bg-[#f8f7f3] p-6 rounded-xl text-center">
                        <div class="w-16 h-16 mx-auto mb-4 bg-[#005A58] rounded-full flex items-center justify-center">
                            @if($iconUrl)
                                <img src="{{ $iconUrl }}" alt="{{ $feature->translate('name') }}" class="w-10 h-10 object-contain">
                            @else
                                <i class="fas {{ $defaultIcon }} text-white text-2xl"></i>
                            @endif
                        </div>
                        <h3 class="font-bold text-lg text-[#005A58] mb-2">{{ $feature->translate('name') }}</h3>
                    </div>
                @endforeach
            @else
                {{-- Show default placeholder features from partial --}}
                @include('project.partials.default-features')
            @endif
        </div>
    </div>
</section>


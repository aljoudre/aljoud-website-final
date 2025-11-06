<!-- Projects Section -->
<section id="projects" class="bg-[#f8f7f3]">
    <div class="about-header">
        <div class="about-tab">
            <h2 class="text-white">{{ isset($uiTexts['section.projects.title']) ? $uiTexts['section.projects.title']->translate() : 'المشاريع' }}</h2>
        </div>
        <div class="about-rest"></div>
    </div>
    <div class="max-w-7xl mx-auto px-4 md:px-8 py-8 md:py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
            <!-- Lands & Auctions Category -->
            <div class="relative w-full h-[500px] md:h-[600px] overflow-hidden rounded-2xl cursor-pointer group" onclick="window.location.href='{{ route('projects.category', 'lands_auctions') }}'">
                @php
                    $landsImage = asset('assets/images/logo.png');
                    if ($landsAuctionsProject) {
                        try {
                            $imageMedia = $landsAuctionsProject->getFirstMedia('project_image');
                            if ($imageMedia) {
                                $landsImage = $imageMedia->getUrl();
                            }
                        } catch (\Exception $e) {}
                    }
                @endphp
                <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-110" style="background-image: url('{{ $landsImage }}');"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
                <div class="absolute bottom-0 left-0 right-0 p-6 md:p-8">
                    <h3 class="text-3xl md:text-5xl font-bold text-white mb-3">{{ isset($uiTexts['category.lands_auctions']) ? $uiTexts['category.lands_auctions']->translate() : 'الأراضي والمزادات' }}</h3>
                    <p class="text-base md:text-lg text-white/90 mb-4">{{ isset($uiTexts['category.lands_auctions.description']) ? $uiTexts['category.lands_auctions.description']->translate() : 'استثمارات عقارية متخصصة في الأراضي والمزادات' }}</p>
                    <button class="bg-[#005A58] text-white px-6 py-2 rounded-lg font-semibold hover:bg-[#003f3d] transition-colors flex items-center gap-2 text-sm">
                        {{ isset($uiTexts['button.explore']) ? $uiTexts['button.explore']->translate() : 'استكشف المشاريع' }}
                        <i class="fas fa-arrow-left"></i>
                    </button>
                </div>
            </div>

            <!-- Residential & Commercial Towers Category -->
            <div class="relative w-full h-[500px] md:h-[600px] overflow-hidden rounded-2xl cursor-pointer group" onclick="window.location.href='{{ route('projects.category', 'residential_commercial') }}'">
                @php
                    $residentialImage = asset('assets/images/logo.png');
                    if ($residentialCommercialProject) {
                        try {
                            $imageMedia = $residentialCommercialProject->getFirstMedia('project_image');
                            if ($imageMedia) {
                                $residentialImage = $imageMedia->getUrl();
                            }
                        } catch (\Exception $e) {}
                    }
                @endphp
                <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-110" style="background-image: url('{{ $residentialImage }}');"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
                <div class="absolute bottom-0 left-0 right-0 p-6 md:p-8">
                    <h3 class="text-3xl md:text-5xl font-bold text-white mb-3">{{ isset($uiTexts['category.residential_commercial']) ? $uiTexts['category.residential_commercial']->translate() : 'الأبراج السكنية والتجارية' }}</h3>
                    <p class="text-base md:text-lg text-white/90 mb-4">{{ isset($uiTexts['category.residential_commercial.description']) ? $uiTexts['category.residential_commercial.description']->translate() : 'مشاريع ضخمة وتطويرات متكاملة' }}</p>
                    <button class="bg-[#005A58] text-white px-6 py-2 rounded-lg font-semibold hover:bg-[#003f3d] transition-colors flex items-center gap-2 text-sm">
                        {{ isset($uiTexts['button.explore']) ? $uiTexts['button.explore']->translate() : 'استكشف المشاريع' }}
                        <i class="fas fa-arrow-left"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>


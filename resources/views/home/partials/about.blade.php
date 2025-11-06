<!-- About Section -->
<section id="about" class="bg-[#f8f7f3]">
    <div class="about-header">
        <div class="about-tab">
            <h2 class="text-white">{{ isset($uiTexts['section.about.title']) ? $uiTexts['section.about.title']->translate() : 'من نحن' }}</h2>
        </div>
        <div class="about-rest"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 md:px-8 py-8 md:py-12">
        <div class="relative z-10 flex flex-col md:flex-row items-center md:items-center justify-between gap-6 md:gap-12">
            <div class="w-full md:w-5/12 flex justify-center md:justify-start">
                @php
                    $aboutLogo = null;
                    if ($about) {
                        try {
                            $logoMedia = $about->getFirstMedia('logo');
                            if ($logoMedia) {
                                $aboutLogo = $logoMedia->getUrl();
                            }
                        } catch (\Exception $e) {
                            // Ignore media library errors
                        }
                    }
                @endphp
                @if($aboutLogo)
                    <img src="{{ $aboutLogo }}" alt="Aljoud Logo" class="w-[180px] md:w-[320px] max-w-full h-auto" />
                @else
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Aljoud Logo" class="w-[180px] md:w-[320px] max-w-full h-auto" />
                @endif
            </div>
            <div class="w-full md:w-6/12 text-center md:text-left">
                <h3 class="text-xl md:text-4xl font-bold text-gray-900 mb-3 md:mb-4">
                    @if($about && $about->header)
                        {{ $about->translate('header') }}
                    @else
                        شريككم نحو تحقيق الأحلام العقارية
                    @endif
                </h3>
                <p class="text-gray-700 leading-relaxed text-sm md:text-base">
                    @if($about && $about->content)
                        {{ $about->translate('content') }}
                    @else
                        في شركة الجود للتطوير والاستثمار العقاري، نسعى لبناء مستقبل عقاري واعد من خلال مشاريعنا المبتكرة وخدماتنا الشاملة. نفخر بفريقنا من الخبراء الذين يعملون بلا كلل لتحقيق رؤية عملائنا وتلبية توقعاتهم. نلتزم بتقديم حلول عقارية متكاملة تضمن الجودة والكفاءة، مع التركيز على تحقيق أفضل العوائد لمستثمرينا.
                    @endif
                </p>
            </div>
        </div>
    </div>
</section>


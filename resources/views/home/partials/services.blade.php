

<!-- Services Section -->
<section id="services" class="bg-[#f8f7f3]">
    <div class="about-header">
        <div class="about-tab">
            <h2 class="text-white">{{ isset($uiTexts['section.services.title']) ? $uiTexts['section.services.title']->translate() : 'الخدمات' }}</h2>
        </div>
        <div class="about-rest"></div>
    </div>
    <div class="max-w-7xl mx-auto px-4 md:px-8 py-8 md:py-12">
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
            @forelse($services as $service)
                @php
                    $serviceIcon = null;
                    try {
                        $iconMedia = $service->getFirstMedia('icon');
                        if ($iconMedia) {
                            $serviceIcon = $iconMedia->getUrl();
                        }
                    } catch (\Exception $e) {
                        // Ignore media library errors
                    }
                @endphp
                <div class="service-card">
                    <div class="service-icon" @if(!$serviceIcon) style="background: transparent !important;" @endif>
                        @if($serviceIcon)
                            <img src="{{ $serviceIcon }}" alt="{{ $service->translate('title') }}" class="w-10 h-10">
                        @else
                            {{-- Empty space to maintain spacing --}}
                            <div class="w-10 h-10"></div>
                        @endif
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold mb-2">{{ $service->translate('title') ?: 'خدمة' }}</h3>
                    <p class="text-sm md:text-base text-gray-500">{{ $service->translate('description') ?: 'وصف الخدمة' }}</p>
                </div>
            @empty
                <!-- Fallback static services -->
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-building text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold mb-2">التطوير العقاري</h3>
                    <p class="text-sm md:text-base text-gray-500">تحويل الأراضي والمباني إلى مشاريع متميزة بجودة عالية وتصميم معاصر.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-chart-line text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold mb-2">التسويق العقاري</h3>
                    <p class="text-sm md:text-base text-gray-500">استراتيجيات تسويق متطورة لتعزيز الوجود وجذب المستثمرين والعملاء.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-key text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold mb-2">إدارة الأملاك</h3>
                    <p class="text-sm md:text-base text-gray-500">حلول متكاملة للصيانة، التأجير وإدارة العائدات بكفاءة عالية.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>


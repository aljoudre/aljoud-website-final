<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aljoud Real Estate - شركة الجود للتطوير والاستثمار العقاري</title>
    <!-- Professional Fonts: Cairo for Arabic/English -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Cairo', 'sans-serif'],
                    },
                },
            },
        };
    </script>
    <style>
        * {
            direction: rtl !important;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    @php
        use Illuminate\Support\Str;
    @endphp
    <link rel="stylesheet" href="{{ asset('css/final_style.css') }}">
</head>
<body>

    <!-- Navigation -->
    <nav class="nav-container navbar-transition navbar-visible">
        <div class="nav-content px-6 py-2">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <div class="logo flex items-center gap-2">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Aljoud" class="h-8 w-auto logo-normal" id="navbarLogo">
                    <img src="{{ asset('assets/images/logo_light.svg') }}" alt="Aljoud" class="h-8 w-auto logo-light hidden" id="navbarLogoLight">
                    <span class="text-xl font-bold hidden sm:inline">الجود</span>
                </div>
                <div class="hidden md:flex items-center gap-4 text-sm mr-2" id="desktopNav">
                    <a href="#home" data-target="home" class="pb-1 border-b-2 border-transparent hover:border-current transition-colors">{{ isset($uiTexts['nav.home']) ? $uiTexts['nav.home']->translate() : 'الرئيسية' }}</a>
                    <a href="#about" data-target="about" class="pb-1 border-b-2 border-transparent hover:border-current transition-colors">{{ isset($uiTexts['nav.about']) ? $uiTexts['nav.about']->translate() : 'من نحن' }}</a>
                    <a href="#services" data-target="services" class="pb-1 border-b-2 border-transparent hover:border-current transition-colors">{{ isset($uiTexts['nav.services']) ? $uiTexts['nav.services']->translate() : 'الخدمات' }}</a>
                    <a href="#projects" data-target="projects" class="pb-1 border-b-2 border-transparent hover:border-current transition-colors">{{ isset($uiTexts['nav.projects']) ? $uiTexts['nav.projects']->translate() : 'المشاريع' }}</a>
                    <a href="#contact" data-target="contact" class="pb-1 border-b-2 border-transparent hover:border-current transition-colors">{{ isset($uiTexts['nav.contact']) ? $uiTexts['nav.contact']->translate() : 'اتصل بنا' }}</a>
                </div>
                <div class="hidden md:block relative" id="langDropdown">
                    <button class="px-3 py-1 rounded-md border border-white/30 hover:bg-white/10 transition flex items-center gap-2" id="langToggle">
                        <span>{{ $currentLanguage ? $currentLanguage->name : 'AR' }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div class="absolute right-0 mt-2 w-32 bg-white text-black rounded-md shadow-lg border border-gray-200 hidden" id="langMenu">
                        @foreach($translations as $translation)
                            <a href="{{ route('web.set-locale', $translation->value) }}" class="block w-full text-left px-3 py-2 hover:bg-gray-100 transition {{ $translation->value === app()->getLocale() ? 'bg-gray-50 font-semibold' : '' }}">
                                {{ $translation->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
                <div class="burger md:hidden" id="burger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
        <div class="nav-content px-8 py-2">
            <div class="max-w-7xl mx-auto flex gap-6 md:gap-8 text-sm">
                @php
                    $phone = isset($contactSettings) ? $contactSettings->where('type', 'phone')->first() : null;
                @endphp
                @if($phone)
                    <a href="tel:{{ $phone->value }}" class="hover:opacity-70 transition"><i class="fas fa-phone mr-2"></i>{{ $phone->value }}</a>
                @endif
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="flex justify-end mb-8">
            <button class="text-white text-3xl" id="closeSidebar">&times;</button>
        </div>
        <nav class="flex flex-col gap-4" id="mobileNav">
            <a href="#home" data-target="home" class="text-white text-xl pb-1 border-b-2 border-transparent hover:border-white transition-colors">{{ isset($uiTexts['nav.home']) ? $uiTexts['nav.home']->translate() : 'الرئيسية' }}</a>
            <a href="#about" data-target="about" class="text-white text-xl pb-1 border-b-2 border-transparent hover:border-white transition-colors">{{ isset($uiTexts['nav.about']) ? $uiTexts['nav.about']->translate() : 'من نحن' }}</a>
            <a href="#services" data-target="services" class="text-white text-xl pb-1 border-b-2 border-transparent hover:border-white transition-colors">{{ isset($uiTexts['nav.services']) ? $uiTexts['nav.services']->translate() : 'الخدمات' }}</a>
            <a href="#projects" data-target="projects" class="text-white text-xl pb-1 border-b-2 border-transparent hover:border-white transition-colors">{{ isset($uiTexts['nav.projects']) ? $uiTexts['nav.projects']->translate() : 'المشاريع' }}</a>
            <a href="#contact" data-target="contact" class="text-white text-xl pb-1 border-b-2 border-transparent hover:border-white transition-colors">{{ isset($uiTexts['nav.contact']) ? $uiTexts['nav.contact']->translate() : 'اتصل بنا' }}</a>
        </nav>
        <div class="mt-6 relative">
            <button class="w-full text-left px-3 py-2 rounded-md border border-white/30 text-white hover:bg-white/10 transition flex items-center justify-between" id="langToggleMobile">
                <span>{{ $currentLanguage ? $currentLanguage->name : 'AR' }}</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            </button>
            <div class="absolute left-0 right-0 mt-2 bg-white text-black rounded-md shadow-lg border border-gray-200 hidden" id="langMenuMobile">
                @foreach($translations as $translation)
                    <a href="{{ route('web.set-locale', $translation->value) }}" class="block w-full text-left px-3 py-2 hover:bg-gray-100 transition {{ $translation->value === app()->getLocale() ? 'bg-gray-50 font-semibold' : '' }}">
                        {{ $translation->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Hero Section -->
    <section id="home" class="relative flex items-center justify-start">
        <div class="hero-bg">
            @php
                $heroVideo = null;
                $heroImage = null;
                if ($hero) {
                    // Use media URL field directly to avoid media library issues
                    if ($hero->media) {
                        $heroImage = $hero->media;
                    }
                }
            @endphp
            @if($heroVideo)
                <video autoplay loop muted playsinline class="active">
                    <source src="{{ $heroVideo }}" type="video/mp4">
                </video>
            @elseif($heroImage)
                <img src="{{ $heroImage }}" alt="Aljoud Real Estate" class="active">
            @else
                <img src="https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=1920&q=80" alt="Aljoud Real Estate" class="active">
            @endif
        </div>
        <div class="relative z-10 max-w-2xl ml-3 md:ml-16 p-4 md:p-8 bg-black/40 backdrop-blur-sm rounded-2xl mx-3 md:mx-0">
            <h1 class="text-2xl md:text-6xl font-bold mb-3 md:mb-4 text-white leading-tight">{{ $hero && isset($hero->title) ? $hero->translate('title') : 'شريككم نحو تحقيق الأحلام العقارية' }}</h1>
            <p class="text-base md:text-xl text-gray-200">{{ $hero && isset($hero->subtitle) ? $hero->translate('subtitle') : 'الجود.. رمز الإبداع العقاري والاستثمار الواعد' }}</p>
        </div>
    </section>

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
                    {{-- <p class="text-xs md:text-sm tracking-widest text-[#005A58] font-semibold mb-2">شركة الجود للتطوير و الاستثمار العقاري</p> --}}
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
                        $landsImage = 'https://images.unsplash.com/photo-1560518883-ce09059eeffa?q=80&w=1920';
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
                        $residentialImage = 'https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?q=80&w=1920';
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

    <!-- Contact Section -->
    <section id="contact" class="bg-[#f8f7f3]">
        <div class="about-header">
            <div class="about-tab">
                <h2 class="text-white">{{ isset($uiTexts['section.contact.title']) ? $uiTexts['section.contact.title']->translate() : 'اتصل بنا' }}</h2>
            </div>
            <div class="about-rest"></div>
        </div>
        <div class="max-w-7xl mx-auto px-4 md:px-8 py-8 md:py-12 grid md:grid-cols-2 gap-8 md:gap-16">
            <div class="flex flex-col justify-center space-y-6">
                @php
                    $emails = isset($contactSettings) ? $contactSettings->where('type', 'email') : collect();
                    $phones = isset($contactSettings) ? $contactSettings->where('type', 'phone') : collect();
                    $socialMedia = isset($contactSettings) ? $contactSettings->whereIn('type', ['facebook', 'twitter', 'instagram', 'linkedin', 'youtube']) : collect();
                @endphp
                
                @if($emails->count() > 0)
                    <div>
                        <h3 class="text-xl md:text-2xl font-bold mb-2 text-[#005A58]">{{ isset($uiTexts['contact.email']) ? $uiTexts['contact.email']->translate() : 'البريد الإلكتروني' }}</h3>
                        @foreach($emails as $email)
                            <p class="text-base md:text-lg text-gray-700"><a href="mailto:{{ $email->value }}" class="hover:text-[#005A58] transition">{{ $email->value }}</a></p>
                        @endforeach
                    </div>
                @endif
                
                @if($phones->count() > 0)
                    <div>
                        <h3 class="text-xl md:text-2xl font-bold mb-2 text-[#005A58]">{{ isset($uiTexts['contact.phone']) ? $uiTexts['contact.phone']->translate() : 'رقم الهاتف' }}</h3>
                        @foreach($phones as $phone)
                            <p class="text-base md:text-lg text-gray-700"><a href="tel:{{ $phone->value }}" class="hover:text-[#005A58] transition">{{ $phone->value }}</a></p>
                        @endforeach
                    </div>
                @endif
                
                @if($socialMedia->count() > 0)
                    <div>
                        <h3 class="text-xl md:text-2xl font-bold mb-3 text-[#005A58]">{{ isset($uiTexts['contact.follow_us']) ? $uiTexts['contact.follow_us']->translate() : 'تابعنا' }}</h3>
                        <div class="flex gap-3 flex-wrap">
                            @foreach($socialMedia as $social)
                                @php
                                    $icons = [
                                        'facebook' => 'fa-brands fa-facebook-f',
                                        'twitter' => 'fa-brands fa-x-twitter',
                                        'instagram' => 'fa-brands fa-instagram',
                                        'linkedin' => 'fa-brands fa-linkedin-in',
                                        'youtube' => 'fa-brands fa-youtube',
                                    ];
                                    $icon = $icons[$social->type] ?? 'fa-solid fa-link';
                                    $labels = [
                                        'facebook' => 'Facebook',
                                        'twitter' => 'X / Twitter',
                                        'instagram' => 'Instagram',
                                        'linkedin' => 'LinkedIn',
                                        'youtube' => 'YouTube',
                                    ];
                                    $label = $labels[$social->type] ?? $social->type;
                                @endphp
                                <a href="{{ $social->value }}" target="_blank" rel="noopener noreferrer" class="w-11 h-11 bg-white border border-gray-200 rounded-full flex items-center justify-center hover:bg-[#005A58] hover:text-white transition" aria-label="{{ $label }}">
                                    <i class="{{ $icon }} text-lg"></i>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
            <div>
                <form id="contactForm" class="space-y-4">
                    @csrf
                    <input type="text" name="name" id="contact_name" placeholder="{{ isset($uiTexts['form.name']) ? $uiTexts['form.name']->translate() : 'الاسم' }}" required class="w-full px-6 py-4 border rounded-lg focus:border-[#005A58] focus:outline-none transition">
                    <input type="tel" name="phone" id="contact_phone" placeholder="{{ isset($uiTexts['form.phone']) ? $uiTexts['form.phone']->translate() : 'رقم الهاتف' }}" required class="w-full px-6 py-4 border rounded-lg focus:border-[#005A58] focus:outline-none transition">
                    <input type="email" name="email" id="contact_email" placeholder="{{ isset($uiTexts['form.email']) ? $uiTexts['form.email']->translate() : 'البريد الإلكتروني' }}" required class="w-full px-6 py-4 border rounded-lg focus:border-[#005A58] focus:outline-none transition">
                    <textarea name="message" id="contact_message" placeholder="{{ isset($uiTexts['form.message']) ? $uiTexts['form.message']->translate() : 'الرسالة' }}" rows="5" required class="w-full px-6 py-4 border rounded-lg focus:border-[#005A58] focus:outline-none transition"></textarea>
                    <div id="contact_message_div" class="hidden"></div>
                    <button type="submit" id="contact_submit_btn" class="w-full py-4 bg-[#005A58] text-white rounded-lg font-bold hover:opacity-90 transition">{{ isset($uiTexts['form.submit']) ? $uiTexts['form.submit']->translate() : 'إرسال' }}</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="footer" class="bg-[#f3f2ed] flex items-center justify-center px-4 md:px-8">
        <div class="max-w-7xl w-full text-center">
            <div class="mb-8">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Aljoud Real Estate" class="h-12 md:h-16 w-auto mx-auto mb-4">
                <p class="text-gray-600 text-sm md:text-base">{{ isset($uiTexts['footer.company_name']) ? $uiTexts['footer.company_name']->translate() : 'شركة الجود للتطوير والاستثمار العقاري' }}</p>
            </div>
            <div class="grid md:grid-cols-3 gap-8 mb-12">
                <div>
                    <h4 class="text-lg md:text-xl font-bold mb-4">{{ isset($uiTexts['footer.quick_links']) ? $uiTexts['footer.quick_links']->translate() : 'روابط سريعة' }}</h4>
                    <div class="space-y-2">
                        <a href="#home" class="block text-gray-500 hover:text-[#005A58] transition text-sm md:text-base">{{ isset($uiTexts['nav.home']) ? $uiTexts['nav.home']->translate() : 'الرئيسية' }}</a>
                        <a href="#about" class="block text-gray-500 hover:text-[#005A58] transition text-sm md:text-base">{{ isset($uiTexts['nav.about']) ? $uiTexts['nav.about']->translate() : 'من نحن' }}</a>
                        <a href="#services" class="block text-gray-500 hover:text-[#005A58] transition text-sm md:text-base">{{ isset($uiTexts['nav.services']) ? $uiTexts['nav.services']->translate() : 'الخدمات' }}</a>
                        <a href="{{ route('privacy') }}" class="block text-gray-500 hover:text-[#005A58] transition text-sm md:text-base">{{ isset($uiTexts['footer.privacy_policy']) ? $uiTexts['footer.privacy_policy']->translate() : 'سياسة الخصوصية' }}</a>
                    </div>
                </div>
                <div>
                    <h4 class="text-lg md:text-xl font-bold mb-4">{{ isset($uiTexts['footer.contact_info']) ? $uiTexts['footer.contact_info']->translate() : 'معلومات التواصل' }}</h4>
                    <div class="space-y-2 text-gray-500 text-sm md:text-base">
                        @php
                            $footerEmails = isset($contactSettings) ? $contactSettings->where('type', 'email') : collect();
                            $footerPhones = isset($contactSettings) ? $contactSettings->where('type', 'phone') : collect();
                        @endphp
                        @foreach($footerEmails as $email)
                            <p><a href="mailto:{{ $email->value }}" class="hover:text-[#005A58] transition">{{ $email->value }}</a></p>
                        @endforeach
                        @foreach($footerPhones as $phone)
                            <p><a href="tel:{{ $phone->value }}" class="hover:text-[#005A58] transition">{{ $phone->value }}</a></p>
                        @endforeach
                        <p>الرياض، المملكة العربية السعودية</p>
                    </div>
                </div>
                <div>
                    <h4 class="text-lg md:text-xl font-bold mb-4">{{ isset($uiTexts['footer.follow_us']) ? $uiTexts['footer.follow_us']->translate() : 'تابعنا' }}</h4>
                    <div class="flex justify-center gap-3">
                        @php
                            $footerSocial = isset($contactSettings) ? $contactSettings->whereIn('type', ['facebook', 'twitter', 'instagram', 'linkedin', 'youtube']) : collect();
                        @endphp
                        @foreach($footerSocial as $social)
                            @php
                                $icons = [
                                    'facebook' => 'fa-brands fa-facebook-f',
                                    'twitter' => 'fa-brands fa-x-twitter',
                                    'instagram' => 'fa-brands fa-instagram',
                                    'linkedin' => 'fa-brands fa-linkedin-in',
                                    'youtube' => 'fa-brands fa-youtube',
                                ];
                                $icon = $icons[$social->type] ?? 'fa-solid fa-link';
                                $labels = [
                                    'facebook' => 'Facebook',
                                    'twitter' => 'X / Twitter',
                                    'instagram' => 'Instagram',
                                    'linkedin' => 'LinkedIn',
                                    'youtube' => 'YouTube',
                                ];
                                $label = $labels[$social->type] ?? $social->type;
                            @endphp
                            <a href="{{ $social->value }}" target="_blank" rel="noopener noreferrer" class="w-11 h-11 bg-white border border-gray-200 rounded-full flex items-center justify-center hover:bg-[#005A58] hover:text-white transition text-gray-600" aria-label="{{ $label }}">
                                <i class="{{ $icon }} text-lg"></i>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-300 pt-8">
                <p class="text-gray-500 text-sm md:text-base">{!! isset($uiTexts['footer.copyright']) ? $uiTexts['footer.copyright']->translate() : '&copy; 2025 شركة الجود للتطوير والاستثمار العقاري. جميع الحقوق محفوظة.' !!}</p>
            </div>
        </div>
    </footer>

   <script src="{{ asset('js/final_script.js') }}"></script>
</body>
</html>


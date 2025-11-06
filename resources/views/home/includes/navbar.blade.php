<!-- Navigation -->
<nav class="nav-container navbar-transition navbar-visible">
    <div class="nav-content px-6 py-2">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="logo flex items-center gap-2">
                <a href="{{ route('welcome') }}">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Aljoud" class="h-8 w-auto logo-normal hidden" id="navbarLogo">
                    <img src="{{ asset('assets/images/logo_light.svg') }}" alt="Aljoud" class="h-8 w-auto logo-light" id="navbarLogoLight">
                </a>
                {{-- <span class="text-xl font-bold hidden sm:inline">الجود</span> --}}
            </div>
            <div class="hidden md:flex items-center gap-4 text-sm mr-2" id="desktopNav">
                <a href="{{ route('welcome') }}#home" data-target="home" class="pb-1 border-b-2 border-transparent hover:border-current transition-colors">{{ isset($uiTexts['nav.home']) ? $uiTexts['nav.home']->translate() : 'الرئيسية' }}</a>
                <a href="{{ route('welcome') }}#about" data-target="about" class="pb-1 border-b-2 border-transparent hover:border-current transition-colors">{{ isset($uiTexts['nav.about']) ? $uiTexts['nav.about']->translate() : 'من نحن' }}</a>
                <a href="{{ route('welcome') }}#services" data-target="services" class="pb-1 border-b-2 border-transparent hover:border-current transition-colors">{{ isset($uiTexts['nav.services']) ? $uiTexts['nav.services']->translate() : 'الخدمات' }}</a>
                <a href="{{ route('welcome') }}#projects" data-target="projects" class="pb-1 border-b-2 border-transparent hover:border-current transition-colors">{{ isset($uiTexts['nav.projects']) ? $uiTexts['nav.projects']->translate() : 'المشاريع' }}</a>
                <a href="{{ route('welcome') }}#contact" data-target="contact" class="pb-1 border-b-2 border-transparent hover:border-current transition-colors">{{ isset($uiTexts['nav.contact']) ? $uiTexts['nav.contact']->translate() : 'اتصل بنا' }}</a>
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
        {{-- <div class="max-w-7xl mx-auto flex gap-6 md:gap-8 text-sm">
            @if(isset($contactSettings) && $contactSettings->phone)
                <a href="tel:{{ $contactSettings->phone }}" class="hover:opacity-70 transition"><i class="fas fa-phone mr-2"></i>{{ $contactSettings->phone }}</a>
            @endif
        </div> --}}
    </div>
</nav>


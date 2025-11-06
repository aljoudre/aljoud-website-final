<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="flex justify-end mb-8">
        <button class="text-white text-3xl" id="closeSidebar">&times;</button>
    </div>
    <nav class="flex flex-col gap-4" id="mobileNav">
        <a href="{{ route('welcome') }}#home" data-target="home" class="text-white text-xl pb-1 border-b-2 border-transparent hover:border-white transition-colors">{{ isset($uiTexts['nav.home']) ? $uiTexts['nav.home']->translate() : 'الرئيسية' }}</a>
        <a href="{{ route('welcome') }}#about" data-target="about" class="text-white text-xl pb-1 border-b-2 border-transparent hover:border-white transition-colors">{{ isset($uiTexts['nav.about']) ? $uiTexts['nav.about']->translate() : 'من نحن' }}</a>
        <a href="{{ route('welcome') }}#services" data-target="services" class="text-white text-xl pb-1 border-b-2 border-transparent hover:border-white transition-colors">{{ isset($uiTexts['nav.services']) ? $uiTexts['nav.services']->translate() : 'الخدمات' }}</a>
        <a href="{{ route('welcome') }}#projects" data-target="projects" class="text-white text-xl pb-1 border-b-2 border-transparent hover:border-white transition-colors">{{ isset($uiTexts['nav.projects']) ? $uiTexts['nav.projects']->translate() : 'المشاريع' }}</a>
        <a href="{{ route('welcome') }}#contact" data-target="contact" class="text-white text-xl pb-1 border-b-2 border-transparent hover:border-white transition-colors">{{ isset($uiTexts['nav.contact']) ? $uiTexts['nav.contact']->translate() : 'اتصل بنا' }}</a>
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


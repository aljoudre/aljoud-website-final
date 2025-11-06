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
                    @if(isset($contactSettings) && $contactSettings->email)
                        <p><a href="mailto:{{ $contactSettings->email }}" class="hover:text-[#005A58] transition">{{ $contactSettings->email }}</a></p>
                    @endif
                    @if(isset($contactSettings) && $contactSettings->phone)
                        <p><a href="tel:{{ $contactSettings->phone }}" class="hover:text-[#005A58] transition">{{ $contactSettings->phone }}</a></p>
                    @endif
                    <p>الرياض، المملكة العربية السعودية</p>
                </div>
            </div>
            <div>
                <h4 class="text-lg md:text-xl font-bold mb-4">{{ isset($uiTexts['footer.follow_us']) ? $uiTexts['footer.follow_us']->translate() : 'تابعنا' }}</h4>
                <div class="flex justify-center gap-3">
                    @php
                        $footerSocial = [];
                        if (isset($contactSettings)) {
                            if ($contactSettings->facebook) $footerSocial[] = ['url' => $contactSettings->facebook, 'icon' => 'fa-brands fa-facebook-f', 'label' => 'Facebook'];
                            if ($contactSettings->twitter) $footerSocial[] = ['url' => $contactSettings->twitter, 'icon' => 'fa-brands fa-x-twitter', 'label' => 'X / Twitter'];
                            if ($contactSettings->instagram) $footerSocial[] = ['url' => $contactSettings->instagram, 'icon' => 'fa-brands fa-instagram', 'label' => 'Instagram'];
                            if ($contactSettings->linkedin) $footerSocial[] = ['url' => $contactSettings->linkedin, 'icon' => 'fa-brands fa-linkedin-in', 'label' => 'LinkedIn'];
                            if ($contactSettings->youtube) $footerSocial[] = ['url' => $contactSettings->youtube, 'icon' => 'fa-brands fa-youtube', 'label' => 'YouTube'];
                        }
                    @endphp
                    @foreach($footerSocial as $social)
                        <a href="{{ $social['url'] }}" target="_blank" rel="noopener noreferrer" class="w-11 h-11 bg-white border border-gray-200 rounded-full flex items-center justify-center hover:bg-[#005A58] hover:text-white transition text-gray-600" aria-label="{{ $social['label'] }}">
                            <i class="{{ $social['icon'] }} text-lg"></i>
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


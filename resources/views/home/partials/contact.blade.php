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
            @if(isset($contactSettings) && $contactSettings->email)
                <div>
                    <h3 class="text-xl md:text-2xl font-bold mb-2 text-[#005A58]">{{ isset($uiTexts['contact.email']) ? $uiTexts['contact.email']->translate() : 'البريد الإلكتروني' }}</h3>
                    <p class="text-base md:text-lg text-gray-700"><a href="mailto:{{ $contactSettings->email }}" class="hover:text-[#005A58] transition">{{ $contactSettings->email }}</a></p>
                </div>
            @endif
            
            @if(isset($contactSettings) && $contactSettings->phone)
                <div>
                    <h3 class="text-xl md:text-2xl font-bold mb-2 text-[#005A58]">{{ isset($uiTexts['contact.phone']) ? $uiTexts['contact.phone']->translate() : 'رقم الهاتف' }}</h3>
                    <p class="text-base md:text-lg text-gray-700"><a href="tel:{{ $contactSettings->phone }}" class="hover:text-[#005A58] transition">{{ $contactSettings->phone }}</a></p>
                </div>
            @endif
            
            @php
                $socialLinks = [];
                if (isset($contactSettings)) {
                    if ($contactSettings->facebook) $socialLinks[] = ['url' => $contactSettings->facebook, 'icon' => 'fa-brands fa-facebook-f', 'label' => 'Facebook'];
                    if ($contactSettings->twitter) $socialLinks[] = ['url' => $contactSettings->twitter, 'icon' => 'fa-brands fa-x-twitter', 'label' => 'X / Twitter'];
                    if ($contactSettings->instagram) $socialLinks[] = ['url' => $contactSettings->instagram, 'icon' => 'fa-brands fa-instagram', 'label' => 'Instagram'];
                    if ($contactSettings->linkedin) $socialLinks[] = ['url' => $contactSettings->linkedin, 'icon' => 'fa-brands fa-linkedin-in', 'label' => 'LinkedIn'];
                    if ($contactSettings->youtube) $socialLinks[] = ['url' => $contactSettings->youtube, 'icon' => 'fa-brands fa-youtube', 'label' => 'YouTube'];
                }
            @endphp
            
            @if(count($socialLinks) > 0)
                <div>
                    <h3 class="text-xl md:text-2xl font-bold mb-3 text-[#005A58]">{{ isset($uiTexts['contact.follow_us']) ? $uiTexts['contact.follow_us']->translate() : 'تابعنا' }}</h3>
                    <div class="flex gap-3 flex-wrap">
                        @foreach($socialLinks as $social)
                            <a href="{{ $social['url'] }}" target="_blank" rel="noopener noreferrer" class="w-11 h-11 bg-white border border-gray-200 rounded-full flex items-center justify-center hover:bg-[#005A58] hover:text-white transition" aria-label="{{ $social['label'] }}">
                                <i class="{{ $social['icon'] }} text-lg"></i>
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


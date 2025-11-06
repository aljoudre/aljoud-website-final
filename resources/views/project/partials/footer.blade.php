<!-- Footer -->
<footer class="bg-[#f3f2ed] py-12">
    <div class="max-w-7xl mx-auto px-4 md:px-8 text-center">
        <div class="mb-8">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Aljoud Real Estate" class="h-12 md:h-16 w-auto mx-auto mb-4">
            <p class="text-gray-600 text-sm md:text-base">{{ isset($uiTexts['footer.company_name']) ? $uiTexts['footer.company_name']->translate() : 'شركة الجود للتطوير والاستثمار العقاري' }}</p>
        </div>
        <div class="border-t border-gray-300 pt-8">
            <p class="text-gray-500 text-sm md:text-base">{!! isset($uiTexts['footer.copyright']) ? $uiTexts['footer.copyright']->translate() : '&copy; 2025 شركة الجود للتطوير والاستثمار العقاري. جميع الحقوق محفوظة.' !!}</p>
        </div>
    </div>
</footer>


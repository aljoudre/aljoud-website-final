<!-- Interest Registration Button -->
@php
    $interestButton = $project->buttons->where('type', 'form')->first();
@endphp

@if($interestButton && $interestButton->form_url)
    <section class="py-12 md:py-16 bg-[#f8f7f3]">
        <div class="max-w-3xl mx-auto px-4 md:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-[#005A58] mb-4">سجل اهتمامك</h2>
            <p class="text-gray-600 mb-8">انقر على الزر أدناه لتسجيل اهتمامك في هذا المشروع</p>
            <a href="{{ $interestButton->form_url }}" target="_blank" class="inline-block px-12 py-5 bg-[#005A58] text-white rounded-lg font-bold text-lg hover:opacity-90 transition shadow-lg">
                {{ $interestButton->translate('title') }}
            </a>
        </div>
    </section>
@endif


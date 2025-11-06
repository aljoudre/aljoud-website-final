<!-- Minimal Layout (No header image, just title) -->
<section class="py-12 md:py-20 bg-[#f8f7f3]">
    <div class="max-w-4xl mx-auto px-4 md:px-8 text-center">
        <h1 class="text-4xl md:text-7xl font-bold text-[#005A58] mb-4">{{ $project->translate('name') }}</h1>
        <h2 class="text-2xl md:text-4xl font-light text-gray-700 mb-6">{{ $project->translate('subtitle') }}</h2>
        @if($project->header_description)
            <p class="text-lg md:text-xl text-gray-700 mb-8 leading-relaxed">
                {{ $project->translate('header_description') }}
            </p>
        @endif
        @if($project->external_website_url)
            <a href="{{ $project->external_website_url }}" target="_blank" class="inline-block px-8 py-4 bg-[#005A58] text-white rounded-lg font-bold hover:opacity-90 transition">
                زيارة الموقع الخارجي
            </a>
        @endif
    </div>
</section>


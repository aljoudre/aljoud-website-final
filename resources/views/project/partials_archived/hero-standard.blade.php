<!-- Standard Layout (Full hero with image) -->
<section class="relative {{ $hasHeaderImage && $headerImage ? 'h-screen' : 'py-20' }} overflow-hidden bg-[#f8f7f3]">
    @if($hasHeaderImage && $headerImage)
        <div class="absolute inset-0">
            <img src="{{ $headerImage }}" alt="{{ $project->translate('name') }}" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/40 to-transparent"></div>
        </div>
    @endif
    <div class="{{ $hasHeaderImage && $headerImage ? 'relative z-10 h-full flex items-center justify-center' : '' }} px-4">
        <div class="max-w-4xl mx-auto text-center {{ $hasHeaderImage && $headerImage ? 'text-white' : 'text-[#005A58]' }}">
            <h1 class="text-4xl md:text-7xl font-bold mb-4">{{ $project->translate('name') }}</h1>
            <h2 class="text-2xl md:text-4xl font-light mb-6">{{ $project->translate('subtitle') }}</h2>
            @if($project->header_description)
                <p class="text-lg md:text-xl mb-8 max-w-2xl mx-auto leading-relaxed">
                    {{ $project->translate('header_description') }}
                </p>
            @else
                <p class="text-lg md:text-xl mb-8 max-w-2xl mx-auto leading-relaxed">
                    {{ $project->translate('location') }}
                </p>
            @endif
            @if($project->external_website_url)
                <a href="{{ $project->external_website_url }}" target="_blank" class="inline-block px-8 py-4 bg-[#005A58] text-white rounded-lg font-bold hover:opacity-90 transition">
                    زيارة الموقع الخارجي
                </a>
            @endif
        </div>
    </div>
</section>


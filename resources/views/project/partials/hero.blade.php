<!-- Hero Section -->
<section class="relative {{ $hasHeroImage ? 'h-screen overflow-hidden' : 'py-16 md:py-24 bg-[#f8f7f3]' }}">
    @if($hasHeroImage)
        <div class="absolute inset-0">
            <img src="{{ $heroImage }}" alt="{{ $project->translate('name') }}" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
        </div>
    @endif
    <div class="relative z-10 {{ $hasHeroImage ? 'h-full flex items-center justify-center' : '' }} px-4 md:px-8">
        <div class="{{ $hasHeroImage ? 'bg-white/20 backdrop-blur-md px-8 md:px-12 py-6 md:py-8 rounded-2xl border border-white/30 shadow-2xl' : '' }} max-w-7xl w-full mx-auto">
            <div class="flex flex-col md:flex-row items-center justify-center gap-4 md:gap-6 {{ $hasHeroImage ? 'text-white' : 'text-[#005A58]' }}">
                @if($projectLogo)
                    <div class="flex-shrink-0">
                        <img src="{{ $projectLogo }}" alt="{{ $project->translate('name') }}" class="h-16 md:h-24 w-auto">
                    </div>
                @endif
                <div class="text-center md:text-right">
                    <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold">{{ $project->translate('name') }}</h1>
                    @if($project->translate('subtitle'))
                        <p class="{{ $hasHeroImage ? 'text-white/90' : 'text-gray-600' }} text-lg md:text-xl mt-2">{{ $project->translate('subtitle') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>


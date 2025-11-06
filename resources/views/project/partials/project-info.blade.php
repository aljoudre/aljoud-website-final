<!-- Project Stats & Description Section -->
<section class="py-12 md:py-16 bg-[#f8f7f3]">
    <div class="max-w-7xl mx-auto px-4 md:px-8">
        <div class="grid md:grid-cols-2 gap-8 md:gap-12 items-start">
            <!-- Stats Grid (Left Side) -->
            @if($project->stats && $project->stats->count() > 0)
                <div class="grid grid-cols-2 gap-6 md:gap-8">
                    @foreach($project->stats as $stat)
                        <div class="flex flex-col">
                            <div class="text-3xl md:text-4xl font-bold text-[#005A58] mb-2">
                                {{ $stat->value }}
                            </div>
                            <div class="text-sm md:text-base text-gray-700 leading-relaxed">
                                {{ $stat->translate('title') }}
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Placeholder if no stats -->
                <div class="grid grid-cols-2 gap-6 md:gap-8">
                    <div class="flex flex-col">
                        <div class="text-3xl md:text-4xl font-bold text-[#005A58] mb-2">0</div>
                        <div class="text-sm md:text-base text-gray-700">م2 مساحة الأرض السكنية</div>
                    </div>
                    <div class="flex flex-col">
                        <div class="text-3xl md:text-4xl font-bold text-[#005A58] mb-2">0</div>
                        <div class="text-sm md:text-base text-gray-700">م2 مساحة الأرض التجارية</div>
                    </div>
                </div>
            @endif
            
            <!-- Project Description (Right Side - RTL) -->
            @if($project->description)
                <div class="rtl text-right">
                    <div class="prose prose-lg max-w-none">
                        <p class="text-gray-700 text-lg leading-relaxed whitespace-pre-line">{{ $project->translate('description') }}</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>

<!-- Logos Section -->
@if(($ownerLogo && $project->translate('owner')) || ($developerLogo && $project->translate('developer')) || ($contractorLogo && $project->translate('contractor')))
<section class="py-12 md:py-16">
    <div class="max-w-7xl mx-auto px-4 md:px-8">
        <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
            @if($ownerLogo && $project->translate('owner'))
                <div class="flex flex-col items-center justify-center">
                    <img src="{{ $ownerLogo }}" alt="Owner Logo" class="h-16 w-auto mb-3">
                    <p class="text-xs text-gray-600 mb-1">{{ isset($uiTexts['project.owner']) ? $uiTexts['project.owner']->translate() : 'المالك' }}</p>
                    <h3 class="text-sm font-semibold text-[#005A58]">{{ $project->translate('owner') }}</h3>
                </div>
            @endif
            @if($developerLogo && $project->translate('developer'))
                <div class="flex flex-col items-center justify-center">
                    <img src="{{ $developerLogo }}" alt="Developer Logo" class="h-16 w-auto mb-3">
                    <p class="text-xs text-gray-600 mb-1">{{ isset($uiTexts['project.developer']) ? $uiTexts['project.developer']->translate() : 'المطور' }}</p>
                    <h3 class="text-sm font-semibold text-[#005A58]">{{ $project->translate('developer') }}</h3>
                </div>
            @endif
            @if($contractorLogo && $project->translate('contractor'))
                <div class="flex flex-col items-center justify-center">
                    <img src="{{ $contractorLogo }}" alt="Contractor Logo" class="h-16 w-auto mb-3">
                    <p class="text-xs text-gray-600 mb-1">{{ isset($uiTexts['project.contractor']) ? $uiTexts['project.contractor']->translate() : 'المقاول' }}</p>
                    <h3 class="text-sm font-semibold text-[#005A58]">{{ $project->translate('contractor') }}</h3>
                </div>
            @endif
        </div>
    </div>
</section>
@endif


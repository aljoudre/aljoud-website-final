<!-- Project Description -->
@if($project->description)
    <section class="py-12 md:py-16 bg-[#f8f7f3]">
        <div class="max-w-7xl mx-auto px-4 md:px-8">
            <h2 class="text-3xl md:text-5xl font-bold text-[#005A58] mb-8 text-center md:text-right">{{ $project->translate('name') }}</h2>
            
            @php
                $hasOwner = $project->owner && !empty($project->translate('owner'));
                $hasDeveloper = $project->developer && !empty($project->translate('developer'));
                $hasContractor = $project->contractor && !empty($project->translate('contractor'));
                
                // Get project logo
                $projectLogo = null;
                try {
                    $projectLogoMedia = $project->getFirstMedia('project_logo');
                    if ($projectLogoMedia) {
                        $projectLogo = $projectLogoMedia->getUrl();
                    }
                } catch (\Exception $e) {}
                
                // Use placeholder if no logo
                if (!$projectLogo) {
                    $projectName = substr($project->translate('name'), 0, 2);
                    $projectLogo = "https://placehold.co/200x200/005A58/ffffff?text=" . urlencode($projectName);
                }
                
                // Get owner logo
                $ownerLogo = null;
                if ($hasOwner) {
                    try {
                        $ownerLogoMedia = $project->getFirstMedia('owner_logo');
                        if ($ownerLogoMedia) {
                            $ownerLogo = $ownerLogoMedia->getUrl();
                        }
                    } catch (\Exception $e) {}
                    
                    if (!$ownerLogo && $project->translate('owner')) {
                        $ownerName = substr($project->translate('owner'), 0, 2);
                        $ownerLogo = "https://placehold.co/150x150/005A58/ffffff?text=" . urlencode($ownerName);
                    } else if (!$ownerLogo) {
                        $ownerLogo = "https://placehold.co/150x150/005A58/ffffff?text=LOGO";
                    }
                }
                
                // Get developer logo
                $developerLogo = null;
                if ($hasDeveloper) {
                    try {
                        $developerLogoMedia = $project->getFirstMedia('developer_logo');
                        if ($developerLogoMedia) {
                            $developerLogo = $developerLogoMedia->getUrl();
                        }
                    } catch (\Exception $e) {}
                    
                    if (!$developerLogo && $project->translate('developer')) {
                        $developerName = substr($project->translate('developer'), 0, 2);
                        $developerLogo = "https://placehold.co/150x150/005A58/ffffff?text=" . urlencode($developerName);
                    } else if (!$developerLogo) {
                        $developerLogo = "https://placehold.co/150x150/005A58/ffffff?text=LOGO";
                    }
                }
                
                // Get contractor logo
                $contractorLogo = null;
                if ($hasContractor) {
                    try {
                        $contractorLogoMedia = $project->getFirstMedia('contractor_logo');
                        if ($contractorLogoMedia) {
                            $contractorLogo = $contractorLogoMedia->getUrl();
                        }
                    } catch (\Exception $e) {}
                    
                    if (!$contractorLogo && $project->translate('contractor')) {
                        $contractorName = substr($project->translate('contractor'), 0, 2);
                        $contractorLogo = "https://placehold.co/150x150/005A58/ffffff?text=" . urlencode($contractorName);
                    } else if (!$contractorLogo) {
                        $contractorLogo = "https://placehold.co/150x150/005A58/ffffff?text=LOGO";
                    }
                }
                
                $hasCompanyLogos = $hasOwner || $hasDeveloper || $hasContractor;
            @endphp
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 items-start">
                <!-- Left Side: Logos Grid (1/4 width) -->
                <div class="md:col-span-1 space-y-6">
                    <!-- Project Logo (Bigger) -->
                    <div class="p-6 text-center flex flex-col items-center justify-center">
                        <img src="{{ $projectLogo }}" alt="{{ $project->translate('name') }}" class="h-32 md:h-40 w-auto mb-4 object-contain" onerror="this.src='https://placehold.co/200x200/005A58/ffffff?text=LOGO'">
                        <h3 class="font-bold text-lg md:text-xl text-[#005A58]">{{ $project->translate('name') }}</h3>
                    </div>
                    
                    <!-- Company Logos (Owner, Developer, Contractor) -->
                    @if($hasCompanyLogos)
                        <div class="grid grid-cols-{{ $hasOwner + $hasDeveloper + $hasContractor <= 2 ? ($hasOwner + $hasDeveloper + $hasContractor) : '3' }} gap-4">
                            @if($hasOwner)
                                <div class="p-4 text-center flex flex-col items-center justify-center">
                                    <img src="{{ $ownerLogo }}" alt="{{ $project->translate('owner') }}" class="h-12 md:h-16 w-auto mb-2 object-contain" onerror="this.src='https://placehold.co/150x150/005A58/ffffff?text=LOGO'">
                                    <h4 class="font-bold text-sm text-[#005A58] mb-1">{{ isset($uiTexts['project.owner']) ? $uiTexts['project.owner']->translate() : 'المالك' }}</h4>
                                    <p class="text-xs text-gray-600">@php echo mb_strlen($project->translate('owner')) > 15 ? mb_substr($project->translate('owner'), 0, 15) . '...' : $project->translate('owner'); @endphp</p>
                                </div>
                            @endif
                            
                            @if($hasDeveloper)
                                <div class="p-4 text-center flex flex-col items-center justify-center">
                                    <img src="{{ $developerLogo }}" alt="{{ $project->translate('developer') }}" class="h-12 md:h-16 w-auto mb-2 object-contain" onerror="this.src='https://placehold.co/150x150/005A58/ffffff?text=LOGO'">
                                    <h4 class="font-bold text-sm text-[#005A58] mb-1">{{ isset($uiTexts['project.developer']) ? $uiTexts['project.developer']->translate() : 'المطور' }}</h4>
                                    <p class="text-xs text-gray-600">@php echo mb_strlen($project->translate('developer')) > 15 ? mb_substr($project->translate('developer'), 0, 15) . '...' : $project->translate('developer'); @endphp</p>
                                </div>
                            @endif
                            
                            @if($hasContractor)
                                <div class="p-4 text-center flex flex-col items-center justify-center">
                                    <img src="{{ $contractorLogo }}" alt="{{ $project->translate('contractor') }}" class="h-12 md:h-16 w-auto mb-2 object-contain" onerror="this.src='https://placehold.co/150x150/005A58/ffffff?text=LOGO'">
                                    <h4 class="font-bold text-sm text-[#005A58] mb-1">{{ isset($uiTexts['project.contractor']) ? $uiTexts['project.contractor']->translate() : 'المقاول' }}</h4>
                                    <p class="text-xs text-gray-600">@php echo mb_strlen($project->translate('contractor')) > 15 ? mb_substr($project->translate('contractor'), 0, 15) . '...' : $project->translate('contractor'); @endphp</p>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
                
                <!-- Right Side: Description (3/4 width) -->
                <div class="md:col-span-3">
                    <div class="text-lg md:text-xl text-gray-700 leading-relaxed whitespace-pre-line">
                        {{ $project->translate('description') }}
                    </div>
                    
                    @if($project->buttons->count() > 0)
                        {{-- Show action buttons from database --}}
                        <div class="flex flex-wrap justify-start gap-4 mt-8">
                            @foreach($project->buttons as $button)
                                @php
                                    $buttonUrl = '#';
                                    $target = '_self';
                                    
                                    switch($button->type) {
                                        case 'website':
                                            $buttonUrl = $project->external_website_url ?? '#';
                                            $target = '_blank';
                                            break;
                                        case '360_tour':
                                            $buttonUrl = $button->url ?? '#tour';
                                            $target = '_self';
                                            break;
                                        case 'form':
                                            $buttonUrl = $button->form_url ?? '#';
                                            $target = '_blank';
                                            break;
                                        case 'external_url':
                                        default:
                                            $buttonUrl = $button->url ?? '#';
                                            $target = '_blank';
                                            break;
                                    }
                                @endphp
                                <a href="{{ $buttonUrl }}" target="{{ $target }}" class="px-8 py-4 bg-[#005A58] text-white rounded-lg font-bold hover:opacity-90 transition">
                                    {{ $button->translate('title') }}
                                </a>
                            @endforeach
                        </div>
                    @elseif(isset($layout) && $layout === 'standard')
                        {{-- Default buttons if none configured --}}
                        <div class="flex flex-wrap justify-start gap-4 mt-8">
                            <a href="#features" class="px-8 py-4 bg-[#005A58] text-white rounded-lg font-bold hover:opacity-90 transition">استكشف المرافق</a>
                            @if($project->enable_3d_tour)
                                <a href="#tour" class="px-8 py-4 bg-white border-2 border-[#005A58] text-[#005A58] rounded-lg font-bold hover:bg-[#005A58] hover:text-white transition">جولة 360°</a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endif

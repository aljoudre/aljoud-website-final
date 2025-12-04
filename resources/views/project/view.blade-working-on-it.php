@php
    // Get hero image
    $heroImage = null;
    $hasHeroImage = false;
    try {
        $headerMedia = $project->getFirstMedia('header_image');
        if (!$headerMedia) {
            $headerMedia = $project->getFirstMedia('project_hero');
        }
        if (!$headerMedia) {
            $headerMedia = $project->getFirstMedia('project_image');
        }
        if ($headerMedia) {
            $heroImage = $headerMedia->getUrl();
            $hasHeroImage = true;
        }
    } catch (\Exception $e) {}
    
    // Get gallery images
    $galleryImages = [];
    try {
        $gallery = $project->getMedia('project_gallery');
        if ($gallery->count() > 0) {
            foreach ($gallery as $media) {
                $galleryImages[] = $media->getUrl();
            }
        }
    } catch (\Exception $e) {
        // Silently handle media library errors
    }
    
    // Get logos
    $projectLogo = null;
    $ownerLogo = null;
    $developerLogo = null;
    $contractorLogo = null;
    try {
        $projectLogoMedia = $project->getFirstMedia('project_logo');
        if ($projectLogoMedia) $projectLogo = $projectLogoMedia->getUrl();
        
        $ownerLogoMedia = $project->getFirstMedia('owner_logo');
        if ($ownerLogoMedia) $ownerLogo = $ownerLogoMedia->getUrl();
        
        $developerLogoMedia = $project->getFirstMedia('developer_logo');
        if ($developerLogoMedia) $developerLogo = $developerLogoMedia->getUrl();
        
        $contractorLogoMedia = $project->getFirstMedia('contractor_logo');
        if ($contractorLogoMedia) $contractorLogo = $contractorLogoMedia->getUrl();
    } catch (\Exception $e) {}
@endphp

@include('project.partials.head')

@include('project.partials.navigation')

@include('project.partials.project-data')

@include('project.partials.hero')

@include('project.partials.project-info')

@include('project.partials.location')

@include('project.partials.gallery')

@include('project.partials.interest-button')

@include('project.partials.footer')

@include('project.partials.scripts')

@include('project.partials.map-scripts')

@include('project.partials.gallery-scripts')

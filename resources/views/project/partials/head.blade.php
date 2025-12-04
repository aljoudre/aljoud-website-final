<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    @php
        $projectImage = asset('assets/images/logo.png');
        try {
            $imageMedia = $project->getFirstMedia('project_image');
            if ($imageMedia) {
                $projectImage = $imageMedia->getUrl();
            }
        } catch (\Exception $e) {}
        
        $projectDescription = $project->translate('description');
        if (empty($projectDescription)) {
            $projectDescription = $project->translate('subtitle');
        }
        if (empty($projectDescription)) {
            $projectDescription = 'مشروع عقاري متميز من شركة الجود للتطوير والاستثمار العقاري';
        }
        
        $seoData = [
            'title' => $project->translate('name') . ' - Aljoud Real Estate',
            'description' => strip_tags($projectDescription),
            'keywords' => $project->translate('name') . '، ' . $project->translate('location') . '، ' . $project->translate('type') . '، عقارات، استثمار عقاري',
            'image' => $projectImage,
            'url' => route('projects.show', $project->uuid),
            'type' => 'article',
        ];
        
        $structuredData = [
            '@context' => 'https://schema.org',
            '@type' => 'RealEstateAgent',
            'name' => $project->translate('name'),
            'description' => strip_tags($projectDescription),
            'image' => $projectImage,
            'url' => route('projects.show', $project->uuid),
            'address' => [
                '@type' => 'PostalAddress',
                'addressLocality' => $project->translate('location'),
                'addressCountry' => 'SA',
            ],
        ];
    @endphp
    
    <x-seo-meta :seoData="$seoData" :canonicalUrl="route('projects.show', $project->uuid)" />
    <!-- Professional Fonts: Cairo for Arabic/English -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Cairo', 'sans-serif'],
                    },
                },
            },
        };
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/final_style.css') }}">
    <style>
        * {
            direction: rtl !important;
        }
        .gallery-container {
            scroll-snap-type: x mandatory;
            -webkit-overflow-scrolling: touch;
        }
        .gallery-item {
            scroll-snap-align: center;
        }
        .gallery-container::-webkit-scrollbar {
            display: none;
        }
        .amenity-card {
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .amenity-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 90, 88, 0.15);
        }
        .stat-card {
            background: linear-gradient(135deg, #005A58 0%, #004a40 100%);
        }
    </style>
    
    <x-structured-data :structuredData="$structuredData" />
</head>
<body class="bg-[#f8f7f3]">


<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $categoryName }} - Aljoud Real Estate</title>
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
        .project-card {
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .project-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body class="bg-[#f8f7f3]">

@include('project.partials.navigation')

<!-- Category Header -->
<section class="relative h-[400px] overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-[#005A58] to-[#003f3d]">
        <div class="absolute inset-0 bg-black/20"></div>
    </div>
    <div class="relative z-10 flex flex-col items-center justify-center h-full">
        {{-- <a href="{{ route('welcome') }}#projects" class="absolute top-8 right-8 flex items-center gap-2 text-white hover:text-gray-200 transition">
            <i class="fas fa-arrow-right"></i>
            <span>العودة إلى المشاريع</span>
        </a> --}}
        <div class="text-center text-white px-4">
            <h1 class="text-4xl md:text-6xl font-bold mb-4">{{ $categoryName }}</h1>
            <p class="text-xl md:text-2xl text-white/90">
                {{ isset($uiTexts['category.description']) ? $uiTexts['category.description']->translate() : 'استكشف مشاريعنا المتميزة' }}
            </p>
        </div>
    </div>
</section>

<!-- Projects Grid -->
<section class="py-12 md:py-16">
    <div class="max-w-7xl mx-auto px-4 md:px-8">
        @if($projects->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
              
                @foreach($projects as $project)
                    @php
                        $projectImage = asset('assets/images/logo.png');
                        try {
                            $imageMedia = $project->getFirstMedia('project_image');
                            if ($imageMedia) {
                                $projectImage = $imageMedia->getUrl();
                            }
                        } catch (\Exception $e) {}
                    @endphp
                    
                    <a href="{{ route('projects.show', $project->uuid) }}" class="block">
                        <div class="project-card bg-white rounded-2xl overflow-hidden shadow-lg">
                            <!-- Image -->
                            <div class="relative h-64 overflow-hidden">
                                <img src="{{ $projectImage }}" alt="{{ $project->translate('name') }}" class="w-full h-full object-cover">
                                <div class="absolute top-4 left-4">
                                    <span class="text-white text-xs font-semibold px-3 py-1 rounded-full" style="background-color: {{ $project->status_color ?? '#6B7280' }};">
                                        {{ $project->translate('status') }}
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Content -->
                            <div class="p-6">
                                
                                <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $project->translate('name') }}</h3>
                                <p class="text-s font-bold text-gray-900 mb-2">{{ $projectImage }}</p>
                                <p class="text-s font-bold text-gray-900 mb-2">{{ $project->getFirstMedia('project_image') }}</p>



                                <div class="flex items-center text-gray-600 mb-4">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <span class="text-sm">{{ $project->translate('location') }}</span>
                                </div>
                                <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $project->translate('subtitle') }}</p>
                                <div class="flex items-center justify-between">
                                    <span class="text-[#005A58] font-semibold">{{ $project->translate('type') }}</span>
                                    <span class="text-gray-400 text-sm">{{ $project->created_at->format('Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-16">
                <i class="fas fa-folder-open text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-2xl font-bold text-gray-700 mb-2">لا توجد مشاريع</h3>
                <p class="text-gray-500">{{ isset($uiTexts['category.no_projects']) ? $uiTexts['category.no_projects']->translate() : 'لا توجد مشاريع متاحة في هذه الفئة حالياً' }}</p>
            </div>
        @endif
    </div>
</section>

@include('project.partials.footer')

@include('project.partials.scripts')

</body>
</html>


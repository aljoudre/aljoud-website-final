@php
    $privacyTitle = $privacy ? $privacy->translate('title') : 'سياسة الخصوصية';
    $privacyDescription = $privacy ? strip_tags(\Filament\Forms\Components\RichEditor\RichContentRenderer::make($privacy->translate('content'))->toHtml()) : 'سياسة الخصوصية لشركة الجود للتطوير والاستثمار العقاري';
    $privacyDescription = mb_substr($privacyDescription, 0, 160);
    
    $seoData = [
        'title' => $privacyTitle . ' - Aljoud Real Estate',
        'description' => $privacyDescription,
        'keywords' => 'سياسة الخصوصية، الجود، عقارات، شركة الجود',
        'image' => asset('assets/images/logo.png'),
        'url' => route('privacy'),
        'type' => 'article',
    ];
    
    $structuredData = [
        '@context' => 'https://schema.org',
        '@type' => 'WebPage',
        'name' => $privacyTitle,
        'description' => $privacyDescription,
        'url' => route('privacy'),
    ];
@endphp

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <x-seo-meta :seoData="$seoData" :canonicalUrl="route('privacy')" />
    
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
    <style>
        * {
            direction: rtl !important;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/final_style.css') }}">
    
    <x-structured-data :structuredData="$structuredData" />
</head>
<body>

@include('home.includes.navbar')

@include('home.includes.sidebar')

    <!-- Privacy Policy Content -->
    <div class="max-w-4xl mx-auto px-4 md:px-8 py-12 md:py-16">
        <div class="bg-white rounded-lg shadow-lg p-6 md:p-10">
            @if($privacy)
                <h1 class="text-3xl md:text-4xl font-bold text-[#005A58] mb-8 text-center">{{ $privacy->translate('title') ?: 'سياسة الخصوصية' }}</h1>
                
                <div class="space-y-6 text-gray-700 leading-relaxed rtl prose prose-lg max-w-none">
                    {!! \Filament\Forms\Components\RichEditor\RichContentRenderer::make($privacy->translate('content'))->toHtml() !!}
                </div>

                <div class="border-t pt-6 mt-8">
                    <p class="text-sm text-gray-500">
                        <strong>آخر تحديث:</strong> {{ $privacy->updated_at->format('Y-m-d') }}
                    </p>
                </div>
            @else
                <h1 class="text-3xl md:text-4xl font-bold text-[#005A58] mb-8 text-center">سياسة الخصوصية</h1>
                <div class="text-center text-gray-500 py-8">
                    <p>لم يتم إعداد محتوى سياسة الخصوصية بعد.</p>
                    <p class="text-sm mt-2">يرجى إضافة المحتوى من لوحة التحكم.</p>
                </div>
            @endif
        </div>
    </div>

@include('home.includes.footer')

@include('home.includes.scripts')


<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    @php
        $seoData = [
            'title' => 'Aljoud Real Estate - شركة الجود للتطوير والاستثمار العقاري',
            'description' => 'شركة الجود للتطوير والاستثمار العقاري - مشاريع عقارية متميزة في المملكة العربية السعودية. استكشف مشاريعنا السكنية والتجارية والأراضي والمزادات.',
            'keywords' => 'عقارات، استثمار عقاري، تطوير عقاري، مشاريع سكنية، مشاريع تجارية، أراضي، مزادات، السعودية، الرياض',
            'image' => asset('assets/images/logo.png'),
            'url' => url('/'),
            'type' => 'website',
        ];
        $structuredData = [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => 'الجود للتطوير والاستثمار العقاري',
            'alternateName' => 'Aljoud Real Estate',
            'url' => url('/'),
            'logo' => asset('assets/images/logo.png'),
            'description' => 'شركة الجود للتطوير والاستثمار العقاري - مشاريع عقارية متميزة',
            'address' => [
                '@type' => 'PostalAddress',
                'addressLocality' => 'الرياض',
                'addressCountry' => 'SA',
            ],
        ];
        if (isset($contactSettings)) {
            if ($contactSettings->phone) {
                $structuredData['telephone'] = $contactSettings->phone;
            }
            if ($contactSettings->email) {
                $structuredData['email'] = $contactSettings->email;
            }
        }
    @endphp
    
    <x-seo-meta :seoData="$seoData" />
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
    @php
        use Illuminate\Support\Str;
    @endphp
    <link rel="stylesheet" href="{{ asset('css/final_style.css') }}">
    
    <x-structured-data :structuredData="$structuredData" />
</head>
<body>


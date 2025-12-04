@php
    $seo = \App\Helpers\SeoHelper::metaTags($seoData ?? []);
    $currentUrl = url()->current();
    $canonicalUrl = $canonicalUrl ?? $currentUrl;
@endphp

<!-- Primary Meta Tags -->
<title>{{ $seo['title'] }}</title>
<meta name="title" content="{{ $seo['title'] }}">
<meta name="description" content="{{ $seo['description'] }}">
@if(isset($seo['keywords']))
<meta name="keywords" content="{{ $seo['keywords'] }}">
@endif
<meta name="author" content="{{ $seo['site_name'] }}">
<link rel="canonical" href="{{ $canonicalUrl }}">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="{{ $seo['type'] }}">
<meta property="og:url" content="{{ $seo['url'] }}">
<meta property="og:title" content="{{ $seo['title'] }}">
<meta property="og:description" content="{{ $seo['description'] }}">
<meta property="og:image" content="{{ $seo['image'] }}">
<meta property="og:site_name" content="{{ $seo['site_name'] }}">
<meta property="og:locale" content="{{ $seo['locale'] === 'ar' ? 'ar_SA' : 'en_US' }}">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="{{ $seo['url'] }}">
<meta property="twitter:title" content="{{ $seo['title'] }}">
<meta property="twitter:description" content="{{ $seo['description'] }}">
<meta property="twitter:image" content="{{ $seo['image'] }}">

<!-- Additional Meta Tags -->
<meta name="robots" content="index, follow">
<meta name="language" content="{{ $seo['locale'] }}">
<meta name="revisit-after" content="7 days">
<meta name="theme-color" content="#005A58">


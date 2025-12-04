<!-- Hero Section -->
<section id="home" class="relative flex items-center justify-start">
    <div class="hero-bg">
        @php
            $heroVideo = null;
            $heroImage = null;
            if ($hero) {
                // Use media URL field directly to avoid media library issues
                if ($hero->media) {
                    $heroImage = $hero->media;
                }
            }
        @endphp
        @if($hero->is_video)
            <video autoplay loop muted playsinline class="active">
                <source src="{{ $heroVideo }}" type="video/mp4">
            </video>
        @elseif($heroImage)
            <img src="{{ $heroImage }}" alt="Aljoud Real Estate" class="active">
        @else
            <img src="https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=1920&q=80" alt="Aljoud Real Estate" class="active">
        @endif
    </div>
    <div class="relative z-10 max-w-2xl ml-3 md:ml-16 p-4 md:p-8 bg-black/40 backdrop-blur-sm rounded-2xl mx-3 md:mx-0">
        <h1 class="text-2xl md:text-6xl font-bold mb-3 md:mb-4 text-white leading-tight">{{ $hero && isset($hero->title) ? $hero->translate('title') : 'شريككم نحو تحقيق الأحلام العقارية' }}</h1>
        <p class="text-base md:text-xl text-gray-200">{{ $hero && isset($hero->subtitle) ? $hero->translate('subtitle') : 'الجود.. رمز الإبداع العقاري والاستثمار الواعد' }}</p>
    </div>
</section>


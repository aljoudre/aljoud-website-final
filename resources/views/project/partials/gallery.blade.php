<!-- Gallery Section -->
@if(isset($galleryImages) && is_array($galleryImages) && count($galleryImages) > 0)
<section class="py-12 md:py-16 bg-[#f8f7f3]">
    <div class="max-w-7xl mx-auto px-4 md:px-8">
        <h2 class="text-3xl md:text-5xl font-bold text-[#005A58] mb-8 text-center">{{ isset($uiTexts['project.gallery']) ? $uiTexts['project.gallery']->translate() : 'معرض الصور' }}</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-0">
            @foreach($galleryImages as $index => $image)
                <div class="aspect-square overflow-hidden cursor-pointer gallery-item" data-index="{{ $index }}">
                    <img src="{{ $image }}" alt="Gallery Image {{ $index + 1 }}" class="w-full h-full object-cover hover:scale-110 transition-transform duration-300">
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Gallery Modal -->
<div id="galleryModal" class="fixed inset-0 bg-black/95 z-50 hidden items-center justify-center">
    <button id="closeModal" class="absolute top-6 left-6 text-white text-3xl hover:text-gray-300 transition">
        <i class="fas fa-times"></i>
    </button>
    <button id="prevImage" class="absolute right-6 top-1/2 -translate-y-1/2 text-white text-4xl hover:text-gray-300 transition">
        <i class="fas fa-chevron-right"></i>
    </button>
    <button id="nextImage" class="absolute left-6 top-1/2 -translate-y-1/2 text-white text-4xl hover:text-gray-300 transition">
        <i class="fas fa-chevron-left"></i>
    </button>
    <div class="max-w-7xl mx-auto px-4">
        <img id="modalImage" src="" alt="Gallery Image" class="max-h-[90vh] w-auto mx-auto rounded-lg">
    </div>
    <div class="absolute bottom-6 left-1/2 -translate-x-1/2 text-white text-lg">
        <span id="imageCounter"></span>
    </div>
</div>
@endif


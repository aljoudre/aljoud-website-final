<!-- Gallery Section (Always show with placeholders if needed) -->
<section class="py-12 md:py-16 bg-black">
    <div class="gallery-container flex overflow-x-auto h-[60vh] md:h-[80vh] snap-x">
        @foreach($galleryImages as $image)
            <div class="gallery-item flex-shrink-0 w-full md:w-1/2 lg:w-1/3 h-full">
                <img src="{{ $image }}" alt="Gallery Image" class="w-full h-full object-cover">
            </div>
        @endforeach
    </div>
    
    <!-- Gallery Indicators -->
    <div class="flex justify-center gap-2 mt-6" id="galleryIndicators">
        @for($i = 0; $i < count($galleryImages); $i++)
            <div class="w-8 h-1 rounded-full {{ $i === 0 ? 'bg-[#005A58]' : 'bg-gray-400' }} transition-colors"></div>
        @endfor
    </div>
</section>


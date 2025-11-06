<!-- Near Places Section (Always show) -->
<section class="py-12 md:py-16 bg-[#f8f7f3]">
    <div class="max-w-7xl mx-auto px-4 md:px-8">
        <h2 class="text-3xl md:text-5xl font-bold text-center text-[#005A58] mb-12">مواقع قريبة</h2>
        <div class="grid md:grid-cols-3 gap-6">
            @if($project->nearPlaces->count() > 0)
                {{-- Show database near places --}}
                @foreach($project->nearPlaces as $place)
                    <div class="bg-white p-6 rounded-xl shadow-lg">
                        <h3 class="font-bold text-xl text-[#005A58] mb-3">{{ $place->translate('name') }}</h3>
                        @if($place->description)
                            <p class="text-gray-700">{{ $place->translate('description') }}</p>
                        @endif
                    </div>
                @endforeach
            @else
                {{-- Show default placeholder near places from partial --}}
                @include('project.partials.default-near-places')
            @endif
        </div>
    </div>
</section>


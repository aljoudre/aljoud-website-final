<!-- 360 Tour Section -->
@if($project->enable_3d_tour && $project->tour_360_url && $layout !== 'villa')
    <section class="py-12 md:py-16 bg-black">
        <div class="max-w-7xl mx-auto px-4 md:px-8">
            <h2 class="text-3xl md:text-5xl font-bold text-center text-white mb-8">جولة 360°</h2>
            <div class="max-w-5xl mx-auto">
                {!! $project->tour_360_url !!}
            </div>
        </div>
    </section>
@endif


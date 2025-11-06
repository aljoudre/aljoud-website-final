<!-- Statistics Section -->
@if($project->total_area || $project->building_area || $project->total_units || $project->market_value)
    <section class="py-12 md:py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 md:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @if($project->total_area)
                    <div class="stat-card text-white p-6 rounded-xl text-center">
                        <h3 class="text-4xl md:text-6xl font-bold mb-2">{{ number_format($project->total_area) }}</h3>
                        <p class="text-sm md:text-base opacity-90">المساحة (متر مربع)</p>
                    </div>
                @endif
                @if($project->building_area)
                    <div class="stat-card text-white p-6 rounded-xl text-center">
                        <h3 class="text-4xl md:text-6xl font-bold mb-2">{{ number_format($project->building_area) }}</h3>
                        <p class="text-sm md:text-base opacity-90">مسطح البناء (متر مربع)</p>
                    </div>
                @endif
                @if($project->total_units)
                    <div class="stat-card text-white p-6 rounded-xl text-center">
                        <h3 class="text-4xl md:text-6xl font-bold mb-2">{{ number_format($project->total_units) }}</h3>
                        <p class="text-sm md:text-base opacity-90">وحدة</p>
                    </div>
                @endif
                @if($project->market_value)
                    <div class="stat-card text-white p-6 rounded-xl text-center">
                        <h3 class="text-4xl md:text-6xl font-bold mb-2">{{ number_format($project->market_value, 2) }}</h3>
                        <p class="text-sm md:text-base opacity-90">القيمة السوقية (مليون ريال)</p>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endif


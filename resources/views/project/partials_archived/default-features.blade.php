{{-- Default/Placeholder Features --}}
@php
    $defaultFeatures = [
        ['icon' => 'fa-concierge-bell', 'name_ar' => 'استقبال فندقي', 'name_en' => 'Hotel Reception'],
        ['icon' => 'fa-tree', 'name_ar' => 'حدائق مفتوحة', 'name_en' => 'Open Gardens'],
        ['icon' => 'fa-dumbbell', 'name_ar' => 'نادي رياضي', 'name_en' => 'Fitness Club'],
        ['icon' => 'fa-shield-alt', 'name_ar' => 'أنظمة أمن خاصة', 'name_en' => 'Private Security Systems'],
        ['icon' => 'fa-users', 'name_ar' => 'مجلس ضيافة', 'name_en' => 'Hospitality Lounge'],
        ['icon' => 'fa-car', 'name_ar' => 'مواقف قبو', 'name_en' => 'Basement Parking'],
        ['icon' => 'fa-lightbulb', 'name_ar' => 'بيئة ذكية', 'name_en' => 'Smart Environment'],
        ['icon' => 'fa-child', 'name_ar' => 'ألعاب أطفال', 'name_en' => 'Children\'s Play Area'],
    ];
@endphp

@foreach($defaultFeatures as $feature)
    <div class="amenity-card bg-[#f8f7f3] p-6 rounded-xl text-center" style="background-color:rgb(213, 173, 16);">
        <div class="w-16 h-16 mx-auto mb-4 bg-[#005A58] rounded-full flex items-center justify-center">
            <i class="fas {{ $feature['icon'] }} text-white text-2xl"></i>
        </div>
        <h3 class="font-bold text-lg text-[#005A58] mb-2">{{ app()->getLocale() === 'ar' ? $feature['name_ar'] : $feature['name_en'] }}</h3>
    </div>
@endforeach


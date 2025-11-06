{{-- Default/Placeholder Near Places --}}
@php
    $defaultNearPlaces = [
        ['name_ar' => 'مراكز تسوق', 'name_en' => 'Shopping Centers', 'description_ar' => 'مراكز تسوق قريبة من المشروع', 'description_en' => 'Shopping centers near the project'],
        ['name_ar' => 'مستشفيات', 'name_en' => 'Hospitals', 'description_ar' => 'مستشفيات ومستوصفات صحية قريبة', 'description_en' => 'Hospitals and medical centers nearby'],
        ['name_ar' => 'مدارس', 'name_en' => 'Schools', 'description_ar' => 'مدارس وجامعات في المنطقة', 'description_en' => 'Schools and universities in the area'],
    ];
@endphp

@foreach($defaultNearPlaces as $place)
    <div class="bg-white p-6 rounded-xl shadow-lg" style="background-color:rgb(213, 173, 16);">
        <h3 class="font-bold text-xl text-[#005A58] mb-3">{{ app()->getLocale() === 'ar' ? $place['name_ar'] : $place['name_en'] }}</h3>
        <p class="text-gray-700">{{ app()->getLocale() === 'ar' ? $place['description_ar'] : $place['description_en'] }}</p>
    </div>
@endforeach


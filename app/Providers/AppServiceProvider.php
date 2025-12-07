<?php

namespace App\Providers;

use App\Models\Hero;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        // Livewire::uploadMaxSize(102400); // 102400 KB = 100 MB

        Hero::firstOrCreate([], [
            'title' => [
                'ar' => 'شريككم نحو تحقيق الأحلام العقارية',
                'en' => 'Your Partner Towards Achieving Real Estate Dreams',
            ],
            'subtitle' => [
                'ar' => 'الجود.. رمز الإبداع العقاري والاستثمار الواعد',
                'en' => 'Aljoud.. The Symbol of Real Estate Innovation and Promising Investment',
            ],
            'media_url' => 'https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=1920&q=80',
            'is_video' => false,
        ]);

    }
}

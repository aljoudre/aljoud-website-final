<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SitemapController;
use App\Http\Middleware\Localization;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('/', [HomeController::class, 'final'])->name('welcome')
    ->middleware(Localization::class);

Route::get('/privacy', [HomeController::class, 'privacy'])->middleware(Localization::class)->name('privacy');

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');


Route::get('/set-locale/{locale}', function ($locale) {
    Session::put('locale', $locale);
    App::setLocale($locale);
    return redirect()->back();
})->middleware(Localization::class)->name('web.set-locale');



// Project 
Route::get('/projects/category/{category}', [ProjectController::class, 'showCategory'])->middleware(Localization::class)->name('projects.category');
Route::get('/projects/{project}', [ProjectController::class, 'show'])->middleware(Localization::class)->name('projects.show');

// Sitemap
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

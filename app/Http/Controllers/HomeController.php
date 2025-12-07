<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hero;
use App\Models\About;
use App\Models\Project;
use App\Models\Service;
use App\Models\Map;
use App\Models\News;
use App\Models\Footer;
use App\Models\Privacy;
use App\Models\Translation;
use App\Models\UiText;
use App\Models\ContactSetting;
class HomeController extends Controller
{

    public function index()
    {
        return view('welcome');
    }


    public function indexX()
    {
        $hero = Hero::first();
        $about = About::first();
        $projects = Project::inRandomOrder()->take(6)->get();
        $services = Service::all();
        $news = News::inRandomOrder()->take(2)->get();
        return view('home.index', [
            'hero' => $hero,
            'about' => $about,
            'projects' => $projects,
            'services' => $services,
            'news' => $news
        ]);
    }

    public function final()
    {
        // Load models without media relationships to avoid errors
        $hero = Hero::select('id', 'title', 'subtitle', 'media_url', 'created_at', 'updated_at')->first();
        $about = About::select('id', 'header', 'content', 'created_at', 'updated_at')->first();
        
        // return $hero->getMedia();
        // Get latest project from each category for main page display
        $landsAuctionsProject = Project::where('category', 'lands_auctions')
            ->orderBy('created_at', 'desc')
            ->first();
        $residentialCommercialProject = Project::where('category', 'residential_commercial')
            ->orderBy('created_at', 'desc')
            ->first();
        
        $services = Service::all();
        $translations = Translation::all();
        $currentLocale = app()->getLocale();
        $currentLanguage = Translation::where('value', $currentLocale)->first();
        
        // Load all UI texts for efficiency
        $uiTexts = UiText::all()->keyBy('key');
        
        // Load contact settings (first record only)
        $contactSettings = ContactSetting::first();
        
        return view('home.final', [
            'hero' => $hero,
            'about' => $about,
            'landsAuctionsProject' => $landsAuctionsProject,
            'residentialCommercialProject' => $residentialCommercialProject,
            'services' => $services,
            'translations' => $translations,
            'currentLanguage' => $currentLanguage,
            'uiTexts' => $uiTexts,
            'contactSettings' => $contactSettings,
        ]);
    }

    public function privacy()
    {
        $privacy = Privacy::first();
        $translations = Translation::all();
        $currentLocale = app()->getLocale();
        $currentLanguage = Translation::where('value', $currentLocale)->first();
        
        // Load all UI texts for navbar and footer
        $uiTexts = UiText::all()->keyBy('key');
        
        // Load contact settings for navbar and footer
        $contactSettings = ContactSetting::first();
        
        return view('privacy', [
            'privacy' => $privacy,
            'translations' => $translations,
            'currentLanguage' => $currentLanguage,
            'uiTexts' => $uiTexts,
            'contactSettings' => $contactSettings,
        ]);
    }

    
}

<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Translation;
use App\Models\UiText;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
class ProjectController extends Controller
{


    public function showCategory($category)
    {
        // Validate category
        if (!in_array($category, ['lands_auctions', 'residential_commercial'])) {
            abort(404);
        }

        $projects = Project::where('category', $category)
            ->orderBy('created_at', 'desc')
            ->get();
        
        $translations = \App\Models\Translation::all();
        $currentLocale = app()->getLocale();
        $currentLanguage = \App\Models\Translation::where('value', $currentLocale)->first();
        $uiTexts = \App\Models\UiText::all()->keyBy('key');
        
        $categoryName = $category === 'lands_auctions' 
            ? (isset($uiTexts['category.lands_auctions']) ? $uiTexts['category.lands_auctions']->translate() : 'الأراضي والمزادات')
            : (isset($uiTexts['category.residential_commercial']) ? $uiTexts['category.residential_commercial']->translate() : 'الأبراج السكنية والتجارية');
        
            // return $projects->first();
        return view('project.category', [
            'projects' => $projects,
            'category' => $category,
            'categoryName' => $categoryName,
            'translations' => $translations,
            'currentLanguage' => $currentLanguage,
            'uiTexts' => $uiTexts,
        ]);
    }

    
    public function show($project){
        // return Project::where('uuid', $project)->firstOrFail();
       
            // Eager load relationships to avoid N+1 queries
            $project = Project::with(['features', 'stats' => function($query) {
                $query->orderBy('order');
            }, 'nearPlaces' => function($query) {
                $query->orderBy('order');
            }, 'buttons' => function($query) {
                $query->orderBy('order');
            }])->where('uuid', $project)->firstOrFail();
            
            // Cache translations and UI texts for better performance
            $translations = Cache::remember('translations', 3600, function() {
                return Translation::all();
            });
            
            $currentLocale = app()->getLocale();
            $currentLanguage = $translations->where('value', $currentLocale)->first();
            
            $uiTexts = Cache::remember('ui_texts', 3600, function() {
                return \App\Models\UiText::all()->keyBy('key');
            });
            
            return response()->view('project.view', [
                'project' => $project,
                'translations' => $translations,
                'currentLanguage' => $currentLanguage,
                'uiTexts' => $uiTexts,
            ])->header('Content-Type', 'text/html; charset=utf-8');
       
    }

    public function showXX($project){
        // return Project::where('uuid', $project)->firstOrFail();
        try {
            // Eager load relationships to avoid N+1 queries
            $project = Project::with(['features', 'stats' => function($query) {
                $query->orderBy('order');
            }, 'nearPlaces' => function($query) {
                $query->orderBy('order');
            }, 'buttons' => function($query) {
                $query->orderBy('order');
            }])->where('uuid', $project)->firstOrFail();
            
            // Cache translations and UI texts for better performance
            $translations = Cache::remember('translations', 3600, function() {
                return Translation::all();
            });
            
            $currentLocale = app()->getLocale();
            $currentLanguage = $translations->where('value', $currentLocale)->first();
            
            $uiTexts = Cache::remember('ui_texts', 3600, function() {
                return \App\Models\UiText::all()->keyBy('key');
            });
            
            return response()->view('project.view', [
                'project' => $project,
                'translations' => $translations,
                'currentLanguage' => $currentLanguage,
                'uiTexts' => $uiTexts,
            ])->header('Content-Type', 'text/html; charset=utf-8');
        } catch (\Exception $e) {
            Log::error('Project view error: ' . $e->getMessage());
            // abort(404);
            return $e->getMessage();
        }
    }
}

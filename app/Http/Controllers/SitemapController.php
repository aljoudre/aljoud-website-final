<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class SitemapController extends Controller
{
    public function index()
    {
        $baseUrl = url('/');
        $projects = Project::select('uuid', 'updated_at')->get();
        
        $urls = [
            [
                'loc' => $baseUrl,
                'lastmod' => now()->format('Y-m-d'),
                'changefreq' => 'daily',
                'priority' => '1.0',
            ],
            [
                'loc' => route('privacy'),
                'lastmod' => now()->format('Y-m-d'),
                'changefreq' => 'monthly',
                'priority' => '0.5',
            ],
            [
                'loc' => route('projects.category', 'lands_auctions'),
                'lastmod' => now()->format('Y-m-d'),
                'changefreq' => 'weekly',
                'priority' => '0.8',
            ],
            [
                'loc' => route('projects.category', 'residential_commercial'),
                'lastmod' => now()->format('Y-m-d'),
                'changefreq' => 'weekly',
                'priority' => '0.8',
            ],
        ];
        
        foreach ($projects as $project) {
            $urls[] = [
                'loc' => route('projects.show', $project->uuid),
                'lastmod' => $project->updated_at->format('Y-m-d'),
                'changefreq' => 'weekly',
                'priority' => '0.7',
            ];
        }
        
        return response()->view('sitemap', [
            'urls' => $urls,
        ])->header('Content-Type', 'application/xml');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Place;
use App\Models\Product;
use App\Models\Tour;
use App\Models\Cruise;
use App\Models\Flight;

class SitemapController extends Controller
{
    public function index()
    {
        $baseUrl = rtrim(config('app.url'), '/');

        $staticPages = [
            ['loc' => $baseUrl.'/tr',         'alt_en' => $baseUrl.'/en',         'priority' => '1.0', 'changefreq' => 'weekly'],
            ['loc' => $baseUrl.'/tr/blog',     'alt_en' => $baseUrl.'/en/blog',     'priority' => '0.9', 'changefreq' => 'weekly'],
            ['loc' => $baseUrl.'/tr/shop',     'alt_en' => $baseUrl.'/en/shop',     'priority' => '0.8', 'changefreq' => 'weekly'],
            ['loc' => $baseUrl.'/tr/places',   'alt_en' => $baseUrl.'/en/places',   'priority' => '0.8', 'changefreq' => 'monthly'],
            ['loc' => $baseUrl.'/tr/guides',   'alt_en' => $baseUrl.'/en/guides',   'priority' => '0.8', 'changefreq' => 'monthly'],
            ['loc' => $baseUrl.'/tr/tours',    'alt_en' => $baseUrl.'/en/tours',    'priority' => '0.7', 'changefreq' => 'monthly'],
            ['loc' => $baseUrl.'/tr/cruiselog', 'alt_en' => $baseUrl.'/en/cruiselog', 'priority' => '0.5', 'changefreq' => 'monthly'],
            ['loc' => $baseUrl.'/tr/flights',  'alt_en' => $baseUrl.'/en/flights',  'priority' => '0.6', 'changefreq' => 'monthly'],
            ['loc' => $baseUrl.'/tr/about',    'alt_en' => $baseUrl.'/en/about',    'priority' => '0.6', 'changefreq' => 'yearly'],
            ['loc' => $baseUrl.'/tr/contact',  'alt_en' => $baseUrl.'/en/contact',  'priority' => '0.5', 'changefreq' => 'yearly'],
            ['loc' => $baseUrl.'/tr/privacy',  'alt_en' => $baseUrl.'/en/privacy',  'priority' => '0.2', 'changefreq' => 'yearly'],
            ['loc' => $baseUrl.'/tr/cookies',  'alt_en' => $baseUrl.'/en/cookies',  'priority' => '0.2', 'changefreq' => 'yearly'],
            ['loc' => $baseUrl.'/tr/terms',    'alt_en' => $baseUrl.'/en/terms',    'priority' => '0.2', 'changefreq' => 'yearly'],
            ['loc' => $baseUrl.'/tr/returns',  'alt_en' => $baseUrl.'/en/returns',  'priority' => '0.2', 'changefreq' => 'yearly'],
        ];

        $posts    = Post::published()->latest()->get(['slug', 'updated_at']);
        $products = Product::where('is_active', true)->latest()->get(['slug', 'updated_at']);
        $places   = Place::active()->latest()->get(['slug', 'updated_at']);
        $tours    = Tour::active()->latest()->get(['slug', 'updated_at']);
        $cruises  = Cruise::active()->latest()->get(['slug', 'updated_at']);
        $guides   = Place::active()->latest()->get(['slug', 'updated_at']); // guides = places

        $xml = view('sitemap', compact('staticPages', 'posts', 'products', 'places', 'tours', 'cruises', 'guides', 'baseUrl'));

        return response($xml, 200)->header('Content-Type', 'application/xml');
    }
}

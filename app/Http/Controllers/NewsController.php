<?php
// app/Http/Controllers/NewsController.php

namespace App\Http\Controllers;

use App\Services\NewsFetcherService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class NewsController extends Controller
{
    protected $newsFetcher;

    public function __construct(NewsFetcherService $newsFetcher)
    {
        $this->newsFetcher = $newsFetcher;
    }

    /**
     * Display the news listing page
     */
    public function index()
    {
        // Try to get cached news first, or fetch fresh
        $news = Cache::remember('news_articles', now()->addMinutes(30), function () {
            return $this->newsFetcher->fetchAllNews();
        });

        // Get market data for the sidebar
        $marketData = Cache::remember('market_data', now()->addMinutes(15), function () {
            return $this->newsFetcher->fetchMarketData();
        });

        $weatherData = Cache::remember('weather_data', now()->addMinutes(30), function () {
            return $this->newsFetcher->fetchWeatherData('Lagos');
        });

        return view('news.index', compact('news', 'marketData', 'weatherData'));
    }

    /**
     * AJAX endpoint to refresh news
     */
    public function refresh(Request $request)
    {
        $news = $this->newsFetcher->fetchAllNews(true);
        $marketData = $this->newsFetcher->fetchMarketData(true);
        
        return response()->json([
            'success' => true,
            'news' => $news,
            'marketData' => $marketData,
            'lastUpdated' => now()->toIso8601String()
        ]);
    }

    /**
     * Redirect to original article (no local detail page)
     */
    public function show($slug)
    {
        // Find the article by slug and redirect to original URL
        $newsCollection = collect(Cache::get('news_articles', []));
        $news = $newsCollection->firstWhere('slug', $slug);
        
        if ($news && isset($news['url']) && filter_var($news['url'], FILTER_VALIDATE_URL)) {
            return redirect()->away($news['url']);
        }
        
        abort(404, 'Article not found');
    }

    /**
     * Display sports news page
     */
    public function sports()
    {
        $sportsNews = Cache::remember('sports_articles', now()->addMinutes(30), function () {
            return $this->newsFetcher->fetchSportsNews();
        });

        $marketData = Cache::remember('market_data', now()->addMinutes(15), function () {
            return $this->newsFetcher->fetchMarketData();
        });

        $weatherData = Cache::remember('weather_data', now()->addMinutes(30), function () {
            return $this->newsFetcher->fetchWeatherData('Lagos');
        });

        return view('news.sports', compact('sportsNews', 'marketData', 'weatherData'));
    }

    /**
     * Redirect to original sport article
     */
    public function showSport($slug)
    {
        $sportsCollection = collect(Cache::get('sports_articles', []));
        $news = $sportsCollection->firstWhere('slug', $slug);
        
        if ($news && isset($news['url']) && filter_var($news['url'], FILTER_VALIDATE_URL)) {
            return redirect()->away($news['url']);
        }
        
        abort(404, 'Article not found');
    }
}
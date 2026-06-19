<?php

use App\Http\Controllers\DownloadController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ServiceController;
use App\Services\NewsFetcherService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/services', [ServiceController::class, 'index'])->name('services');
Route::get('/services/{slug}', [ServiceController::class, 'show'])->name('service.detail');
Route::view('/terms', 'terms')->name('terms');
Route::view('/policy', 'policy')->name('policy');
Route::get('/news', [NewsController::class, 'index'])->name('news');
Route::get('/news/refresh', [NewsController::class, 'refresh'])->name('news.refresh');
Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.detail');
Route::get('/sports', [NewsController::class, 'sports'])->name('sports');
Route::get('/sports/{slug}', [NewsController::class, 'showSport'])->name('sport.detail');

// Auto-refresh news endpoint (fetches both medical and sports news)
Route::get('/auto-refresh-news', function () {
    try {
        $newsFetcher = new NewsFetcherService;

        // Fetch medical/health news
        $news = $newsFetcher->fetchAllNews(true);
        Cache::put('news_articles', $news, now()->addMinutes(30));

        // Fetch sports news
        $sportsNews = $newsFetcher->fetchSportsNews(true);
        Cache::put('sports_articles', $sportsNews, now()->addMinutes(30));

        return response()->json([
            'success' => true,
            'count' => count($news),
            'sports_count' => count($sportsNews),
            'timestamp' => now()->toIso8601String(),
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'error' => $e->getMessage(),
        ], 500);
    }
})->name('auto.refresh');

// Download Routes
Route::get('/download-app', [DownloadController::class, 'redirect'])->name('download.redirect');
Route::get('/download-app/{platform}', [DownloadController::class, 'direct'])->name('download.direct');

// Contact Route
Route::post('/contact', [HomeController::class, 'contact'])->name('contact.submit');

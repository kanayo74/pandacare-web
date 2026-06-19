<?php
// app/Console/Commands/FetchNewsCommand.php

namespace App\Console\Commands;

use App\Services\NewsFetcherService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class FetchNewsCommand extends Command
{
    protected $signature = 'news:fetch';
    protected $description = 'Fetch latest news from RSS feeds and update cache';

    protected $newsFetcher;

    public function __construct(NewsFetcherService $newsFetcher)
    {
        parent::__construct();
        $this->newsFetcher = $newsFetcher;
    }

    public function handle()
    {
        $this->info('Fetching latest medical news...');
        
        try {
            $news = $this->newsFetcher->fetchAllNews(true);
            Cache::put('news_articles', $news, now()->addMinutes(30));
            $this->info('✓ Fetched ' . count($news) . ' medical articles');
            
            $sportsNews = $this->newsFetcher->fetchSportsNews(true);
            Cache::put('sports_articles', $sportsNews, now()->addMinutes(30));
            $this->info('✓ Fetched ' . count($sportsNews) . ' sports articles');
            
            $this->info('News cache updated successfully!');
            
        } catch (\Exception $e) {
            $this->error('Error fetching news: ' . $e->getMessage());
            return 1;
        }
        
        return 0;
    }
}
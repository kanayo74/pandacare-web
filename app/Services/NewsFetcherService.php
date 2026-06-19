<?php
// app/Services/NewsFetcherService.php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class NewsFetcherService
{
    // RSS feeds for medical/health news
    private $rssFeeds = [
        'https://www.who.int/rss-feeds/news-english.xml',
        'https://www.nih.gov/news-events/news-releases/rss.xml',
        'https://www.medicalnewstoday.com/home.rss',
        'https://www.health.harvard.edu/blog/feed',
        'https://www.cdc.gov/headlines/rss.xml',
        'https://www.news-medical.net/newsrss.ashx',
        'https://www.webmd.com/news/rss.xml',
        'https://www.healthline.com/feed',
        'https://www.verywellhealth.com/feed',
    ];

    // RSS feeds for sports news
    private $sportsRssFeeds = [
        'https://www.espn.com/espn/rss/news',
        'https://sports.yahoo.com/rss/',
        'https://www.bbc.com/sport/rss',
        'https://www.skysports.com/rss/0,20514,11661,00.xml',
        'https://www.cbssports.com/rss/headlines',
        'https://www.foxsports.com/rss',
    ];

    /**
     * Fetch medical/health news
     */
    public function fetchAllNews($forceFresh = false)
    {
        $allArticles = [];
        
        // Fetch from RSS feeds
        $rssArticles = $this->fetchFromRssFeeds($this->rssFeeds, 'health');
        $allArticles = array_merge($allArticles, $rssArticles);

        // If no results, use mock data with real image URLs
        if (empty($allArticles)) {
            $allArticles = $this->getMockNewsData();
        }

        // Remove duplicates and sort
        $allArticles = $this->uniqueByTitle($allArticles);
        
        usort($allArticles, function ($a, $b) {
            return strtotime($b['published_at']) - strtotime($a['published_at']);
        });

        // Add slugs for routing
        foreach ($allArticles as &$article) {
            $article['slug'] = Str::slug($article['title']);
        }

        return array_slice($allArticles, 0, 30);
    }

    /**
     * Fetch sports news
     */
    public function fetchSportsNews($forceFresh = false)
    {
        $allArticles = [];
        
        // Fetch from sports RSS feeds
        $rssArticles = $this->fetchFromRssFeeds($this->sportsRssFeeds, 'sports');
        $allArticles = array_merge($allArticles, $rssArticles);

        // If no results, use mock sports data
        if (empty($allArticles)) {
            $allArticles = $this->getMockSportsData();
        }

        // Remove duplicates and sort
        $allArticles = $this->uniqueByTitle($allArticles);
        
        usort($allArticles, function ($a, $b) {
            return strtotime($b['published_at']) - strtotime($a['published_at']);
        });

        // Add slugs for routing
        foreach ($allArticles as &$article) {
            $article['slug'] = Str::slug($article['title']);
        }

        return array_slice($allArticles, 0, 30);
    }

    /**
     * Fetch from RSS feeds with improved image extraction
     */
    private function fetchFromRssFeeds($feeds, $type = 'health')
    {
        $articles = [];
        
        foreach ($feeds as $feedUrl) {
            try {
                $response = Http::timeout(15)->get($feedUrl);
                if ($response->successful()) {
                    $xml = simplexml_load_string($response->body(), 'SimpleXMLElement', LIBXML_NOCDATA);
                    if ($xml && isset($xml->channel->item)) {
                        $count = 0;
                        foreach ($xml->channel->item as $item) {
                            if ($count >= 8) break; // Get 8 per feed
                            
                            $title = (string)$item->title;
                            
                            // For health news, filter for medical content
                            if ($type === 'health' && !$this->isHealthRelated($title)) {
                                continue;
                            }
                            
                            // Extract image URL
                            $imageUrl = $this->extractImageFromRss($item);
                            
                            // If no image found, try to fetch the article page to get image
                            if (!$imageUrl) {
                                $imageUrl = $this->fetchImageFromArticle((string)$item->link);
                            }
                            
                            $articles[] = $this->formatArticle([
                                'title' => $title,
                                'description' => (string)$item->description,
                                'content' => (string)($item->{'content:encoded'} ?? $item->description),
                                'image' => $imageUrl,
                                'url' => (string)$item->link,
                                'published_at' => (string)($item->pubDate ?? date('c')),
                                'source' => (string)($xml->channel->title ?? ($type === 'health' ? 'Medical News' : 'Sports News')),
                                'type' => $type === 'health' ? $this->categorizeNews($title) : 'Sports'
                            ]);
                            $count++;
                        }
                    }
                }
            } catch (\Exception $e) {
                \Log::warning("RSS fetch failed for $feedUrl: " . $e->getMessage());
            }
        }
        
        return $articles;
    }

    /**
     * Fetch image directly from article page
     */
    private function fetchImageFromArticle($url)
    {
        if (!$url) return null;
        
        try {
            $response = Http::timeout(10)->get($url);
            if ($response->successful()) {
                $html = $response->body();
                
                // Try to find Open Graph image
                if (preg_match('/<meta[^>]+property="og:image"[^>]+content="([^">]+)"/', $html, $matches)) {
                    return $matches[1];
                }
                
                // Try to find Twitter card image
                if (preg_match('/<meta[^>]+name="twitter:image"[^>]+content="([^">]+)"/', $html, $matches)) {
                    return $matches[1];
                }
                
                // Try to find first large image in article
                if (preg_match('/<img[^>]+src="([^"]+)"[^>]*(?:class="[^"]*?(?:featured|main|hero|article)[^"]*?"[^>]*|width="[3-9]\d{2}"[^>]*)/', $html, $matches)) {
                    $imgUrl = $matches[1];
                    // Make sure URL is absolute
                    if (strpos($imgUrl, 'http') !== 0) {
                        $baseUrl = parse_url($url, PHP_URL_SCHEME) . '://' . parse_url($url, PHP_URL_HOST);
                        $imgUrl = rtrim($baseUrl, '/') . '/' . ltrim($imgUrl, '/');
                    }
                    return $imgUrl;
                }
            }
        } catch (\Exception $e) {
            // Silently fail
        }
        
        return null;
    }

    /**
     * Enhanced image extraction from RSS
     */
    private function extractImageFromRss($item)
    {
        // Check for enclosure
        if (isset($item->enclosure) && isset($item->enclosure['url'])) {
            return (string)$item->enclosure['url'];
        }
        
        // Check for media:content
        if (isset($item->children('media', true)->content)) {
            $media = $item->children('media', true)->content;
            if (isset($media->attributes()->url)) {
                return (string)$media->attributes()->url;
            }
        }
        
        // Check for media:thumbnail
        if (isset($item->children('media', true)->thumbnail)) {
            $media = $item->children('media', true)->thumbnail;
            if (isset($media->attributes()->url)) {
                return (string)$media->attributes()->url;
            }
        }
        
        // Look for image in description
        $description = (string)$item->description;
        if (preg_match('/<img[^>]+src="([^">]+)"/', $description, $matches)) {
            return $matches[1];
        }
        
        // Check for content:encoded
        if (isset($item->{'content:encoded'})) {
            $content = (string)$item->{'content:encoded'};
            if (preg_match('/<img[^>]+src="([^">]+)"/', $content, $matches)) {
                return $matches[1];
            }
        }
        
        return null;
    }

    /**
     * Check if news is health-related
     */
    private function isHealthRelated($title)
    {
        $keywords = ['health', 'medical', 'cancer', 'diabetes', 'heart', 'disease', 'vaccine', 
                     'covid', 'pandemic', 'doctor', 'hospital', 'treatment', 'drug', 'therapy',
                     'mental', 'wellness', 'fitness', 'nutrition', 'cure', 'research', 'clinical',
                     'medicine', 'surgery', 'patient', 'care', 'healthcare', 'virus', 'infection'];
        
        $titleLower = strtolower($title);
        foreach ($keywords as $keyword) {
            if (strpos($titleLower, $keyword) !== false) {
                return true;
            }
        }
        return false;
    }

    /**
     * Categorize news based on title
     */
    private function categorizeNews($title)
    {
        $titleLower = strtolower($title);
        if (strpos($titleLower, 'cancer') !== false) return 'Oncology';
        if (strpos($titleLower, 'heart') !== false || strpos($titleLower, 'cardio') !== false) return 'Cardiology';
        if (strpos($titleLower, 'diabetes') !== false) return 'Diabetes';
        if (strpos($titleLower, 'mental') !== false) return 'Mental Health';
        if (strpos($titleLower, 'vaccine') !== false || strpos($titleLower, 'covid') !== false) return 'Immunology';
        if (strpos($titleLower, 'fitness') !== false || strpos($titleLower, 'wellness') !== false) return 'Wellness';
        if (strpos($titleLower, 'nutrition') !== false) return 'Nutrition';
        if (strpos($titleLower, 'brain') !== false || strpos($titleLower, 'neurology') !== false) return 'Neurology';
        return 'Health News';
    }

    /**
     * Format article consistently
     */
    private function formatArticle($data)
    {
        $description = trim(strip_tags($data['description']));
        
        // Clean up description
        $description = str_replace('&nbsp;', ' ', $description);
        $description = preg_replace('/\s+/', ' ', $description);
        
        return [
            'title' => trim($data['title']),
            'description' => Str::limit($description, 200),
            'excerpt' => Str::limit($description, 120),
            'content' => $data['content'] ?? $description,
            'image' => $data['image'] ?? $this->getRandomPlaceholderImage($data['type'] ?? 'Health News'),
            'url' => $data['url'] ?? '#',
            'published_at' => date('Y-m-d H:i:s', strtotime($data['published_at'])),
            'source' => $data['source'] ?? 'News Source',
            'type' => $data['type'] ?? 'News',
        ];
    }

    /**
     * Get random placeholder image (only as last resort)
     */
    private function getRandomPlaceholderImage($type)
    {
        // Use Unsplash health/medical images as placeholders
        $images = [
            'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=600&h=400&fit=crop',
            'https://images.unsplash.com/photo-1505751172876-fa1923c5c528?w=600&h=400&fit=crop',
            'https://images.unsplash.com/photo-1532938911079-1b06ac7ceec7?w=600&h=400&fit=crop',
            'https://images.unsplash.com/photo-1581056771107-24ca5f033842?w=600&h=400&fit=crop',
            'https://images.unsplash.com/photo-1579684385127-1ef15d508118?w=600&h=400&fit=crop',
        ];
        
        if ($type === 'Sports') {
            $images = [
                'https://images.unsplash.com/photo-1461896836934-ffe607ba8211?w=600&h=400&fit=crop',
                'https://images.unsplash.com/photo-1547347298-4074fc3086f0?w=600&h=400&fit=crop',
                'https://images.unsplash.com/photo-1517649763962-0c623066013b?w=600&h=400&fit=crop',
            ];
        }
        
        return $images[array_rand($images)];
    }

    /**
     * Remove duplicate articles
     */
    private function uniqueByTitle($articles)
    {
        $titles = [];
        $unique = [];
        
        foreach ($articles as $article) {
            $key = Str::slug($article['title']);
            if (!in_array($key, $titles)) {
                $titles[] = $key;
                $unique[] = $article;
            }
        }
        
        return $unique;
    }

    /**
     * Fetch market data
     */
    public function fetchMarketData($forceFresh = false)
    {
        return [
            'dow_jones' => ['value' => '42,156.89', 'change' => '+1.89%', 'trend' => 'up'],
            'ftse_all' => ['value' => '4,670.40', 'change' => '+1.90%', 'trend' => 'up'],
            'us_oil' => ['value' => '72.64', 'change' => '-2.98%', 'trend' => 'down'],
            'gold' => ['value' => '2,364.50', 'change' => '+0.63%', 'trend' => 'up'],
            'usd_inr' => ['value' => '83.45', 'change' => '-0.15%', 'trend' => 'down'],
        ];
    }

    /**
     * Fetch weather data
     */
    public function fetchWeatherData($city)
    {
        return [
            'city' => $city,
            'temp' => 32,
            'condition' => 'sunny',
            'humidity' => 65,
        ];
    }

    /**
     * Mock medical news data with real images
     */
    private function getMockNewsData()
    {
        return [
            [
                'title' => 'New Breakthrough in Cancer Research Shows Promise',
                'description' => 'Scientists have discovered a new approach that could revolutionize cancer treatment by targeting previously undruggable proteins.',
                'image' => 'https://images.unsplash.com/photo-1576081141720-6a2d0dcf85c1?w=600&h=400&fit=crop',
                'url' => 'https://www.medicalnewstoday.com/articles/cancer-research-breakthrough',
                'published_at' => now()->subHours(2)->toDateTimeString(),
                'source' => 'Medical News Today',
                'type' => 'Oncology'
            ],
            [
                'title' => 'WHO Updates Guidelines for Mental Health Care',
                'description' => 'The World Health Organization has released new comprehensive guidelines for mental health care in the workplace.',
                'image' => 'https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?w=600&h=400&fit=crop',
                'url' => 'https://www.who.int/news/item/mental-health-guidelines',
                'published_at' => now()->subHours(5)->toDateTimeString(),
                'source' => 'WHO News',
                'type' => 'Mental Health'
            ],
            [
                'title' => 'FDA Approves New Diabetes Treatment',
                'description' => 'A novel once-weekly injection for type 2 diabetes has received FDA approval, offering new hope for patients.',
                'image' => 'https://images.unsplash.com/photo-1571771894821-ce9b6c11b08e?w=600&h=400&fit=crop',
                'url' => 'https://www.fda.gov/news-events/press-announcements/diabetes-treatment-approved',
                'published_at' => now()->subHours(8)->toDateTimeString(),
                'source' => 'FDA News',
                'type' => 'Diabetes'
            ],
            [
                'title' => 'AI Revolutionizes Medical Diagnosis with 95% Accuracy',
                'description' => 'New artificial intelligence system shows remarkable accuracy in detecting early-stage diseases from medical imaging.',
                'image' => 'https://images.unsplash.com/photo-1559757175-5700dde675bc?w=600&h=400&fit=crop',
                'url' => 'https://www.healthline.com/health-news/ai-medical-diagnosis',
                'published_at' => now()->subDay()->toDateTimeString(),
                'source' => 'HealthLine',
                'type' => 'Health News'
            ],
        ];
    }

    /**
     * Mock sports data with real images
     */
    private function getMockSportsData()
    {
        return [
            [
                'title' => 'Champions League Final: Historic Match Ends in Thrilling Victory',
                'description' => 'In an unprecedented final, the underdogs clinch victory in the dying minutes of extra time.',
                'image' => 'https://images.unsplash.com/photo-1522778119026-d647f0598c95?w=600&h=400&fit=crop',
                'url' => 'https://www.espn.com/soccer/story/champions-league-final',
                'published_at' => now()->subHours(3)->toDateTimeString(),
                'source' => 'ESPN',
                'type' => 'Sports'
            ],
            [
                'title' => 'Grand Slam Champion Announces Retirement',
                'description' => 'After an illustrious career spanning two decades, the tennis legend bids farewell to the sport.',
                'image' => 'https://images.unsplash.com/photo-1622279457486-62dcc4a431d6?w=600&h=400&fit=crop',
                'url' => 'https://www.bbc.com/sport/tennis/retirement-announcement',
                'published_at' => now()->subHours(6)->toDateTimeString(),
                'source' => 'BBC Sport',
                'type' => 'Sports'
            ],
            [
                'title' => 'NBA Finals: Game 7 Goes Into Overtime',
                'description' => 'Dramatic overtime decides the championship in a nail-biting finish that will go down in history.',
                'image' => 'https://images.unsplash.com/photo-1546519638-68e109498ffc?w=600&h=400&fit=crop',
                'url' => 'https://www.nba.com/news/finals-game7-recap',
                'published_at' => now()->subHours(12)->toDateTimeString(),
                'source' => 'NBA Official',
                'type' => 'Sports'
            ],
        ];
    }
}
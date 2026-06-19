{{-- resources/views/news/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Medical Health News - Pandacare')

@section('content')
<style>
    .market-ticker {
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
        border-radius: 16px;
        padding: 1rem;
        margin-bottom: 1.5rem;
    }
    .market-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem 0;
        border-bottom: 1px solid rgba(255,255,255,0.1);
    }
    .market-item:last-child {
        border-bottom: none;
    }
    .trend-up { color: #00ff88; }
    .trend-down { color: #ff4444; }
    .news-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        cursor: pointer;
        text-decoration: none;
        display: block;
    }
    .news-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 30px -15px rgba(0,0,0,0.2) !important;
    }
    .weather-widget {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 16px;
        padding: 1.25rem;
        color: white;
    }
    .refresh-btn {
        background: rgba(255,255,255,0.2);
        backdrop-filter: blur(10px);
        border-radius: 50px;
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
        transition: all 0.3s ease;
    }
    .refresh-btn:hover {
        background: rgba(255,255,255,0.3);
        transform: rotate(180deg);
    }
    .badge-category {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.75rem;
        display: inline-block;
    }
    .external-link-icon {
        font-size: 0.7rem;
        margin-left: 4px;
        opacity: 0.6;
    }
    .news-card img {
        transition: transform 0.3s ease;
    }
    .news-card:hover img {
        transform: scale(1.05);
    }
    .img-container {
        overflow: hidden;
        height: 200px;
    }
    .source-badge {
        font-size: 0.7rem;
        background: #f0f0f0;
        padding: 2px 8px;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }
</style>

<section class="news-hero bg-gradient-primary text-white py-4">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <div>
                <h1 class="display-5 fw-bold mb-2">Medical Health News</h1>
                <p class="lead mb-0">Stay informed with the latest healthcare updates from trusted sources</p>
            </div>
            <div class="mt-3 mt-md-0">
                <button class="btn refresh-btn" onclick="refreshNews()" id="refreshBtn">
                    <i class="fas fa-sync-alt me-2"></i>Refresh News
                </button>
                <small class="d-block text-white-50 mt-1" id="lastUpdated">
                    Last updated: {{ now()->format('g:i A') }}
                </small>
            </div>
        </div>
    </div>
</section>

<section class="news-list py-4">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="row g-4" id="newsContainer">
                    @forelse($news as $item)
                        <div class="col-md-6" data-aos="fade-up">
                            <a href="{{ $item['url'] }}" target="_blank" class="news-card card h-100 border-0 shadow-sm text-decoration-none">
                                <div class="img-container">
                                    <img src="{{ $item['image'] }}" 
                                         class="card-img-top" 
                                         alt="{{ $item['title'] }}"
                                         style="height: 200px; width: 100%; object-fit: cover;"
                                         onerror="this.src='https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=600&h=400&fit=crop'">
                                </div>
                                <div class="card-body">
                                    <div class="mb-2 d-flex justify-content-between align-items-center">
                                        <span class="badge-category">{{ $item['type'] }}</span>
                                        <small class="text-muted">
                                            <i class="far fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($item['published_at'])->diffForHumans() }}
                                        </small>
                                    </div>
                                    <h3 class="h6 fw-bold mb-3 text-dark">
                                        {{ Str::limit($item['title'], 80) }}
                                        <i class="fas fa-external-link-alt external-link-icon"></i>
                                    </h3>
                                    <p class="text-muted small">{{ Str::limit($item['excerpt'] ?? $item['description'], 100) }}</p>
                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                        <span class="source-badge">
                                            <i class="far fa-newspaper"></i> {{ $item['source'] }}
                                        </span>
                                        <span class="text-primary small">
                                            Read Original <i class="fas fa-arrow-right ms-1"></i>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5">
                            <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
                            <p class="lead text-muted">No news articles available at the moment.</p>
                            <button class="btn btn-primary" onclick="refreshNews()">
                                <i class="fas fa-sync-alt me-2"></i>Refresh News
                            </button>
                        </div>
                    @endforelse
                </div>
            </div>
            
            <div class="col-lg-4">
                <!-- Weather Widget -->
                <div class="weather-widget mb-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <i class="fas fa-map-marker-alt me-1"></i> {{ $weatherData['city'] }}
                            <h2 class="display-4 fw-bold mb-0">{{ $weatherData['temp'] }}°C</h2>
                            <p class="mb-0 text-capitalize">{{ $weatherData['condition'] }}</p>
                            <small><i class="fas fa-tint"></i> Humidity: {{ $weatherData['humidity'] }}%</small>
                        </div>
                        <div>
                            <i class="fas fa-sun fa-3x"></i>
                            <div class="mt-2">
                                <span class="badge bg-light text-dark">6 days hot weather ahead ></span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Market Ticker -->
                <div class="market-ticker" id="marketData">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold mb-0 text-white">Markets</h6>
                        <small class="text-white-50"><i class="fas fa-chart-line"></i> Live</small>
                    </div>
                    @foreach($marketData as $key => $data)
                    <div class="market-item">
                        <span class="text-white-50">{{ ucfirst(str_replace('_', ' ', $key)) }}</span>
                        <div class="text-end">
                            <strong class="text-white">{{ $data['value'] }}</strong>
                            <span class="{{ $data['trend'] === 'up' ? 'trend-up' : 'trend-down' }} ms-2">
                                {{ $data['change'] }} {{ $data['trend'] === 'up' ? '↑' : '↓' }}
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <!-- Suggested Publishers -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-0 pt-3">
                        <h5 class="fw-bold mb-0">Follow publishers</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                        <img src="{{ asset('images/tec.jpg') }}" class="rounded-circle me-2" width="32" height="32" style="object-fit: contain;">
                            <div>
                                <strong>World Health Organization</strong>
                                <small class="d-block text-muted">Official WHO News</small>
                            </div>
                            <button class="btn btn-sm btn-outline-primary ms-auto">+ Follow</button>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                        <img src="{{ asset('images/background2.png') }}" class="rounded-circle me-2" width="32" height="32" style="object-fit: contain;">
                            <div>
                                <strong>CDC Health</strong>
                                <small class="d-block text-muted">Centers for Disease Control</small>
                            </div>
                            <button class="btn btn-sm btn-outline-primary ms-auto">+ Follow</button>
                        </div>
                        <div class="d-flex align-items-center">
                        <img src="{{ asset('images/logo.png') }}" class="rounded-circle me-2" width="32" height="32" style="object-fit: contain;">
                            <div>
                                <strong>Pandacare</strong>
                                <small class="d-block text-muted">National Institutes of Health</small>
                            </div>
                            <button class="btn btn-sm btn-outline-primary ms-auto">+ Follow</button>
                        </div>
                    </div>
                </div>
                
                <!-- Daily Digest Subscription -->
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3">The Daily Digest</h6>
                        <p class="small text-muted">Get the latest medical news delivered to your inbox</p>
                        <div class="d-flex align-items-center mb-2">
                            <input type="checkbox" class="form-check-input me-2" id="morningDigest">
                            <label for="morningDigest">Morning Briefing (6 AM)</label>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <input type="checkbox" class="form-check-input me-2" id="eveningDigest">
                            <label for="eveningDigest">Evening Update (6 PM)</label>
                        </div>
                        <button class="btn btn-primary btn-sm w-100">Subscribe for Free</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
// Manual refresh function
async function refreshNews() {
    const refreshBtn = document.getElementById('refreshBtn');
    if (!refreshBtn) return;
    
    const originalHtml = refreshBtn.innerHTML;
    refreshBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Fetching latest news...';
    refreshBtn.disabled = true;
    
    try {
        const response = await fetch('{{ route("news.refresh") }}', {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        });
        
        if (response.ok) {
            // Show success message
            const lastUpdated = document.getElementById('lastUpdated');
            if (lastUpdated) {
                lastUpdated.innerHTML = 'Updating...';
            }
            
            // Reload the page to show fresh content
            setTimeout(() => {
                window.location.reload();
            }, 500);
        } else {
            alert('Failed to refresh news. Please try again.');
            refreshBtn.innerHTML = originalHtml;
            refreshBtn.disabled = false;
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Network error. Please check your connection.');
        refreshBtn.innerHTML = originalHtml;
        refreshBtn.disabled = false;
    }
}

// AUTO-REFRESH NEWS EVERY 30 MINUTES
// This runs in the background and fetches fresh news automatically
setInterval(async () => {
    try {
        console.log('Auto-refreshing news...');
        const response = await fetch('/auto-refresh-news');
        const data = await response.json();
        
        if (data.success) {
            console.log('✓ News auto-refreshed successfully at:', new Date().toLocaleTimeString());
            console.log('  - Fetched', data.count, 'new articles');
            
            // Update the last updated time display
            const lastUpdated = document.getElementById('lastUpdated');
            if (lastUpdated) {
                const now = new Date();
                lastUpdated.innerHTML = 'Last updated: ' + now.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
                
                // Flash effect to notify user
                lastUpdated.style.animation = 'none';
                lastUpdated.offsetHeight; // Trigger reflow
                lastUpdated.style.animation = 'pulse 0.5s ease-in-out';
            }
            
            // Optional: Show a subtle notification
            const refreshBtn = document.getElementById('refreshBtn');
            if (refreshBtn) {
                refreshBtn.style.transform = 'rotate(0deg)';
                setTimeout(() => {
                    refreshBtn.style.transform = '';
                }, 1000);
            }
        } else {
            console.error('✗ Auto-refresh failed:', data.error);
        }
    } catch (error) {
        console.error('✗ Auto-refresh network error:', error.message);
    }
}, 1800000); // 30 minutes (1800000 milliseconds)

// Also refresh when the page becomes visible again (user returns to tab)
document.addEventListener('visibilitychange', function() {
    if (!document.hidden) {
        console.log('Tab became visible - checking for news updates...');
        // Optional: Uncomment to refresh when user returns to tab
        // refreshNews();
    }
});

// Add CSS animation for the flash effect
const style = document.createElement('style');
style.textContent = `
    @keyframes pulse {
        0% { opacity: 1; }
        50% { opacity: 0.5; transform: scale(0.95); }
        100% { opacity: 1; transform: scale(1); }
    }
`;
document.head.appendChild(style);

// Log that auto-refresh is enabled
console.log('✓ News auto-refresh enabled - will update every 30 minutes');

// Initialize AOS if available
if (typeof AOS !== 'undefined') {
    AOS.init({
        duration: 800,
        once: true
    });
}
</script>
@endpush
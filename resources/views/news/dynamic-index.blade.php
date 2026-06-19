{{-- resources/views/news/dynamic-index.blade.php --}}
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
    }
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }
    .loading-pulse {
        animation: pulse 1.5s ease-in-out infinite;
    }
</style>

<section class="news-hero bg-gradient-primary text-white py-4">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <div>
                <h1 class="display-5 fw-bold mb-2">Medical Health News</h1>
                <p class="lead mb-0">Stay informed with the latest healthcare updates</p>
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
            <!-- Main News Column -->
            <div class="col-lg-8">
                <div class="row g-4" id="newsContainer">
                    @include('news.partials.news-items', ['news' => $news])
                </div>
                
                <div class="text-center mt-5">
                    <button class="btn btn-outline-primary" onclick="loadMoreNews()" id="loadMoreBtn">
                        Load More <i class="fas fa-arrow-down ms-2"></i>
                    </button>
                </div>
            </div>
            
            <!-- Sidebar Column -->
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
                    @include('news.partials.market-data', ['marketData' => $marketData])
                </div>
                
                <!-- Suggested for You -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-0 pt-3">
                        <h5 class="fw-bold mb-0">Suggested for you</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://ui-avatars.com/api/?background=0d6efd&color=fff&name=TL" class="rounded-circle me-2" width="32" height="32">
                            <div>
                                <strong>The Lancet</strong>
                                <small class="d-block text-muted">Follow</small>
                            </div>
                            <button class="btn btn-sm btn-outline-primary ms-auto">+ Follow</button>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://ui-avatars.com/api/?background=198754&color=fff&name=WHO" class="rounded-circle me-2" width="32" height="32">
                            <div>
                                <strong>WHO Official</strong>
                                <small class="d-block text-muted">Follow</small>
                            </div>
                            <button class="btn btn-sm btn-outline-primary ms-auto">+ Follow</button>
                        </div>
                        <div class="d-flex align-items-center">
                            <img src="https://ui-avatars.com/api/?background=dc3545&color=fff&name=CDC" class="rounded-circle me-2" width="32" height="32">
                            <div>
                                <strong>CDC Health</strong>
                                <small class="d-block text-muted">Follow</small>
                            </div>
                            <button class="btn btn-sm btn-outline-primary ms-auto">+ Follow</button>
                        </div>
                    </div>
                </div>
                
                <!-- Daily Digest -->
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3">The Daily Digest</h6>
                        <div class="d-flex align-items-center mb-2">
                            <input type="checkbox" class="form-check-input me-2">
                            <span>Morning Briefing</span>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <input type="checkbox" class="form-check-input me-2">
                            <span>Evening Update</span>
                        </div>
                        <button class="btn btn-primary btn-sm w-100 mt-2">Subscribe</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
let currentPage = 1;
let isLoading = false;

async function refreshNews() {
    const refreshBtn = document.getElementById('refreshBtn');
    const originalHtml = refreshBtn.innerHTML;
    
    refreshBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Refreshing...';
    refreshBtn.disabled = true;
    
    try {
        const response = await fetch('{{ route("news.refresh") }}', {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        });
        
        if (!response.ok) throw new Error('Network response was not ok');
        
        const data = await response.json();
        
        if (data.success) {
            // Update news container
            const newsContainer = document.getElementById('newsContainer');
            newsContainer.style.opacity = '0.5';
            
            // Rebuild news items
            let newsHtml = '';
            data.news.forEach(item => {
                newsHtml += `
                    <div class="col-md-6 col-lg-6" data-aos="fade-up">
                        <div class="card h-100 border-0 shadow-sm news-card">
                            <img src="${item.image || 'https://placehold.co/600x400/0d6efd/white?text=News'}" 
                                 class="card-img-top" alt="${item.title}"
                                 style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <div class="mb-2">
                                    <span class="badge-category">${item.type}</span>
                                    <small class="text-muted ms-2">
                                        <i class="far fa-calendar-alt"></i> ${new Date(item.published_at).toLocaleDateString('en-US', {month: 'short', day: 'numeric', year: 'numeric'})}
                                    </small>
                                </div>
                                <h3 class="h6 fw-bold mb-3">
                                    <a href="/news/${item.slug}" class="text-decoration-none text-dark">
                                        ${item.title.substring(0, 80)}${item.title.length > 80 ? '...' : ''}
                                    </a>
                                </h3>
                                <p class="text-muted small">${item.excerpt || item.description?.substring(0, 100)}</p>
                                <a href="/news/${item.slug}" class="text-primary text-decoration-none small">
                                    Read More <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                `;
            });
            
            newsContainer.innerHTML = newsHtml;
            newsContainer.style.opacity = '1';
            
            // Update market data
            if (data.marketData) {
                const marketContainer = document.getElementById('marketData');
                if (marketContainer) {
                    marketContainer.innerHTML = generateMarketHtml(data.marketData);
                }
            }
            
            // Update last updated time
            document.getElementById('lastUpdated').innerHTML = `Last updated: ${new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}`;
            
            // Show success toast
            showToast('News refreshed successfully!', 'success');
        }
    } catch (error) {
        console.error('Error refreshing news:', error);
        showToast('Failed to refresh news. Please try again.', 'error');
    } finally {
        refreshBtn.innerHTML = originalHtml;
        refreshBtn.disabled = false;
    }
}

function generateMarketHtml(marketData) {
    return `
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="fw-bold mb-0 text-white">Markets</h6>
            <small class="text-white-50">Live</small>
        </div>
        <div class="market-item">
            <span class="text-white-50">Dow Jones Global</span>
            <div class="text-end">
                <strong class="text-white">${marketData.dow_jones?.value || '42,156.89'}</strong>
                <span class="${marketData.dow_jones?.trend === 'up' ? 'trend-up' : 'trend-down'} ms-2">
                    ${marketData.dow_jones?.change || '+1.89%'} ${marketData.dow_jones?.trend === 'up' ? '↑' : '↓'}
                </span>
            </div>
        </div>
        <div class="market-item">
            <span class="text-white-50">FTSE All World</span>
            <div class="text-end">
                <strong class="text-white">${marketData.ftse_all?.value || '4,670.40'}</strong>
                <span class="${marketData.ftse_all?.trend === 'up' ? 'trend-up' : 'trend-down'} ms-2">
                    ${marketData.ftse_all?.change || '+1.90%'} ${marketData.ftse_all?.trend === 'up' ? '↑' : '↓'}
                </span>
            </div>
        </div>
        <div class="market-item">
            <span class="text-white-50">US Oil WTI</span>
            <div class="text-end">
                <strong class="text-white">${marketData.us_oil?.value || '72.64'}</strong>
                <span class="${marketData.us_oil?.trend === 'up' ? 'trend-up' : 'trend-down'} ms-2">
                    ${marketData.us_oil?.change || '-2.98%'} ${marketData.us_oil?.trend === 'up' ? '↑' : '↓'}
                </span>
            </div>
        </div>
        <div class="market-item">
            <span class="text-white-50">Gold</span>
            <div class="text-end">
                <strong class="text-white">${marketData.gold?.value || '2,364.50'}</strong>
                <span class="${marketData.gold?.trend === 'up' ? 'trend-up' : 'trend-down'} ms-2">
                    ${marketData.gold?.change || '+0.63%'} ${marketData.gold?.trend === 'up' ? '↑' : '↓'}
                </span>
            </div>
        </div>
        <div class="market-item">
            <span class="text-white-50">USD/INR</span>
            <div class="text-end">
                <strong class="text-white">${marketData.usd_inr?.value || '83.45'}</strong>
                <span class="${marketData.usd_inr?.trend === 'up' ? 'trend-up' : 'trend-down'} ms-2">
                    ${marketData.usd_inr?.change || '-0.15%'} ${marketData.usd_inr?.trend === 'up' ? '↑' : '↓'}
                </span>
            </div>
        </div>
    `;
}

function showToast(message, type) {
    // Simple toast implementation
    const toast = document.createElement('div');
    toast.className = `position-fixed bottom-0 end-0 m-3 alert alert-${type === 'success' ? 'success' : 'danger'} shadow`;
    toast.style.zIndex = '9999';
    toast.innerHTML = `
        <div class="d-flex align-items-center">
            <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'} me-2"></i>
            <span>${message}</span>
        </div>
    `;
    document.body.appendChild(toast);
    setTimeout(() => toast.remove(), 3000);
}

function loadMoreNews() {
    if (isLoading) return;
    isLoading = true;
    currentPage++;
    
    const loadMoreBtn = document.getElementById('loadMoreBtn');
    loadMoreBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Loading...';
    loadMoreBtn.disabled = true;
    
    // Simulate loading more (in production, this would fetch from API with pagination)
    setTimeout(() => {
        loadMoreBtn.innerHTML = 'Load More <i class="fas fa-arrow-down ms-2"></i>';
        loadMoreBtn.disabled = false;
        isLoading = false;
        showToast('More news loaded!', 'success');
    }, 1000);
}

// Auto-refresh every 5 minutes
setInterval(() => {
    refreshNews();
}, 300000); // 5 minutes

// Add AOS initialization
if (typeof AOS !== 'undefined') {
    AOS.init({
        duration: 800,
        once: true
    });
}
</script>
@endsection
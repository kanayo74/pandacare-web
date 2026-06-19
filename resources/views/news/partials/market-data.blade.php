{{-- resources/views/news/partials/market-data.blade.php --}}
<div class="d-flex justify-content-between align-items-center mb-3">
    <h6 class="fw-bold mb-0 text-white">Markets</h6>
    <small class="text-white-50"><i class="fas fa-chart-line"></i> Live</small>
</div>
<div class="market-item">
    <span class="text-white-50">Dow Jones Global</span>
    <div class="text-end">
        <strong class="text-white">{{ $marketData['dow_jones']['value'] ?? '42,156.89' }}</strong>
        <span class="{{ $marketData['dow_jones']['trend'] === 'up' ? 'trend-up' : 'trend-down' }} ms-2">
            {{ $marketData['dow_jones']['change'] ?? '+1.89%' }} {{ $marketData['dow_jones']['trend'] === 'up' ? '↑' : '↓' }}
        </span>
    </div>
</div>
<div class="market-item">
    <span class="text-white-50">FTSE All World</span>
    <div class="text-end">
        <strong class="text-white">{{ $marketData['ftse_all']['value'] ?? '4,670.40' }}</strong>
        <span class="{{ $marketData['ftse_all']['trend'] === 'up' ? 'trend-up' : 'trend-down' }} ms-2">
            {{ $marketData['ftse_all']['change'] ?? '+1.90%' }} {{ $marketData['ftse_all']['trend'] === 'up' ? '↑' : '↓' }}
        </span>
    </div>
</div>
<div class="market-item">
    <span class="text-white-50">US Oil WTI</span>
    <div class="text-end">
        <strong class="text-white">{{ $marketData['us_oil']['value'] ?? '72.64' }}</strong>
        <span class="{{ $marketData['us_oil']['trend'] === 'up' ? 'trend-up' : 'trend-down' }} ms-2">
            {{ $marketData['us_oil']['change'] ?? '-2.98%' }} {{ $marketData['us_oil']['trend'] === 'up' ? '↑' : '↓' }}
        </span>
    </div>
</div>
<div class="market-item">
    <span class="text-white-50">Gold</span>
    <div class="text-end">
        <strong class="text-white">{{ $marketData['gold']['value'] ?? '2,364.50' }}</strong>
        <span class="{{ $marketData['gold']['trend'] === 'up' ? 'trend-up' : 'trend-down' }} ms-2">
            {{ $marketData['gold']['change'] ?? '+0.63%' }} {{ $marketData['gold']['trend'] === 'up' ? '↑' : '↓' }}
        </span>
    </div>
</div>
<div class="market-item">
    <span class="text-white-50">USD/INR</span>
    <div class="text-end">
        <strong class="text-white">{{ $marketData['usd_inr']['value'] ?? '83.45' }}</strong>
        <span class="{{ $marketData['usd_inr']['trend'] === 'up' ? 'trend-up' : 'trend-down' }} ms-2">
            {{ $marketData['usd_inr']['change'] ?? '-0.15%' }} {{ $marketData['usd_inr']['trend'] === 'up' ? '↑' : '↓' }}
        </span>
    </div>
</div>
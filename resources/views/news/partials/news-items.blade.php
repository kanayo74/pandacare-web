{{-- resources/views/news/partials/news-items.blade.php --}}
@forelse($news as $item)
    <div class="col-md-6 col-lg-6" data-aos="fade-up">
        <div class="card h-100 border-0 shadow-sm news-card">
            @if($item['image'])
                <img src="{{ $item['image'] }}" 
                     class="card-img-top" 
                     alt="{{ $item['title'] }}"
                     style="height: 200px; object-fit: cover;"
                     onerror="this.src='https://placehold.co/600x400/0d6efd/white?text=Health+News'">
            @endif
            <div class="card-body">
                <div class="mb-2">
                    <span class="badge-category">{{ $item['type'] }}</span>
                    <small class="text-muted ms-2">
                        <i class="far fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($item['published_at'])->format('M d, Y') }}
                    </small>
                </div>
                <h3 class="h6 fw-bold mb-3">
                    <a href="{{ route('news.detail', $item['slug']) }}" class="text-decoration-none text-dark">
                        {{ Str::limit($item['title'], 80) }}
                    </a>
                </h3>
                <p class="text-muted small">{{ Str::limit($item['excerpt'] ?? $item['description'], 100) }}</p>
                <a href="{{ route('news.detail', $item['slug']) }}" class="text-primary text-decoration-none small">
                    Read More <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
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
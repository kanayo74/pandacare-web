{{-- resources/views/news/detail.blade.php --}}
@extends('layouts.app')

@section('title', $news['title'] . ' - Pandacare')

@section('content')
<section class="news-detail py-5">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('news.index') }}">News</a></li>
                <li class="breadcrumb-item active" aria-current="page">Article</li>
            </ol>
        </nav>
        
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <article>
                    <h1 class="display-5 fw-bold mb-3">{{ $news['title'] }}</h1>
                    
                    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
                        <div>
                            <span class="badge-category">{{ $news['type'] }}</span>
                            <span class="text-muted ms-3">
                                <i class="far fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($news['published_at'])->format('F d, Y \a\t g:i A') }}
                            </span>
                        </div>
                        <div>
                            <span class="text-muted">
                                <i class="far fa-newspaper"></i> Source: {{ $news['source'] }}
                            </span>
                        </div>
                    </div>
                    
                    @if($news['image'])
                        <img src="{{ $news['image'] }}" 
                             class="img-fluid rounded-4 mb-4 w-100" 
                             alt="{{ $news['title'] }}"
                             style="max-height: 400px; object-fit: cover;">
                    @endif
                    
                    <div class="news-content fs-5 lh-lg">
                        <p class="lead fw-semibold">{{ $news['description'] }}</p>
                        <p>{{ $news['content'] ?? $news['description'] }}</p>
                    </div>
                    
                    <div class="mt-5 pt-3 border-top">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span class="me-3">Share:</span>
                                <a href="#" class="btn btn-sm btn-outline-primary me-1"><i class="fab fa-facebook-f"></i></a>
                                <a href="#" class="btn btn-sm btn-outline-info me-1"><i class="fab fa-twitter"></i></a>
                            </div>
                            <a href="{{ route('news.index') }}" class="btn btn-primary">
                                <i class="fas fa-arrow-left me-2"></i>Back to News
                            </a>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>

<style>
.badge-category {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    display: inline-block;
}
</style>
@endsection
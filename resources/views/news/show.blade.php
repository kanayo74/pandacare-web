@extends('layouts.app')

@section('title', $news->title . ' - Pandacare')

@section('content')
<section class="news-detail py-5">
    <div class="container py-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('news') }}">Health News</a></li>
                <li class="breadcrumb-item active">{{ Str::limit($news->title, 50) }}</li>
            </ol>
        </nav>
        
        <article class="mt-4">
            <h1 class="display-5 fw-bold mb-4">{{ $news->title }}</h1>
            
            <div class="mb-4">
                <span class="badge bg-primary me-2">{{ ucfirst($news->type) }}</span>
                <span class="text-muted">
                    <i class="far fa-calendar-alt me-1"></i> {{ $news->published_at->format('F d, Y') }}
                </span>
                @if($news->author)
                    <span class="text-muted ms-3">
                        <i class="far fa-user me-1"></i> By {{ $news->author }}
                    </span>
                @endif
                <span class="text-muted ms-3">
                    <i class="far fa-eye me-1"></i> {{ $news->views }} views
                </span>
            </div>
            
            @if($news->image)
                <img src="{{ asset('images/news/' . $news->image) }}" 
                     alt="{{ $news->title }}" 
                     class="img-fluid rounded-4 shadow-lg mb-4 w-100"
                     style="max-height: 500px; object-fit: cover;">
            @endif
            
            <div class="content">
                {!! nl2br(e($news->content)) !!}
            </div>
        </article>
        
        @if($relatedNews->count() > 0)
            <div class="mt-5 pt-5">
                <h3 class="h3 fw-bold mb-4">Related Articles</h3>
                <div class="row g-4">
                    @foreach($relatedNews as $related)
                        <div class="col-md-4">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body">
                                    <h4 class="h6 fw-bold">
                                        <a href="{{ route('news.detail', $related->slug) }}" class="text-decoration-none text-dark">
                                            {{ $related->title }}
                                        </a>
                                    </h4>
                                    <p class="text-muted small mt-2">{{ Str::limit($related->excerpt, 80) }}</p>
                                    <a href="{{ route('news.detail', $related->slug) }}" class="text-primary small">
                                        Read More <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</section>
@endsection
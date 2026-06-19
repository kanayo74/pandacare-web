@extends('layouts.app')

@section('title', $service->name . ' - Pandacare')

@section('content')
<section class="service-detail py-5">
    <div class="container py-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('services') }}">Services</a></li>
                <li class="breadcrumb-item active">{{ $service->name }}</li>
            </ol>
        </nav>
        
        <div class="row mt-4">
            <div class="col-lg-6 mb-4 mb-lg-0" data-aos="fade-right">
                <img src="{{ asset('images/services/' . $service->image) }}" 
                     alt="{{ $service->name }}" 
                     class="img-fluid rounded-4 shadow-lg">
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <h1 class="display-5 fw-bold mb-4">{{ $service->name }}</h1>
                <p class="lead mb-4">{{ $service->description }}</p>
                
                @if($service->features)
                    <div class="mb-4">
                        <h3 class="h5 fw-bold mb-3">Key Features:</h3>
                        <ul class="list-unstyled">
                            @foreach($service->features as $feature)
                                <li class="mb-2">
                                    <i class="fas fa-check-circle text-primary me-2"></i>
                                    {{ $feature }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                @if($service->price_range)
                    <div class="alert alert-info">
                        <i class="fas fa-tag me-2"></i>
                        Price Range: {{ $service->price_range }}
                    </div>
                @endif
                
                <a href="{{ route('download.redirect') }}" class="btn btn-primary btn-lg mt-3">
                    <i class="fas fa-download me-2"></i>Book This Service
                </a>
            </div>
        </div>
        
        @if($relatedServices->count() > 0)
            <div class="mt-5 pt-5">
                <h3 class="h3 fw-bold mb-4">Related Services</h3>
                <div class="row g-4">
                    @foreach($relatedServices as $related)
                        <div class="col-md-4">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body">
                                    <i class="fas {{ $related->icon }} fa-2x text-primary mb-3"></i>
                                    <h4 class="h5 fw-bold">{{ $related->name }}</h4>
                                    <p class="text-muted small">{{ Str::limit($related->short_description, 80) }}</p>
                                    <a href="{{ route('service.detail', $related->slug) }}" class="text-primary">
                                        Learn More <i class="fas fa-arrow-right ms-1"></i>
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
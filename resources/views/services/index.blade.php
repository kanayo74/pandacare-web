@extends('layouts.app')

@section('title', 'Our Services - Pandacare')

@section('content')
<section class="services-hero bg-gradient-primary text-white py-5">
    <div class="container py-5 text-center">
        <h1 class="display-4 fw-bold mb-4">Our Healthcare Services</h1>
        <p class="lead">Comprehensive medical care tailored to your needs</p>
    </div>
</section>

<section class="services-list py-5">
    <div class="container py-5">
        <div class="row g-4">
            @foreach($services as $service)
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                    <div class="card h-100 border-0 shadow-sm hover-shadow">
                        <img src="{{ asset('images/services/' . $service->image) }}" 
                             class="card-img-top" 
                             alt="{{ $service->name }}"
                             style="height: 200px; object-fit: cover;">
                        <div class="card-body p-4">
                            <div class="service-icon mb-3">
                                <i class="fas {{ $service->icon }} fa-2x text-primary"></i>
                            </div>
                            <h3 class="h4 fw-bold mb-3">{{ $service->name }}</h3>
                            <p class="text-muted mb-4">{{ $service->short_description }}</p>
                            <a href="{{ route('service.detail', $service->slug) }}" class="btn btn-outline-primary">
                                Learn More <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
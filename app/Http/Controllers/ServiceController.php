<?php
// app/Http/Controllers/ServiceController.php

namespace App\Http\Controllers;

use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::where('is_active', true)
            ->orderBy('order')
            ->get();
        
        return view('index', compact('services'));
    }

    public function show($slug)
    {
        $service = Service::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
        
        $otherServices = Service::where('is_active', true)
            ->where('id', '!=', $service->id)
            ->orderBy('order')
            ->limit(3)
            ->get();
            
        return view('services.detail', compact('service', 'otherServices'));
    }
}
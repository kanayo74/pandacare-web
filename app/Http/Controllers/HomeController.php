<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\News;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $services = Service::where('is_active', true)->take(6)->get();
        $latestNews = News::where('type', 'medical')->where('is_published', true)->take(3)->get();
        $latestSports = News::where('type', 'sports')->where('is_published', true)->take(3)->get();
        
        return view('home', compact('services', 'latestNews', 'latestSports'));
    }
    
    public function about()
    {
        return view('about');
    }
    
    public function contact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string',
            
        ]);

        $teamMembers = TeamMember::orderBy('order_column', 'asc')  // or 'id'
                            ->where('is_active', true)
                            ->get();

    return view('your-page-name', compact(
        'services', 
        'latestNews', 
        'latestSports',
        'teamMembers'   // ← Add this
    ));

                
        // Store contact message or send email
        // Contact::create($validated);
        
        return back()->with('success', 'Thank you for contacting us. We will get back to you soon!');
    }
}
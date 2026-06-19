<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class DownloadController extends Controller
{
    public function redirect(Request $request)
    {
        $agent = new Agent();
        
        if ($agent->isAndroid()) {
            return redirect()->away('https://play.google.com/store/apps/details?id=app.pandacare.com');
        } elseif ($agent->isIOS()) {
            return redirect()->away('https://apps.apple.com/ng/app/pandacare-app/id6755859705');
        } else {
            // Desktop - show download options page
            return view('download-options');
        }
    }
    
    public function direct($platform)
    {
        if ($platform === 'android') {
            return redirect()->away('https://play.google.com/store/apps/details?id=app.pandacare.com');
        } elseif ($platform === 'ios') {
            return redirect()->away('https://apps.apple.com/ng/app/pandacare-app/id6755859705');
        }
        
        return redirect()->route('home');
    }
}
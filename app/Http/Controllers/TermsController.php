<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TermsController extends Controller
{
    /**
     * Show the Terms & Conditions page.
     */
    public function index()
    {
        return view('terms');
    }
}
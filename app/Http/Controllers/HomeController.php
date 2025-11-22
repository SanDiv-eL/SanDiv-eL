<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = \App\Models\Product::latest()->take(4)->get();
        return view('welcome', compact('featuredProducts'));
    }
}

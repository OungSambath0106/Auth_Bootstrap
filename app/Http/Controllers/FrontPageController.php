<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontPageController extends Controller
{
    
    public function index()
    {
        return view('front_home');
    }

    public function about()
    {
        return view('front_about');
    }

    public function service()
    {
        return view('front_service');
    }

    public function menu()
    {
        return view('front_menu');
    }

    public function reservation()
    {
        return view('front_reservation');
    }

    public function testimonial()
    {
        return view('front_testimonial');
    }

    public function contact()
    {
        return view('front_contact');
    }
}

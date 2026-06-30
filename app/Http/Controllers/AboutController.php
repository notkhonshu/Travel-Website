<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $data = [
            'metadata' => [
                'title'          => 'About Us | Bali Guide Adventure',
                'description'    => 'Get to know Bali Guide Adventure — our story, our passion for Bali, and the local guides who make every trip unforgettable.',
                'keyword'        => 'about bali guide adventure, bali tour company, local bali guides, bali adventure team',
                'og-title'       => 'About Bali Guide Adventure',
                'og-description' => 'Discover the story behind Bali Guide Adventure and the local team dedicated to showing you the real Bali.',
                'og-image'       => 'assets/img/static/about/about-cover.jpg',
                'og-type'        => 'website',
            ],
        ];

        return view('pages.landing.about', compact('data'));
    }
}
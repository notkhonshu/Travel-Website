<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $data = [
            'metadata' => [
                'title'          => 'About Us | The Bali Guides Adventure',
                'description'    => 'Get to know The Bali Guides Adventure — our story, our passion for Bali, and the local guides who make every trip unforgettable.',
                'keyword'        => 'about the bali guides adventure, bali tour company, local bali guides, bali adventure team',
                'og-title'       => 'About The Bali Guides Adventure',
                'og-description' => 'Discover the story behind The Bali Guides Adventure and the local team dedicated to showing you the real Bali.',
                'og-image'       => 'assets/img/static/about/about-cover.jpg',
                'og-type'        => 'website',
            ],
        ];

        return view('pages.landing.about', compact('data'));
    }
}
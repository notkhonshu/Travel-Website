<?php

namespace App\Http\Controllers;

class LegalController extends Controller
{
    public function index()
    {
        $data = [
            'metadata' => [
                'title'          => config('app.name') . ' | Legal Notice',
                'description'    => 'Legal notice for Bali Guide Adventure — company registration, management, contact information, and tax details for PT Bali Guide Adventure.',
                'keyword'        => 'legal notice, bali guide adventure, PT bali guide adventure, company registration bali, travel agency bali',
                'og-title'       => config('app.name') . ' | Legal Notice',
                'og-description' => 'Official legal information for PT Bali Guide Adventure, a registered tour and adventure company based in Gianyar, Bali, Indonesia.',
                'og-image'       => 'assets/img/static/beach.jpg',
                'og-type'        => 'website',
            ],
        ];

        return view('pages.support.legal', compact('data'));
    }
}
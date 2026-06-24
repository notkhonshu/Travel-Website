<?php

namespace App\Http\Controllers;

class LandingController extends Controller
{
    public function index()
    {
        $configData   = config('data');
        $destinations = collect($configData['destinations'] ?? []);
        $packages     = collect($configData['packages']    ?? []);
        $activities   = collect($configData['activities']  ?? []);
        $posts        = collect(config('blog.posts',       []));

        $usedSlugs = $packages->pluck('destination')
                    ->concat($activities->pluck('destination'))
                    ->filter()->unique();

        $sections = [
            'has_packages'     => $packages->isNotEmpty(),
            'has_activities'   => $activities->isNotEmpty(),
            'has_destinations' => $usedSlugs->isNotEmpty(),
            'has_blog'         => $posts->isNotEmpty(),
        ];

        $data = [
            'metadata' => [
                'title'          => config('app.name').' | Bali Tours, Trekking & Adventure Packages',
                'description'    => "Discover Bali's best adventures with The Bali Guides Adventure — Mount Batur trekking, ATV rides, snorkeling, cultural tours, and more, all with trusted local guides.",
                'keyword'        => 'bali tours, bali adventure, mount batur trekking, bali activities, the bali guides adventure',
                'og-title'       => config('app.name'),
                'og-description' => "Your journey to Bali starts here — thrilling adventures, hidden destinations, and authentic local guidance.",
                'og-image'       => 'assets/img/static/beach.jpg',
                'og-type'        => 'website',
            ],
        ];

        return view('pages.landing.index', compact('sections', 'data'));
    }
}
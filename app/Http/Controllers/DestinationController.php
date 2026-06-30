<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function index(Request $request)
    {
        $configData  = config('data');
        $destinations = collect($configData['destinations'] ?? []);
        $q = trim($request->query('q', ''));
        if ($q !== '') {
            $qLower       = strtolower($q);
            $destinations = $destinations->filter(function ($item) use ($qLower) {
                $haystack = strtolower(implode(' ', array_filter([
                    $item['label']   ?? '',
                    $item['tagline'] ?? '',
                    $item['desc']    ?? '',
                    $item['tag']     ?? '',
                ])));
                return str_contains($haystack, $qLower);
            });
        }

        $destinations = $destinations->values();

        $pageTitle = 'Explore Bali Destinations';
        if ($q !== '') {
            $pageTitle = "Search results for \"{$q}\" — Bali Destinations";
        }

        $data = [
            'metadata' => [
                'title'          => "{$pageTitle} | Bali Guide Adventure",
                'description'    => 'Discover the best destinations in Bali — from volcanic highlands to tropical islands. Find your perfect Bali experience.',
                'keyword'        => 'bali destinations, bali places, ubud, kintamani, nusa penida, seminyak, uluwatu, the bali guides adventure',
                'og-title'       => $pageTitle,
                'og-description' => 'Explore all Bali destinations and plan your perfect trip with Bali Guide Adventure.',
                'og-image'       => $destinations->first()['image'] ?? 'assets/img/static/beach.jpg',
                'og-type'        => 'website',
            ],
        ];

        return view('pages.landing.destinations', compact(
            'destinations',
            'q',
            'data'
        ));
    }
}
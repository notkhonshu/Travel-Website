<?php

namespace App\Http\Controllers;

class LandingController extends Controller
{
    public function index()
    {
        $data       = config('data');
        $destinations = collect($data['destinations'] ?? []);
        $packages   = collect($data['packages']   ?? []);
        $activities = collect($data['activities'] ?? []);

        $usedSlugs    = $packages->pluck('destination')
                    ->concat($activities->pluck('destination'))
                    ->filter()->unique();

        $sections = [
            'has_packages'     => $packages->isNotEmpty(),
            'has_activities'   => $activities->isNotEmpty(),
            'has_destinations' => $usedSlugs->isNotEmpty(),
        ];

        return view('pages.landing.index', compact('sections'));
    }
}
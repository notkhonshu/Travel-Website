<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index(Request $request)
    {
        $configData = config('data');

        $listings = collect($configData['packages'] ?? [])
            ->map(fn($p) => array_merge($p, ['type' => 'package']));

        $destConfig = collect($configData['destinations'] ?? []);
        $usedSlugs    = $listings->pluck('destination')->filter()->unique()->values();
        $destinations = $usedSlugs
            ->map(fn($slug) => $destConfig->firstWhere('slug', $slug))
            ->filter()
            ->values();

        $categories = $listings
            ->pluck('category')
            ->filter()
            ->unique()
            ->values()
            ->map(fn($slug) => [
                'slug'  => $slug,
                'label' => ucwords(str_replace('-', ' ', $slug)),
            ])
            ->all();

        $q = trim($request->query('q', ''));
        if ($q !== '') {
            $qLower   = strtolower($q);
            $listings = $listings->filter(function ($item) use ($qLower) {
                $haystack = strtolower(implode(' ', array_filter([
                    $item['title']       ?? '',
                    $item['excerpt']     ?? '',
                    $item['category']    ?? '',
                    $item['destination'] ?? '',
                    $item['difficulty']  ?? '',
                    $item['badge']       ?? '',
                ])));
                return str_contains($haystack, $qLower);
            });
        }

        $activeCategory = $request->query('category', 'all');
        if ($activeCategory !== 'all') {
            $listings = $listings->filter(
                fn($item) => ($item['category'] ?? '') === $activeCategory
            );
        }

        $activeDestination = $request->query('destination', '');
        if ($activeDestination !== '') {
            $listings = $listings->filter(
                fn($item) => strtolower($item['destination'] ?? '') === strtolower($activeDestination)
            );
        }

        $sort     = $request->query('sort', 'default');
        $listings = match ($sort) {
            'price_asc'  => $listings->sortBy('price'),
            'price_desc' => $listings->sortByDesc('price'),
            'rating'     => $listings->sortByDesc('rating'),
            default      => $listings,
        };
        $listings = $listings->values();

        $pageTitle = 'Bali Tour Packages';

        if ($activeDestination !== '') {
            $destLabel = optional($destConfig->firstWhere('slug', $activeDestination))['label']
                ?? ucwords(str_replace('-', ' ', $activeDestination));
            $pageTitle = "Tour Packages in {$destLabel}, Bali";
        } elseif ($activeCategory !== 'all' && $activeCategory !== '') {
            $catLabel  = ucwords(str_replace('-', ' ', $activeCategory));
            $pageTitle = "{$catLabel} Packages in Bali";
        }

        if ($q !== '') {
            $pageTitle = "Search results for \"{$q}\" — {$pageTitle}";
        }

        $data = [
            'metadata' => [
                'title'          => "{$pageTitle} | The Bali Guides Adventure",
                'description'    => "Browse {$pageTitle} — book the best guided tour packages across Bali with The Bali Guides Adventure.",
                'keyword'        => "bali tour packages, {$activeDestination}, {$activeCategory}, bali packages, the bali guides adventure",
                'og-title'       => $pageTitle,
                'og-description' => "Explore {$pageTitle} and book your next Bali adventure with trusted local guides.",
                'og-image'       => $listings->first()['image'] ?? 'assets/img/static/beach.jpg',
                'og-type'        => 'website',
            ],
        ];

        return view('pages.landing.packages', compact(
            'listings',
            'categories',
            'destinations',
            'activeCategory',
            'activeDestination',
            'sort',
            'q',
            'data'
        ));
    }
}
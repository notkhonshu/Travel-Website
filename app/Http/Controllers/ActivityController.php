<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index(Request $request)
    {
        $configData = config('data');
        $listings = collect($configData['activities'] ?? [])
            ->map(fn($a) => array_merge($a, ['type' => 'activity']));

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

        $pageTitle = 'Bali Activities';

        if ($activeDestination !== '') {
            $destLabel = optional($destConfig->firstWhere('slug', $activeDestination))['label']
                ?? ucwords(str_replace('-', ' ', $activeDestination));
            $pageTitle = "Activities in {$destLabel}, Bali";
        } elseif ($activeCategory !== 'all' && $activeCategory !== '') {
            $catLabel  = ucwords(str_replace('-', ' ', $activeCategory));
            $pageTitle = "{$catLabel} Activities in Bali";
        }

        if ($q !== '') {
            $pageTitle = "Search results for \"{$q}\" — {$pageTitle}";
        }

        $data = [
            'metadata' => [
                'title'          => "{$pageTitle} | Bali Guide Adventure",
                'description'    => "Browse {$pageTitle} — discover and book the best guided activities across Bali with Bali Guide Adventure.",
                'keyword'        => "bali activities, {$activeDestination}, {$activeCategory}, bali tours, bali guide adventure",
                'og-title'       => $pageTitle,
                'og-description' => "Explore {$pageTitle} and book your next Bali activity with trusted local guides.",
                'og-image'       => $listings->first()['image'] ?? 'assets/img/static/beach.jpg',
                'og-type'        => 'website',
            ],
        ];

        return view('pages.landing.activities', compact(
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
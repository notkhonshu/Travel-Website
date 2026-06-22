<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function index(Request $request)
    {
        $data = config('data');

        // ── Base collections ─────────────────────────────────────────────────
        $packages   = collect($data['packages']   ?? [])->map(fn($p) => array_merge($p, ['type' => 'package']));
        $activities = collect($data['activities'] ?? [])->map(fn($a) => array_merge($a, ['type' => 'activity']));
        $allListings = $packages->concat($activities);

        // ── Destinations ─────────────────────────────────────────────────────
        $destConfig  = collect($data['destinations'] ?? []);
        $usedSlugs   = $allListings->pluck('destination')->filter()->unique()->values();
        $destinations = $usedSlugs
            ->map(fn($slug) => $destConfig->firstWhere('slug', $slug))
            ->filter()
            ->values();

        // ── Categories (dari data langsung, tanpa icon map) ───────────────────
        $categories = $allListings
            ->pluck('category')
            ->filter()
            ->unique()
            ->values()
            ->map(fn($slug) => [
                'slug'  => $slug,
                'label' => ucwords(str_replace('-', ' ', $slug)),
            ])
            ->all();

        // ── Search query ──────────────────────────────────────────────────────
        $q = trim($request->query('q', ''));
        if ($q !== '') {
            $qLower      = strtolower($q);
            $allListings = $allListings->filter(function ($item) use ($qLower) {
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

        // ── Category filter ───────────────────────────────────────────────────
        $activeCategory = $request->query('category', 'all');
        $listings = $activeCategory !== 'all'
            ? $allListings->filter(fn($item) => ($item['category'] ?? '') === $activeCategory)
            : $allListings;

        // ── Destination filter ────────────────────────────────────────────────
        $activeDestination = $request->query('destination', '');
        if ($activeDestination !== '') {
            $listings = $listings->filter(
                fn($item) => strtolower($item['destination'] ?? '') === strtolower($activeDestination)
            );
        }

        // ── Sort ──────────────────────────────────────────────────────────────
        $sort = $request->query('sort', 'default');
        $listings = match ($sort) {
            'price_asc'  => $listings->sortBy('price'),
            'price_desc' => $listings->sortByDesc('price'),
            'rating'     => $listings->sortByDesc('rating'),
            default      => $listings,
        };
        $listings = $listings->values();

        return view('pages.landing.trip', compact(
            'listings',
            'categories',
            'destinations',
            'activeCategory',
            'activeDestination',
            'sort',
            'q'
        ));
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TripController extends Controller
{
    public function show(string $slug)
    {
        $data = config('data');

        $trip = collect($data['packages'])->firstWhere('slug', $slug);
        $type = 'package';

        if (! $trip) {
            $trip = collect($data['activities'])->firstWhere('slug', $slug);
            $type = 'activity';
        }

        abort_if(! $trip, 404);

        // Resolve image paths ke URL absolut
        $trip = $this->resolveImagePaths($trip);

        $destination = collect($data['destinations'])->firstWhere('slug', $trip['destination']);

        return view('pages.detail.trip', compact('trip', 'type', 'destination'));
    }

    private function resolveImagePaths(array $trip): array
    {
        if (!empty($trip['image'])) {
            $trip['image'] = asset($trip['image']);
        }

        if (!empty($trip['gallery'])) {
            $trip['gallery'] = array_map(fn($img) => asset($img), $trip['gallery']);
        }

        return $trip;
    }
}
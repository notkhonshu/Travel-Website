<?php

namespace App\Http\Controllers;

class TripController extends Controller
{
    public function show(string $slug)
    {
        $configData = config('data');

        $trip = collect($configData['packages'])->firstWhere('slug', $slug);
        $type = 'package';
        if (! $trip) {
            $trip = collect($configData['activities'])->firstWhere('slug', $slug);
            $type = 'activity';
        }

        abort_if(! $trip, 404);

        $destination = collect($configData['destinations'])->firstWhere('slug', $trip['destination']);

        $data = [
            'metadata' => [
                'title'          => "{$trip['title']} - {$trip['duration']} | The Bali Guides Adventure",
                'description'    => $trip['excerpt'] ?? '',
                'keyword'        => "{$trip['category']}, {$trip['destination']}, bali tour, {$trip['title']}",
                'og-title'       => $trip['title'],
                'og-description' => $trip['excerpt'] ?? '',
                'og-image'       => $trip['image'] ?? 'assets/img/static/beach.jpg',
                'og-type'        => 'product',
            ],
        ];

        $trip = $this->resolveImagePaths($trip);

        return view('pages.detail.trip', compact('trip', 'type', 'destination', 'data'));
    }

    private function resolveImagePaths(array $trip): array
    {
        if (!empty($trip['image']) && !str_starts_with($trip['image'], 'http')) {
            $trip['image'] = asset($trip['image']);
        }
        if (!empty($trip['gallery'])) {
            $trip['gallery'] = array_map(
                fn($img) => str_starts_with($img, 'http') ? $img : asset($img),
                $trip['gallery']
            );
        }
        return $trip;
    }
}
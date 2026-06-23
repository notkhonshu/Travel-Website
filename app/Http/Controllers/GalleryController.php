<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class GalleryController extends Controller
{
    private array $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp', 'gif', 'avif'];

    public function index()
    {
        $galleryPath = public_path('assets/img/static/gallery');

        $images = collect();

        if (File::isDirectory($galleryPath)) {
            $images = collect(File::files($galleryPath))
                ->filter(fn ($file) => in_array(
                    strtolower($file->getExtension()),
                    $this->allowedExtensions
                ))
                ->map(fn ($file) => [
                    'filename' => $file->getFilename(),
                    'url'      => asset('assets/img/static/gallery/' . $file->getFilename()),
                    'alt'      => pathinfo($file->getFilename(), PATHINFO_FILENAME),
                ])
                ->values();
        }

        $data = [
            'metadata' => [
                'title'          => 'Gallery | The Bali Guides Adventure',
                'description'    => 'Browse photos from our Bali tours and activities — volcanic treks, waterfalls, snorkeling, and cultural adventures captured by our guests and guides.',
                'keyword'        => 'bali gallery, bali tour photos, bali adventure photos, the bali guides adventure gallery',
                'og-title'       => 'Photo Gallery — The Bali Guides Adventure',
                'og-description' => 'A look at the adventures, landscapes, and experiences our guests have captured across Bali.',
                'og-image'       => $images->first()['url'] ?? asset('assets/img/static/beach.jpg'),
                'og-type'        => 'website',
            ],
        ];

        return view('pages.landing.gallery', compact('images', 'data'));
    }
}
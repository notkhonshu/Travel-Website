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

        return view('pages.landing.gallery', compact('images'));
    }
}
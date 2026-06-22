<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\ContactController;


Route::view('/about-us', 'pages.landing.about')
    ->name('landing.about');
Route::get('/', [LandingController::class, 'index'])->name('landing.index');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/trip', [ListingController::class, 'index'])->name('trip.index');
Route::get('/trip/{slug}', [TripController::class, 'show'])->name('trip.show');


Route::get('/contact-us',  [ContactController::class, 'index'])->name('landing.contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
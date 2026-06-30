<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\LegalController;
use App\Http\Controllers\FaqController;

Route::get('/', [LandingController::class, 'index'])->name('landing.index');
Route::get('/about-us', [AboutController::class, 'index'])->name('landing.about');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/contact-us', [ContactController::class, 'index'])->name('landing.contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

Route::get('/trip', [ListingController::class, 'index'])->name('trip.index');
Route::get('/trip/{slug}', [TripController::class, 'show'])->name('trip.show');

Route::get('/activities', [ActivityController::class, 'index'])->name('activity.index');
Route::get('/activities/{slug}', [TripController::class, 'show'])->name('activity.show');

Route::get('/packages', [PackageController::class, 'index'])->name('package.index');
Route::get('/packages/{slug}', [TripController::class, 'show'])->name('package.show');

Route::get('/destinations', [DestinationController::class, 'index'])->name('destination.index');

Route::get('/articles', [BlogController::class, 'index'])->name('article.index');
Route::get('/articles/{slug}', [BlogController::class, 'show'])->name('article.show');

Route::get('/legal', [LegalController::class, 'index'])->name('legal.index');
Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');

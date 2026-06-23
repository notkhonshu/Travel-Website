<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;

class ContactController extends Controller
{
    public function index()
    {
        $social  = config('social');
        $cs      = $social['customer_service'];
        $address = $social['address'];

        $socials = collect([
            'instagram' => ['icon' => 'ti-brand-instagram', 'label' => 'Instagram'],
            'facebook'  => ['icon' => 'ti-brand-facebook',  'label' => 'Facebook'],
            'tiktok'    => ['icon' => 'ti-brand-tiktok',    'label' => 'TikTok'],
            'youtube'   => ['icon' => 'ti-brand-youtube',   'label' => 'YouTube'],
            'twitter'   => ['icon' => 'ti-brand-x',         'label' => 'X / Twitter'],
        ])->filter(fn($_, $key) => !empty($social[$key]['url']))->map(function ($item, $key) use ($social) {
            $item['name'] = $social[$key]['name'] ?? '';
            $item['url']  = $social[$key]['url'];
            return $item;
        });

        $data = [
            'metadata' => [
                'title'          => 'Contact Us | The Bali Guides Adventure',
                'description'    => 'Get in touch with The Bali Guides Adventure for bookings, custom itineraries, or any questions about our Bali tours and activities.',
                'keyword'        => 'contact the bali guides adventure, bali tour booking, bali travel agent contact',
                'og-title'       => 'Contact The Bali Guides Adventure',
                'og-description' => 'Reach out to our team for bookings, custom trips, or questions about touring Bali with us.',
                'og-image'       => 'assets/img/static/beach.jpg',
                'og-type'        => 'website',
            ],
        ];

        return view('pages.landing.contact', compact('cs', 'address', 'socials', 'data'));
    }

    public function send(Request $request)
    {
        $key = 'contact-form:' . $request->ip();

        if (RateLimiter::tooManyAttempts($key, 3)) {
            $seconds = RateLimiter::availableIn($key);
            return back()->withErrors([
                'rate_limit' => "Too many attempts. Please try again in {$seconds} seconds.",
            ])->withInput();
        }

        $validated = $request->validate([
            'name'    => ['required', 'string', 'max:100'],
            'email'   => ['required', 'email', 'max:150'],
            'phone'   => ['nullable', 'string', 'max:30'],
            'subject' => ['required', 'string', 'max:150'],
            'message' => ['required', 'string', 'min:10', 'max:2000'],
        ]);

        RateLimiter::hit($key, 300);

        $recipient = config('social.customer_service.email')
            ?: config('mail.from.address');

        Mail::to($recipient)->send(new ContactFormMail($validated));

        return back()->with('success', 'Your message has been sent. We\'ll get back to you shortly!');
    }
}
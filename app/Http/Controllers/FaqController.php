<?php

namespace App\Http\Controllers;

class FaqController extends Controller
{
    public function index()
    {
        $faqCategories = collect(config('faq.categories', []));

        $data = [
            'metadata' => [
                'title'          => config('app.name') . ' | Frequently Asked Questions',
                'description'    => 'Find answers to common questions about booking Bali tours and activities with Bali Guide Adventure — cancellation policy, what to bring, group bookings, and more.',
                'keyword'        => 'bali tour faq, bali adventure questions, book bali tour, bali guide adventure faq, bali activities cancellation policy, PT bali guide adventure',
                'og-title'       => config('app.name') . ' | FAQ',
                'og-description' => 'Got questions about your Bali adventure? Browse our FAQ for everything you need to know — from booking and payment to safety and logistics.',
                'og-image'       => 'assets/img/static/beach.jpg',
                'og-type'        => 'website',
            ],
        ];

        return view('pages.support.faq', compact('data', 'faqCategories'));
    }
}
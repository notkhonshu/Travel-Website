<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $configData = config('blog');
        $posts      = collect($configData['posts'] ?? []);
        $categories = $configData['categories'] ?? [];

        $q = trim($request->query('q', ''));
        if ($q !== '') {
            $qLower = strtolower($q);
            $posts  = $posts->filter(function ($post) use ($qLower) {
                $haystack = strtolower(implode(' ', array_filter([
                    $post['title']    ?? '',
                    $post['excerpt']  ?? '',
                    $post['category'] ?? '',
                    implode(' ', $post['tags'] ?? []),
                ])));
                return str_contains($haystack, $qLower);
            });
        }

        $activeCategory = $request->query('category', 'all');
        if ($activeCategory !== 'all') {
            $posts = $posts->filter(
                fn($post) => ($post['category'] ?? '') === $activeCategory
            );
        }

        $posts = $posts->values();

        $pageTitle = 'Travel Blog & Guides';
        if ($activeCategory !== 'all') {
            $catLabel  = collect($categories)->firstWhere('slug', $activeCategory)['label']
                ?? ucwords(str_replace('-', ' ', $activeCategory));
            $pageTitle = "{$catLabel} — Bali Travel Blog";
        }
        if ($q !== '') {
            $pageTitle = "Search results for \"{$q}\" — Bali Travel Blog";
        }

        $data = [
            'metadata' => [
                'title'          => "{$pageTitle} | Bali Guide Adventure",
                'description'    => 'Travel guides, adventure tips, cultural insights and wellness stories from Bali — written by local experts at Bali Guide Adventure.',
                'keyword'        => 'bali travel blog, bali guide, bali tips, bali culture, bali adventure',
                'og-title'       => $pageTitle,
                'og-description' => 'Explore Bali through the eyes of local guides — travel tips, destination guides, and cultural stories.',
                'og-image'       => $posts->first()['image'] ?? 'assets/img/static/beach.jpg',
                'og-type'        => 'website',
            ],
        ];

        return view('pages.landing.articles', compact(
            'posts',
            'categories',
            'activeCategory',
            'q',
            'data'
        ));
    }

    public function show(string $slug)
    {
        $configData = config('blog');
        $posts      = collect($configData['posts'] ?? []);

        $post = $posts->firstWhere('slug', $slug);
        abort_if(!$post, 404);

        $related = $posts
            ->filter(fn($p) => $p['slug'] !== $slug && $p['category'] === $post['category'])
            ->take(3)
            ->values();

        $categories = $configData['categories'] ?? [];

        $recentPosts = $posts
            ->filter(fn($p) => $p['slug'] !== $slug)
            ->sortByDesc('published_at')
            ->take(4)
            ->values();

        $data = [
            'metadata' => [
                'title'          => $post['meta']['title']       ?? "{$post['title']} | The Bali Guides Adventure",
                'description'    => $post['meta']['description'] ?? $post['excerpt'],
                'keyword'        => $post['meta']['keywords']    ?? implode(', ', $post['tags'] ?? []),
                'og-title'       => $post['title'],
                'og-description' => $post['excerpt'],
                'og-image'       => $post['image'],
                'og-type'        => 'article',
            ],
        ];

        return view('pages.detail.articles', compact(
            'post',
            'related',
            'categories',
            'recentPosts',
            'data'
        ));
    }
}
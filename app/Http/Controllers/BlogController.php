<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Support\PublicCache\PublicCacheKey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(Request $request): View
    {
        $data = Cache::remember(PublicCacheKey::blogIndex($request), now()->addMinutes(15), function () use ($request): array {
            $search = $request->query('search', '');
            $categoryId = $request->query('category', '');

            $query = Blog::query()
                ->with(['category', 'branch'])
                ->where('active', true)
                ->whereHas('category', fn ($q) => $q->where('active', true))
                ->whereHas('branch', fn ($q) => $q->where('active', true));

            if (! empty($search)) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhere('body', 'like', "%{$search}%")
                        ->orWhere('quotes', 'like', "%{$search}%");
                });
            }

            if (! empty($categoryId)) {
                $query->where('category_id', $categoryId);
            }

            $paginator = $query->latest()->paginate(6)->withQueryString();

            $blogsMapped = collect($paginator->items())->map(fn ($b) => [
                'id' => $b->id,
                'title' => $b->title,
                'slug' => $b->slug,
                'quotes' => $b->quotes,
                'body' => $b->body,
                'category_name' => $b->category?->name ?? 'Umum',
                'branch_name' => $b->branch?->name ?? '-',
                'thumbnail_url' => public_image_url($b->thumbnail),
                'formatted_date' => $b->created_at?->format('d M Y') ?? date('d M Y'),
            ])->toArray();

            $categories = Category::query()
                ->where('active', true)
                ->get(['id', 'name'])
                ->toArray();

            return [
                'hero' => [
                    'title' => 'Blog & Artikel HIMSI',
                    'subtitle' => 'Kumpulan Berita, Informasi Kegiatan, dan Artikel Edukatif Terkini',
                ],
                'blogs' => $blogsMapped,
                'paginator' => $paginator,
                'categories' => $categories,
                'currentSearch' => $search,
                'currentCategory' => $categoryId,
            ];
        });

        return view('pages.blog.index', $data);
    }

    public function show(string $slug): View
    {
        $data = Cache::remember(PublicCacheKey::blogShow($slug), now()->addHour(), function () use ($slug): array {
            $blog = Blog::query()
                ->with(['category', 'branch', 'images' => fn ($q) => $q->where('active', true)])
                ->where('active', true)
                ->whereHas('category', fn ($q) => $q->where('active', true))
                ->whereHas('branch', fn ($q) => $q->where('active', true))
                ->where('slug', $slug)
                ->firstOrFail();

            $relatedBlogs = Blog::query()
                ->with(['category', 'branch'])
                ->where('active', true)
                ->whereHas('category', fn ($q) => $q->where('active', true))
                ->whereHas('branch', fn ($q) => $q->where('active', true))
                ->where('id', '!=', $blog->id)
                ->where('category_id', $blog->category_id)
                ->latest()
                ->limit(3)
                ->get();

            return [
                'blog' => [
                    'id' => $blog->id,
                    'title' => $blog->title,
                    'slug' => $blog->slug,
                    'quotes' => $blog->quotes,
                    'body' => $blog->body,
                    'category_name' => $blog->category?->name ?? 'Umum',
                    'branch_name' => $blog->branch?->name ?? '-',
                    'thumbnail_url' => public_image_url($blog->thumbnail),
                    'formatted_date' => $blog->created_at?->format('d M Y') ?? date('d M Y'),
                    'images' => $blog->images->map(fn ($img) => [
                        'id' => $img->id,
                        'image_url' => public_image_url($img->image),
                        'description' => $img->description,
                    ])->toArray(),
                ],
                'relatedBlogs' => $relatedBlogs->map(fn ($b) => [
                    'id' => $b->id,
                    'title' => $b->title,
                    'slug' => $b->slug,
                    'quotes' => $b->quotes,
                    'category_name' => $b->category?->name ?? 'Umum',
                    'branch_name' => $b->branch?->name ?? '-',
                    'thumbnail_url' => public_image_url($b->thumbnail),
                    'formatted_date' => $b->created_at?->format('d M Y') ?? date('d M Y'),
                ])->toArray(),
            ];
        });

        return view('pages.blog.show', $data);
    }
}

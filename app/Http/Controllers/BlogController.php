<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Traits\FormatsFrontendData;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlogController extends Controller
{
    use FormatsFrontendData;

    public function index(Request $request): View
    {
        $search = $request->query('search');
        $categoryId = $request->query('category');

        $query = Blog::where('active', true)->with(['category', 'branch']);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('quotes', 'like', "%{$search}%")
                  ->orWhere('body', 'like', "%{$search}%");
            });
        }

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        $blogsPaginator = $query->latest()->paginate(9)->withQueryString();

        $categories = Category::where('active', true)->get();

        $data = [
            'hero' => [
                'title' => 'Blog & Artikel HIMSI',
                'subtitle' => 'Kumpulan Berita, Informasi Kegiatan, dan Artikel Edukatif Terkini',
            ],
            'blogs' => $blogsPaginator->map(fn ($item) => [
                'id' => $item->id,
                'title' => $item->title,
                'slug' => $item->slug,
                'quotes' => $item->quotes,
                'category_name' => $item->category?->name ?? 'Umum',
                'branch_name' => $item->branch?->name ?? 'DPP',
                'thumbnail_url' => $this->formatImageUrl($item->thumbnail),
                'formatted_date' => $item->created_at?->format('d M Y') ?? '',
            ]),
            'paginator' => $blogsPaginator,
            'categories' => $categories->map(fn ($c) => [
                'id' => $c->id,
                'name' => $c->name,
            ]),
            'currentSearch' => $search ?? '',
            'currentCategory' => $categoryId ?? '',
        ];

        return view('pages.blog.index', $data);
    }

    public function show(Blog $blog): View
    {
        if (! $blog->active) {
            abort(404);
        }

        $blog->load(['category', 'branch', 'images']);

        // Related blogs in same category
        $relatedBlogs = Blog::where('active', true)
            ->where('id', '!=', $blog->id)
            ->where('category_id', $blog->category_id)
            ->with(['category', 'branch'])
            ->latest()
            ->take(3)
            ->get();

        $data = [
            'blog' => [
                'id' => $blog->id,
                'title' => $blog->title,
                'slug' => $blog->slug,
                'quotes' => $blog->quotes,
                'body' => $blog->body,
                'category_name' => $blog->category?->name ?? 'Umum',
                'branch_name' => $blog->branch?->name ?? 'DPP',
                'thumbnail_url' => $this->formatImageUrl($blog->thumbnail),
                'formatted_date' => $blog->created_at?->format('d M Y') ?? '',
                'images' => $blog->images->map(fn ($img) => [
                    'id' => $img->id,
                    'image_url' => $this->formatImageUrl($img->image),
                    'description' => $img->description,
                ]),
            ],
            'relatedBlogs' => $relatedBlogs->map(fn ($item) => [
                'id' => $item->id,
                'title' => $item->title,
                'slug' => $item->slug,
                'quotes' => $item->quotes,
                'category_name' => $item->category?->name ?? 'Umum',
                'branch_name' => $item->branch?->name ?? 'DPP',
                'thumbnail_url' => $this->formatImageUrl($item->thumbnail),
                'formatted_date' => $item->created_at?->format('d M Y') ?? '',
            ]),
        ];

        return view('pages.blog.show', $data);
    }
}

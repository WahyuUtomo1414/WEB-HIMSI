<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Support\PublicCache\PublicCacheKey;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(Request $request): View
    {
        $data = Cache::remember(PublicCacheKey::blogIndex($request), now()->addMinutes(15), function () use ($request): array {
            $search     = $request->query('search', '');
            $categoryId = $request->query('category', '');

            $query = Blog::query()
                ->with(['category', 'branch'])
                ->where('active', true)
                ->whereHas('category', fn ($q) => $q->where('active', true))
                ->whereHas('branch', fn ($q) => $q->where('active', true));

            if (! empty($search)) {
                $query->where(fn ($q) => $q
                    ->where('title', 'like', "%{$search}%")
                    ->orWhere('body', 'like', "%{$search}%")
                    ->orWhere('quotes', 'like', "%{$search}%")
                );
            }

            if (! empty($categoryId)) {
                $query->where('category_id', $categoryId);
            }

            $paginator = $query->latest()->paginate(6)->withQueryString();

            return [
                'hero' => [
                    'title'    => 'Blog & Artikel HIMSI',
                    'subtitle' => 'Kumpulan Berita, Informasi Kegiatan, dan Artikel Edukatif Terkini',
                ],
                'blogs'           => collect($paginator->items())->map(fn ($b) => $this->mapBlog($b))->toArray(),
                'paginator'       => $this->buildPaginator($paginator),
                'categories'      => Category::query()->where('active', true)->get(['id', 'name'])->toArray(),
                'currentSearch'   => $search,
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
                    ...$this->mapBlog($blog),
                    'body'   => $blog->body,
                    'quotes' => $blog->quotes,
                    'images' => $blog->images->map(fn ($img) => [
                        'id'          => $img->id,
                        'image_url'   => public_image_url($img->image),
                        'description' => $img->description,
                    ])->toArray(),
                ],
                'relatedBlogs' => $relatedBlogs->map(fn ($b) => $this->mapBlog($b))->toArray(),
            ];
        });

        return view('pages.blog.show', $data);
    }

    private function mapBlog(Blog $b): array
    {
        return [
            'id'             => $b->id,
            'title'          => $b->title,
            'slug'           => $b->slug,
            'quotes'         => $b->quotes,
            'body'           => $b->body,
            'category_name'  => $b->category?->name ?? 'Umum',
            'branch_name'    => $b->branch?->name ?? '-',
            'thumbnail_url'  => public_image_url($b->thumbnail),
            'formatted_date' => $b->created_at?->format('d M Y') ?? date('d M Y'),
        ];
    }

    private function buildPaginator(LengthAwarePaginator $paginator): array
    {
        $currentPage = $paginator->currentPage();
        $lastPage    = $paginator->lastPage();
        $allUrls     = $paginator->getUrlRange(1, $lastPage);

        $visible = collect([1]);
        for ($i = max(2, $currentPage - 1); $i <= min($lastPage - 1, $currentPage + 1); $i++) {
            $visible->push($i);
        }
        if ($lastPage > 1) {
            $visible->push($lastPage);
        }
        $visible = $visible->unique()->sort()->values();

        $pages = [];
        $prev  = null;
        foreach ($visible as $p) {
            if ($prev !== null && $p - $prev > 1) {
                $pages[] = ['type' => 'ellipsis'];
            }
            $pages[] = [
                'type'   => 'page',
                'number' => $p,
                'url'    => $allUrls[$p] ?? '#',
                'active' => $p === $currentPage,
            ];
            $prev = $p;
        }

        return [
            'currentPage'     => $currentPage,
            'lastPage'        => $lastPage,
            'firstItem'       => $paginator->firstItem() ?? 0,
            'lastItem'        => $paginator->lastItem() ?? 0,
            'total'           => $paginator->total(),
            'hasMorePages'    => $paginator->hasMorePages(),
            'onFirstPage'     => $paginator->onFirstPage(),
            'previousPageUrl' => $paginator->previousPageUrl(),
            'nextPageUrl'     => $paginator->nextPageUrl(),
            'pages'           => $pages,
        ];
    }
}

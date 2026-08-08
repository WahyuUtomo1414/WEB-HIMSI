<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Branch;
use App\Support\PublicCache\PublicCacheKey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class BranchController extends Controller
{
    public function index(Request $request): View
    {
        $data = Cache::remember(PublicCacheKey::branchIndex($request), now()->addMinutes(30), function () use ($request): array {
            $search = $request->query('search', '');
            $sektor = $request->query('sektor', '');
            $type = $request->query('type', '');

            $query = Branch::query()
                ->where('active', true);

            if (! empty($search)) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('location', 'like', "%{$search}%")
                        ->orWhere('sektor', 'like', "%{$search}%");
                });
            }

            if (! empty($sektor)) {
                $query->where('sektor', $sektor);
            }

            if ($type === 'dpp') {
                $query->where('is_dpp', true);
            } elseif ($type === 'dpc') {
                $query->where('is_dpp', false);
            }

            $branches = $query->latest()->get();

            $allSektors = Branch::query()
                ->where('active', true)
                ->distinct()
                ->pluck('sektor')
                ->filter()
                ->values()
                ->toArray();

            return [
                'hero' => [
                    'title' => 'Cabang & DPC HIMSI',
                    'subtitle' => 'Daftar Wilayah Kepengurusan Himpunan Mahasiswa Sistem Informasi',
                ],
                'branches' => $branches->map(fn ($b) => [
                    'id' => $b->id,
                    'name' => $b->name,
                    'location' => $b->location,
                    'sektor' => $b->sektor,
                    'description' => $b->description,
                    'grup_wa' => $b->grup_wa,
                    'thumbnail_url' => public_image_url($b->thumbnail),
                    'is_dpp' => (bool) $b->is_dpp,
                    'sosial_media' => is_array($b->sosial_media) ? $b->sosial_media : [],
                ])->toArray(),
                'sektors' => $allSektors,
                'currentSearch' => $search,
                'currentSektor' => $sektor,
                'currentType' => $type,
            ];
        });

        return view('pages.branch.index', $data);
    }

    public function show(string $id): View
    {
        $data = Cache::remember(PublicCacheKey::branchShow($id), now()->addMinutes(30), function () use ($id): array {
            $branch = Branch::query()
                ->with(['structures' => function ($q) {
                    $q->where('active', true)
                        ->with('division')
                        ->orderBy('sort')
                        ->orderBy('id');
                }])
                ->where('active', true)
                ->where('id', $id)
                ->firstOrFail();

            $blogs = Blog::query()
                ->with('category')
                ->where('active', true)
                ->whereHas('category', fn ($q) => $q->where('active', true))
                ->where('branch_id', $branch->id)
                ->latest()
                ->limit(3)
                ->get();

            return [
                'branch' => [
                    'id' => $branch->id,
                    'name' => $branch->name,
                    'location' => $branch->location,
                    'sektor' => $branch->sektor,
                    'description' => $branch->description,
                    'grup_wa' => $branch->grup_wa,
                    'thumbnail_url' => public_image_url($branch->thumbnail),
                    'is_dpp' => (bool) $branch->is_dpp,
                    'sosial_media' => is_array($branch->sosial_media) ? $branch->sosial_media : [],
                ],
                'structures' => $branch->structures->map(fn ($s) => [
                    'id' => $s->id,
                    'name' => $s->name,
                    'position' => $s->position,
                    'sort' => $s->sort,
                    'no_wa' => $s->no_wa,
                    'division_name' => $s->division?->name ?? 'Pengurus Harian',
                    'image_url' => public_image_url($s->image),
                ])->toArray(),
                'blogs' => $blogs->map(fn ($b) => [
                    'id' => $b->id,
                    'title' => $b->title,
                    'slug' => $b->slug,
                    'quotes' => $b->quotes,
                    'body' => $b->body,
                    'category_name' => $b->category?->name ?? 'Umum',
                    'branch_name' => $branch->name,
                    'thumbnail_url' => public_image_url($b->thumbnail),
                    'formatted_date' => $b->created_at?->format('d M Y') ?? date('d M Y'),
                ])->toArray(),
            ];
        });

        return view('pages.branch.show', $data);
    }
}

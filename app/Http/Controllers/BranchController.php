<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Branch;
use App\Models\BranchStructure;
use App\Traits\FormatsFrontendData;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BranchController extends Controller
{
    use FormatsFrontendData;

    public function index(Request $request): View
    {
        $search = $request->query('search');
        $filterSektor = $request->query('sektor');
        $type = $request->query('type'); // 'dpp', 'dpc', or null

        $query = Branch::where('active', true);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhere('sektor', 'like', "%{$search}%");
            });
        }

        if ($filterSektor) {
            $query->where('sektor', $filterSektor);
        }

        if ($type === 'dpp') {
            $query->where('is_dpp', true);
        } elseif ($type === 'dpc') {
            $query->where('is_dpp', false);
        }

        $branches = $query->latest()->get();

        // Get distinct sectors for filter list
        $sektors = Branch::where('active', true)->whereNotNull('sektor')->distinct()->pluck('sektor');

        $data = [
            'hero' => [
                'title' => 'Cabang & DPC HIMSI',
                'subtitle' => 'Daftar Wilayah Kepengurusan Himpunan Mahasiswa Sistem Informasi',
            ],
            'branches' => $branches->map(fn ($item) => [
                'id' => $item->id,
                'name' => $item->name,
                'location' => $item->location,
                'sektor' => $item->sektor,
                'description' => $item->description,
                'grup_wa' => $item->grup_wa,
                'thumbnail_url' => $this->formatImageUrl($item->thumbnail),
                'is_dpp' => $item->is_dpp,
                'sosial_media' => is_array($item->sosial_media) ? $item->sosial_media : [],
            ]),
            'sektors' => $sektors,
            'currentSearch' => $search ?? '',
            'currentSektor' => $filterSektor ?? '',
            'currentType' => $type ?? '',
        ];

        return view('pages.branch.index', $data);
    }

    public function show(Branch $branch): View
    {
        if (! $branch->active) {
            abort(404);
        }

        $structures = BranchStructure::where('branch_id', $branch->id)
            ->where('active', true)
            ->with('division')
            ->get();

        $blogs = Blog::where('branch_id', $branch->id)
            ->where('active', true)
            ->with('category')
            ->latest()
            ->take(3)
            ->get();

        $data = [
            'branch' => [
                'id' => $branch->id,
                'name' => $branch->name,
                'location' => $branch->location,
                'sektor' => $branch->sektor,
                'description' => $branch->description,
                'grup_wa' => $branch->grup_wa,
                'thumbnail_url' => $this->formatImageUrl($branch->thumbnail),
                'is_dpp' => $branch->is_dpp,
                'sosial_media' => is_array($branch->sosial_media) ? $branch->sosial_media : [],
            ],
            'structures' => $structures->map(fn ($item) => [
                'id' => $item->id,
                'name' => $item->name,
                'position' => $item->position,
                'no_wa' => $item->no_wa,
                'division_name' => $item->division?->name ?? '-',
                'image_url' => $this->formatImageUrl($item->image),
            ]),
            'blogs' => $blogs->map(fn ($item) => [
                'id' => $item->id,
                'title' => $item->title,
                'slug' => $item->slug,
                'quotes' => $item->quotes,
                'category_name' => $item->category?->name ?? 'Umum',
                'thumbnail_url' => $this->formatImageUrl($item->thumbnail),
                'formatted_date' => $item->created_at?->format('d M Y') ?? '',
            ]),
        ];

        return view('pages.branch.show', $data);
    }
}

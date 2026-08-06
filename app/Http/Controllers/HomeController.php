<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Branch;
use App\Models\Count;
use App\Models\Division;
use App\Models\Faq;
use App\Models\Greeting;
use App\Models\Organization;
use App\Support\PublicCache\PublicCacheKey;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $data = Cache::remember(PublicCacheKey::home(), now()->addMinutes(30), function (): array {
            $organization = Organization::query()
                ->where('active', true)
                ->latest()
                ->first();

            $counts = Count::query()
                ->where('active', true)
                ->latest()
                ->limit(4)
                ->get();

            $greeting = Greeting::query()
                ->where('active', true)
                ->latest()
                ->first();

            $divisions = Division::query()
                ->where('active', true)
                ->orderBy('name')
                ->limit(4)
                ->get();

            $branches = Branch::query()
                ->where('active', true)
                ->latest()
                ->limit(10)
                ->get();

            $latestBlogs = Blog::query()
                ->with(['category', 'branch'])
                ->where('active', true)
                ->whereHas('category', fn ($q) => $q->where('active', true))
                ->whereHas('branch', fn ($q) => $q->where('active', true))
                ->latest()
                ->limit(3)
                ->get();

            $faqs = Faq::query()
                ->where('active', true)
                ->latest()
                ->limit(6)
                ->get();

            return [
                'hero' => [
                    'name' => $organization?->name ?? 'HIMSI UBSI',
                    'kode_org' => $organization?->kode_org ?? 'HIMSI',
                    'description' => $organization?->description ?? 'Himpunan Mahasiswa Sistem Informasi Universitas Bina Sarana Informatika.',
                    'logo_url' => public_image_url($organization?->logo),
                    'thumbnail_url' => public_image_url($organization?->thumbnail),
                ],
                'counts' => $counts->map(fn ($c) => [
                    'id' => $c->id,
                    'name' => $c->name,
                    'digit' => $c->digit,
                ])->toArray(),
                'greeting' => [
                    'name' => $greeting?->name ?? 'Ketua Umum HIMSI',
                    'position' => $greeting?->position ?? 'Ketua Umum Period 2025/2026',
                    'body' => $greeting?->body ?? 'Selamat datang di Official Website HIMSI UBSI.',
                    'image_url' => public_image_url($greeting?->image),
                ],
                'divisions' => $divisions->map(fn ($d) => [
                    'id' => $d->id,
                    'name' => $d->name,
                    'description' => $d->description,
                    'logo_url' => public_image_url($d->logo),
                    'image_url' => public_image_url($d->image),
                    'is_dpp' => (bool) $d->is_dpp,
                ])->toArray(),
                'branches' => $branches->map(fn ($b) => [
                    'id' => $b->id,
                    'name' => $b->name,
                    'location' => $b->location,
                    'sektor' => $b->sektor,
                    'thumbnail_url' => public_image_url($b->thumbnail),
                    'is_dpp' => (bool) $b->is_dpp,
                ])->toArray(),
                'blogs' => $latestBlogs->map(fn ($b) => [
                    'id' => $b->id,
                    'title' => $b->title,
                    'slug' => $b->slug,
                    'quotes' => $b->quotes,
                    'body' => $b->body,
                    'category_name' => $b->category?->name ?? 'Umum',
                    'branch_name' => $b->branch?->name ?? '-',
                    'thumbnail_url' => public_image_url($b->thumbnail),
                    'formatted_date' => $b->created_at?->format('d M Y') ?? date('d M Y'),
                ])->toArray(),
                'faqs' => $faqs->map(fn ($f) => [
                    'id' => $f->id,
                    'question' => $f->question,
                    'answer' => $f->answer,
                ])->toArray(),
            ];
        });

        return view('pages.home', $data);
    }
}

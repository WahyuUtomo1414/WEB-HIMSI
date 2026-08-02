<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Branch;
use App\Models\Count;
use App\Models\Division;
use App\Models\Faq;
use App\Models\Greeting;
use App\Models\Organization;
use App\Traits\FormatsFrontendData;
use Illuminate\View\View;

class HomeController extends Controller
{
    use FormatsFrontendData;

    public function index(): View
    {
        $organization = Organization::where('active', true)->first();
        $counts = Count::where('active', true)->get();
        $greeting = Greeting::where('active', true)->latest()->first();
        $divisions = Division::where('active', true)->get();
        $branches = Branch::where('active', true)->get();
        $blogs = Blog::where('active', true)
            ->with(['category', 'branch'])
            ->latest()
            ->take(3)
            ->get();
        $faqs = Faq::where('active', true)->get();

        // Format data to clean structures
        $data = [
            'hero' => [
                'name' => $organization?->name ?? 'HIMSI UBSI',
                'kode_org' => $organization?->kode_org ?? 'HIMSI',
                'description' => $organization?->description ?? 'Himpunan Mahasiswa Sistem Informasi Universitas Bina Sarana Informatika',
                'logo_url' => $this->formatImageUrl($organization?->logo),
                'thumbnail_url' => $this->formatImageUrl($organization?->thumbnail),
            ],
            'counts' => $counts->map(fn ($item) => [
                'id' => $item->id,
                'name' => $item->name,
                'digit' => $item->digit,
            ]),
            'greeting' => $greeting ? [
                'name' => $greeting->name,
                'position' => $greeting->position,
                'body' => $greeting->body,
                'image_url' => $this->formatImageUrl($greeting->image),
            ] : null,
            'divisions' => $divisions->map(fn ($item) => [
                'id' => $item->id,
                'name' => $item->name,
                'description' => $item->description,
                'logo_url' => $this->formatImageUrl($item->logo),
                'image_url' => $this->formatImageUrl($item->image),
                'is_dpp' => $item->is_dpp,
            ]),
            'branches' => $branches->map(fn ($item) => [
                'id' => $item->id,
                'name' => $item->name,
                'location' => $item->location,
                'sektor' => $item->sektor,
                'thumbnail_url' => $this->formatImageUrl($item->thumbnail),
                'is_dpp' => $item->is_dpp,
            ]),
            'blogs' => $blogs->map(fn ($item) => [
                'id' => $item->id,
                'title' => $item->title,
                'slug' => $item->slug,
                'quotes' => $item->quotes,
                'category_name' => $item->category?->name ?? 'Umum',
                'branch_name' => $item->branch?->name ?? 'DPP',
                'thumbnail_url' => $this->formatImageUrl($item->thumbnail),
                'formatted_date' => $item->created_at?->format('d M Y') ?? '',
            ]),
            'faqs' => $faqs->map(fn ($item) => [
                'id' => $item->id,
                'question' => $item->question,
                'answer' => $item->answer,
            ]),
        ];

        return view('pages.home', $data);
    }
}

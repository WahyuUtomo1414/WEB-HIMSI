<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Greeting;
use App\Models\Milestone;
use App\Models\Organization;
use App\Traits\FormatsFrontendData;
use Illuminate\View\View;

class AboutController extends Controller
{
    use FormatsFrontendData;

    public function index(): View
    {
        $organization = Organization::where('active', true)->first();
        $milestones = Milestone::where('active', true)->orderBy('sort', 'asc')->get();
        $divisions = Division::where('active', true)->get();
        $greeting = Greeting::where('active', true)->latest()->first();

        $data = [
            'hero' => [
                'title' => 'Tentang HIMSI UBSI',
                'subtitle' => 'Mengenal Lebih Dekat Himpunan Mahasiswa Sistem Informasi UBSI',
            ],
            'organization' => [
                'name' => $organization?->name ?? 'HIMSI UBSI',
                'kode_org' => $organization?->kode_org ?? 'HIMSI',
                'description' => $organization?->description ?? 'Himpunan Mahasiswa Sistem Informasi UBSI',
                'vision' => $organization?->vision ?? '-',
                'mision' => is_array($organization?->mision) ? $organization->mision : [],
                'purpose' => $organization?->purpose ?? '-',
                'address' => $organization?->address ?? '-',
                'email' => $organization?->email ?? '-',
                'no_tlpn' => $organization?->no_tlpn ?? '-',
                'logo_url' => $this->formatImageUrl($organization?->logo),
                'thumbnail_url' => $this->formatImageUrl($organization?->thumbnail),
                'sosial_media' => is_array($organization?->sosial_media) ? $organization->sosial_media : [],
            ],
            'milestones' => $milestones->map(fn ($item) => [
                'id' => $item->id,
                'sort' => $item->sort,
                'year' => $item->year ? (is_string($item->year) ? substr($item->year, 0, 4) : $item->year->format('Y')) : '-',
                'list' => is_array($item->list) ? $item->list : [],
            ]),
            'divisions' => $divisions->map(fn ($item) => [
                'id' => $item->id,
                'name' => $item->name,
                'description' => $item->description,
                'logo_url' => $this->formatImageUrl($item->logo),
                'image_url' => $this->formatImageUrl($item->image),
                'job_description' => is_array($item->job_description) ? $item->job_description : [],
                'is_dpp' => $item->is_dpp,
            ]),
            'greeting' => $greeting ? [
                'name' => $greeting->name,
                'position' => $greeting->position,
                'body' => $greeting->body,
                'image_url' => $this->formatImageUrl($greeting->image),
            ] : null,
        ];

        return view('pages.about', $data);
    }
}

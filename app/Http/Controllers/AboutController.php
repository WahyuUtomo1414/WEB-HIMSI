<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Greeting;
use App\Models\Milestone;
use App\Models\Organization;
use App\Support\PublicCache\PublicCacheKey;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class AboutController extends Controller
{
    public function index(): View
    {
        $data = Cache::remember(PublicCacheKey::about(), now()->addHour(), function (): array {
            $organization = Organization::query()
                ->where('active', true)
                ->latest()
                ->first();

            $milestones = Milestone::query()
                ->where('active', true)
                ->orderBy('sort')
                ->get();

            $divisions = Division::query()
                ->where('active', true)
                ->orderBy('name')
                ->get();

            $greeting = Greeting::query()
                ->where('active', true)
                ->latest()
                ->first();

            return [
                'hero' => [
                    'title' => 'Tentang '.($organization?->kode_org ?? 'HIMSI UBSI'),
                    'subtitle' => 'Mengenal Lebih Dekat '.($organization?->name ?? 'Himpunan Mahasiswa Sistem Informasi UBSI'),
                ],
                'organization' => [
                    'name' => $organization?->name ?? 'HIMSI UBSI',
                    'kode_org' => $organization?->kode_org ?? 'HIMSI',
                    'description' => $organization?->description ?? 'Himpunan Mahasiswa Sistem Informasi Universitas Bina Sarana Informatika adalah organisasi kemahasiswaan berbasis akademik dan profesi.',
                    'vision' => $organization?->vision ?? 'Menjadi himpunan mahasiswa yang unggul, inovatif, dan berdaya saing tinggi.',
                    'mision' => is_array($organization?->mision) ? $organization->mision : [],
                    'purpose' => $organization?->purpose ?? 'HIMSI dibentuk untuk wadah pengasahan minat bakat dan potensi akademik.',
                    'address' => $organization?->address ?? 'Jl. Pemuda No. 8, Rawamangun, Jakarta Timur',
                    'email' => $organization?->email ?? 'info@himsi.org',
                    'no_tlpn' => $organization?->no_tlpn ?? '0812-3456-7890',
                    'logo_url' => public_image_url($organization?->logo),
                    'thumbnail_url' => public_image_url($organization?->thumbnail),
                    'sosial_media' => is_array($organization?->sosial_media) ? $organization->sosial_media : [],
                ],
                'milestones' => $milestones->map(fn ($m) => [
                    'id' => $m->id,
                    'sort' => $m->sort,
                    'year' => $m->year ? date('Y', strtotime($m->year)) : '',
                    'list' => is_array($m->list) ? $m->list : [],
                ])->toArray(),
                'divisions' => $divisions->map(fn ($d) => [
                    'id' => $d->id,
                    'name' => $d->name,
                    'description' => $d->description,
                    'logo_url' => public_image_url($d->logo),
                    'image_url' => public_image_url($d->image),
                    'job_description' => is_array($d->job_description) ? $d->job_description : [],
                    'is_dpp' => (bool) $d->is_dpp,
                ])->toArray(),
                'greeting' => [
                    'name' => $greeting?->name ?? 'Ketua Umum HIMSI',
                    'position' => $greeting?->position ?? 'Ketua Umum Period 2025/2026',
                    'body' => $greeting?->body ?? 'Mari bersama-sama memajukan HIMSI UBSI.',
                    'image_url' => public_image_url($greeting?->image),
                ],
            ];
        });

        return view('pages.about', $data);
    }
}

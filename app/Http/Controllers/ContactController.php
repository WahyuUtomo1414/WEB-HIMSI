<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Organization;
use App\Support\PublicCache\PublicCacheKey;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        $data = Cache::remember(PublicCacheKey::contact(), now()->addHour(), function (): array {
            $organization = Organization::query()
                ->where('active', true)
                ->latest()
                ->first();

            return [
                'hero' => [
                    'title' => 'Hubungi Kami',
                    'subtitle' => 'Sampaikan Pertanyaan, Saran, atau Kerjasama dengan Pengurus HIMSI',
                ],
                'organization' => [
                    'name' => $organization?->name ?? 'HIMSI UBSI',
                    'address' => $organization?->address ?? 'Alamat belum tersedia',
                    'email' => $organization?->email ?? 'email belum tersedia',
                    'no_tlpn' => $organization?->no_tlpn ?? 'Nomor telepon belum tersedia',
                    'sosial_media' => $this->mapSocialMedia($organization?->sosial_media ?? []),
                    'logo_url' => public_image_url($organization?->logo),
                ],
            ];
        });

        return view('pages.contact', $data);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:128',
            'email' => 'required|email|max:128',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'subject.required' => 'Subjek pesan wajib diisi.',
            'message.required' => 'Isi pesan wajib diisi.',
            'message.min' => 'Isi pesan minimal 10 karakter.',
        ]);

        Contact::create($validated);

        return back()->with('success', 'Terima kasih! Pesan Anda telah berhasil terkirim. Pengurus HIMSI akan segera merespons.');
    }

    private function mapSocialMedia(array $socialMedia): array
    {
        return collect($socialMedia)
            ->map(function ($item, string|int $key): array {
                if (is_array($item)) {
                    return [
                        'platform' => $item['platform'] ?? (is_string($key) ? $key : 'Media Sosial'),
                        'url' => $item['url'] ?? $item['value'] ?? '',
                    ];
                }

                return [
                    'platform' => is_string($key) ? $key : 'Media Sosial',
                    'url' => (string) $item,
                ];
            })
            ->filter(fn (array $item): bool => filled($item['url']))
            ->values()
            ->all();
    }
}

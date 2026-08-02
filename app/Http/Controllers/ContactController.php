<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Organization;
use App\Traits\FormatsFrontendData;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    use FormatsFrontendData;

    public function index(): View
    {
        $organization = Organization::where('active', true)->first();
        $branches = Branch::where('active', true)->get();

        $data = [
            'hero' => [
                'title' => 'Hubungi Kami',
                'subtitle' => 'Sampaikan Pertanyaan, Saran, atau Kerjasama dengan Pengurus HIMSI',
            ],
            'organization' => [
                'name' => $organization?->name ?? 'HIMSI UBSI',
                'address' => $organization?->address ?? 'Kampus UBSI',
                'email' => $organization?->email ?? 'info@himsi.org',
                'no_tlpn' => $organization?->no_tlpn ?? '-',
                'sosial_media' => is_array($organization?->sosial_media) ? $organization->sosial_media : [],
                'logo_url' => $this->formatImageUrl($organization?->logo),
            ],
            'branches' => $branches->map(fn ($item) => [
                'id' => $item->id,
                'name' => $item->name,
                'location' => $item->location,
                'grup_wa' => $item->grup_wa,
                'sosial_media' => is_array($item->sosial_media) ? $item->sosial_media : [],
            ]),
        ];

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

        // Feedback message
        return back()->with('success', 'Terima kasih! Pesan Anda telah berhasil terkirim. Pengurus HIMSI akan segera merespons.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        $data = [
            'hero' => [
                'title' => 'Hubungi Kami',
                'subtitle' => 'Sampaikan Pertanyaan, Saran, atau Kerjasama dengan Pengurus HIMSI',
            ],
            'organization' => [
                'name' => 'HIMSI UBSI',
                'address' => 'Jl. Pemuda No. 8, Rawamangun, Jakarta Timur',
                'email' => 'info@himsi.org',
                'no_tlpn' => '0812-3456-7890',
                'sosial_media' => [
                    ['platform' => 'Instagram', 'url' => '@himsi.ubsi'],
                    ['platform' => 'YouTube', 'url' => 'HIMSI UBSI Official'],
                    ['platform' => 'LinkedIn', 'url' => 'HIMSI UBSI'],
                ],
                'logo_url' => '/images/placeholder.svg',
            ],
            'branches' => [
                [
                    'id' => 1,
                    'name' => 'HIMSI DPC Pemuda',
                    'location' => 'Rawamangun',
                    'grup_wa' => 'https://chat.whatsapp.com/example',
                    'sosial_media' => [],
                ],
            ],
        ];

        return view('pages.contact', $data);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
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

        return back()->with('success', 'Terima kasih! Pesan Anda telah berhasil terkirim. Pengurus HIMSI akan segera merespons.');
    }
}

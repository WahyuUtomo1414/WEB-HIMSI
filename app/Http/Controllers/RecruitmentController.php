<?php

namespace App\Http\Controllers;

use App\Mail\RecruitmentNotificationMail;
use App\Models\Branch;
use App\Models\Division;
use App\Models\Organization;
use App\Models\Recruitment;
use App\Models\Status;
use App\Support\ImageUploadOptimizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class RecruitmentController extends Controller
{
    public function index()
    {
        $organization = Organization::first();

        // Fetch real divisions from Division Model
        $dbDivisions = Division::where('is_dpp', false)->get();

        // Fetch real branches from Branch Model
        $branches = Branch::all();

        $badgeColors = [
            ['badge' => 'Teknologi & Riset', 'color' => 'blue', 'glow' => 'rgba(59, 130, 246, 0.45)'],
            ['badge' => 'Kreatif & Media', 'color' => 'amber', 'glow' => 'rgba(245, 158, 11, 0.45)'],
            ['badge' => 'Sumber Daya Manusia', 'color' => 'emerald', 'glow' => 'rgba(16, 185, 129, 0.45)'],
            ['badge' => 'Riset & Inovasi', 'color' => 'purple', 'glow' => 'rgba(168, 85, 247, 0.45)'],
            ['badge' => 'Manajemen Strategis', 'color' => 'red', 'glow' => 'rgba(239, 68, 68, 0.45)'],
            ['badge' => 'Humas & Kemitraan', 'color' => 'indigo', 'glow' => 'rgba(99, 102, 241, 0.45)'],
        ];

        if ($dbDivisions->count() > 0) {
            $divisions = $dbDivisions->map(function ($div, $index) use ($badgeColors) {
                $style = $badgeColors[$index % count($badgeColors)];
                $jobs = is_array($div->job_description) ? $div->job_description : json_decode($div->job_description, true) ?? [];

                return [
                    'id' => $div->id,
                    'name' => $div->name,
                    'badge' => $style['badge'],
                    'color' => $style['color'],
                    'glow' => $style['glow'],
                    'description' => $div->description,
                    'requirements' => count($jobs) > 0 ? $jobs : [
                        'Mahasiswa aktif Sistem Informasi UBSI',
                        'Memiliki komitmen dan minat pengembangan diri',
                        'Mampu bekerja dalam tim secara profesional',
                    ],
                ];
            })->toArray();
        } else {
            // Fallback default divisions
            $divisions = [
                [
                    'id' => 1,
                    'name' => 'Divisi Pendidikan',
                    'badge' => 'Teknologi & Riset',
                    'color' => 'blue',
                    'glow' => 'rgba(59, 130, 246, 0.45)',
                    'description' => 'Mengembangkan kualitas keilmuan IT, menyelenggarakan workshop, bootcamps, pelatihan coding, dan riset akademik.',
                    'requirements' => [
                        'Menyusun kurikulum pelatihan internal',
                        'Mengelola kegiatan belajar mengajar',
                        'Mengadakan seminar, workshop, dan pelatihan rutin',
                    ],
                ],
                [
                    'id' => 2,
                    'name' => 'Divisi Kominfo',
                    'badge' => 'Kreatif & Media',
                    'color' => 'amber',
                    'glow' => 'rgba(245, 158, 11, 0.45)',
                    'description' => 'Mengelola komunikasi internal maupun eksternal organisasi, branding media sosial, website, dan publikasi informasi.',
                    'requirements' => [
                        'Mengelola media sosial organisasi',
                        'Membuat konten publikasi kreatif',
                        'Mengelola website dan sistem informasi',
                    ],
                ],
                [
                    'id' => 3,
                    'name' => 'Divisi RSDM',
                    'badge' => 'Sumber Daya Manusia',
                    'color' => 'emerald',
                    'glow' => 'rgba(16, 185, 129, 0.45)',
                    'description' => 'Berfokus pada pengelolaan, pembinaan, dan pengembangan soft skill & hard skill seluruh anggota organisasi.',
                    'requirements' => [
                        'Mengelola data dan database anggota',
                        'Menyusun program pengembangan diri',
                        'Mengatur penempatan dan rotasi anggota',
                    ],
                ],
                [
                    'id' => 4,
                    'name' => 'Divisi Litbang',
                    'badge' => 'Riset & Inovasi',
                    'color' => 'purple',
                    'glow' => 'rgba(168, 85, 247, 0.45)',
                    'description' => 'Melakukan riset, analisis, evaluasi kinerja, serta menciptakan terobosan program kerja baru yang inovatif.',
                    'requirements' => [
                        'Melakukan riset dan analisis organisasi',
                        'Mengembangkan inovasi program kerja',
                        'Mengevaluasi efektivitas kegiatan organisasi',
                    ],
                ],
            ];
        }

        $timelines = [
            [
                'step' => '01',
                'title' => 'Pendaftaran & Pengumpulan Berkas',
                'date' => '01-30 September 2026',
                'desc' => 'Pengisian formulir online, memilih divisi pilihan, dan mengunggah berkas persyaratan pendaftaran.',
                'color' => 'from-blue-500 to-indigo-600',
            ],
            [
                'step' => '02',
                'title' => 'Pelaksanaan OPREC & SEMOT',
                'date' => '20 September 2026',
                'desc' => 'Sosialisasi open recruitment untuk mengenalkan HIMSI serta membangun semangat calon anggota.',
                'color' => 'from-purple-500 to-pink-600',
            ],
            [
                'step' => '03',
                'title' => 'Pengecekan Pendaftaran Calon Anggota',
                'date' => '1 Oktober 2026',
                'desc' => 'Verifikasi dan validasi berkas pendaftaran untuk memastikan calon anggota memenuhi persyaratan administrasi dasar.',
                'color' => 'from-amber-500 to-red-600',
            ],
            [
                'step' => '04',
                'title' => 'Interview Calon Anggota',
                'date' => '3-4 Oktober 2026',
                'desc' => 'Sesi wawancara untuk menilai komitmen, potensi, minat, dan kesiapan calon anggota dalam berkontribusi di HIMSI.',
                'color' => 'from-emerald-500 to-teal-600',
            ],
        ];

        $faqs = [
            [
                'question' => 'Siapa saja yang diperbolehkan mendaftar Open Recruitment HIMSI?',
                'answer' => 'Seluruh mahasiswa aktif Program Studi Sistem Informasi UBSI (kampus manapun) semester 1 hingga semester 4 diperbolehkan mendaftar.',
            ],
            [
                'question' => 'Apakah diperbolehkan memilih lebih dari satu divisi?',
                'answer' => 'Boleh! Pendaftar dapat memilih 1 Divisi Utama (Pilihan 1) dan 1 Divisi Cadangan (Pilihan 2) pada formulir pendaftaran.',
            ],
            [
                'question' => 'Apakah proses rekrutmen ini dipungut biaya?',
                'answer' => 'Sama sekali TIDAK dipungut biaya (100% Gratis). Hati-hati terhadap pihak yang mengatasnamakan HIMSI untuk pemungutan biaya.',
            ],
            [
                'question' => 'Bagaimana jika saya belum berpengalaman dalam organisasi sebelumnya?',
                'answer' => 'Jangan khawatir! HIMSI adalah tempat terbaik untuk belajar. Yang terpenting adalah komitmen, semangat belajar, dan niat berkontribusi.',
            ],
            [
                'question' => 'Apakah ada sertifikat pengurus setelah masa jabatan selesai?',
                'answer' => 'Ya, seluruh pengurus yang menyelesaikan masa kepengurusan akan menerima E-Sertifikat Resmi bertandatangan Pembina & Ketua Jurusan yang diakui kampus.',
            ],
        ];

        return view('pages.recruitment', compact('organization', 'divisions', 'timelines', 'faqs', 'branches'));
    }

    public function create()
    {
        $organization = Organization::first();
        $branches = Branch::where('is_dpp', false)->where('active', true)->orderBy('name')->get();
        $divisions = Division::query()
            ->where('active', true)
            ->where('is_dpp', false)
            ->orderBy('name')
            ->get();

        return view('pages.recruitment-form', compact('organization', 'branches', 'divisions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:128',
            'nim' => 'required|string|max:10|unique:recruitment,nim',
            'semester' => 'required|string|max:16',
            'email' => 'required|email|max:128',
            'no_wa' => 'required|string|max:16|unique:recruitment,no_wa',
            'branch_id' => 'required|exists:branch,id',
            'division_id' => [
                'required',
                Rule::exists('division', 'id')->where('active', true),
            ],
            'instagram' => 'required|string|max:128',
            'description' => 'required|string',
            'follow_dpc' => 'required|file|image|mimes:jpg,jpeg,png,webp|max:3072',
            'ektm' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'cv' => 'required|file|mimes:pdf|max:5024',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'nim.required' => 'NIM wajib diisi.',
            'nim.unique' => 'NIM ini sudah terdaftar sebelumnya.',
            'semester.required' => 'Semester wajib dipilih.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'no_wa.required' => 'Nomor WhatsApp wajib diisi.',
            'no_wa.unique' => 'Nomor WhatsApp ini sudah terdaftar sebelumnya.',
            'branch_id.required' => 'Cabang DPC wajib dipilih.',
            'branch_id.exists' => 'Cabang DPC pilihan tidak valid.',
            'division_id.required' => 'Divisi pilihan wajib dipilih.',
            'division_id.exists' => 'Divisi pilihan tidak valid.',
            'instagram.required' => 'Username Instagram wajib diisi.',
            'description.required' => 'Motivasi & alasan wajib diisi.',
            'follow_dpc.required' => 'Bukti follow Instagram DPC wajib diunggah.',
            'follow_dpc.image' => 'File bukti follow harus berupa gambar.',
            'ektm.required' => 'Foto / PDF e-KTM wajib diunggah.',
            'cv.required' => 'File CV (PDF) wajib diunggah.',
            'cv.mimes' => 'File CV harus berformat PDF.',
        ]);

        // Handle file uploads
        $followDpcPath = ImageUploadOptimizer::storeUploadedWebp(
            file: $request->file('follow_dpc'),
            disk: 'public',
            directory: 'recruitment/follow_dpc',
            maxWidth: 1600,
            quality: 82,
        );

        $ektmPath = $request->hasFile('ektm')
            ? $this->storeEktmFile($request->file('ektm'))
            : 'default-ektm.jpg';

        $cvPath = $request->hasFile('cv')
            ? $request->file('cv')->store('recruitment/cv', 'public')
            : null;

        // Default Status ID
        $statusId = Status::where('name', 'Belum Diverifikasi')->first()?->id ?? Status::first()?->id ?? 1;

        // Create Recruitment Model Record
        $recruitment = Recruitment::create([
            'name' => $validated['name'],
            'nim' => $validated['nim'],
            'semester' => $validated['semester'],
            'ektm' => $ektmPath,
            'email' => $validated['email'],
            'instagram' => $validated['instagram'],
            'no_wa' => $validated['no_wa'],
            'description' => $validated['description'],
            'branch_id' => $validated['branch_id'],
            'division_id' => $validated['division_id'],
            'follow_dpc' => $followDpcPath,
            'cv' => $cvPath,
            'status_id' => $statusId,
        ]);

        // Send Email Notification immediately without Queue
        try {
            Mail::to($recruitment->email)->send(new RecruitmentNotificationMail($recruitment));
        } catch (\Throwable $e) {
            Log::error('Recruitment email failed to send: '.$e->getMessage());
        }

        // Redirect back to recruitment form with success message
        return redirect()->route('recruitment.create')->with('success', 'Pendaftaran Anda berhasil dikirim! Silakahkan cek email Anda untuk informasi lebih lanjut.');
    }

    private function storeEktmFile($file): string
    {
        if (str($file->getMimeType())->startsWith('image/')) {
            return ImageUploadOptimizer::storeUploadedWebp(
                file: $file,
                disk: 'public',
                directory: 'recruitment/ektm',
                maxWidth: 1600,
                quality: 85,
            );
        }

        return $file->store('recruitment/ektm', 'public');
    }
}

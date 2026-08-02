<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'HIMSI UBSI - Himpunan Mahasiswa Sistem Informasi' }}</title>
    <meta name="description" content="Website Resmi Himpunan Mahasiswa Sistem Informasi (HIMSI) Universitas Bina Sarana Informatika">
    
    {{-- Alpine.js CDN --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#f9f9fc] text-[#1a1c1e] antialiased flex flex-col min-h-screen">

    <x-layout.navbar />

    <main class="flex-grow">
        @if (session('success'))
            <div class="mx-auto max-w-7xl px-4 pt-6 sm:px-6 lg:px-8">
                <div class="rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-emerald-800 flex items-center justify-between shadow-sm">
                    <div class="flex items-center gap-3">
                        <svg class="h-5 w-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span class="text-sm font-medium">{{ session('success') }}</span>
                    </div>
                </div>
            </div>
        @endif

        {{ $slot }}
    </main>

    <x-layout.footer />

</body>
</html>

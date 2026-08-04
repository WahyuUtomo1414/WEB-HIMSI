<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'HIMSI UBSI - Himpunan Mahasiswa Sistem Informasi' }}</title>
    <meta name="description" content="Website Resmi Himpunan Mahasiswa Sistem Informasi (HIMSI) Universitas Bina Sarana Informatika">
    <link rel="icon" type="image/png" href="{{ asset('images/himsi.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/himsi.png') }}">
    
    <style>
        [x-cloak] { display: none !important; }
    </style>

    {{-- Alpine.js CDN --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#f9f9fc] text-[#1a1c1e] antialiased flex flex-col min-h-screen">

    <x-layout.navbar />

    <main class="flex-grow">
        @if (session('success'))
            <div x-data="{ show: true }" 
                 x-show="show" 
                 x-init="setTimeout(() => show = false, 5000)"
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="-translate-y-full opacity-0"
                 x-transition:enter-end="translate-y-0 opacity-100"
                 x-transition:leave="transition ease-in duration-300 transform"
                 x-transition:leave-start="translate-y-0 opacity-100"
                 x-transition:leave-end="-translate-y-full opacity-0"
                 class="fixed top-24 left-1/2 -translate-x-1/2 z-[100] w-full max-w-md px-4 sm:px-0">
                <div class="rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-emerald-800 flex items-center justify-between shadow-lg">
                    <div class="flex items-center gap-3">
                        <svg class="h-5 w-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span class="text-sm font-medium">{{ session('success') }}</span>
                    </div>
                    <button @click="show = false" class="text-emerald-500 hover:text-emerald-700 focus:outline-none ml-4 transition-colors">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        @endif

        {{ $slot }}
    </main>

    <x-layout.footer />

    <!-- Global Floating Animated WhatsApp Button (Bottom Right) -->
    @php
        $waUrl = 'https://wa.me/6281234567890';
        if (isset($globalOrganization?->sosial_media) && is_array($globalOrganization->sosial_media)) {
            foreach ($globalOrganization->sosial_media as $item) {
                if (is_array($item) && isset($item['platform'], $item['url']) && in_array(strtolower($item['platform']), ['wa', 'whatsapp']) && filled($item['url'])) {
                    $waUrl = $item['url'];
                    break;
                }
            }
        }
    @endphp

    <div class="fixed bottom-6 right-6 z-[9999]">
        <a href="{{ $waUrl }}" target="_blank" rel="noopener" 
           title="Hubungi Kami via WhatsApp"
           class="relative h-16 w-16 rounded-full bg-[#25D366] hover:bg-[#20ba5a] text-white flex items-center justify-center shadow-[0_4px_24px_rgba(37,211,102,0.5)] hover:scale-110 transition-all duration-300 group">
            <!-- Pulsing outer ring animation -->
            <span class="absolute inset-0 rounded-full bg-[#25D366] animate-ping opacity-40"></span>
            
            <!-- WhatsApp Official Icon -->
            <svg class="w-9 h-9 relative z-10 text-white fill-current transform group-hover:rotate-12 transition-transform duration-300" viewBox="0 0 24 24">
                <path d="M12.012 2c-5.506 0-9.989 4.478-9.99 9.984 0 1.765.459 3.488 1.334 5.006L2 22l5.12-1.341c1.472.802 3.136 1.225 4.887 1.226h.005c5.505 0 9.988-4.478 9.989-9.984 0-2.668-1.038-5.176-2.924-7.062A9.923 9.923 0 0 0 12.012 2zm0 18.258h-.004a8.272 8.272 0 0 1-4.22-1.161l-.303-.18-3.135.821.836-3.054-.197-.314a8.261 8.261 0 0 1-1.265-4.386c0-4.564 3.714-8.278 8.28-8.278 2.21 0 4.288.862 5.852 2.427a8.232 8.232 0 0 1 2.425 5.853c-.001 4.565-3.715 8.279-8.279 8.279zm4.536-6.195c-.248-.124-1.469-.724-1.696-.807-.227-.083-.393-.124-.559.124-.165.248-.641.807-.786.972-.145.165-.29.186-.538.062-.248-.124-1.047-.386-1.995-1.231-.738-.659-1.236-1.472-1.38-1.72-.146-.248-.016-.382.108-.506.112-.112.248-.29.372-.434.124-.145.165-.248.248-.414.083-.165.041-.31-.021-.434-.062-.124-.559-1.346-.765-1.842-.201-.484-.405-.418-.559-.426l-.476-.008c-.165 0-.434.062-.661.31-.227.248-.868.848-.868 2.07 0 1.221.889 2.4 1.013 2.565.124.165 1.75 2.673 4.239 3.748.592.256 1.055.409 1.416.523.595.19 1.136.163 1.564.1.477-.07 1.469-.6 1.675-1.179.207-.579.207-1.075.145-1.179-.062-.104-.227-.166-.475-.29z"/>
            </svg>
        </a>
    </div>

</body>
</html>

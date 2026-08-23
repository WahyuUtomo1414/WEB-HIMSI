@props(['activities' => []])

@php
    // Prepare items, if empty generate 6 elegant fallback items with image icons
    $rawItems = count($activities) > 0 ? $activities : [
        [
            'id' => 1,
            'image_url' => null,
            'title' => 'Dokumentasi Agenda Organisasi',
            'description' => 'Dokumentasi agenda kegiatan dan program kerja HIMSI UBSI.',
            'category_name' => 'KEGIATAN',
            'branch_name' => 'HIMSI UBSI',
            'detail_url' => '#',
        ],
        [
            'id' => 2,
            'image_url' => null,
            'title' => 'Workshop & Pelatihan IT',
            'description' => 'Pelatihan kompetensi software engineering & keilmuan komputasi.',
            'category_name' => 'KEGIATAN',
            'branch_name' => 'DPP HIMSI',
            'detail_url' => '#',
        ],
        [
            'id' => 3,
            'image_url' => null,
            'title' => 'Seminar Nasional Teknologi',
            'description' => 'Seminar nasional bersama praktisi dan pakar industri teknologi.',
            'category_name' => 'KEGIATAN',
            'branch_name' => 'HIMSI UBSI',
            'detail_url' => '#',
        ],
        [
            'id' => 4,
            'image_url' => null,
            'title' => 'Kunjungan Industri IT',
            'description' => 'Studi lapangan dan eksplorasi budaya kerja industri digital.',
            'category_name' => 'KEGIATAN',
            'branch_name' => 'DPC SEKTOR',
            'detail_url' => '#',
        ],
        [
            'id' => 5,
            'image_url' => null,
            'title' => 'Latihan Kepemimpinan Organisasi',
            'description' => 'Pembentukan karakter kepemimpinan & etika profesionalisme IT.',
            'category_name' => 'KEGIATAN',
            'branch_name' => 'DPP HIMSI',
            'detail_url' => '#',
        ],
        [
            'id' => 6,
            'image_url' => null,
            'title' => 'Aksi Pengabdian Masyarakat',
            'description' => 'Kontribusi nyata dan kolaborasi sosial mahasiswa Sistem Informasi.',
            'category_name' => 'KEGIATAN',
            'branch_name' => 'HIMSI UBSI',
            'detail_url' => '#',
        ],
    ];

    // Ensure enough items to create seamless infinite 2-row marquee
    $allItems = $rawItems;
    while (count($allItems) < 10) {
        $allItems = array_merge($allItems, $rawItems);
    }

    $half = (int) ceil(count($allItems) / 2);
    $row1 = array_slice($allItems, 0, $half);
    $row2 = array_slice($allItems, $half);

    // Duplicate sets for infinite seamless marquee loop
    $row1Loop = array_merge($row1, $row1);
    $row2Loop = array_merge($row2, $row2);
@endphp

<section class="space-y-8 relative py-8 sm:py-12 overflow-hidden">
    
    <!-- Custom CSS Marquee Styling (Hashmicro Style) -->
    <style>
        @keyframes himsiMarqueeLeft {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        @keyframes himsiMarqueeRight {
            0% { transform: translateX(-50%); }
            100% { transform: translateX(0); }
        }

        .himsi-marquee-container {
            width: 100%;
            overflow: hidden;
            position: relative;
        }

        .himsi-marquee-track-left {
            display: flex;
            gap: 1.25rem;
            width: max-content;
            animation: himsiMarqueeLeft 35s linear infinite;
        }

        .himsi-marquee-track-right {
            display: flex;
            gap: 1.25rem;
            width: max-content;
            animation: himsiMarqueeRight 35s linear infinite;
        }

        .himsi-marquee-container:hover .himsi-marquee-track-left,
        .himsi-marquee-container:hover .himsi-marquee-track-right {
            animation-play-state: paused;
        }
    </style>

    <!-- Section Header (Matches standard max-w-7xl container padding) -->
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <x-common.section-header 
            badge="Dokumentasi & Galeri" 
            title="Jejak Langkah & Dokumentasi Kegiatan HIMSI"
            subtitle="Potret momen kebersamaan, agenda acara, workshop teknologi, dan aksi nyata pengurus Himpunan Mahasiswa Sistem Informasi UBSI dalam menghidupkan ekosistem organisasi." 
            align="left" />
    </div>

    <!-- 2-Row Infinite Marquee Showcase -->
    <div class="space-y-5">
        
        <!-- Row 1: Marquee Left -->
        <div class="himsi-marquee-container">
            <div class="himsi-marquee-track-left">
                @foreach ($row1Loop as $item)
                    <a href="{{ $item['detail_url'] ?? '#' }}" 
                       class="group relative block w-[320px] sm:w-[380px] md:w-[412px] h-[200px] sm:h-[237px] shrink-0 rounded-2xl overflow-hidden border border-[#c5c5d4]/40 bg-[#000c46] shadow-md transition-all duration-500">
                        
                        @if (!empty($item['image_url']))
                            <!-- Photo (Grayscale by default, full vibrant colors on hover!) -->
                            <img src="{{ $item['image_url'] }}" 
                                 alt="{{ $item['description'] ?? $item['title'] }}" 
                                 loading="lazy" 
                                 class="h-full w-full object-cover filter grayscale contrast-105 brightness-90 group-hover:filter-none group-hover:scale-105 transition-all duration-500">
                        @else
                            <!-- Empty Fallback: Placeholder Image Icon -->
                            <div class="h-full w-full bg-[#001b79]/40 flex flex-col items-center justify-center gap-3 text-slate-300 p-6 text-center group-hover:bg-[#001b79]/60 transition-colors">
                                <svg class="w-12 h-12 text-amber-400/80 group-hover:scale-110 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V7.5zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                </svg>
                                <span class="text-xs font-semibold tracking-wide text-slate-200">Dokumentasi Foto Kegiatan</span>
                            </div>
                        @endif

                        <!-- Dark Overlay Gradient -->
                        <div class="absolute inset-0 bg-gradient-to-t from-[#000c46] via-[#000c46]/30 to-transparent opacity-60 group-hover:opacity-90 transition-opacity duration-300 pointer-events-none"></div>

                        <!-- Top Badges -->
                        <div class="absolute top-3.5 left-3.5 right-3.5 flex items-center justify-between z-10 pointer-events-none">
                            <span class="rounded-full bg-black/50 backdrop-blur-md border border-white/20 px-3 py-1 text-[10px] font-extrabold text-white uppercase tracking-wider">
                                {{ $item['category_name'] ?? 'KEGIATAN' }}
                            </span>
                            <span class="rounded-full bg-[#001b79]/85 backdrop-blur-md px-3 py-1 text-[10px] font-bold text-amber-300 border border-[#356ee7]/40 shadow-xs">
                                {{ $item['branch_name'] ?? 'HIMSI UBSI' }}
                            </span>
                        </div>

                        <!-- Title Quote Overlay (APPEARS ONLY ON HOVER!) -->
                        <div class="absolute inset-x-0 bottom-0 p-5 z-10 opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-3 group-hover:translate-y-0 text-white pointer-events-none">
                            <p class="text-xs sm:text-sm font-bold leading-snug text-amber-300 drop-shadow-sm">
                                "{{ $item['description'] ?? $item['title'] }}"
                            </p>
                        </div>

                    </a>
                @endforeach
            </div>
        </div>

        <!-- Row 2: Marquee Right -->
        <div class="himsi-marquee-container">
            <div class="himsi-marquee-track-right">
                @foreach ($row2Loop as $item)
                    <a href="{{ $item['detail_url'] ?? '#' }}" 
                       class="group relative block w-[320px] sm:w-[380px] md:w-[412px] h-[200px] sm:h-[237px] shrink-0 rounded-2xl overflow-hidden border border-[#c5c5d4]/40 bg-[#000c46] shadow-md transition-all duration-500">
                        
                        @if (!empty($item['image_url']))
                            <!-- Photo (Grayscale by default, full vibrant colors on hover!) -->
                            <img src="{{ $item['image_url'] }}" 
                                 alt="{{ $item['description'] ?? $item['title'] }}" 
                                 loading="lazy" 
                                 class="h-full w-full object-cover filter grayscale contrast-105 brightness-90 group-hover:filter-none group-hover:scale-105 transition-all duration-500">
                        @else
                            <!-- Empty Fallback: Placeholder Image Icon -->
                            <div class="h-full w-full bg-[#001b79]/40 flex flex-col items-center justify-center gap-3 text-slate-300 p-6 text-center group-hover:bg-[#001b79]/60 transition-colors">
                                <svg class="w-12 h-12 text-amber-400/80 group-hover:scale-110 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V7.5zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                </svg>
                                <span class="text-xs font-semibold tracking-wide text-slate-200">Dokumentasi Foto Kegiatan</span>
                            </div>
                        @endif

                        <!-- Dark Overlay Gradient -->
                        <div class="absolute inset-0 bg-gradient-to-t from-[#000c46] via-[#000c46]/30 to-transparent opacity-60 group-hover:opacity-90 transition-opacity duration-300 pointer-events-none"></div>

                        <!-- Top Badges -->
                        <div class="absolute top-3.5 left-3.5 right-3.5 flex items-center justify-between z-10 pointer-events-none">
                            <span class="rounded-full bg-black/50 backdrop-blur-md border border-white/20 px-3 py-1 text-[10px] font-extrabold text-white uppercase tracking-wider">
                                {{ $item['category_name'] ?? 'KEGIATAN' }}
                            </span>
                            <span class="rounded-full bg-[#001b79]/85 backdrop-blur-md px-3 py-1 text-[10px] font-bold text-amber-300 border border-[#356ee7]/40 shadow-xs">
                                {{ $item['branch_name'] ?? 'HIMSI UBSI' }}
                            </span>
                        </div>

                        <!-- Title Quote Overlay (APPEARS ONLY ON HOVER!) -->
                        <div class="absolute inset-x-0 bottom-0 p-5 z-10 opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-3 group-hover:translate-y-0 text-white pointer-events-none">
                            <p class="text-xs sm:text-sm font-bold leading-snug text-amber-300 drop-shadow-sm">
                                "{{ $item['description'] ?? $item['title'] }}"
                            </p>
                        </div>

                    </a>
                @endforeach
            </div>
        </div>

    </div>

</section>

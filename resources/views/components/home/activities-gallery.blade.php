@props(['row1Loop' => [], 'row2Loop' => []])

<section class="w-full bg-[#f0f4ff]/70 py-12 sm:py-16 lg:py-20 border-b border-[#c5c5d4]/40 space-y-8 relative overflow-hidden">

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

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <x-common.section-header
            badge="Dokumentasi & Galeri"
            title="Jejak Langkah & Dokumentasi Kegiatan HIMSI"
            subtitle="Potret momen kebersamaan, agenda acara, workshop teknologi, dan aksi nyata pengurus Himpunan Mahasiswa Sistem Informasi UBSI dalam menghidupkan ekosistem organisasi."
            align="left" />
    </div>

    <div class="space-y-5">

        <!-- Row 1: Marquee Left -->
        <div class="himsi-marquee-container">
            <div class="himsi-marquee-track-left">
                @foreach ($row1Loop as $item)
                    <x-home.activities-gallery-card :item="$item" />
                @endforeach
            </div>
        </div>

        <!-- Row 2: Marquee Right -->
        <div class="himsi-marquee-container">
            <div class="himsi-marquee-track-right">
                @foreach ($row2Loop as $item)
                    <x-home.activities-gallery-card :item="$item" />
                @endforeach
            </div>
        </div>

    </div>

</section>

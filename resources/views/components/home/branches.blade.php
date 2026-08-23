@props(['branches'])

<section class="w-full bg-[#f0f4ff]/70 py-12 sm:py-16 lg:py-20 border-b border-[#c5c5d4]/40 relative" x-data="{
    timer: null,
    intervalMs: 2500,
    step: 420,
    init() {
        this.startAutoScroll();
    },
    startAutoScroll() {
        if (this.timer) return;
        this.timer = setInterval(() => {
            this.scrollNext();
        }, this.intervalMs);
    },
    stopAutoScroll() {
        if (this.timer) {
            clearInterval(this.timer);
            this.timer = null;
        }
    },
    scrollNext() {
        const el = this.$refs.carousel;
        if (!el) return;
        const maxScrollLeft = el.scrollWidth - el.clientWidth;
        if (el.scrollLeft >= maxScrollLeft - 20) {
            el.scrollTo({ left: 0, behavior: 'smooth' });
        } else {
            el.scrollBy({ left: this.step, behavior: 'smooth' });
        }
    },
    scrollLeft() {
        this.stopAutoScroll();
        const el = this.$refs.carousel;
        if (el) el.scrollBy({ left: -this.step, behavior: 'smooth' });
        this.startAutoScroll();
    },
    scrollRight() {
        this.stopAutoScroll();
        this.scrollNext();
        this.startAutoScroll();
    }
}" @mouseenter="stopAutoScroll()" @mouseleave="startAutoScroll()">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 space-y-8">

    <!-- Section Header with Left-Right Navigation Controls -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
        <x-common.section-header badge="Wilayah" title="DPP & DPC HIMSI"
            subtitle="Jaringan kepengurusan HIMSI di berbagai sektor dan wilayah kampus UBSI" />

        @if (count($branches) > 0)
            <!-- Carousel Navigation Arrows -->
            <div class="flex items-center gap-3 shrink-0 self-start md:self-end">
                <button @click="scrollLeft()" type="button" aria-label="Scroll Kiri"
                    class="h-11 w-11 rounded-2xl border border-[#c5c5d4]/60 bg-white text-[#000c46] hover:bg-[#001b79] hover:text-white hover:border-[#001b79] transition-all duration-200 flex items-center justify-center shadow-sm cursor-pointer active:scale-95">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                </button>
                <button @click="scrollRight()" type="button" aria-label="Scroll Kanan"
                    class="h-11 w-11 rounded-2xl border border-[#c5c5d4]/60 bg-white text-[#000c46] hover:bg-[#001b79] hover:text-white hover:border-[#001b79] transition-all duration-200 flex items-center justify-center shadow-sm cursor-pointer active:scale-95">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </button>
            </div>
        @endif
    </div>

    @if (count($branches) > 0)
        <!-- Horizontal Scroll Container -->
        <div x-ref="carousel"
            class="flex gap-6 overflow-x-auto snap-x snap-mandatory scroll-smooth pb-6 pt-2 no-scrollbar [-ms-overflow-style:none] [scrollbar-width:none]">
            <style>
                .no-scrollbar::-webkit-scrollbar {
                    display: none;
                }
            </style>

            @foreach ($branches as $branch)
                <div class="flex-none w-[85%] sm:w-[360px] md:w-[400px] snap-start">
                    <div
                        class="group h-full rounded-2xl bg-white border border-[#c5c5d4]/60 shadow-[0_4px_20px_rgba(0,27,121,0.04)] hover:shadow-[0_12px_32px_rgba(0,27,121,0.12)] hover:border-[#0453cd]/40 transition-all duration-300 overflow-hidden flex flex-col justify-between">

                        <!-- Thumbnail Container (Full Bleed) -->
                        <div class="h-64 sm:h-72 lg:h-80 w-full overflow-hidden relative bg-[#f0f4ff]/70">
                            <x-common.image :src="$branch['thumbnail_url']" :alt="$branch['name']"
                                class="h-full w-full object-cover group-hover:scale-105 transition-all duration-500" />

                            <div class="absolute top-4 right-4 flex items-center gap-1.5 z-10">
                                @if (isset($branch['is_dpp']) && $branch['is_dpp'])
                                    <span
                                        class="rounded-full bg-[#000c46] px-3 py-1 text-xs font-bold text-white uppercase tracking-wider shadow-xs">
                                        DPP
                                    </span>
                                @endif
                                <span
                                    class="rounded-full bg-white border border-[#c5c5d4]/50 px-3.5 py-1 text-xs font-bold text-[#001b79] shadow-xs">
                                    {{ $branch['sektor'] ?? 'Wilayah' }}
                                </span>
                            </div>
                        </div>

                        <!-- Info Content -->
                        <div class="p-7 md:p-8 space-y-5 flex-1 flex flex-col justify-between">
                            <div class="space-y-3">
                                <h3
                                    class="text-xl font-bold text-[#000c46] group-hover:text-[#0453cd] transition-colors leading-snug">
                                    {{ $branch['name'] }}
                                </h3>
                                <p class="text-sm font-semibold text-[#454652] flex items-center gap-2">
                                    <svg class="h-4.5 w-4.5 text-[#0453cd] shrink-0" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span>{{ $branch['location'] }}</span>
                                </p>
                            </div>

                            <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                                <a href="{{ route('branch.show', $branch['id']) }}"
                                    class="inline-flex items-center gap-2 text-sm font-bold text-[#0453cd] group-hover:text-[#001b79] transition-colors">
                                    <span>Lihat Detail Cabang</span>
                                    <svg class="w-4 h-4 group-hover:translate-x-1.5 transition-transform" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                    </svg>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    @else
        <x-common.empty-state title="Belum Ada Cabang" message="Data cabang HIMSI akan segera diperbarui." />
    @endif
    </div>
</section>

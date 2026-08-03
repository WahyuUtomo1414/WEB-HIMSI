@props(['blogs'])

<section class="w-full bg-[#eef4ff] py-10 sm:py-14 lg:py-16 border-y border-[#c5c5d4]/40">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 space-y-10">
        
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-6">
            <x-common.section-header 
                badge="Publikasi"
                title="Artikel & Berita Terbaru" 
                subtitle="Informasi dan kabar seputar kegiatan akademik dan berita mahasiswa Sistem Informasi"
                align="left" />
            <a href="{{ route('blog.index') }}" class="inline-flex items-center justify-center rounded-xl border border-[#001b79] bg-white px-5 py-2.5 text-sm font-bold text-[#001b79] hover:bg-[#001b79] hover:text-white transition-all shadow-sm shrink-0 self-start sm:self-end">
                Lihat Semua Blog
            </a>
        </div>

        @if (count($blogs) > 0)
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
                @foreach (array_slice($blogs, 0, 3) as $blog)
                    <article class="group rounded-2xl bg-white border border-[#c5c5d4]/60 shadow-[0_4px_16px_rgba(0,27,121,0.04)] hover:shadow-[0_12px_32px_rgba(0,27,121,0.12)] hover:border-[#0453cd]/40 transition-all duration-300 overflow-hidden flex flex-col justify-between">
                        
                        <div class="space-y-4">
                            <!-- Thumbnail Container -->
                            <div class="h-52 sm:h-56 overflow-hidden relative bg-[#f0f4ff]/70 flex items-center justify-center p-4 border-b border-[#c5c5d4]/40">
                                <x-common.image :src="$blog['thumbnail_url']" :alt="$blog['title']" class="h-full w-full object-cover rounded-xl group-hover:scale-105 transition-all duration-500" />
                            </div>

                            <!-- Content -->
                            <div class="p-6 space-y-3">
                                <div class="flex items-center justify-between text-xs font-semibold">
                                    <span class="rounded-full bg-[#001b79]/10 px-2.5 py-0.5 text-xs font-bold text-[#001b79]">
                                        {{ $blog['category_name'] }}
                                    </span>
                                    <span class="text-slate-400">{{ $blog['formatted_date'] }}</span>
                                </div>
                                <h3 class="text-lg font-bold text-[#000c46] group-hover:text-[#0453cd] transition-colors leading-snug line-clamp-2">
                                    {{ $blog['title'] }}
                                </h3>
                                <p class="text-sm text-[#454652] leading-relaxed line-clamp-3">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($blog['body'] ?? $blog['quotes'] ?? ''), 100, '...') }}
                                </p>
                            </div>
                        </div>

                        <!-- Card Footer -->
                        <div class="p-6 pt-0">
                            <div class="pt-3 border-t border-slate-100 flex items-center justify-between">
                                <a href="{{ route('blog.show', $blog['slug']) }}" class="inline-flex items-center gap-1.5 text-sm font-bold text-[#0453cd] group-hover:text-[#001b79] transition-colors">
                                    <span>Baca Selengkapnya</span>
                                    <svg class="w-4 h-4 group-hover:translate-x-1.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                                    </svg>
                                </a>
                            </div>
                        </div>

                    </article>
                @endforeach
            </div>
        @else
            <x-common.empty-state title="Belum Ada Artikel" message="Belum ada artikel publikasi terbaru." />
        @endif

    </div>
</section>

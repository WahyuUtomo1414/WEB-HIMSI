@props(['blogs' => [], 'paginator' => []])

@if (count($blogs) > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
        @foreach ($blogs as $blog)
            <article class="group rounded-2xl bg-white border border-[#c5c5d4]/60 shadow-[0_4px_20px_rgba(0,27,121,0.04)] hover:shadow-[0_12px_32px_rgba(0,27,121,0.12)] hover:border-[#0453cd]/40 transition-all duration-300 overflow-hidden flex flex-col h-full">

                {{-- Thumbnail --}}
                <div class="aspect-[16/9] w-full overflow-hidden bg-[#f0f4ff]/70 shrink-0">
                    <x-common.image :src="$blog['thumbnail_url']" :alt="$blog['title']" class="h-full w-full object-cover group-hover:scale-105 transition-all duration-500" />
                </div>

                {{-- Body --}}
                <div class="flex flex-col flex-1 p-5">

                    {{-- Meta: category + date --}}
                    <div class="flex items-center justify-between gap-2 mb-3">
                        <span class="rounded-full bg-[#001b79]/10 px-3 py-1 text-[11px] font-bold text-[#001b79] border border-[#001b79]/15 uppercase tracking-wider truncate max-w-[55%] shrink-0">
                            {{ $blog['category_name'] }}
                        </span>
                        <span class="text-[11px] font-semibold text-slate-400 flex items-center gap-1 shrink-0">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                            </svg>
                            {{ $blog['formatted_date'] }}
                        </span>
                    </div>

                    {{-- Title --}}
                    <h3 class="text-base font-bold text-[#000c46] group-hover:text-[#0453cd] transition-colors leading-snug line-clamp-2 mb-2">
                        {{ $blog['title'] }}
                    </h3>

                    {{-- Excerpt --}}
                    <p class="text-sm text-[#454652] leading-relaxed line-clamp-3 flex-1">
                        {{ strip_tags($blog['body'] ?? $blog['quotes'] ?? '') }}
                    </p>

                    {{-- Footer --}}
                    <div class="flex items-center justify-between gap-3 pt-4 mt-4 border-t border-slate-100">
                        <a href="{{ route('blog.show', $blog['slug']) }}"
                           class="inline-flex items-center gap-1.5 text-xs font-bold text-[#0453cd] hover:text-[#001b79] transition-colors shrink-0">
                            <span>Baca Selengkapnya</span>
                            <svg class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                            </svg>
                        </a>
                        <div class="min-w-0 overflow-hidden">
                            <span class="block rounded-full bg-[#f0f4ff] border border-[#356ee7]/20 px-2.5 py-1 text-[11px] font-semibold text-[#001b79] truncate">
                                {{ $blog['branch_name'] }}
                            </span>
                        </div>
                    </div>
                </div>

            </article>
        @endforeach
    </div>

    {{-- Pagination Bar --}}
    <div class="pt-10 flex flex-col sm:flex-row items-center justify-between gap-4 border-t border-[#c5c5d4]/60">
        <p class="text-xs font-semibold text-[#454652]">
            Menampilkan
            <span class="font-bold text-[#000c46]">{{ $paginator['firstItem'] }}</span>
            sampai
            <span class="font-bold text-[#000c46]">{{ $paginator['lastItem'] }}</span>
            dari
            <span class="font-bold text-[#000c46]">{{ $paginator['total'] }}</span>
            artikel
        </p>

        <nav class="inline-flex items-center gap-1.5">

            {{-- Tombol Sebelumnya --}}
            @if ($paginator['onFirstPage'])
                <span class="inline-flex items-center gap-1 px-3.5 py-2 rounded-xl border border-[#c5c5d4]/60 bg-slate-100 text-xs font-bold text-slate-400 cursor-not-allowed">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/>
                    </svg>
                    <span>Sebelumnya</span>
                </span>
            @else
                <a href="{{ $paginator['previousPageUrl'] }}" class="inline-flex items-center gap-1 px-3.5 py-2 rounded-xl border border-[#c5c5d4]/60 bg-white text-xs font-bold text-[#000c46] hover:bg-[#001b79] hover:text-white hover:border-[#001b79] transition-all shadow-xs group">
                    <svg class="w-4 h-4 group-hover:-translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/>
                    </svg>
                    <span>Sebelumnya</span>
                </a>
            @endif

            {{-- Nomor Halaman --}}
            @foreach ($paginator['pages'] as $item)
                @if ($item['type'] === 'ellipsis')
                    <span class="h-9 w-9 flex items-center justify-center text-sm font-bold text-[#454652]">
                        &hellip;
                    </span>
                @elseif ($item['active'])
                    <span class="h-9 w-9 rounded-xl bg-[#001b79] text-white font-bold text-xs flex items-center justify-center shadow-xs">
                        {{ $item['number'] }}
                    </span>
                @else
                    <a href="{{ $item['url'] }}" class="h-9 w-9 rounded-xl bg-white border border-[#c5c5d4]/60 text-[#000c46] hover:bg-[#f0f4ff] hover:border-[#0453cd] font-bold text-xs flex items-center justify-center transition-all shadow-xs">
                        {{ $item['number'] }}
                    </a>
                @endif
            @endforeach

            {{-- Tombol Selanjutnya --}}
            @if ($paginator['hasMorePages'])
                <a href="{{ $paginator['nextPageUrl'] }}" class="inline-flex items-center gap-1 px-3.5 py-2 rounded-xl border border-[#c5c5d4]/60 bg-white text-xs font-bold text-[#000c46] hover:bg-[#001b79] hover:text-white hover:border-[#001b79] transition-all shadow-xs group">
                    <span>Selanjutnya</span>
                    <svg class="w-4 h-4 group-hover:translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                    </svg>
                </a>
            @else
                <span class="inline-flex items-center gap-1 px-3.5 py-2 rounded-xl border border-[#c5c5d4]/60 bg-slate-100 text-xs font-bold text-slate-400 cursor-not-allowed">
                    <span>Selanjutnya</span>
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                    </svg>
                </span>
            @endif

        </nav>
    </div>
@else
    <x-common.empty-state title="Artikel Tidak Ditemukan" message="Belum ada artikel publikasi yang sesuai dengan kata kunci atau kategori yang dicari." />
@endif

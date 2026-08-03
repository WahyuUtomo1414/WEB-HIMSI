@props(['divisions'])

@props(['divisions'])

<section class="w-full bg-[#eef4ff] py-10 sm:py-14 lg:py-16 border-y border-[#c5c5d4]/40">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        @if (count($divisions) > 0)
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-center">
                
                <!-- Left Side: Header & Overview -->
                <div class="lg:col-span-5 space-y-6">
                    <span class="inline-flex items-center gap-1.5 rounded-full bg-[#001b79]/10 px-3.5 py-1 text-xs font-bold text-[#001b79] uppercase tracking-wider">
                        <svg class="w-3.5 h-3.5 text-[#0453cd]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        Organisasi
                    </span>

                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-[#000c46] tracking-tight leading-tight">
                        Struktur Divisi
                    </h2>

                    <p class="text-base lg:text-lg text-[#454652] leading-relaxed font-normal">
                        Setiap divisi memiliki peran strategis dalam menghadirkan inovasi, meningkatkan kualitas organisasi, dan memberikan dampak positif bagi anggota maupun masyarakat luas.
                    </p>

                    <div class="pt-2">
                        <a href="{{ route('about.index') }}" class="inline-flex items-center gap-2 text-base font-bold text-[#0453cd] hover:text-[#000c46] transition-colors group">
                            <span>Pelajari Selengkapnya</span>
                            <svg class="h-5 w-5 group-hover:translate-x-1.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Right Side: Division Cards (2x2 Grid) -->
                <div class="lg:col-span-7">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 lg:gap-6">
                        @foreach ($divisions as $index => $division)
                            <div class="group rounded-2xl bg-white p-6 sm:p-7 border border-[#c5c5d4]/60 shadow-[0_4px_16px_rgba(0,27,121,0.04)] hover:shadow-[0_12px_32px_rgba(0,27,121,0.12)] hover:border-[#0453cd]/40 transition-all duration-300 flex flex-col justify-between space-y-6">
                                
                                <div class="space-y-4">
                                    <div class="flex items-center justify-between">
                                        <div class="h-12 w-12 rounded-xl bg-[#f0f4ff] group-hover:bg-[#001b79] text-[#0453cd] group-hover:text-white flex items-center justify-center p-2.5 transition-colors duration-300 shadow-sm">
                                            @if (isset($division['logo_url']) && $division['logo_url'] !== '/images/placeholder.svg')
                                                <img src="{{ $division['logo_url'] }}" alt="{{ $division['name'] }}" class="h-full w-full object-contain">
                                            @else
                                                @if ($index % 4 === 0)
                                                    <!-- Academic / Education Icon -->
                                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z"/>
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0112 20.055a11.952 11.952 0 01-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                                                    </svg>
                                                @elseif ($index % 4 === 1)
                                                    <!-- Humas / Media Icon -->
                                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                                                    </svg>
                                                @elseif ($index % 4 === 2)
                                                    <!-- PSDM / Users Icon -->
                                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                                    </svg>
                                                @else
                                                    <!-- Litbang / Innovation Icon -->
                                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L5.6 15.12a2 2 0 00-1.022.547l-1.2 1.2a2 2 0 000 2.828l1.2 1.2a2 2 0 002.828 0l1.2-1.2a2 2 0 00.547-1.022l.477-2.387a6 6 0 01.517-3.86l.158-.318a6 6 0 00.517-3.86l-.477-2.387a2 2 0 00-.547-1.022l-1.2-1.2a2 2 0 00-2.828 0l-1.2 1.2a2 2 0 000 2.828l1.2 1.2z"/>
                                                    </svg>
                                                @endif
                                            @endif
                                        </div>

                                        @if ($division['is_dpp'])
                                            <span class="rounded-full bg-[#000c46] px-2.5 py-0.5 text-[10px] font-bold text-white uppercase tracking-wider shadow-sm">DPP</span>
                                        @endif
                                    </div>

                                    <div class="space-y-2">
                                        <h3 class="text-lg font-bold text-[#000c46] group-hover:text-[#0453cd] transition-colors leading-snug">
                                            {{ $division['name'] }}
                                        </h3>
                                        <p class="text-sm text-[#454652] leading-relaxed line-clamp-3">
                                            {{ $division['description'] }}
                                        </p>
                                    </div>
                                </div>

                                <div class="pt-3 border-t border-slate-100 flex items-center justify-between">
                                    <a href="{{ route('division.show', $division['id']) }}" class="inline-flex items-center gap-1 text-sm font-bold text-[#0453cd] group-hover:text-[#001b79] transition-colors">
                                        <span>Lihat Detail</span>
                                        <svg class="w-4 h-4 group-hover:translate-x-1 group-hover:-translate-y-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25"/>
                                        </svg>
                                    </a>
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        @else
            <x-common.empty-state title="Belum Ada Divisi" message="Data divisi organisasi akan segera diperbarui." />
        @endif
    </div>
</section>

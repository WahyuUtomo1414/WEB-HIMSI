@props(['blogs'])

<section class="space-y-10">
    <div class="flex flex-col md:flex-row items-center justify-between gap-4">
        <x-common.section-header 
            badge="Publikasi"
            title="Artikel & Berita Terbaru" 
            subtitle="Informasi dan kabar seputar kegiatan akademik dan berita mahasiswa Sistem Informasi"
            align="left" />
        <a href="{{ route('blog.index') }}" class="rounded-xl border border-[#001b79] px-5 py-2.5 text-sm font-bold text-[#001b79] hover:bg-[#f0f4ff] shrink-0">
            Lihat Semua Blog
        </a>
    </div>

    @if (count($blogs) > 0)
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach ($blogs as $blog)
                <article class="card-nexus rounded-2xl overflow-hidden flex flex-col justify-between">
                    <div class="space-y-3">
                        <div class="h-48 overflow-hidden">
                            <img src="{{ $blog['thumbnail_url'] }}" alt="{{ $blog['title'] }}" class="h-full w-full object-cover">
                        </div>
                        <div class="p-5 space-y-2">
                            <div class="flex items-center justify-between text-xs font-semibold text-[#0453cd]">
                                <span>{{ $blog['category_name'] }}</span>
                                <span class="text-slate-400">{{ $blog['formatted_date'] }}</span>
                            </div>
                            <h3 class="text-lg font-bold text-[#000c46] line-clamp-2">{{ $blog['title'] }}</h3>
                            @if ($blog['quotes'])
                                <p class="text-xs text-[#454652] line-clamp-2 italic">"{{ $blog['quotes'] }}"</p>
                            @endif
                        </div>
                    </div>
                    <div class="p-5 pt-0">
                        <a href="{{ route('blog.show', $blog['slug']) }}" class="text-sm font-bold text-[#0453cd] hover:underline">
                            Baca Selengkapnya &rarr;
                        </a>
                    </div>
                </article>
            @endforeach
        </div>
    @else
        <x-common.empty-state title="Belum Ada Artikel" message="Belum ada artikel publikasi terbaru." />
    @endif
</section>

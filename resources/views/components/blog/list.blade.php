@props(['blogs', 'paginator'])

@if (count($blogs) > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
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
                <div class="p-5 pt-0 border-t border-slate-100 flex items-center justify-between">
                    <a href="{{ route('blog.show', $blog['slug']) }}" class="text-sm font-bold text-[#0453cd] hover:underline">
                        Baca Artikel &rarr;
                    </a>
                    <span class="text-[11px] font-semibold text-slate-400">{{ $blog['branch_name'] }}</span>
                </div>
            </article>
        @endforeach
    </div>

    {{-- Pagination --}}
    <div class="pt-6">
        {{ $paginator->links() }}
    </div>
@else
    <x-common.empty-state title="Artikel Tidak Ditemukan" message="Belum ada artikel publikasi yang sesuai dengan kata kunci atau kategori yang dicari." />
@endif

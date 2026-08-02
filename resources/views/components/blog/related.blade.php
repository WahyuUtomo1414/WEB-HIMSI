@props(['relatedBlogs'])

@if (count($relatedBlogs) > 0)
    <section class="pt-12 space-y-6 border-t border-slate-200">
        <h3 class="text-2xl font-bold text-[#000c46]">Artikel Terkait</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach ($relatedBlogs as $item)
                <article class="card-nexus rounded-2xl overflow-hidden flex flex-col justify-between">
                    <div class="space-y-3">
                        <div class="h-36 overflow-hidden">
                            <img src="{{ $item['thumbnail_url'] }}" alt="{{ $item['title'] }}" class="h-full w-full object-cover">
                        </div>
                        <div class="p-4 space-y-1">
                            <span class="text-[10px] font-bold text-[#0453cd] uppercase">{{ $item['category_name'] }}</span>
                            <h4 class="text-sm font-bold text-[#000c46] line-clamp-2">{{ $item['title'] }}</h4>
                        </div>
                    </div>
                    <div class="p-4 pt-0">
                        <a href="{{ route('blog.show', $item['slug']) }}" class="text-xs font-bold text-[#0453cd] hover:underline">
                            Baca &rarr;
                        </a>
                    </div>
                </article>
            @endforeach
        </div>
    </section>
@endif

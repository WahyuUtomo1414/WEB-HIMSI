@props(['blog'])

<div class="space-y-6">
    <article class="prose prose-lg max-w-none prose-headings:text-[#000c46] prose-headings:font-bold prose-p:text-[#454652] prose-p:leading-relaxed prose-a:text-[#0453cd] prose-strong:text-[#000c46]">
        {!! $blog['body'] !!}
    </article>

    @if (count($blog['images']) > 0)
        <div class="space-y-4 pt-6">
            <h3 class="text-xl font-bold text-[#000c46]">Dokumentasi Tambahan</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach ($blog['images'] as $img)
                    <div class="rounded-2xl overflow-hidden border border-slate-200 shadow-sm space-y-2">
                        <img src="{{ $img['image_url'] }}" alt="{{ $img['description'] }}" class="h-48 w-full object-cover">
                        @if ($img['description'])
                            <p class="p-3 text-xs text-[#454652] bg-slate-50">{{ $img['description'] }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>

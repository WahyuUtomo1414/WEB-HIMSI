@props(['blog'])

<div class="aspect-[16/9] overflow-hidden rounded-3xl border border-slate-200 shadow-xl">
    <img src="{{ $blog['thumbnail_url'] }}" alt="{{ $blog['title'] }}" class="h-full w-full object-cover">
</div>

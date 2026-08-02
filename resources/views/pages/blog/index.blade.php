<x-layouts.public title="Blog & Artikel - HIMSI UBSI">

    {{-- 1. Hero Section --}}
    <x-blog.hero :hero="$hero" />

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12 space-y-10">

        {{-- 2. Filter dan Search Section --}}
        <x-blog.filter 
            :categories="$categories" 
            :currentSearch="$currentSearch" 
            :currentCategory="$currentCategory" />

        {{-- 3. List Blog / Artikel dan Pagination Section --}}
        <x-blog.list :blogs="$blogs" :paginator="$paginator" />

    </div>

</x-layouts.public>

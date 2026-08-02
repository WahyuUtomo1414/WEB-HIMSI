@props(['division'])

<section class="bg-gradient-to-b from-[#f0f4ff] to-[#f9f9fc] py-16 border-b border-[#c5c5d4]/40">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 space-y-4">
        <div class="flex items-center gap-2">
            <a href="{{ route('home') }}" class="text-xs font-semibold text-[#0453cd] hover:underline">&larr; Kembali ke Beranda</a>
        </div>
        <div class="flex items-center gap-3">
            <div class="h-12 w-12 rounded-xl bg-white p-2 border border-slate-200 shadow-sm flex items-center justify-center">
                <img src="{{ $division['logo_url'] }}" alt="{{ $division['name'] }}" class="h-full w-full object-contain">
            </div>
            <h1 class="text-4xl font-extrabold text-[#000c46] tracking-tight sm:text-5xl">
                {{ $division['name'] }}
            </h1>
        </div>
    </div>
</section>

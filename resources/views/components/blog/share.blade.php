@props(['blog'])

<div class="pt-8 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-4">
    <span class="text-sm font-bold text-[#000c46]">Bagikan Artikel Ini:</span>
    <div class="flex items-center gap-3">
        <a href="https://wa.me/?text={{ urlencode($blog['title'] . ' ' . request()->fullUrl()) }}" 
           target="_blank" rel="noopener" 
           class="rounded-xl bg-emerald-600 px-4 py-2 text-xs font-bold text-white hover:bg-emerald-700 transition">
            WhatsApp
        </a>
        <a href="https://twitter.com/intent/tweet?text={{ urlencode($blog['title']) }}&url={{ urlencode(request()->fullUrl()) }}" 
           target="_blank" rel="noopener" 
           class="rounded-xl bg-sky-500 px-4 py-2 text-xs font-bold text-white hover:bg-sky-600 transition">
            Twitter / X
        </a>
    </div>
</div>

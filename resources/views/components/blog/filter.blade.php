@props(['categories', 'currentSearch', 'currentCategory'])

<div class="rounded-3xl p-6 sm:p-8 bg-white border border-[#c5c5d4]/60 shadow-[0_4px_20px_rgba(0,27,121,0.04)]">
    <form method="GET" action="{{ route('blog.index') }}" class="grid grid-cols-1 md:grid-cols-12 gap-4">
        {{-- Search Input --}}
        <div class="md:col-span-8 relative">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
            <input type="text" 
                   name="search" 
                   value="{{ $currentSearch }}" 
                   placeholder="Cari judul artikel, kutipan, atau kata kunci..." 
                   class="w-full rounded-2xl border border-[#c5c5d4]/60 bg-slate-50/70 pl-11 pr-4 py-3.5 text-sm font-medium text-[#000c46] placeholder:text-slate-400 focus:border-[#0453cd] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0453cd]/20 transition-all shadow-xs">
        </div>

        {{-- Category Dropdown --}}
        <div class="md:col-span-4 relative">
            <select name="category" onchange="this.form.submit()" class="w-full appearance-none rounded-2xl border border-[#c5c5d4]/60 bg-slate-50/70 px-4 py-3.5 text-sm font-bold text-[#000c46] focus:border-[#0453cd] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0453cd]/20 transition-all shadow-xs cursor-pointer">
                <option value="">Semua Kategori</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat['id'] }}" {{ $currentCategory == $cat['id'] ? 'selected' : '' }}>
                        {{ $cat['name'] }}
                    </option>
                @endforeach
            </select>
            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-slate-400">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                </svg>
            </div>
        </div>
    </form>
</div>

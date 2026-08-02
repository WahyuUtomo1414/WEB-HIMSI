@props(['categories', 'currentSearch', 'currentCategory'])

<div class="card-nexus rounded-2xl p-6 bg-white space-y-4">
    <form method="GET" action="{{ route('blog.index') }}" class="grid grid-cols-1 md:grid-cols-12 gap-4">
        {{-- Search Bar --}}
        <div class="md:col-span-8 relative">
            <input type="text" 
                   name="search" 
                   value="{{ $currentSearch }}" 
                   placeholder="Cari judul artikel, kutipan, atau kata kunci..." 
                   class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 pl-10 text-sm focus:border-[#001b79] focus:bg-white focus:outline-none">
            <svg class="absolute left-3 top-3.5 h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
        </div>

        {{-- Category Filter --}}
        <div class="md:col-span-4">
            <select name="category" onchange="this.form.submit()" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-[#001b79] focus:bg-white focus:outline-none">
                <option value="">Semua Kategori</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat['id'] }}" {{ $currentCategory == $cat['id'] ? 'selected' : '' }}>
                        {{ $cat['name'] }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>
</div>

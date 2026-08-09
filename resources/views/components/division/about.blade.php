@props(['division'])

<section class="card-nexus rounded-3xl p-6 sm:p-8 lg:p-12">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
        <!-- Deskripsi Divisi (Kiri) -->
        <div class="lg:col-span-7 space-y-4">
            <x-common.section-header 
                badge="Deskripsi Peran"
                title="Tentang {{ $division['name'] }}" 
                align="left" />
            <div class="prose max-w-none text-base sm:text-lg text-[#454652] leading-relaxed prose-p:mb-4 last:prose-p:mb-0">
                {!! $division['description'] !!}
            </div>
        </div>

        <!-- Thumbnail Divisi (Kanan) -->
        <div class="lg:col-span-5 flex justify-center">
            <div class="w-full rounded-2xl overflow-hidden border border-slate-200/80 shadow-md aspect-[16/10] sm:aspect-[4/3] max-h-[320px] bg-slate-100 group">
                <x-common.image 
                    :src="$division['image_url']" 
                    :alt="$division['name']" 
                    class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105" />
            </div>
        </div>
    </div>
</section>


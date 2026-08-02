<x-layouts.public title="{{ $blog['title'] }} - HIMSI UBSI">

    {{-- Hero Header Section --}}
    <section class="relative bg-gradient-to-br from-[#000c46] via-[#00145c] to-[#001b79] text-white pt-28 pb-14 sm:pt-32 sm:pb-16 lg:pt-36 lg:pb-20 border-b border-[#001b79] overflow-hidden isolate">
        <!-- Subtle Background Glows -->
        <div class="absolute -left-20 -top-20 h-72 w-72 rounded-full bg-[#0453cd]/20 blur-3xl -z-10 pointer-events-none"></div>
        <div class="absolute -right-20 -bottom-20 h-72 w-72 rounded-full bg-[#356ee7]/20 blur-3xl -z-10 pointer-events-none"></div>

        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 space-y-6 text-center relative z-10">
            <div class="flex items-center justify-center">
                <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 rounded-full bg-white/10 hover:bg-white/20 border border-white/20 px-4 py-1.5 text-xs font-bold text-white transition-all backdrop-blur-xs shadow-xs hover:border-white/40 group">
                    <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
                    </svg>
                    <span>Kembali ke Daftar Blog</span>
                </a>
            </div>
            
            {{-- 1. Title and Date Publication Section --}}
            <x-blog.header :blog="$blog" />
        </div>
    </section>

    <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 py-12 space-y-10">

        {{-- 2. Thumbnail Section --}}
        <x-blog.thumbnail :blog="$blog" />

        {{-- 3. Body Section (Body first as requested) --}}
        <x-blog.body :blog="$blog" />

        {{-- 4. Quotes Section (Quote after body as requested) --}}
        <x-blog.quotes :blog="$blog" />

        {{-- 5. Media Sosial Organisasi Section --}}
        <x-blog.share :blog="$blog" />

        {{-- 6. List Blog Section (Related Blogs) --}}
        <x-blog.related :relatedBlogs="$relatedBlogs" />

        {{-- 7. CTA Section --}}
        <x-common.cta-section 
            title="Suka Dengan Artikel Publikasi HIMSI?" 
            subtitle="Jelajahi artikel edukatif dan berita kegiatan mahasiswa Sistem Informasi lainnya." 
            buttonText="Lihat Semua Artikel" 
            :buttonLink="route('blog.index')" />

    </div>

</x-layouts.public>

<x-layouts.public title="{{ $blog['title'] }} - HIMSI UBSI">

    {{-- Hero Header Section --}}
    <section class="relative bg-gradient-to-br from-[#000c46] via-[#00145c] to-[#001b79] text-white pt-28 pb-14 sm:pt-32 sm:pb-16 lg:pt-36 lg:pb-20 border-b border-[#001b79] overflow-hidden isolate">
        <!-- Subtle Background Glows -->
        <div class="absolute -left-20 -top-20 h-72 w-72 rounded-full bg-[#0453cd]/20 blur-3xl -z-10 pointer-events-none"></div>
        <div class="absolute -right-20 -bottom-20 h-72 w-72 rounded-full bg-[#356ee7]/20 blur-3xl -z-10 pointer-events-none"></div>

        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 space-y-6 text-center relative z-10">
            <div class="flex items-center gap-2 justify-center">
                <a href="{{ route('blog.index') }}" class="inline-flex items-center text-xs font-semibold text-[#356ee7] hover:text-white transition-colors">&larr; Kembali ke Daftar Blog</a>
            </div>
            
            {{-- 1. Title and Date Publication Section --}}
            <x-blog.header :blog="$blog" />
        </div>
    </section>

    <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 py-12 space-y-10">

        {{-- 2. Thumbnail Section --}}
        <x-blog.thumbnail :blog="$blog" />

        {{-- 4. Quotes Section (If Available) --}}
        <x-blog.quotes :blog="$blog" />

        {{-- 3. Body Section --}}
        <x-blog.body :blog="$blog" />

        {{-- 5. Sosial Media Section (Share Buttons) --}}
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

<x-layouts.public title="{{ $blog['title'] }} - HIMSI UBSI">

    <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 py-12 space-y-10">

        {{-- Navigation Back --}}
        <div class="flex items-center gap-2">
            <a href="{{ route('blog.index') }}" class="text-xs font-semibold text-[#0453cd] hover:underline">&larr; Kembali ke Daftar Blog</a>
        </div>

        {{-- 1. Title and Date Publication Section --}}
        <x-blog.header :blog="$blog" />

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

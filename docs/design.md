# Design Guideline Website HIMSI

## 1. Tujuan Dokumen

Dokumen ini menjadi acuan desain frontend publik Website HIMSI.

Dokumen ini melengkapi:

- `docs/database.md` untuk struktur data,
- `docs/filament-resource.md` untuk admin panel,
- `docs/architecture.md` untuk arsitektur website publik.

Fokus dokumen:

- identitas visual,
- penggunaan logo dan asset,
- warna,
- typography,
- layout,
- komponen UI,
- standar halaman publik,
- aturan gambar dan responsive design.

## 2. Karakter Desain

Website HIMSI sebaiknya terasa:

- akademik,
- modern,
- profesional,
- informatif,
- mudah dipercaya,
- dekat dengan dunia teknologi dan organisasi mahasiswa.

Gaya yang disarankan:

- visual biru akademik sebagai identitas utama,
- layout bersih dan terstruktur,
- whitespace cukup lega,
- card informatif,
- CTA kontak jelas,
- foto kegiatan, pengurus, dan dokumentasi organisasi sebagai pendukung.

Gaya yang dihindari:

- terlalu ramai,
- terlalu gelap,
- warna neon,
- animasi berlebihan,
- landing page yang terlalu marketing,
- card bertumpuk terlalu banyak,
- dekorasi gradient yang mendominasi.

## 3. Logo

Path logo yang direkomendasikan:

- `public/images/logo.png`
- atau `public/images/logo.jpg`

Catatan kondisi repo:

- Saat dokumen ini dibuat, folder `public/images` belum tersedia.
- Saat logo sudah ada, gunakan path yang konsisten di layout publik dan komponen navbar/footer.

Path pemakaian di Blade jika memakai PNG:

```blade
<img src="/images/logo.png" alt="HIMSI UBSI" class="h-10 w-10 object-contain">
```

Aturan penggunaan:

- gunakan logo di navbar,
- gunakan logo di footer,
- gunakan logo di halaman auth/admin jika dibutuhkan,
- jangan stretch logo,
- gunakan `object-contain` untuk logo transparan,
- gunakan `object-cover` jika file logo berbentuk foto square,
- beri `alt="HIMSI UBSI"`,
- ukuran navbar disarankan `40px` sampai `48px`.

Rekomendasi logo navbar:

```blade
<a href="/" class="flex items-center gap-3">
    <img src="/images/logo.png" alt="HIMSI UBSI" class="h-11 w-11 object-contain">
    <span class="text-base font-semibold text-[#000c46]">HIMSI UBSI</span>
</a>
```

Jika logo dipakai di background gelap, tambahkan surface putih atau ring tipis agar tetap terbaca.

## 4. Warna

Warna utama memakai arah Academic Nexus yang diberikan untuk organisasi akademik teknologi.

Token warna:

| Token | Hex | Fungsi |
| --- | --- | --- |
| Primary | `#000c46` | heading kuat, navbar aktif, footer |
| Primary Container | `#001b79` | tombol utama, highlight utama |
| Secondary | `#0453cd` | link, aksi sekunder, indikator |
| Secondary Container | `#356ee7` | badge dan aksen interaktif |
| Amber Accent | `#f59e0b` | aksen emas hero, tombol hero CTA, badge highlight |
| Surface | `#f9f9fc` | background halaman |
| Surface Tint | `#f0f4ff` | section lembut dan tag |
| Surface Container | `#ffffff` | card utama |
| Surface Dim | `#dadadc` | divider dan surface redup |
| Text | `#1a1c1e` | teks utama |
| Text Muted | `#454652` | teks sekunder |
| Outline | `#757683` | border kuat |
| Outline Variant | `#c5c5d4` | border ringan |
| Error | `#ba1a1a` | validasi error |

Contoh CSS variable:

```css
:root {
  --color-primary: #000c46;
  --color-primary-container: #001b79;
  --color-secondary: #0453cd;
  --color-secondary-container: #356ee7;
  --color-amber-accent: #f59e0b;
  --color-surface: #f9f9fc;
  --color-surface-tint: #f0f4ff;
  --color-surface-container: #ffffff;
  --color-text: #1a1c1e;
  --color-muted: #454652;
  --color-outline: #757683;
  --color-outline-variant: #c5c5d4;
  --color-error: #ba1a1a;
}
```

Jika memakai Tailwind langsung:

- primary dark: `#000c46`,
- primary: `#001b79`,
- secondary: `#0453cd`,
- amber accent: `#f59e0b` (`bg-amber-500` / `text-amber-400`),
- soft background: `#f0f4ff`,
- page background: `#f9f9fc`,
- text utama: `#1a1c1e`.

## 5. Typography

Font yang direkomendasikan:

- heading: `Hanken Grotesk`,
- body dan label: `Plus Jakarta Sans`,
- fallback: system sans-serif.

Jika font belum dipasang, gunakan font bawaan project lebih dulu lalu pasang font saat tahap styling.

Aturan typography:

| Elemen | Mobile | Desktop | Weight | Catatan |
| --- | --- | --- | --- | --- |
| Display/Hero | `text-4xl` | `text-6xl` | `font-extrabold` | hanya untuk hero utama |
| H1 | `text-3xl` | `text-5xl` | `font-extrabold` | judul halaman |
| H2 | `text-2xl` | `text-4xl` | `font-bold` | judul section |
| H3 | `text-lg` | `text-xl` | `font-bold` | judul card |
| Body | `text-base` | `text-base` | `font-normal` | teks normal |
| Body Large | `text-lg` | `text-lg` | `font-normal` | lead paragraph |
| Label | `text-sm` | `text-sm` | `font-semibold` | label, badge, metadata |
| Caption | `text-xs` | `text-xs` | `font-normal` | tanggal dan keterangan kecil |

Catatan:

- Jangan memakai font terlalu kecil untuk paragraf.
- Artikel/blog harus nyaman dibaca.
- Heading card jangan dibuat sebesar hero.
- Hindari letter spacing negatif.
- Label uppercase boleh memakai letter spacing kecil, maksimal `0.05em`.

Contoh wrapper konten blog:

```blade
<article class="prose max-w-none prose-headings:text-[#000c46] prose-a:text-[#0453cd]">
    <x-dynamic-content :content="$content" />
</article>
```

Catatan:

- Jangan render HTML rich editor sembarangan.
- Jika konten blog berasal dari rich editor, sanitasi dan siapkan output aman sebelum dikirim ke view.

## 6. Layout Global

Website publik memakai layout:

- `resources/views/layouts/public.blade.php`

Struktur layout:

```text
Navbar
Main content
Footer
```

Aturan layout:

- semua halaman memakai navbar dan footer yang sama,
- konten utama memakai container konsisten,
- section vertical spacing cukup lega,
- desain mobile-first,
- tidak ada horizontal scroll.

Container:

```blade
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    {{ $slot }}
</div>
```

Spacing section:

- mobile: `py-16`,
- tablet: `md:py-20`,
- desktop: `lg:py-28`.

Grid:

- desktop: maksimal 12 kolom,
- tablet: 8 kolom,
- mobile: 1 sampai 4 kolom sesuai kebutuhan.

## 7. Navbar

Isi navbar:

- logo,
- nama website,
- menu utama,
- tombol kontak atau admin.

Menu utama:

- Beranda,
- Blog,
- Tentang Kami,
- Cabang,
- Kontak.

Aturan:

- navbar sticky boleh dipakai,
- background putih dengan backdrop blur,
- border bawah tipis memakai `#c5c5d4`,
- logo tampil jelas,
- menu mobile wajib tersedia,
- link aktif diberi warna primary dan indikator kecil.

Contoh arah visual:

```blade
<header class="sticky top-0 z-40 border-b border-[#c5c5d4]/60 bg-white/90 backdrop-blur">
    <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
        {{-- logo + menu --}}
    </div>
</header>
```

Active link:

- teks `#001b79`,
- font `font-semibold`,
- indikator bawah 4px atau dot kecil,
- jangan memakai background tebal untuk active nav.

## 8. Footer

Isi footer:

- logo,
- nama HIMSI UBSI,
- deskripsi singkat,
- link halaman,
- kontak organisasi,
- sosial media,
- copyright.

Aturan:

- footer boleh memakai background `#000c46`,
- teks putih atau tint biru muda,
- link hover memakai `#bac3ff`,
- logo diberi surface putih jika background gelap,
- jangan terlalu tinggi di mobile.

## 9. Button

Jenis button:

- primary,
- secondary,
- ghost/link button.

Primary button:

```blade
<a href="/kontak" class="inline-flex items-center justify-center rounded-lg bg-[#001b79] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#000c46]">
    Hubungi Kami
</a>
```

Secondary button:

```blade
<a href="/blog" class="inline-flex items-center justify-center rounded-lg border border-[#001b79] px-5 py-3 text-sm font-semibold text-[#001b79] transition hover:bg-[#f0f4ff]">
    Lihat Blog
</a>
```

Ghost button:

```blade
<a href="/tentang-kami" class="inline-flex items-center justify-center rounded-lg px-4 py-2 text-sm font-semibold text-[#0453cd] transition hover:bg-[#f0f4ff]">
    Tentang Kami
</a>
```

Aturan:

- border radius tombol standar `rounded-lg` atau 8px,
- CTA utama selalu jelas,
- jangan terlalu banyak CTA dalam satu section,
- semua tombol punya focus state yang terlihat.

## 10. Card

Card dipakai untuk:

- blog,
- branch,
- divisi,
- struktur cabang,
- kontak info,
- milestone,
- statistik.

Aturan card:

- background putih,
- border tipis atau shadow lembut,
- radius 16px untuk card publik,
- gambar punya aspect ratio konsisten,
- card tidak terlalu dekoratif.

Shadow:

```css
box-shadow: 0 4px 20px rgba(0, 27, 121, 0.05);
```

Hover shadow:

```css
box-shadow: 0 12px 32px rgba(0, 27, 121, 0.1);
```

Contoh card blog:

```blade
<article class="overflow-hidden rounded-2xl border border-[#c5c5d4]/70 bg-white shadow-[0_4px_20px_rgba(0,27,121,0.05)] transition hover:shadow-[0_12px_32px_rgba(0,27,121,0.1)]">
    <img src="{{ $imageUrl }}" alt="{{ $title }}" class="aspect-[16/10] w-full object-cover">
    <div class="space-y-3 p-5">
        <p class="text-sm font-semibold text-[#0453cd]">{{ $category }}</p>
        <h3 class="text-lg font-bold text-[#000c46]">{{ $title }}</h3>
        <p class="text-sm text-[#454652]">{{ $date }}</p>
    </div>
</article>
```

## 11. Gambar dan Foto

Sumber gambar:

- `organization.logo`,
- `organization.thumbnail`,
- `branch.thumbnail`,
- `division.logo`,
- `division.image`,
- `greeting.image`,
- `blog.thumbnail`,
- `blog_image.image`,
- `branch_structure.image`.

Data gambar berasal dari Filament `FileUpload` atau seeder.

Aturan:

- tampilkan gambar dari URL siap pakai yang dikirim controller atau accessor,
- selalu isi `alt`,
- gunakan placeholder jika gambar kosong,
- hindari gambar terlalu gelap,
- crop dengan `object-cover` untuk card,
- logo memakai `object-contain`,
- detail blog boleh memakai gambar lebih besar,
- jangan memakai tag PHP mentah `<?php ... ?>` di Blade.

Contoh:

```blade
<x-common.image-card
    :src="$imageUrl"
    :alt="$imageAlt"
    fallback="Gambar belum tersedia"
/>
```

## 12. Home Page

Tujuan home:

- memberi gambaran cepat tentang HIMSI,
- mengarahkan pengunjung ke profil organisasi,
- menampilkan statistik ringkas,
- menampilkan sambutan,
- menampilkan divisi dan branch,
- menampilkan blog terbaru,
- mengarahkan ke kontak.

Section home:

1. Hero
2. Statistik ringkas
3. Sambutan
4. Divisi
5. Cabang/DPC
6. Blog terbaru
7. FAQ ringkas
8. CTA kontak

Hero:

- H1 singkat dan kuat,
- supporting copy menjelaskan HIMSI sebagai organisasi mahasiswa Sistem Informasi,
- CTA ke Kontak dan Tentang Kami,
- visual memakai `organization.thumbnail`, dokumentasi kegiatan, atau foto organisasi.

Contoh headline:

```text
Himpunan Mahasiswa Sistem Informasi UBSI
```

## 13. Blog Page

Blog index:

- hero kecil,
- filter kategori,
- list blog,
- pagination,
- empty state jika belum ada blog.

Blog detail:

- judul,
- kategori,
- branch,
- tanggal,
- thumbnail,
- isi rich editor,
- gambar tambahan,
- blog terkait.

Aturan:

- blog hanya menampilkan data `active = true`,
- detail blog nyaman dibaca,
- gambar blog memakai aspect ratio lebar,
- kategori tampil sebagai badge.

## 14. Organisasi Page

Tujuan:

- menjelaskan identitas HIMSI,
- menampilkan visi, misi, tujuan,
- menampilkan alamat dan sosial media,
- menampilkan milestone organisasi,
- menampilkan sambutan pengurus.

Komponen:

- profile hero,
- vision mission section,
- purpose section,
- milestone timeline,
- social links,
- greeting block.

Aturan:

- `mision` tampil sebagai list,
- `sosial_media` tampil sebagai link list,
- `milestone.list` tampil sebagai bullet per tahun,
- teks panjang diberi lebar baca yang nyaman.

## 15. Cabang Page

Tujuan:

- menampilkan DPP/DPC atau cabang HIMSI,
- membantu pengunjung mengenal cabang,
- menampilkan struktur kepengurusan cabang.

Cabang index:

- card cabang,
- filter sektor,
- badge DPP/DPC,
- tombol detail.

Cabang detail:

- nama cabang,
- lokasi,
- deskripsi,
- link grup WhatsApp,
- sosial media cabang,
- struktur pengurus,
- blog terkait cabang.

Aturan:

- tampilkan `thumbnail` jika tersedia,
- `grup_wa` menjadi link eksternal,
- struktur pengurus memakai card dengan foto, nama, posisi, dan divisi.

## 16. Section Divisi

Tujuan:

- memperkenalkan divisi organisasi,
- menjelaskan fokus kerja tiap divisi,
- menampilkan daftar job description.

Aturan:

- divisi tidak dibuat sebagai halaman sendiri pada tahap awal,
- divisi tampil sebagai section di Home dan Tentang Kami,
- logo divisi kecil,
- image divisi sebagai visual pendukung,
- `job_description` tampil sebagai list,
- divisi DPP bisa diberi badge khusus jika `is_dpp = true`.

## 17. Kontak Page

Tujuan:

- menyediakan informasi komunikasi resmi HIMSI,
- menampilkan email, nomor telepon, alamat, sosial media, dan form pesan,
- membantu pengunjung memilih jalur komunikasi yang paling sesuai.

Data:

- `organization.email`,
- `organization.no_tlpn`,
- `organization.address`,
- `organization.sosial_media`,
- `contact.name`,
- `contact.email`,
- `contact.subject`,
- `contact.message`.

Aturan halaman:

- tampilkan card informasi kontak organisasi,
- tampilkan list sosial media,
- tampilkan form pesan kontak,
- link eksternal memakai `target="_blank"` dan `rel="noopener"`,
- jika data kontak organisasi kosong, tampilkan empty state yang jelas.

Contoh link kontak:

```blade
<a href="mailto:{{ $email }}" class="text-sm font-semibold text-[#0453cd] hover:text-[#001b79]">
    {{ $email }}
</a>
```

Field form kontak:

- nama lengkap,
- email,
- subjek,
- pesan.

Aturan form kontak:

- error message tampil di bawah input,
- success message tampil setelah submit berhasil,
- data tersimpan ke tabel `contact`,
- admin membaca pesan melalui `ContactResource`.

## 18. Section FAQ

Tujuan:

- menjawab pertanyaan umum seputar HIMSI,
- mengurangi kebingungan pengunjung.

Aturan:

- FAQ tidak dibuat sebagai halaman sendiri pada tahap awal,
- FAQ tampil sebagai section di Home,
- gunakan accordion,
- pertanyaan tampil jelas,
- jawaban tidak terlalu kecil,
- empty state jika belum ada FAQ aktif.

## 19. Empty State

Empty state dipakai saat data belum ada.

Contoh:

```blade
<div class="rounded-2xl border border-dashed border-[#c5c5d4] bg-[#f0f4ff] p-8 text-center">
    <h3 class="text-lg font-bold text-[#000c46]">Data belum tersedia</h3>
    <p class="mt-2 text-sm text-[#454652]">Silakan cek kembali nanti.</p>
</div>
```

Aturan:

- jangan biarkan halaman kosong,
- pakai bahasa yang ramah dan profesional,
- jangan tampilkan pesan error teknis ke pengunjung.

## 20. Responsive Design

Aturan mobile-first:

- default layout untuk mobile,
- `md:` untuk tablet,
- `lg:` untuk desktop,
- grid mulai `grid-cols-1`,
- gambar responsive,
- navbar mobile wajib bisa dibuka/tutup,
- form full width di mobile.

Contoh:

```blade
<div class="grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-3">
    {{-- card --}}
</div>
```

Breakpoint guideline:

| Viewport | Grid | Section Gap |
| --- | --- | --- |
| Mobile | 1 kolom | 64px |
| Tablet | 2 kolom atau 8-column layout | 80px |
| Desktop | 3 sampai 4 kolom atau 12-column layout | 120px |

## 21. Accessibility

Aturan dasar:

- semua gambar punya `alt`,
- button dan link punya teks jelas,
- warna teks harus kontras,
- form punya label,
- focus state harus terlihat,
- link eksternal memakai `target="_blank"` dan `rel="noopener"`.

Catatan:

- Jangan mengandalkan warna saja untuk status.
- Badge status boleh memakai teks seperti `Aktif`, `DPP`, `DPC`, atau nama sektor.

## 22. Do and Don't

Do:

- pakai warna Academic Nexus sebagai identitas utama,
- gunakan card sederhana,
- tampilkan data dari database,
- prioritaskan mobile,
- gunakan gambar dari upload Filament,
- gunakan route name untuk link internal,
- siapkan fallback gambar.

Don't:

- jangan buat dashboard admin manual di FE publik,
- jangan buat fitur absensi, pembayaran, atau portal anggota sebelum database siap,
- jangan hardcode path gambar upload di banyak Blade,
- jangan taruh query database di Blade,
- jangan tulis tag PHP mentah `<?php ... ?>` di Blade,
- jangan taruh logic formatting berat di Blade,
- jangan pakai terlalu banyak warna,
- jangan biarkan halaman kosong tanpa empty state.

## 23. Prioritas Implementasi Design

Urutan pengerjaan desain yang disarankan:

1. Navbar dengan logo.
2. Footer dengan logo dan link utama.
3. Komponen button primary, secondary, dan ghost.
4. Komponen section header.
5. Komponen image card dan empty state.
6. Komponen card blog.
7. Komponen card cabang.
8. Komponen card divisi.
9. Komponen card struktur cabang.
10. Kontak info dan form kontak.
11. FAQ accordion untuk section Home.
12. Halaman home.
13. Halaman publik lainnya.

Alasan:

- logo, navbar, footer, dan button membentuk identitas utama,
- card dipakai berulang di banyak halaman,
- home bisa dirakit lebih cepat jika komponen dasar sudah siap.

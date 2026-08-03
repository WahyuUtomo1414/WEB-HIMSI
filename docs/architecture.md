# Arsitektur Website HIMSI

## 1. Tujuan Dokumen

Dokumen ini menjadi acuan arsitektur frontend publik dan integrasi data Website HIMSI.

Dokumen ini disesuaikan dengan:

- struktur database pada `docs/database.md`,
- requirement admin Filament pada `docs/filament-resource.md`,
- kondisi repo saat ini yang sudah memiliki model domain, resource Filament, policy, Filament Shield, audit trait, soft delete, dan seeder awal.

Fokus utama dokumen:

- memisahkan area admin dan area publik,
- menentukan struktur controller, route, Blade page, dan Blade component frontend,
- menentukan data apa saja yang tampil di website publik,
- menjaga agar frontend mengambil data dari database tanpa mencampur logic admin.

## 2. Konteks Project Saat Ini

Project menggunakan Laravel 13 sebagai backend utama.

Package dan fitur penting yang sudah tersedia:

- Laravel 13,
- Filament 5,
- Filament Shield,
- model domain HIMSI,
- Filament resource untuk model domain,
- policy per model domain,
- `BaseModelSoftDeleteDefault`,
- `AuditedBySoftDelete`,
- soft delete dan audit user pada tabel domain,
- tabel auth memakai `users` bawaan Laravel dengan tambahan `branch_id`.

Area admin diarahkan ke Filament melalui:

- `app/Providers/Filament/AdminPanelProvider.php`
- path panel: `/admin`
- plugin permission: Filament Shield

Area publik saat ini masih sederhana:

- `/` mengarah ke `resources/views/welcome.blade.php`

## 3. Prinsip Arsitektur

Project dibagi menjadi dua area besar:

- Admin Panel
- Website Publik

Admin Panel:

- dipakai oleh pengurus/admin internal,
- dibangun memakai Filament,
- mengelola user, FAQ, pesan kontak, statistik, recruitment, status, blog, gambar blog, kategori, branch, struktur branch, divisi, sambutan, organisasi, dan milestone,
- tidak perlu dibuat ulang manual dengan Blade.

Website Publik:

- dipakai oleh mahasiswa, calon anggota, alumni, dosen, dan pengunjung umum,
- dibangun memakai route, controller, Blade layout, dan Blade component,
- menampilkan informasi dari data yang sudah dikelola lewat Filament,
- tidak membutuhkan login publik pada tahap awal.

Catatan:

- Jangan membuat dashboard admin manual di Blade.
- Jangan query database langsung dari Blade.
- Jangan menaruh logic admin di controller publik.
- Frontend publik dibuat sebagai website organisasi akademik yang informatif dan siap dikembangkan.

## 4. Struktur Folder Saat Ini

Struktur penting repo saat ini:

```text
app/
├── Filament/
│   ├── Resources/
│   └── Widgets/
├── Http/
│   └── Controllers/
│       └── Controller.php
├── Models/
│   ├── Blog.php
│   ├── BlogImage.php
│   ├── Branch.php
│   ├── BranchStructure.php
│   ├── Category.php
│   ├── Count.php
│   ├── Division.php
│   ├── Faq.php
│   ├── Greeting.php
│   ├── Milestone.php
│   ├── Organization.php
│   ├── Recruitment.php
│   ├── Status.php
│   └── User.php
├── Policies/
└── Traits/
    ├── AuditedBySoftDelete.php
    └── BaseModelSoftDeleteDefault.php

resources/
├── css/
│   └── app.css
├── js/
│   └── app.js
└── views/
    └── welcome.blade.php

routes/
├── console.php
└── web.php
```

## 5. Struktur FE Publik Yang Disarankan

Struktur frontend publik sebaiknya dibuat seperti ini:

```text
app/
└── Http/
    └── Controllers/
        ├── HomeController.php
        ├── BlogController.php
        ├── AboutController.php
        ├── BranchController.php
        └── ContactController.php

resources/
└── views/
    ├── layouts/
    │   └── public.blade.php
    ├── components/
    │   ├── layout/
    │   │   ├── navbar.blade.php
    │   │   └── footer.blade.php
    │   ├── common/
    │   │   ├── section-header.blade.php
    │   │   ├── button-primary.blade.php
    │   │   ├── button-secondary.blade.php
    │   │   ├── empty-state.blade.php
    │   │   └── image-card.blade.php
    │   ├── home/
    │   ├── blog/
    │   ├── branch/
    │   ├── division/
    │   ├── faq/
    │   ├── about/
    │   └── contact/
    └── pages/
        ├── home.blade.php
        ├── blog/
        │   ├── index.blade.php
        │   └── show.blade.php
        ├── about.blade.php
        ├── branch/
        │   ├── index.blade.php
        │   └── show.blade.php
        └── contact.blade.php
```

Catatan:

- `pages` dipakai sebagai penyusun halaman.
- `components` dipakai untuk section kecil dan UI reusable.
- Controller hanya menyiapkan data.
- Blade page tidak boleh menampung query database langsung.
- Blade tidak boleh berisi tag PHP mentah seperti `<?php ... ?>`.
- Blade directive dan echo seperti `{{ }}`, `@if`, `@foreach`, `route()`, `asset()`, `old()`, dan `@csrf` masih boleh dipakai seperlunya.
- Query, mapping URL gambar, dan formatting tanggal berulang sebaiknya disiapkan dari controller, presenter, atau accessor.

## 6. Domain Halaman Website Publik

Halaman publik yang akan dibuat pada tahap awal:

| Halaman | Route | Controller | Method | Data Utama |
| --- | --- | --- | --- | --- |
| Home | `/` | `HomeController` | `index` | organisasi, count, blog terbaru, sambutan, divisi, cabang, FAQ ringkas |
| Tentang Kami | `/tentang-kami` | `AboutController` | `index` | profil organisasi, visi, misi, tujuan, milestone, sambutan, divisi |
| Cabang | `/cabang` | `BranchController` | `index` | list cabang aktif, sektor, DPP/DPC |
| Detail Cabang | `/cabang/{branch}` | `BranchController` | `show` | detail cabang, struktur cabang, blog cabang |
| Detail Divisi | `/divisi/{division}` | `DivisionController` | `show` | detail divisi aktif dan job description |
| Blog | `/blog` | `BlogController` | `index` | list blog aktif, kategori, pagination |
| Detail Blog | `/blog/{blog:slug}` | `BlogController` | `show` | detail blog, gambar tambahan, blog terkait |
| Kontak | `/kontak` | `ContactController` | `index` | alamat, email, nomor telepon, sosial media, form pesan |
| Kirim Kontak | `/kontak` | `ContactController` | `store` | simpan pesan pengunjung |

Catatan:

- Detail blog sebaiknya memakai route model binding slug karena tabel `blog` sudah punya kolom `slug`.
- Detail cabang boleh memakai id terlebih dahulu. Jika nanti ingin URL lebih rapi, tambahkan kolom `slug` pada `branch`.
- Divisi tampil sebagai section di Home dan Tentang Kami, serta memiliki halaman detail `/divisi/{division}` berbasis model `Division`.
- FAQ tidak dibuat sebagai halaman sendiri pada tahap awal. Data FAQ tampil sebagai section di Home.
- Recruitment belum dibuat pada tahap awal, baik list maupun form.
- Kontak dibuat sebagai halaman publik. Data informasi kontak dibaca dari `organization`, sedangkan form pesan disimpan ke tabel `contact`.

## 7. Mapping Data Database ke FE

| Tabel | Model | Area Admin | Tampilan Publik |
| --- | --- | --- | --- |
| `users` | `User` | akun admin, permission, relasi branch | tidak tampil sebagai halaman publik |
| `organization` | `Organization` | profil organisasi tunggal | home, tentang kami, kontak, footer |
| `count` | `Count` | statistik angka | home, profil organisasi |
| `greeting` | `Greeting` | sambutan pengurus | home, profil organisasi |
| `milestone` | `Milestone` | linimasa organisasi | profil organisasi |
| `division` | `Division` | data divisi | home, tentang kami, detail cabang |
| `branch` | `Branch` | data DPP/DPC/cabang | home, halaman cabang, detail cabang, kontak |
| `branch_structure` | `BranchStructure` | pengurus per branch | detail cabang |
| `category` | `Category` | kategori blog | blog list, filter blog, detail blog |
| `blog` | `Blog` | artikel dan publikasi | home, blog list, detail blog |
| `blog_image` | `BlogImage` | gambar tambahan blog | detail blog |
| `faq` | `Faq` | pertanyaan umum | section FAQ di home |
| `contact` | `Contact` | baca pesan masuk | form pesan halaman kontak |
| `status` | `Status` | status recruitment | belum dipakai di FE tahap awal |
| `recruitment` | `Recruitment` | data pendaftar | belum dipakai di FE tahap awal |

Filter data publik:

- tampilkan hanya `active = true`,
- jangan tampilkan data soft deleted,
- urutkan konten terbaru berdasarkan `created_at`,
- urutkan milestone berdasarkan `sort`,
- eager load relasi yang tampil di halaman, misalnya `blog.category`, `blog.branch`, `blog.images`, `branch.structures.division`.

## 8. Layout Global

File layout:

- `resources/views/layouts/public.blade.php`

Isi layout:

- tag `<head>` global,
- meta viewport,
- title dinamis,
- Vite asset,
- navbar,
- slot konten,
- footer,
- script global.

Contoh struktur:

```blade
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'HIMSI UBSI' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <x-layout.navbar />

    <main>
        {{ $slot }}
    </main>

    <x-layout.footer />
</body>
</html>
```

Aturan:

- Jangan memakai tag PHP mentah `<?php ... ?>` di Blade.
- Hindari blok `@php` kecuali benar-benar darurat.
- Jangan menaruh query model di Blade.
- URL gambar dan tanggal terformat disiapkan dari controller, accessor, atau helper khusus.

## 9. Arah Visual FE

Frontend HIMSI sebaiknya terasa akademik, modern, rapi, dan cukup teknologis.

Karakter visual:

- biru akademik sebagai identitas utama,
- background putih dan tint biru muda untuk section,
- tipografi tegas untuk heading,
- gambar kegiatan, foto pengurus, dan dokumentasi organisasi sebagai visual utama,
- card sederhana untuk blog, cabang, divisi, struktur, dan FAQ,
- mobile-first.

Palet utama mengikuti konsep Academic Nexus:

```css
:root {
    --color-primary: #001b79;
    --color-primary-dark: #000c46;
    --color-secondary: #0453cd;
    --color-surface: #f9f9fc;
    --color-surface-tint: #f0f4ff;
    --color-text: #1a1c1e;
    --color-muted: #454652;
    --color-border: #c5c5d4;
    --color-accent: #356ee7;
}
```

Catatan:

- Hindari visual yang terlalu ramai.
- Hindari terlalu banyak gradient.
- Prioritaskan keterbacaan blog, profil organisasi, kontak, dan navigasi cabang.

## 10. Standar Mobile-First

Aturan FE:

- default styling adalah mobile,
- breakpoint `md`, `lg`, dan `xl` dipakai untuk layar lebih besar,
- semua grid dimulai dari satu kolom,
- navbar wajib punya menu mobile,
- gambar harus responsive,
- card tidak boleh menyebabkan horizontal scroll,
- tombol utama mudah ditekan di layar kecil.

Contoh pola grid:

```blade
<div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
    {{-- cards --}}
</div>
```

## 11. Alur Backend ke Frontend

Alur data:

```text
Route
-> Controller
-> Model Query
-> View Data
-> Blade Page
-> Blade Component
-> HTML + CSS
```

Aturan:

- Route hanya mengarahkan request.
- Controller mengambil dan memformat data.
- Query yang rumit boleh dipindah ke service.
- Blade page menyusun section.
- Component fokus ke tampilan kecil yang reusable.
- Jangan query database langsung di component Blade.
- Jangan menulis tag PHP mentah `<?php ... ?>` di Blade.
- Formatting tanggal, URL storage, dan mapping JSON disiapkan sebelum data masuk ke view.
- Blade menerima data siap tampil, misalnya `image_url`, `detail_url`, `formatted_date`, `category_name`, dan `branch_name`.

## 12. Route Publik

Contoh route awal:

```php
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/tentang-kami', [AboutController::class, 'index'])->name('about.index');

Route::get('/cabang', [BranchController::class, 'index'])->name('branch.index');
Route::get('/cabang/{branch}', [BranchController::class, 'show'])->name('branch.show');

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{blog:slug}', [BlogController::class, 'show'])->name('blog.show');

Route::get('/kontak', [ContactController::class, 'index'])->name('contact.index');
Route::post('/kontak', [ContactController::class, 'store'])->name('contact.store');
```

## 13. Controller Publik

### 13.1 HomeController

File page:

- `resources/views/pages/home.blade.php`

Data:

- satu data organisasi aktif,
- statistik aktif dari `Count`,
- sambutan aktif terbaru,
- blog terbaru,
- kategori blog,
- divisi aktif,
- branch aktif,
- FAQ aktif pilihan.

Component section:

- `components/home/hero.blade.php`
- `components/home/stats.blade.php`
- `components/home/greeting.blade.php`
- `components/home/divisions.blade.php`
- `components/home/branches.blade.php`
- `components/home/latest-blogs.blade.php`
- `components/home/faq-preview.blade.php`
- `components/home/contact-cta.blade.php`

### 13.2 BlogController

File page:

- `resources/views/pages/blog/index.blade.php`
- `resources/views/pages/blog/show.blade.php`

Data index:

- list blog aktif,
- filter kategori,
- pagination,
- kategori aktif.

Data show:

- detail blog aktif,
- relasi `category`,
- relasi `branch`,
- gambar tambahan `images`,
- blog terkait dari kategori yang sama.

Component:

- `components/blog/card.blade.php`
- `components/blog/category-filter.blade.php`
- `components/blog/content.blade.php`
- `components/blog/related.blade.php`

### 13.3 AboutController

File page:

- `resources/views/pages/about.blade.php`

Data:

- profil organisasi aktif,
- visi,
- misi dari kolom JSON `mision`,
- tujuan,
- alamat,
- sosial media dari kolom JSON `sosial_media`,
- milestone aktif urut `sort`,
- sambutan aktif.

Component:

- `components/about/profile.blade.php`
- `components/about/vision-mission.blade.php`
- `components/about/milestone.blade.php`
- `components/about/social-links.blade.php`
- `components/division/card.blade.php`
- `components/division/detail-section.blade.php`

### 13.4 BranchController

File page:

- `resources/views/pages/branch/index.blade.php`
- `resources/views/pages/branch/show.blade.php`

Data index:

- list cabang aktif,
- filter sektor,
- penanda DPP/DPC.

Data show:

- detail cabang aktif,
- struktur cabang aktif dengan relasi `division`,
- blog terbaru dari cabang tersebut.

Component:

- `components/branch/card.blade.php`
- `components/branch/sector-filter.blade.php`
- `components/branch/profile.blade.php`
- `components/branch/structure-card.blade.php`
- `components/branch/blog-list.blade.php`

### 13.5 ContactController

File page:

- `resources/views/pages/contact.blade.php`

Data:

- profil organisasi aktif,
- email organisasi,
- nomor telepon organisasi,
- alamat organisasi,
- sosial media organisasi dari JSON `sosial_media`,
- form pesan publik.

Component:

- `components/contact/contact-info.blade.php`
- `components/contact/social-links.blade.php`
- `components/contact/right-form.blade.php`

Catatan:

- Form kontak menyimpan data ke tabel `contact`.
- Pesan kontak dibaca dari Filament `ContactResource`.
- Halaman kontak tidak menampilkan daftar cabang karena kontak cabang sudah ada di detail halaman cabang.

### 13.6 Section Divisi dan FAQ

FAQ tidak punya route sendiri pada tahap awal. Divisi memiliki route detail, tetapi index/list divisi tetap tidak dibuat sebagai halaman publik mandiri.

Divisi:

- tampil sebagai section di Home,
- tampil lebih lengkap di Tentang Kami,
- detail divisi memakai `DivisionController@show`,
- dipakai sebagai label relasi pada struktur Cabang.

FAQ:

- tampil sebagai section di Home,
- tidak perlu halaman `/faq` dulu.

## 14. Standar Gambar dan File Publik

Data gambar/file berasal dari upload Filament atau seeder.

Mapping file:

| Tabel | Field | Disk | Directory |
| --- | --- | --- | --- |
| `organization` | `logo` | `public` | `organization` |
| `organization` | `thumbnail` | `public` | `organization` |
| `branch` | `thumbnail` | `public` | `branch` |
| `division` | `logo` | `public` | `division` |
| `division` | `image` | `public` | `division` |
| `greeting` | `image` | `public` | `greeting` |
| `blog` | `thumbnail` | `public` | `blog/thumbnail` |
| `blog_image` | `image` | `public` | `blog/image` |
| `branch_structure` | `image` | `public` | `branch_structure` |

Aturan FE:

- tampilkan gambar dari field siap pakai seperti `$blog['thumbnail_url']`,
- sediakan placeholder jika gambar kosong,
- semua gambar memakai `alt` yang jelas,
- gambar card memakai ukuran konsisten,
- jangan hardcode path `/storage/...` di banyak file Blade,
- pembentukan URL storage dilakukan di controller, presenter, accessor, atau helper khusus di luar Blade.

## 15. Halaman Kontak Publik

Halaman kontak publik menampilkan data komunikasi dari tabel `organization` dan menyimpan pesan pengunjung ke tabel `contact`.

Data utama:

- `organization.email`,
- `organization.no_tlpn`,
- `organization.address`,
- `organization.sosial_media`,
- `contact.name`,
- `contact.email`,
- `contact.subject`,
- `contact.message`.

Catatan:

- Form kontak memakai validasi Laravel.
- Setelah submit berhasil, tampilkan flash message.
- Pesan kontak tidak bisa dibuat manual dari Filament; admin hanya membaca dan menghapus/restore.
- Link eksternal WhatsApp dan sosial media wajib memakai `target="_blank"` dan `rel="noopener"`.

## 16. Catatan Panel Admin

Panel admin berada di `/admin` dan dikelola Filament.

Resource yang sudah menjadi bagian arsitektur admin:

- `UserResource`
- `FaqResource`
- `CountResource`
- `RecruitmentResource`
- `StatusResource`
- `BlogResource`
- `CategoryResource`
- `BranchResource`
- `BranchStructureResource`
- `DivisionResource`
- `GreetingResource`
- `OrganizationResource`
- `MilestoneResource`
- `ContactResource`

Catatan:

- Gambar blog dikelola lewat relation manager `Gambar Blog` di `BlogResource`, bukan lewat resource sidebar mandiri.
- Detail aturan Filament ada di `docs/filament-resource.md`.
- Database dan model domain ada di `docs/database.md`.
- Panel admin tidak perlu halaman Blade manual.
- Permission memakai Filament Shield.

## 17. Sinkronisasi Naming

Keputusan naming konsep:

- nama tabel domain mengikuti ERD dan tidak dipaksa plural,
- contoh: `blog`, `blog_image`, `branch`, `branch_structure`, `division`, `organization`,
- tabel auth memakai `users` bawaan Laravel,
- model memakai PascalCase,
- resource Filament mengikuti folder generator Filament seperti `Blogs`, `Branches`, dan `Organizations`.

Catatan:

- Yang penting konsisten di `Schema::create(...)`, `protected $table`, relasi model, dan query.

## 18. Prioritas Pengerjaan FE

Urutan pengerjaan yang disarankan:

1. Buat `resources/views/layouts/public.blade.php`.
2. Buat `components/layout/navbar.blade.php`.
3. Buat `components/layout/footer.blade.php`.
4. Buat component button, section header, empty state, dan image card.
5. Ubah route `/` agar memakai `HomeController`.
6. Buat `HomeController` dan `pages/home.blade.php`.
7. Buat halaman blog index dan detail.
8. Buat halaman tentang kami.
9. Buat halaman cabang index dan detail.
10. Buat section divisi untuk Home dan Tentang Kami.
11. Buat halaman kontak.
12. Rapikan responsive mobile-first.
13. Sambungkan gambar/file dari storage public.

Alasan:

- layout global harus stabil lebih dulu,
- home menjadi pintu utama website,
- blog, tentang kami, cabang, dan section divisi adalah konten utama publik,
- kontak dibuat dari data organisasi dan cabang yang sudah tersedia.

## 19. Catatan Teknis Penting

- Jangan menambah login publik pada tahap awal.
- Semua data publik harus difilter `active = true`.
- Data soft deleted tidak tampil di publik.
- Gunakan pagination untuk blog.
- Gunakan eager loading untuk relasi `blog.category`, `blog.branch`, `blog.images`, dan `branch.structures.division`.
- Gunakan route name agar link mudah dirawat.
- Jangan query langsung dari Blade.
- Jangan menulis tag PHP mentah `<?php ... ?>` di Blade.
- Blade directive dan helper view sederhana masih boleh dipakai.
- Jangan membuat halaman admin manual di frontend publik.
- Jalankan `php artisan storage:link` sebelum mengetes gambar publik.
- Pastikan fallback gambar tersedia jika data upload kosong.
- Kolom JSON seperti `sosial_media`, `job_description`, `mision`, dan `list` dikirim ke Blade sebagai array siap tampil.

## 20. Rekomendasi Isi FE Menurut Konsep Saat Ini

Isi FE yang paling pas untuk versi sekarang:

- Home sebagai ringkasan organisasi, statistik, sambutan, divisi, cabang, blog terbaru, dan FAQ ringkas.
- Blog sebagai pusat artikel, kegiatan, informasi, pengumuman, prestasi, dan akademik.
- Organisasi sebagai profil HIMSI, visi, misi, tujuan, sosial media, dan milestone.
- Cabang sebagai daftar DPP/DPC dan detail struktur kepengurusan.
- Kontak sebagai jalur komunikasi pengunjung lewat email, nomor telepon, sosial media, dan grup cabang.

Yang belum perlu dibuat:

- dashboard anggota publik,
- transaksi atau pembayaran,
- portal nilai atau akademik,
- login user publik,
- fitur absensi kegiatan.

Alasan:
Database sekarang belum punya tabel transaksi, pembayaran, absensi, atau portal anggota publik. FE publik sebaiknya fokus pada informasi organisasi, cabang, blog, dan kontak.

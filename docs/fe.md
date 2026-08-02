# Requirement Frontend Website HIMSI

## 1. Halaman & Section Website Publik

### 1. Halaman Home (`/`)
- **Hero Section**: Banner utama, headline Himpunan Mahasiswa Sistem Informasi UBSI, deskripsi singkat, tombol CTA Kontak & Tentang Kami.
- **Count Section**: Counter statistik (jumlah anggota, cabang, program kerja, dll dari model `Count`).
- **Greeting Section**: Sambutan dari Ketua / Pengurus HIMSI (model `Greeting`).
- **List Division Section**: Preview divisi-divisi organisasi (model `Division`).
- **List Cabang Section**: Preview cabang / DPC HIMSI (model `Branch`).
- **List Blog/Artikel Section**: 3 artikel blog terbaru (model `Blog`).
- **FAQ Section**: Accordion pertanyaan dan jawaban umum (model `Faq`).
- **CTA Section**: Call-to-action bergabung/menghubungi HIMSI.

### 2. Halaman Tentang Kami (`/tentang-kami`)
- **Hero Section**: Banner header Halaman Tentang Kami.
- **About Section**: Deskripsi profil organisasi HIMSI (model `Organization`).
- **Vision and Mission Section**: Visi dan list Misi HIMSI (model `Organization.mision`).
- **Purpose Section**: Tujuan pembentukan organisasi (model `Organization.purpose`).
- **Milestone Section**: Linimasa perjalanan sejarah HIMSI (model `Milestone` diurutkan berdasarkan `sort`).
- **List Division Section**: Daftar divisi lengkap beserta tugas utamanya.

### 3. Halaman Cabang (`/cabang`)
- **Hero Section**: Banner header Cabang & DPC HIMSI.
- **List Cabang Section**: Grid cabang dilengkapi fitur **Search** (nama/lokasi/sektor) dan **Filter** (All, DPP, DPC, Sektor).

### 4. Halaman Detail Cabang (`/cabang/{branch}`)
- **Hero Section**: Banner header nama cabang & sektor.
- **About Section**: Deskripsi detail cabang & lokasi.
- **Sosial Media Section**: Link media sosial cabang & link grup WhatsApp.
- **Struktur Organisasi Section**: Card pengurus cabang (`BranchStructure`) beserta divisi dan posisi.
- **CTA Section**: Banner CTA komunikasi cabang.

### 5. Halaman Detail Divisi (`/divisi/{division}`)
- **Hero Section**: Banner header nama divisi.
- **Image Section**: Gambar & logo divisi (`Division.image` & `Division.logo`).
- **About Section**: Deskripsi peran divisi.
- **Job Description Section**: List tugas & tanggung jawab divisi (`Division.job_description`).
- **CTA Section**: Banner CTA gabung/kontak divisi.

### 6. Halaman Blog / Artikel (`/blog`)
- **Hero Section**: Banner header Blog & Publikasi HIMSI.
- **Filter dan Search Section**: Search bar pencarian judul/konten & filter berdasarkan Kategori (`Category`).
- **List Blog dan Pagination Section**: Grid kartu artikel blog aktif dilengkapi dengan pagination Laravel.

### 7. Halaman Detail Blog / Artikel (`/blog/{blog:slug}`)
- **Title and Date Publication Section**: Judul blog, tanggal rilis, nama cabang & nama kategori.
- **Thumbnail Section**: Gambar utama artikel (`Blog.thumbnail`).
- **Body Section**: Isi artikel lengkap dari rich editor.
- **Quotes Section**: Kutipan penting (`Blog.quotes`).
- **Sosial Media Section**: Tombol share ke sosial media.
- **List Blog Section**: List artikel terkait (Related Blogs) dengan kategori yang sama.
- **CTA Section**: Banner CTA baca artikel lainnya / kontak.

### 8. Halaman Kontak (`/kontak`)
- **Hero Section**: Banner header Kontak HIMSI.
- **Left Section**: Informasi kontak resmi (Email, Telepon, Alamat, List Sosial Media Organisasi & Cabang).
- **Right Section**: Form Kontak (Formulir pengiriman pesan pengunjung dengan validasi & feedback notification).

---

## 2. Arsitektur Controller & Route

- `HomeController` -> `GET /`
- `AboutController` -> `GET /tentang-kami`
- `BranchController` -> `GET /cabang`, `GET /cabang/{branch}`
- `DivisionController` -> `GET /divisi/{division}`
- `BlogController` -> `GET /blog`, `GET /blog/{blog:slug}`
- `ContactController` -> `GET /kontak`, `POST /kontak` (Handle pengiriman form kontak)

## 3. Prinsip Data Flow
- Controller mengambil data dari Model (`active = true`, soft delete excluded, eager loading).
- Controller memformat tanggal, URL storage gambar public (`Storage::url(...)`), dan JSON array parsing.
- Blade Layout & Components **murni menerima data terstruktur** dari Controller.
- Zero Eloquent Queries, Zero Raw PHP tags (`<?php ?>`), Zero `@php` block di Blade files.

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

### 5. Halaman Blog / Artikel (`/blog`)
- **Hero Section**: Banner header Blog & Publikasi HIMSI.
- **Filter dan Search Section**: Search bar pencarian judul/konten & filter berdasarkan Kategori (`Category`).
- **List Blog dan Pagination Section**: Grid kartu artikel blog aktif dilengkapi dengan pagination Laravel.

### 6. Halaman Detail Blog / Artikel (`/blog/{blog:slug}`)
- **Title and Date Publication Section**: Judul blog, tanggal rilis, nama cabang & nama kategori.
- **Thumbnail Section**: Gambar utama artikel (`Blog.thumbnail`).
- **Body Section**: Isi artikel lengkap dari rich editor.
- **Quotes Section**: Kutipan penting (`Blog.quotes`).
- **Sosial Media Section**: Tombol share ke sosial media.
- **List Blog Section**: List artikel terkait (Related Blogs) dengan kategori yang sama.
- **CTA Section**: Banner CTA baca artikel lainnya / kontak.

### 7. Halaman Kontak (`/kontak`)
- **Hero Section**: Banner header Kontak HIMSI.
- **Informasi Kontak Section**: Email, telepon, alamat, dan sosial media organisasi dari model `Organization`.
- **Form Kontak Section**: Form pesan publik dengan field nama, email, subjek, dan pesan.
- **CTA Section**: Arahkan pengunjung ke email, WhatsApp, atau sosial media resmi.

### 8. Halaman Rekrutmen (`/rekrutmen`)
- **Hero Section**: Banner informasi open recruitment.
- **Divisi Section**: Daftar divisi dari model `Division`.
- **Timeline dan FAQ Section**: Informasi tahapan dan pertanyaan umum rekrutmen.
- **Form CTA Section**: Arahkan calon pendaftar ke `/rekrutmen/daftar`.

### 9. Form Rekrutmen (`/rekrutmen/daftar`)
- **Form Data Diri**: Nama, NIM, semester, cabang, email, WhatsApp, Instagram, dan motivasi.
- **Upload Berkas**: Bukti follow DPC, e-KTM, dan CV.
- **Validasi**: NIM dan nomor WhatsApp unik. e-KTM dan CV wajib diisi.
- **Submit Flow**: Data disimpan ke `Recruitment`, email notifikasi dikirim, lalu user diarahkan ke grup WhatsApp cabang.

Catatan:
- Halaman Divisi tidak dibuat sebagai route sendiri pada tahap awal. Divisi hanya tampil sebagai section di Home, Tentang Kami, dan detail Cabang.
- FAQ tidak dibuat sebagai route sendiri pada tahap awal. FAQ hanya tampil sebagai section di Home.
- Recruitment sudah dibuat sebagai halaman informasi dan form publik.
- Form kontak menyimpan pesan pengunjung ke tabel `contact`.

---

## 2. Arsitektur Controller & Route

- `HomeController` -> `GET /`
- `AboutController` -> `GET /tentang-kami`
- `BranchController` -> `GET /cabang`, `GET /cabang/{branch}`
- `BlogController` -> `GET /blog`, `GET /blog/{blog:slug}`
- `ContactController` -> `GET /kontak`, `POST /kontak`
- `RecruitmentController` -> `GET /rekrutmen`, `GET /rekrutmen/daftar`, `POST /rekrutmen`

## 3. Prinsip Data Flow
- Controller mengambil data dari Model (`active = true`, soft delete excluded, eager loading).
- Controller memformat tanggal, URL storage gambar public (`Storage::url(...)`), dan JSON array parsing.
- Blade Layout & Components **murni menerima data terstruktur** dari Controller.
- Zero Eloquent Queries, Zero Raw PHP tags (`<?php ?>`), Zero `@php` block di Blade files.

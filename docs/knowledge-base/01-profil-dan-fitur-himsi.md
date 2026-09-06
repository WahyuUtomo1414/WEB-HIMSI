# Profil dan Fitur Website HIMSI UBSI

Dokumen ini adalah materi pengetahuan (knowledge source) untuk AI Chat berbasis RAG di Website HIMSI. Isi dokumen ini akan diunggah ke menu **Sumber Pengetahuan** (`AiKnowledgeSourceResource`) di panel admin Filament sebagai tipe `text`, lalu diproses menjadi chunk dan embedding agar AI dapat menjawab pertanyaan pengunjung seputar HIMSI berdasarkan isi dokumen ini.

Tulisan di bawah ini menjelaskan HIMSI UBSI sebagai organisasi, serta fitur dan data yang tersedia di website publiknya.

---

## 1. Tentang HIMSI UBSI

HIMSI UBSI adalah singkatan dari **Himpunan Mahasiswa Sistem Informasi**, organisasi kemahasiswaan resmi di bawah Program Studi Sistem Informasi, Universitas Bina Sarana Informatika (UBSI).

HIMSI UBSI adalah organisasi mahasiswa Program Studi Sistem Informasi yang menjadi ruang pengembangan potensi akademik, teknologi, kepemimpinan, dan kolaborasi mahasiswa. Organisasi ini berperan sebagai wadah aspirasi, kreativitas, serta penguatan kompetensi mahasiswa agar mampu beradaptasi dengan kebutuhan dunia digital.

**Alamat sekretariat:**
Jl. Kamal Raya Ringroad No.18 RT06/RW03, Cengkareng, Jakarta Barat, 11730.

**Kontak resmi:**
- Email: himsi@bsi.ac.id
- Media sosial: Instagram (@himsi.ubsi), YouTube (@himsiubsi), LinkedIn (himsiubsi), TikTok (@himsiubsi)

### Visi

Menjadikan HIMSI sebagai himpunan yang kreatif, kompetitif, bertanggung jawab, dan berwawasan global.

### Misi

1. Meningkatkan kontribusi HIMSI kepada lingkungan kampus serta masyarakat luas, terutama di bidang Sistem Informasi.
2. Menciptakan prestasi akademik dan non-akademik yang kreatif serta inovatif dari berbagai aspek.
3. Menanamkan sikap disiplin dan bertanggung jawab dalam berorganisasi kepada setiap anggota.
4. Menyalurkan dan mengembangkan minat serta bakat setiap anggota.
5. Menjalin hubungan baik dan kerja sama dengan organisasi lainnya serta menjaga nama baik Himpunan dan Almamater.

### Tujuan

HIMSI UBSI berfungsi sebagai wadah untuk mewujudkan ide-ide kreatif mahasiswa, wadah aspirasi mahasiswa Sistem Informasi Universitas Bina Sarana Informatika untuk pengembangan diri dan Himpunan Mahasiswa Sistem Informasi (HIMSI) itu sendiri.

### Data Singkat Organisasi

- Tahun berdiri: 2012
- Jumlah cabang (DPC) aktif: 10 cabang
- Jumlah divisi: 4 divisi
- Jumlah anggota: sekitar 214 anggota

---

## 2. Struktur Divisi HIMSI

HIMSI UBSI memiliki 4 divisi utama yang menjalankan program kerja organisasi:

### Divisi Pendidikan
Bertugas mengembangkan kualitas keilmuan dan keterampilan anggota melalui berbagai program pembelajaran. Fokus utamanya adalah menyusun kurikulum, mengadakan kegiatan pelatihan, serta membangun suasana akademik yang kondusif demi meningkatkan kompetensi sumber daya manusia.

Tugas utama:
- Menyusun kurikulum pelatihan internal.
- Mengelola kegiatan belajar mengajar.
- Mengadakan seminar, workshop, dan pelatihan rutin.

### Divisi Kominfo (Komunikasi dan Informasi)
Berperan dalam mengelola komunikasi internal maupun eksternal organisasi. Divisi ini bertanggung jawab menjaga citra organisasi dengan memanfaatkan media sosial, website, dan kanal publikasi lainnya.

Tugas utama:
- Mengelola media sosial organisasi.
- Membuat konten publikasi kreatif.
- Mengelola website dan sistem informasi HIMSI.

### Divisi RSDM (Riset dan Sumber Daya Manusia)
Berfokus pada pengelolaan, pembinaan, dan pengembangan anggota. Tugasnya meliputi pengaturan struktur keanggotaan, penempatan posisi, hingga penyediaan program pelatihan untuk mendukung peningkatan soft skill maupun hard skill para anggota.

Tugas utama:
- Mengelola data dan database anggota.
- Menyusun program pengembangan diri.
- Mengatur penempatan dan rotasi anggota.

### Divisi Litbang (Penelitian dan Pengembangan)
Berfungsi untuk melakukan riset, analisis, serta inovasi demi mendukung keberlanjutan program kerja organisasi. Divisi ini berfokus pada evaluasi kinerja, pencarian solusi kreatif, serta menciptakan terobosan baru yang bermanfaat bagi perkembangan organisasi.

Tugas utama:
- Melakukan riset dan analisis organisasi.
- Mengembangkan inovasi program kerja.
- Mengevaluasi efektivitas kegiatan organisasi.

Detail tiap divisi dapat dilihat di halaman `/divisi/{id}` pada website.

---

## 3. Cabang / DPC HIMSI

HIMSI memiliki jaringan cabang yang disebut DPC (Dewan Pengurus Cabang), tersebar di tiga sektor wilayah: sektor barat, sektor tengah, dan sektor timur.

Daftar DPC HIMSI:

| Nama Cabang | Lokasi | Sektor |
| --- | --- | --- |
| DPC BSD | BSD, Tangerang Selatan | Sektor Barat |
| DPC Cengkareng | Cengkareng, Jakarta Barat | Sektor Barat |
| DPC Slipi | Slipi, Jakarta Barat | Sektor Barat |
| DPC Cimone | Cimone, Tangerang Kota | Sektor Barat |
| DPC Samudra | Kramat, Jakarta Pusat | Sektor Tengah |
| DPC Marwati | Depok, Jawa Barat | Sektor Tengah |
| DPC Kaliabang | Bekasi, Jawa Barat | Sektor Timur |
| DPC Cikarang | Cikarang, Jawa Barat | Sektor Timur |
| DPC Kalimalang | Kalimalang, Jakarta Timur | Sektor Timur |
| DPC Jatiwaringin | Pondok Gede, Jakarta Timur | Sektor Timur |

Setiap cabang memiliki:
- Grup WhatsApp cabang untuk koordinasi anggota.
- Akun Instagram cabang.
- Struktur kepengurusan sendiri (Ketua, Wakil Ketua, Sekretaris, Bendahara, dan Koordinator per divisi).

Struktur kepengurusan cabang mengikuti urutan posisi tetap: Ketua, Wakil Ketua, Sekretaris 1, Sekretaris 2, Bendahara, Koordinator Divisi Pendidikan, Koordinator Divisi RSDM, Koordinator Divisi Litbang, Koordinator Divisi Kominfo, Koordinator Divisi Sosmas, dan Koordinator Divisi PSDM.

Pengunjung dapat melihat daftar cabang di halaman `/cabang` (dengan fitur pencarian dan filter sektor/DPP/DPC), dan detail tiap cabang di `/cabang/{branch}` yang menampilkan profil, sosial media, link grup WhatsApp, struktur pengurus, dan blog terkait cabang tersebut.

---

## 4. Blog dan Publikasi

Website HIMSI memiliki halaman Blog (`/blog`) yang berisi artikel, berita kegiatan, pengumuman, dan prestasi organisasi.

Fitur blog:
- Pencarian judul dan isi artikel.
- Filter berdasarkan kategori.
- Pagination untuk daftar artikel.
- Setiap artikel memiliki judul, thumbnail, kutipan (quotes), isi lengkap, kategori, cabang terkait, dan tanggal terbit.
- Detail artikel (`/blog/{slug}`) menampilkan gambar tambahan, serta daftar artikel terkait dari kategori yang sama.
- Tombol berbagi ke sosial media.

Hanya artikel dengan status aktif yang tampil ke publik.

---

## 5. Rekrutmen Anggota Baru (Open Recruitment)

HIMSI membuka pendaftaran anggota baru melalui Open Recruitment yang dapat diakses di halaman `/rekrutmen`.

### Persyaratan dan Info Umum

- Terbuka untuk seluruh mahasiswa aktif Program Studi Sistem Informasi UBSI (dari kampus manapun), semester 1 hingga semester 4.
- Pendaftar dapat memilih 1 Divisi Utama (pilihan pertama) dan 1 Divisi Cadangan (pilihan kedua).
- Proses pendaftaran **100% gratis**, tidak dipungut biaya apa pun.
- Jangan khawatir jika belum berpengalaman berorganisasi — HIMSI adalah tempat belajar, yang terpenting adalah komitmen dan semangat belajar.
- Setiap pengurus yang menyelesaikan masa kepengurusan akan menerima E-Sertifikat resmi bertandatangan Pembina dan Ketua Jurusan, yang diakui kampus.

### Tahapan Rekrutmen

1. **Pendaftaran & Pengumpulan Berkas** — pengisian formulir online, memilih divisi pilihan, dan mengunggah berkas persyaratan.
2. **Pelaksanaan OPREC & SEMOT** — sosialisasi open recruitment untuk mengenalkan HIMSI dan membangun semangat calon anggota.
3. **Pengecekan Pendaftaran Calon Anggota** — verifikasi dan validasi berkas administrasi.
4. **Interview Calon Anggota** — sesi wawancara untuk menilai komitmen, potensi, minat, dan kesiapan calon anggota.

### Formulir Pendaftaran (`/rekrutmen/daftar`)

Data yang perlu diisi pendaftar:
- Nama lengkap
- NIM (harus unik, belum pernah dipakai daftar sebelumnya)
- Semester
- Email
- Nomor WhatsApp (harus unik)
- Cabang (DPC) pilihan
- Divisi pilihan
- Username Instagram
- Motivasi/alasan bergabung

Berkas yang wajib diunggah:
- **Bukti follow Instagram DPC** — wajib berupa gambar (JPG/JPEG/PNG/WebP).
- **e-KTM** — boleh berupa gambar atau PDF.
- **CV** — wajib berformat PDF.

Setelah pendaftaran berhasil dikirim, sistem otomatis mengirim email notifikasi ke pendaftar, dan pendaftar diarahkan untuk bergabung ke grup WhatsApp cabang yang dipilih.

---

## 6. Halaman Kontak

Halaman `/kontak` menampilkan informasi komunikasi resmi HIMSI (email, nomor telepon, alamat, dan sosial media organisasi) serta menyediakan formulir pesan publik dengan field: nama, email, subjek, dan pesan. Pesan yang dikirim pengunjung akan masuk ke sistem dan dibaca oleh admin melalui panel Filament.

---

## 7. Fitur AI Chat (Asisten Virtual HIMSI)

Website HIMSI memiliki fitur **AI Chat** berupa widget chat mengambang di pojok kanan bawah setiap halaman publik. Fitur ini memungkinkan pengunjung bertanya langsung seputar HIMSI dan mendapat jawaban otomatis dari asisten AI.

Kemampuan AI Chat:
- Menjawab pertanyaan umum seputar profil, visi-misi, divisi, dan program HIMSI berdasarkan dokumen pengetahuan yang diunggah admin (termasuk dokumen ini).
- Mengenali nama cabang (DPC) yang disebut dalam pertanyaan, lalu mengambil data cabang dan blog terbaru cabang tersebut secara langsung dari database agar informasi selalu terbaru.
- Menolak menjawab pertanyaan yang mengandung kata atau topik terlarang sesuai aturan yang diatur admin.
- Tidak memerlukan login untuk digunakan.

Fitur ini bisa diaktifkan atau dinonaktifkan oleh admin melalui panel Filament.

---

## 8. Ringkasan Navigasi Website Publik

| Halaman | URL | Isi |
| --- | --- | --- |
| Beranda | `/` | Hero, statistik, sambutan pengurus, preview divisi, preview cabang, blog terbaru, FAQ, CTA kontak |
| Tentang Kami | `/tentang-kami` | Profil organisasi, visi, misi, tujuan, milestone, daftar divisi lengkap |
| Cabang | `/cabang` | Daftar seluruh DPC dengan pencarian dan filter sektor |
| Detail Cabang | `/cabang/{branch}` | Profil cabang, sosial media, struktur pengurus, blog cabang |
| Detail Divisi | `/divisi/{division}` | Deskripsi dan tugas kerja satu divisi |
| Blog | `/blog` | Daftar artikel dengan pencarian dan filter kategori |
| Detail Blog | `/blog/{slug}` | Isi artikel lengkap dan artikel terkait |
| Kontak | `/kontak` | Info kontak organisasi dan form pesan |
| Rekrutmen | `/rekrutmen` | Informasi open recruitment, divisi, timeline, FAQ |
| Form Rekrutmen | `/rekrutmen/daftar` | Formulir pendaftaran calon anggota baru |

Semua data yang tampil di halaman publik berasal dari data yang dikelola admin lewat panel Filament (`/admin`), dan hanya data berstatus aktif yang ditampilkan ke pengunjung.

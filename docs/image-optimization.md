# Strategi Optimasi Gambar Website HIMSI

## 1. Tujuan

Dokumen ini menjadi acuan implementasi optimasi gambar untuk upload gambar dari Filament.

Target utama:

- gambar yang diupload dari Filament otomatis dikonversi ke WebP,
- ukuran file lebih kecil tanpa mengorbankan kualitas visual yang terlihat,
- path file tetap konsisten dan aman dipakai oleh frontend publik,
- file non-gambar seperti PDF/CV tidak ikut dikonversi,
- implementasi mudah dipakai ulang di semua `FileUpload::image()`.

Scope awal hanya untuk upload baru dari Filament. Migrasi gambar lama bisa dibuat sebagai tahap terpisah.

## 2. Dependency

Package yang dipakai:

```bash
composer require intervention/image:^2
```

Catatan:

- Project memakai `intervention/image:^2`.
- Intervention Image versi 2 memakai API `Intervention\Image\ImageManagerStatic`.
- Server perlu punya extension image yang aktif. Environment lokal saat ini sudah memiliki `gd` dan `imagick`.
- Driver yang direkomendasikan untuk awal: `gd`, karena umumnya tersedia di shared hosting. Jika server produksi stabil dengan Imagick, driver bisa diganti ke `imagick`.

## 3. Prinsip Implementasi

Aturan umum:

- hanya field Filament yang memakai `->image()` yang dikonversi,
- jangan convert PDF,
- field hybrid seperti `ektm` boleh memakai converter kondisional: gambar dikonversi ke WebP, PDF tetap disimpan sebagai PDF,
- hasil akhir disimpan sebagai `.webp`,
- file asli dihapus hanya setelah WebP berhasil disimpan,
- path hasil harus tetap berada di directory upload asal,
- nama file dibuat unik agar tidak bentrok,
- kualitas WebP default `85`,
- resize maksimal dilakukan sesuai konteks gambar.

Jangan memakai helper yang hanya menerima string path untuk tahap upload baru. Untuk upload Filament lebih tepat memakai hook `saveUploadedFileUsing()` karena proses terjadi saat file baru disimpan.

## 4. Field Target

Field yang aman untuk WebP karena memang image-only:

| Resource | Field | Directory | Catatan |
| --- | --- | --- | --- |
| Organization | `logo` | `organization` | resize maksimal 512px |
| Organization | `thumbnail` | `organization/thumbnail` | resize maksimal 1600px |
| Blog | `thumbnail` | `blog/thumbnail` | resize maksimal 1600px |
| Blog Images | `image` | sesuai relation manager | resize maksimal 1600px |
| Branch | `thumbnail` | `branch` | resize maksimal 1600px |
| Branch Structure | `image` | `branch_structure` | resize maksimal 1000px |
| Branch Relation Structure | `image` | sesuai relation manager | resize maksimal 1000px |
| Division | `logo` | `division/logo` | resize maksimal 512px |
| Division | `image` | `division/image` | resize maksimal 1600px |
| Greeting | `image` | `greeting` | resize maksimal 1200px |
| Recruitment | `follow_dpc` | `recruitment/follow_dpc` | resize maksimal 1600px |

Field dokumen atau hybrid:

| Resource | Field | Alasan |
| --- | --- | --- |
| Recruitment | `cv` | PDF/file dokumen |
| Recruitment | `ektm` | hybrid: gambar dikonversi ke WebP, PDF tetap disimpan tanpa konversi |

`ektm` dan `cv` wajib diisi pada form publik. Kewajiban ini ada di validasi aplikasi, walaupun kolom `cv` database tetap nullable untuk kompatibilitas data lama.

## 5. Service Yang Disarankan

Buat service kecil:

```text
app/Support/ImageUploadOptimizer.php
```

Tanggung jawab service:

- menerima file upload Livewire dari Filament,
- validasi MIME gambar,
- membaca gambar memakai Intervention Image,
- orientasi gambar diperbaiki bila memungkinkan,
- resize dengan menjaga aspect ratio,
- encode WebP quality 85,
- simpan ke disk dan directory tujuan,
- return path relatif yang disimpan ke database.

Contoh bentuk API:

```php
ImageUploadOptimizer::storeWebp(
    file: $file,
    disk: 'public',
    directory: 'blog/thumbnail',
    maxWidth: 1600,
    quality: 85,
);
```

Output harus berupa path relatif:

```text
blog/thumbnail/01JABCDEF123456789.webp
```

## 6. Pola Filament

Setiap upload gambar memakai pola ini:

```php
FileUpload::make('thumbnail')
    ->label('Thumbnail')
    ->image()
    ->disk('public')
    ->directory('blog/thumbnail')
    ->visibility('public')
    ->maxSize(2048)
    ->saveUploadedFileUsing(fn ($file) => ImageUploadOptimizer::storeWebp(
        file: $file,
        disk: 'public',
        directory: 'blog/thumbnail',
        maxWidth: 1600,
    ));
```

Catatan:

- `preserveFilenames()` sebaiknya dihapus untuk field yang dikonversi, karena nama file asli tidak lagi relevan setelah WebP dan rawan bentrok.
- Jika perlu audit nama asli, simpan metadata terpisah, bukan nama file storage utama.
- Field non-gambar tetap memakai `FileUpload` normal.

## 7. Rekomendasi Resize

Ukuran maksimal:

| Jenis Gambar | Max Width | Quality |
| --- | ---: | ---: |
| Logo organisasi/divisi | 512px | 90 |
| Thumbnail blog/cabang/organisasi | 1600px | 85 |
| Foto pengurus/struktur | 1000px | 85 |
| Foto sambutan | 1200px | 85 |
| Bukti follow DPC | 1600px | 82 |

Aturan resize:

- jangan upscale gambar kecil,
- aspect ratio wajib dipertahankan,
- tinggi mengikuti otomatis,
- crop tidak dilakukan pada tahap awal.

## 8. Public Frontend

Frontend tidak perlu berubah besar karena database tetap menyimpan path file di disk `public`.

Helper `public_image_url()` tetap dipakai:

```php
public_image_url($record->thumbnail)
```

Browser modern akan menerima gambar WebP langsung. Untuk fallback browser lama tidak diprioritaskan karena target website publik modern.

## 9. Rollout Bertahap

Tahap 1:

- install `intervention/image:^2`,
- buat `ImageUploadOptimizer`,
- terapkan ke 1 field aman, misalnya `Blog.thumbnail`,
- test upload JPG/PNG/WebP,
- pastikan preview Filament dan frontend publik tetap tampil.

Tahap 2:

- terapkan ke semua field image-only di Filament,
- hapus `preserveFilenames()` pada field yang dikonversi,
- cek seluruh infolist `ImageEntry`.

Tahap 3:

- buat command migrasi gambar lama ke WebP,
- jalankan dry-run dahulu,
- backup storage sebelum migrasi,
- update database path setelah convert berhasil.

Tahap 4:

- tambah validasi ukuran dimensi,
- tambah laporan ukuran file sebelum/sesudah,
- pertimbangkan responsive derivative jika traffic sudah tinggi.

## 10. Risiko dan Mitigasi

Risiko:

- gambar transparan PNG logo berubah kualitas jika quality terlalu rendah,
- file PDF tidak boleh melewati converter,
- path file bisa berubah kalau directory tidak dijaga,
- upload besar bisa memakan memory PHP,
- shared hosting mungkin membatasi memory/process time.

Mitigasi:

- logo pakai quality 90,
- converter hanya dipasang pada `FileUpload::image()`,
- output selalu memakai directory input,
- batas `maxSize` tetap dipasang,
- resize sebelum encode WebP,
- log error dan fallback gagal upload dengan pesan yang jelas.

## 11. Checklist Implementasi

- Tambah dependency `intervention/image:^2`. Selesai.
- Buat service `ImageUploadOptimizer`. Selesai.
- Tambah unit/helper test untuk JPG, PNG, WebP, dan file invalid.
- Pasang ke `Blog.thumbnail` sebagai pilot. Selesai.
- Verifikasi upload di Filament.
- Verifikasi file tersimpan `.webp`.
- Verifikasi path database benar.
- Verifikasi frontend publik menampilkan gambar.
- Terapkan ke field image-only lain. Selesai untuk field image-only utama.
- Rencanakan command migrasi gambar lama.

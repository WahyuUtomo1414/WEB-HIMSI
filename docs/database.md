# Database Web HIMSI

## 1. Ringkasan

Dokumen ini merangkum konsep struktur database awal Website HIMSI berdasarkan ERD terbaru, dengan penyesuaian teknis agar cocok untuk implementasi Laravel, Filament, migration trait, soft delete, dan audit user.

Catatan penting:

- Nama tabel domain mengikuti nama pada ERD dan tidak dipaksa memakai akhiran `s`.
- ERD memiliki `basemodel` sebagai template kolom bawaan, bukan tabel domain yang perlu dibuat.
- Tabel domain direkomendasikan memakai trait `BaseModelSoftDeleteDefault` dan memanggil `$this->base($table);`.
- Model domain direkomendasikan memakai `AuditedBySoftDelete`, `HasFactory`, dan `SoftDeletes`.
- Model domain tidak perlu memakai `$fillable`; gunakan `protected $guarded = ['id'];`.
- Relasi foreign key memakai format Laravel `foreignId()->constrained('nama_table')`.
- Tabel auth pada ERD tertulis `user`, sedangkan Laravel bawaan memakai `users`. Sebelum implementasi migration, pilih salah satu strategi:
  - tetap memakai `users` bawaan Laravel, lalu foreign key audit dan auth mengarah ke `users`;
  - atau ubah tabel auth menjadi `user` dan set `protected $table = 'user';` pada model `User`.

## 2. Daftar Tabel

- `user`
- `faq`
- `contact`
- `count`
- `recruitment`
- `status`
- `blog`
- `blog_image`
- `category`
- `branch`
- `branch_structure`
- `division`
- `greeting`
- `organization`
- `milestone`

## 3. Base Column

ERD menampilkan `basemodel` sebagai kumpulan kolom standar. Pada Laravel, kolom ini sudah cocok dengan trait `BaseModelSoftDeleteDefault`.

Kolom bawaan dari `$this->base($table);`:

| Kolom | Tipe | Null | Keterangan |
| --- | --- | --- | --- |
| active | boolean | no | status data aktif, default `true` |
| created_by | bigint unsigned | no | id user pembuat data, default `1` |
| updated_by | bigint unsigned | yes | id user terakhir yang mengubah data |
| deleted_by | bigint unsigned | yes | id user yang menghapus data secara soft delete |
| created_at | timestamp | yes | bawaan Laravel |
| updated_at | timestamp | yes | bawaan Laravel |
| deleted_at | timestamp | yes | kolom soft delete |

Contoh pola migration:

```php
return new class extends Migration
{
    use BaseModelSoftDeleteDefault;

    public function up(): void
    {
        Schema::create('nama_table', function (Blueprint $table) {
            $table->id();
            // kolom utama table
            $this->base($table);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nama_table');
    }
};
```

## 4. Detail Tabel

### 4.1 user

Fungsi:
Menyimpan akun pengguna aplikasi untuk login admin atau pengelola website.

Kolom berdasarkan ERD:

| Kolom | Tipe | Null | Keterangan |
| --- | --- | --- | --- |
| id | bigint unsigned | no | primary key |
| name | varchar(128) | no | nama user |
| branch_id | bigint unsigned | yes | foreign key ke `branch.id`, opsional |
| email | varchar(128) | no | email user, unik |
| password | varchar(255) | no | password hash |

Catatan:
Jika memakai Laravel auth bawaan, tabel default bernama `users` dan biasanya memiliki kolom tambahan seperti `email_verified_at`, `remember_token`, `created_at`, dan `updated_at`.

Contoh migration jika mengikuti nama ERD `user`:

```php
Schema::create('user', function (Blueprint $table) {
    $table->id();
    $table->string('name', 128);
    $table->foreignId('branch_id')->nullable()->constrained('branch');
    $table->string('email', 128)->unique();
    $table->string('password');
    $table->rememberToken();
    $table->timestamps();
});
```

### 4.2 faq

Fungsi:
Menyimpan daftar pertanyaan dan jawaban yang sering ditanyakan pada website.

Kolom:

| Kolom | Tipe | Null | Keterangan |
| --- | --- | --- | --- |
| id | bigint unsigned | no | primary key |
| question | varchar(255) | no | pertanyaan |
| answer | varchar(255) | no | jawaban singkat |
| active | boolean | no | status data aktif |
| created_by | bigint unsigned | no | user pembuat data |
| updated_by | bigint unsigned | yes | user terakhir yang mengubah data |
| deleted_by | bigint unsigned | yes | user yang menghapus data |
| created_at | timestamp | yes | bawaan Laravel |
| updated_at | timestamp | yes | bawaan Laravel |
| deleted_at | timestamp | yes | soft delete |

Contoh migration:

```php
Schema::create('faq', function (Blueprint $table) {
    $table->id();
    $table->string('question');
    $table->string('answer');
    $this->base($table);
});
```

### 4.3 count

Fungsi:
Menyimpan angka statistik singkat untuk ditampilkan pada website, misalnya jumlah anggota, program, atau pencapaian.

Kolom:

| Kolom | Tipe | Null | Keterangan |
| --- | --- | --- | --- |
| id | bigint unsigned | no | primary key |
| name | varchar(32) | no | nama statistik |
| digit | varchar(10) | no | nilai angka/statistik |
| active | boolean | no | status data aktif |
| created_by | bigint unsigned | no | user pembuat data |
| updated_by | bigint unsigned | yes | user terakhir yang mengubah data |
| deleted_by | bigint unsigned | yes | user yang menghapus data |
| created_at | timestamp | yes | bawaan Laravel |
| updated_at | timestamp | yes | bawaan Laravel |
| deleted_at | timestamp | yes | soft delete |

Contoh migration:

```php
Schema::create('count', function (Blueprint $table) {
    $table->id();
    $table->string('name', 32);
    $table->string('digit', 10);
    $this->base($table);
});
```

### 4.3.1 contact

Fungsi:
Menyimpan pesan yang dikirim pengunjung melalui form kontak publik.

Kolom:

| Kolom | Tipe | Null | Keterangan |
| --- | --- | --- | --- |
| id | bigint unsigned | no | primary key |
| name | varchar(128) | no | nama lengkap pengirim |
| email | varchar(128) | no | email pengirim |
| subject | varchar(255) | no | subjek pesan |
| message | text | no | isi pesan |
| active | boolean | no | status data aktif |
| created_by | bigint unsigned | no | user pembuat data atau fallback audit |
| updated_by | bigint unsigned | yes | user terakhir yang mengubah data |
| deleted_by | bigint unsigned | yes | user yang menghapus data |
| created_at | timestamp | yes | bawaan Laravel |
| updated_at | timestamp | yes | bawaan Laravel |
| deleted_at | timestamp | yes | soft delete |

Contoh migration:

```php
Schema::create('contact', function (Blueprint $table) {
    $table->id();
    $table->string('name', 128);
    $table->string('email', 128);
    $table->string('subject');
    $table->text('message');
    $this->base($table);
});
```

### 4.4 status

Fungsi:
Menyimpan status proses recruitment, misalnya pending, accepted, rejected, atau status lain sesuai kebutuhan.

Kolom:

| Kolom | Tipe | Null | Keterangan |
| --- | --- | --- | --- |
| id | bigint unsigned | no | primary key |
| name | varchar(128) | no | nama status |
| description | text | no | deskripsi status |
| active | boolean | no | status data aktif |
| created_by | bigint unsigned | no | user pembuat data |
| updated_by | bigint unsigned | yes | user terakhir yang mengubah data |
| deleted_by | bigint unsigned | yes | user yang menghapus data |
| created_at | timestamp | yes | bawaan Laravel |
| updated_at | timestamp | yes | bawaan Laravel |
| deleted_at | timestamp | yes | soft delete |

Contoh migration:

```php
Schema::create('status', function (Blueprint $table) {
    $table->id();
    $table->string('name', 128);
    $table->text('description');
    $this->base($table);
});
```

### 4.5 recruitment

Fungsi:
Menyimpan data pendaftaran calon pengurus atau anggota HIMSI.

Kolom:

| Kolom | Tipe | Null | Keterangan |
| --- | --- | --- | --- |
| id | bigint unsigned | no | primary key |
| nim | varchar(10) | no | NIM pendaftar |
| name | varchar(128) | no | nama pendaftar |
| semester | varchar(16) | no | semester pendaftar |
| ektm | varchar(128) | no | path/file e-KTM |
| email | varchar(128) | no | email pendaftar |
| instagram | varchar(128) | no | akun Instagram |
| no_wa | varchar(16) | no | nomor WhatsApp |
| description | text | no | deskripsi atau motivasi pendaftar |
| branch_id | bigint unsigned | no | foreign key ke `branch.id` |
| follow_dpc | varchar(128) | no | bukti/status mengikuti DPC |
| cv | varchar(128) | yes | path/file CV |
| status_id | bigint unsigned | no | foreign key ke `status.id` |
| active | boolean | no | status data aktif |
| created_by | bigint unsigned | no | user pembuat data |
| updated_by | bigint unsigned | yes | user terakhir yang mengubah data |
| deleted_by | bigint unsigned | yes | user yang menghapus data |
| created_at | timestamp | yes | bawaan Laravel |
| updated_at | timestamp | yes | bawaan Laravel |
| deleted_at | timestamp | yes | soft delete |

Contoh migration:

```php
Schema::create('recruitment', function (Blueprint $table) {
    $table->id();
    $table->string('nim', 10);
    $table->string('name', 128);
    $table->string('semester', 16);
    $table->string('ektm', 128);
    $table->string('email', 128);
    $table->string('instagram', 128);
    $table->string('no_wa', 16);
    $table->text('description');
    $table->foreignId('branch_id')->constrained('branch');
    $table->string('follow_dpc', 128);
    $table->string('cv', 128)->nullable();
    $table->foreignId('status_id')->constrained('status');
    $this->base($table);
});
```

### 4.6 category

Fungsi:
Menyimpan kategori artikel/blog website.

Kolom:

| Kolom | Tipe | Null | Keterangan |
| --- | --- | --- | --- |
| id | bigint unsigned | no | primary key |
| name | varchar(128) | no | nama kategori |
| description | text | yes | deskripsi kategori |
| active | boolean | no | status data aktif |
| created_by | bigint unsigned | no | user pembuat data |
| updated_by | bigint unsigned | yes | user terakhir yang mengubah data |
| deleted_by | bigint unsigned | yes | user yang menghapus data |
| created_at | timestamp | yes | bawaan Laravel |
| updated_at | timestamp | yes | bawaan Laravel |
| deleted_at | timestamp | yes | soft delete |

Contoh migration:

```php
Schema::create('category', function (Blueprint $table) {
    $table->id();
    $table->string('name', 128);
    $table->text('description')->nullable();
    $this->base($table);
});
```

### 4.7 blog

Fungsi:
Menyimpan artikel, berita, atau konten publikasi website HIMSI.

Kolom:

| Kolom | Tipe | Null | Keterangan |
| --- | --- | --- | --- |
| id | bigint unsigned | no | primary key |
| branch_id | bigint unsigned | no | foreign key ke `branch.id` |
| title | varchar(128) | no | judul blog |
| slug | varchar(128) | no | slug unik untuk URL |
| thumbnail | varchar(255) | no | path gambar utama |
| quotes | varchar(255) | yes | kutipan singkat |
| body | text | no | isi konten blog |
| category_id | bigint unsigned | no | foreign key ke `category.id` |
| active | boolean | no | status data aktif |
| created_by | bigint unsigned | no | user pembuat data |
| updated_by | bigint unsigned | yes | user terakhir yang mengubah data |
| deleted_by | bigint unsigned | yes | user yang menghapus data |
| created_at | timestamp | yes | bawaan Laravel |
| updated_at | timestamp | yes | bawaan Laravel |
| deleted_at | timestamp | yes | soft delete |

Contoh migration:

```php
Schema::create('blog', function (Blueprint $table) {
    $table->id();
    $table->foreignId('branch_id')->constrained('branch');
    $table->string('title', 128);
    $table->string('slug', 128)->unique();
    $table->string('thumbnail');
    $table->string('quotes')->nullable();
    $table->text('body');
    $table->foreignId('category_id')->constrained('category');
    $this->base($table);
});
```

### 4.8 blog_image

Fungsi:
Menyimpan gambar tambahan untuk blog.

Kolom:

| Kolom | Tipe | Null | Keterangan |
| --- | --- | --- | --- |
| id | bigint unsigned | no | primary key |
| blog_id | bigint unsigned | no | foreign key ke `blog.id` |
| image | varchar(255) | no | path gambar |
| description | varchar(255) | no | deskripsi gambar |
| active | boolean | no | status data aktif |
| created_by | bigint unsigned | no | user pembuat data |
| updated_by | bigint unsigned | yes | user terakhir yang mengubah data |
| deleted_by | bigint unsigned | yes | user yang menghapus data |
| created_at | timestamp | yes | bawaan Laravel |
| updated_at | timestamp | yes | bawaan Laravel |
| deleted_at | timestamp | yes | soft delete |

Contoh migration:

```php
Schema::create('blog_image', function (Blueprint $table) {
    $table->id();
    $table->foreignId('blog_id')->constrained('blog')->cascadeOnDelete();
    $table->string('image');
    $table->string('description');
    $this->base($table);
});
```

### 4.9 branch

Fungsi:
Menyimpan data cabang atau DPC HIMSI, termasuk lokasi dan media sosial.

Kolom:

| Kolom | Tipe | Null | Keterangan |
| --- | --- | --- | --- |
| id | bigint unsigned | no | primary key |
| name | varchar(128) | no | nama branch |
| location | varchar(128) | no | lokasi branch |
| thumbnail | varchar(128) | no | path thumbnail branch |
| description | text | no | deskripsi branch |
| grup_wa | varchar(128) | no | link atau nomor grup WhatsApp |
| sektor | varchar(128) | no | sektor/wilayah branch |
| sosial_media | json | no | daftar media sosial branch dalam format key-value fixed |
| is_dpp | boolean | no | penanda branch DPP |
| active | boolean | no | status data aktif |
| created_by | bigint unsigned | no | user pembuat data |
| updated_by | bigint unsigned | yes | user terakhir yang mengubah data |
| deleted_by | bigint unsigned | yes | user yang menghapus data |
| created_at | timestamp | yes | bawaan Laravel |
| updated_at | timestamp | yes | bawaan Laravel |
| deleted_at | timestamp | yes | soft delete |

Contoh migration:

```php
Schema::create('branch', function (Blueprint $table) {
    $table->id();
    $table->string('name', 128);
    $table->string('location', 128);
    $table->string('thumbnail', 128);
    $table->text('description');
    $table->string('grup_wa', 128);
    $table->string('sektor', 128);
    $table->json('sosial_media');
    $table->boolean('is_dpp')->default(false);
    $this->base($table);
});
```

Format `sosial_media` branch:

```php
[
    'instagram' => 'https://instagram.com/dpccontoh',
    'website' => '',
    'youtube' => '',
    'linkedin' => '',
    'tiktok' => '',
    'facebook' => '',
    'wa' => 'https://chat.whatsapp.com/...',
]
```

Catatan:

- Key sosial media dibuat fixed dari Filament form.
- Value kosong boleh disimpan sementara saat input, tetapi sebaiknya dibuang sebelum save atau difilter sebelum tampil di FE.
- FE hanya menampilkan item yang value link-nya terisi.

### 4.10 division

Fungsi:
Menyimpan data divisi organisasi dan deskripsi pekerjaan divisi.

Kolom:

| Kolom | Tipe | Null | Keterangan |
| --- | --- | --- | --- |
| id | bigint unsigned | no | primary key |
| name | varchar(128) | no | nama divisi |
| logo | varchar(128) | no | path logo divisi |
| image | varchar(128) | no | path gambar divisi |
| description | text | no | deskripsi divisi |
| job_description | json | no | daftar tugas divisi |
| is_dpp | boolean | no | penanda divisi DPP |
| active | boolean | no | status data aktif |
| created_by | bigint unsigned | no | user pembuat data |
| updated_by | bigint unsigned | yes | user terakhir yang mengubah data |
| deleted_by | bigint unsigned | yes | user yang menghapus data |
| created_at | timestamp | yes | bawaan Laravel |
| updated_at | timestamp | yes | bawaan Laravel |
| deleted_at | timestamp | yes | soft delete |

Contoh migration:

```php
Schema::create('division', function (Blueprint $table) {
    $table->id();
    $table->string('name', 128);
    $table->string('logo', 128);
    $table->string('image', 128);
    $table->text('description');
    $table->json('job_description');
    $table->boolean('is_dpp')->default(false);
    $this->base($table);
});
```

### 4.11 branch_structure

Fungsi:
Menyimpan struktur kepengurusan pada setiap branch.

Kolom:

| Kolom | Tipe | Null | Keterangan |
| --- | --- | --- | --- |
| id | bigint unsigned | no | primary key |
| branch_id | bigint unsigned | no | foreign key ke `branch.id` |
| name | varchar(128) | no | nama pengurus |
| division_id | bigint unsigned | yes | foreign key ke `division.id`, opsional |
| sort | integer unsigned | no | urutan tampil struktur pengurus |
| position | varchar(128) | no | jabatan pengurus |
| image | varchar(255) | no | path foto pengurus |
| no_wa | varchar(18) | no | nomor WhatsApp pengurus |
| active | boolean | no | status data aktif |
| created_by | bigint unsigned | no | user pembuat data |
| updated_by | bigint unsigned | yes | user terakhir yang mengubah data |
| deleted_by | bigint unsigned | yes | user yang menghapus data |
| created_at | timestamp | yes | bawaan Laravel |
| updated_at | timestamp | yes | bawaan Laravel |
| deleted_at | timestamp | yes | soft delete |

Contoh migration:

```php
Schema::create('branch_structure', function (Blueprint $table) {
    $table->id();
    $table->foreignId('branch_id')->constrained('branch');
    $table->string('name', 128);
    $table->foreignId('division_id')->nullable()->constrained('division');
    $table->unsignedInteger('sort')->default(0);
    $table->string('position', 128);
    $table->string('image');
    $table->string('no_wa', 18);
    $this->base($table);
});
```

### 4.12 greeting

Fungsi:
Menyimpan sambutan atau pesan dari pengurus.

Kolom:

| Kolom | Tipe | Null | Keterangan |
| --- | --- | --- | --- |
| id | bigint unsigned | no | primary key |
| name | varchar(128) | no | nama pemberi sambutan |
| position | varchar(128) | no | jabatan pemberi sambutan |
| body | text | no | isi sambutan |
| image | varchar(255) | no | path foto |
| active | boolean | no | status data aktif |
| created_by | bigint unsigned | no | user pembuat data |
| updated_by | bigint unsigned | yes | user terakhir yang mengubah data |
| deleted_by | bigint unsigned | yes | user yang menghapus data |
| created_at | timestamp | yes | bawaan Laravel |
| updated_at | timestamp | yes | bawaan Laravel |
| deleted_at | timestamp | yes | soft delete |

Contoh migration:

```php
Schema::create('greeting', function (Blueprint $table) {
    $table->id();
    $table->string('name', 128);
    $table->string('position', 128);
    $table->text('body');
    $table->string('image');
    $this->base($table);
});
```

### 4.13 organization

Fungsi:
Menyimpan profil organisasi HIMSI secara umum.

Kolom:

| Kolom | Tipe | Null | Keterangan |
| --- | --- | --- | --- |
| id | bigint unsigned | no | primary key |
| name | varchar(255) | no | nama organisasi |
| kode_org | varchar(128) | no | kode organisasi |
| logo | varchar(128) | no | path logo organisasi |
| thumbnail | varchar(255) | no | path thumbnail organisasi |
| description | text | no | deskripsi organisasi |
| mision | json | no | daftar misi organisasi |
| vision | varchar(255) | no | visi organisasi |
| purpose | text | no | tujuan organisasi |
| address | varchar(255) | no | alamat organisasi |
| sosial_media | json | no | daftar media sosial organisasi dalam format key-value fixed |
| email | varchar(128) | no | email organisasi |
| no_tlpn | varchar(18) | no | nomor telepon organisasi |
| active | boolean | no | status data aktif |
| created_by | bigint unsigned | no | user pembuat data |
| updated_by | bigint unsigned | yes | user terakhir yang mengubah data |
| deleted_by | bigint unsigned | yes | user yang menghapus data |
| created_at | timestamp | yes | bawaan Laravel |
| updated_at | timestamp | yes | bawaan Laravel |
| deleted_at | timestamp | yes | soft delete |

Contoh migration:

```php
Schema::create('organization', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('kode_org', 128);
    $table->string('logo', 128);
    $table->string('thumbnail');
    $table->text('description');
    $table->json('mision');
    $table->string('vision');
    $table->text('purpose');
    $table->string('address');
    $table->json('sosial_media');
    $table->string('email', 128);
    $table->string('no_tlpn', 18);
    $this->base($table);
});
```

Format `sosial_media` organisasi:

```php
[
    'instagram' => 'https://instagram.com/himsi.ubsi',
    'website' => 'https://himsi.test',
    'youtube' => 'https://youtube.com/@himsiubsi',
    'linkedin' => 'https://linkedin.com/company/himsiubsi',
    'tiktok' => 'https://tiktok.com/@himsiubsi',
    'facebook' => 'https://facebook.com/himsiubsi',
    'wa' => 'https://wa.me/6281234567890',
    'email' => 'info@himsi.org',
]
```

Catatan:

- Key sosial media dibuat fixed dari Filament form.
- FE hanya menampilkan item yang value link-nya terisi.

Catatan:
Nama kolom pada ERD tertulis `mision`. Jika ingin memakai ejaan bahasa Inggris yang umum, bisa dipertimbangkan menjadi `mission`, tetapi dokumentasi ini tetap mengikuti ERD.

### 4.14 milestone

Fungsi:
Menyimpan perjalanan atau linimasa organisasi.

Kolom:

| Kolom | Tipe | Null | Keterangan |
| --- | --- | --- | --- |
| id | bigint unsigned | no | primary key |
| sort | integer | no | urutan tampil milestone |
| year | date | no | tahun atau tanggal milestone |
| list | json | no | daftar poin milestone |
| active | boolean | no | status data aktif |
| created_by | bigint unsigned | no | user pembuat data |
| updated_by | bigint unsigned | yes | user terakhir yang mengubah data |
| deleted_by | bigint unsigned | yes | user yang menghapus data |
| created_at | timestamp | yes | bawaan Laravel |
| updated_at | timestamp | yes | bawaan Laravel |
| deleted_at | timestamp | yes | soft delete |

Contoh migration:

```php
Schema::create('milestone', function (Blueprint $table) {
    $table->id();
    $table->integer('sort');
    $table->date('year');
    $table->json('list');
    $this->base($table);
});
```

## 5. Relasi Antar Tabel

Relasi utama berdasarkan ERD:

- `user.branch_id` -> `branch.id`
- `recruitment.branch_id` -> `branch.id`
- `recruitment.status_id` -> `status.id`
- `blog.branch_id` -> `branch.id`
- `blog.category_id` -> `category.id`
- `blog_image.blog_id` -> `blog.id`
- `branch_structure.branch_id` -> `branch.id`
- `branch_structure.division_id` -> `division.id`

Secara konsep:

```text
branch (1) ----< (n) user
branch (1) ----< (n) recruitment
status (1) ----< (n) recruitment
branch (1) ----< (n) blog
category (1) ----< (n) blog
blog (1) ----< (n) blog_image
branch (1) ----< (n) branch_structure
division (1) ----< (n) branch_structure
```

Kolom audit `created_by`, `updated_by`, dan `deleted_by` secara konsep mengarah ke user login, tetapi trait `BaseModelSoftDeleteDefault` membuatnya sebagai `unsignedBigInteger`, bukan `foreignId()->constrained(...)`.

## 6. Rekomendasi Migration Order

Urutan migration yang direkomendasikan:

1. migration auth `user` atau `users`
2. `create_branch_table`
3. `create_division_table`
4. `create_status_table`
5. `create_category_table`
6. `create_faq_table`
7. `create_contact_table`
8. `create_count_table`
9. `create_greeting_table`
10. `create_organization_table`
11. `create_milestone_table`
12. `create_recruitment_table`
13. `create_blog_table`
14. `create_blog_image_table`
15. `create_branch_structure_table`

Alasan:
Tabel seperti `recruitment`, `blog`, `blog_image`, `branch_structure`, dan `user` memiliki foreign key sehingga tabel referensinya perlu dibuat lebih dahulu.

Catatan:
Jika `user.branch_id` dibuat sebagai foreign key langsung, migration `branch` harus tersedia sebelum tabel `user`. Jika ingin mempertahankan migration `users` bawaan Laravel di awal, tambahkan `branch_id` ke `users` lewat migration terpisah setelah `branch` dibuat.

## 7. Rekomendasi Index dan Constraint

### 7.1 Unique

- `user.email` atau `users.email`
- `blog.slug`
- `category.name` jika kategori tidak boleh duplikat
- `status.name` jika status tidak boleh duplikat

### 7.2 Index

- `user.branch_id`
- `recruitment.branch_id`
- `recruitment.status_id`
- `recruitment.email`
- `recruitment.nim`
- `contact.email`
- `blog.branch_id`
- `blog.category_id`
- `blog.slug`
- `blog_image.blog_id`
- `branch_structure.branch_id`
- `branch_structure.division_id`
- `branch.is_dpp`
- `division.is_dpp`
- `milestone.sort`
- `created_by`
- `updated_by`
- `deleted_by`

Contoh tambahan index:

```php
$table->index('slug');
$table->index(['branch_id', 'category_id']);
$table->index('sort');
```

## 8. Contoh Model Eloquent

Setiap model domain memakai `AuditedBySoftDelete`, `HasFactory`, dan `SoftDeletes`. Model tidak perlu `$fillable`; gunakan `protected $guarded = ['id'];`.

Template dasar model:

```php
namespace App\Models;

use App\Traits\AuditedBySoftDelete;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NamaModel extends Model
{
    use AuditedBySoftDelete, HasFactory, SoftDeletes;

    protected $table = 'nama_table';

    protected $guarded = ['id'];
}
```

### 8.1 User

Jika tabel auth mengikuti ERD `user`, model `User` perlu diberi nama tabel eksplisit.

```php
namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $table = 'user';

    protected $guarded = ['id'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
```

Jika tetap memakai tabel Laravel bawaan `users`, jangan tambahkan `protected $table = 'user';`.

### 8.2 Blog

```php
namespace App\Models;

use App\Traits\AuditedBySoftDelete;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use AuditedBySoftDelete, HasFactory, SoftDeletes;

    protected $table = 'blog';

    protected $guarded = ['id'];

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(BlogImage::class, 'blog_id');
    }
}
```

### 8.3 Branch

```php
namespace App\Models;

use App\Traits\AuditedBySoftDelete;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use AuditedBySoftDelete, HasFactory, SoftDeletes;

    protected $table = 'branch';

    protected $guarded = ['id'];

    protected $casts = [
        'sosial_media' => 'array',
        'is_dpp' => 'boolean',
    ];

    public function blogs(): HasMany
    {
        return $this->hasMany(Blog::class, 'branch_id');
    }

    public function recruitments(): HasMany
    {
        return $this->hasMany(Recruitment::class, 'branch_id');
    }

    public function structures(): HasMany
    {
        return $this->hasMany(BranchStructure::class, 'branch_id');
    }
}
```

### 8.4 Recruitment

```php
namespace App\Models;

use App\Traits\AuditedBySoftDelete;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recruitment extends Model
{
    use AuditedBySoftDelete, HasFactory, SoftDeletes;

    protected $table = 'recruitment';

    protected $guarded = ['id'];

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
}
```

### 8.5 BranchStructure

```php
namespace App\Models;

use App\Traits\AuditedBySoftDelete;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BranchStructure extends Model
{
    use AuditedBySoftDelete, HasFactory, SoftDeletes;

    protected $table = 'branch_structure';

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'sort' => 'integer',
        ];
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class, 'division_id');
    }
}
```

## 9. Catatan Teknis Penting

- `basemodel` pada ERD sebaiknya tidak dibuat sebagai tabel, cukup direpresentasikan sebagai trait migration.
- Semua migration domain perlu menambahkan `use BaseModelSoftDeleteDefault;`.
- Semua tabel domain perlu memanggil `$this->base($table);` sebelum penutup schema.
- Karena `$this->base($table);` sudah menambahkan `timestamps()` dan `softDeletes()`, migration domain tidak perlu memanggil `$table->timestamps();` lagi.
- Karena model memakai `SoftDeletes`, query Eloquent otomatis tidak mengambil data yang sudah soft delete.
- Trait `AuditedBySoftDelete` akan mengisi `created_by`, `updated_by`, dan `deleted_by` berdasarkan user login, atau fallback ke user id `1`.
- Untuk upload `image`, `thumbnail`, `logo`, `ektm`, dan `cv`, simpan file di `storage/app/public`, lalu simpan path-nya ke database.
- Kolom JSON seperti `sosial_media`, `job_description`, `mision`, dan `list` sebaiknya diberi cast `array` pada model.
- Hindari menjalankan `migrate:fresh` atau `db:wipe` pada database lokal yang berisi data kerja tanpa backup.

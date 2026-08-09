# Requirement Filament Resource Web HIMSI

## 1. Tujuan

Dokumen ini menjadi acuan pembuatan resource admin menggunakan Filament untuk Website HIMSI.

Scope tahap ini:

- Generate resource memakai command artisan.
- Fokus pada resource, form, table, dan halaman detail jika dibutuhkan.
- Resource disesuaikan dengan struktur database pada `docs/database.md`.
- Resource memakai model domain dengan `SoftDeletes`, `AuditedBySoftDelete`, dan `protected $guarded = ['id'];`.
- Role dan permission admin memakai Spatie Permission.
- Semua label UI wajib memakai bahasa Indonesia.

Catatan:

- Filament menjadi panel admin utama untuk mengelola user, FAQ, pesan kontak, statistik, recruitment, status, blog, gambar blog, kategori, branch, struktur branch, divisi, greeting, organisasi, dan milestone.
- Tabel `admin` tidak dibuat. Admin panel memakai model `User`.
- Tabel auth memakai `users` bawaan Laravel, dengan tambahan `branch_id` sesuai strategi implementasi pada `docs/database.md`.
- Kolom audit `created_by`, `updated_by`, dan `deleted_by` berasal dari trait `BaseModelSoftDeleteDefault`.
- Role dan permission user tidak dibuat sebagai kolom manual, tetapi dikelola melalui Spatie Permission.

## 2. Model Resource

Model yang dibuatkan resource:

- `User`
- `Faq`
- `Contact`
- `Count`
- `Recruitment`
- `Status`
- `Blog`
- `BlogImage`
- `Category`
- `Branch`
- `BranchStructure`
- `Division`
- `Greeting`
- `Organization`
- `Milestone`

Catatan:

- `UserResource` dipakai untuk mengelola akun panel Filament.
- Semua resource domain selain `User` mengikuti pola soft delete dan audit user.
- Model domain wajib menulis `protected $table` eksplisit karena nama tabel mengikuti ERD dan tidak dipaksa plural.

## 3. Dependency

Package yang dibutuhkan:

```bash
composer require filament/filament
composer require spatie/laravel-permission
```

Setelah dependency terpasang:

- Buat panel admin Filament.
- Publish migration dan config Spatie Permission sesuai dokumentasi package.
- Tambahkan trait `HasRoles` pada model `User`.
- Jangan menambah kolom `level`, `role`, atau `permission` pada tabel `users`.

## 4. Command Generate Resource

Command resource mengikuti preferensi:

- Pakai `php artisan make:filament-resource`.
- Pakai `--generate`.
- Pakai `--soft-deletes` untuk resource domain yang memakai soft delete.

Daftar command:

```bash
php artisan make:filament-resource User --generate
php artisan make:filament-resource Faq --generate --soft-deletes
php artisan make:filament-resource Contact --generate --soft-deletes
php artisan make:filament-resource Count --generate --soft-deletes
php artisan make:filament-resource Recruitment --generate --soft-deletes
php artisan make:filament-resource Status --generate --soft-deletes
php artisan make:filament-resource Blog --generate --soft-deletes
php artisan make:filament-resource BlogImage --generate --soft-deletes
php artisan make:filament-resource Category --generate --soft-deletes
php artisan make:filament-resource Branch --generate --soft-deletes
php artisan make:filament-resource BranchStructure --generate --soft-deletes
php artisan make:filament-resource Division --generate --soft-deletes
php artisan make:filament-resource Greeting --generate --soft-deletes
php artisan make:filament-resource Organization --generate --soft-deletes
php artisan make:filament-resource Milestone --generate --soft-deletes
```

Catatan:

- `UserResource` tidak memakai `--soft-deletes` selama tabel `users` bawaan belum memakai soft delete.
- Resource domain memakai `--soft-deletes` karena tabel domain memakai `$this->base($table);`.

## 5. Standar Struktur Resource

Resource dirapikan dengan pola modular:

```php
<?php

namespace App\Filament\Resources\Blog;

use App\Filament\Resources\Blog\Pages\CreateBlog;
use App\Filament\Resources\Blog\Pages\EditBlog;
use App\Filament\Resources\Blog\Pages\ListBlogs;
use App\Filament\Resources\Blog\Pages\ViewBlog;
use App\Filament\Resources\Blog\Schemas\BlogForm;
use App\Filament\Resources\Blog\Schemas\BlogInfolist;
use App\Filament\Resources\Blog\Tables\BlogsTable;
use App\Models\Blog;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class BlogResource extends Resource
{
    protected static ?string $model = Blog::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-newspaper';

    protected static string|UnitEnum|null $navigationGroup = 'Konten';

    protected static ?string $navigationLabel = 'Blog';

    protected static ?string $modelLabel = 'Blog';

    protected static ?string $pluralModelLabel = 'Blog';

    public static function form(Schema $schema): Schema
    {
        return BlogForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return BlogInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BlogsTable::configure($table);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBlogs::route('/'),
            'create' => CreateBlog::route('/create'),
            'view' => ViewBlog::route('/{record}'),
            'edit' => EditBlog::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
```

## 6. Properti Resource

Semua resource wajib memiliki properti:

```php
protected static ?string $model = ModelName::class;

protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-document-text';

protected static string|UnitEnum|null $navigationGroup = 'Nama Group';

protected static ?string $navigationLabel = 'Label';

protected static ?string $modelLabel = 'Label';

protected static ?string $pluralModelLabel = 'Label';
```

Ketentuan:

- Label wajib bahasa Indonesia.
- Nama model tetap PascalCase.
- Nama tabel tetap mengikuti `docs/database.md`, misalnya `blog`, `blog_image`, `branch`, dan `branch_structure`.

## 7. Standar Page

Page default untuk resource domain:

- `List`
- `Create`
- `View`
- `Edit`

Pengecualian:

- `UserResource` boleh memakai `List`, `Create`, dan `Edit`.
- Halaman detail memakai `Infolist`.
- `BlogImage` tidak memakai resource mandiri di sidebar; data gambar blog dikelola lewat relation manager pada `BlogResource`.
- `BranchStructureResource` boleh hanya memakai resource mandiri, atau dikelola lewat relation manager pada `BranchResource`.
- Form resource wajib memakai `Filament\Schemas\Components\Section` dan setiap section memakai `columnSpanFull()` agar input dikelompokkan per konteks, misalnya `Informasi Utama`, `Relasi`, `Media`, dan `Status`.
- Infolist resource wajib memakai `Filament\Schemas\Components\Section` dengan minimal section `Informasi Utama` dan `Audit Data`; setiap section juga memakai `columnSpanFull()`.
- Section `Audit Data` berisi `createdBy`, `created_at`, `updatedBy`, `updated_at`, `deletedBy`, dan `deleted_at` untuk resource domain yang memakai audit/soft delete.
- `OrganizationResource` tidak menampilkan table karena data organisasi hanya satu record. Saat menu `Organisasi` dibuka, halaman index harus langsung mengarah ke halaman detail/infolist record organisasi pertama. Resource ini hanya membutuhkan halaman `view` dan `edit`; halaman `create` hanya dipakai sebagai fallback jika data organisasi belum tersedia.

## 8. Navigation Group

| Resource | Group |
| --- | --- |
| `User` | `Pengguna` |
| `Faq` | `Konten` |
| `Count` | `Konten` |
| `Blog` | `Konten` |
| `Category` | `Master Data` |
| `Status` | `Master Data` |
| `Recruitment` | `Recruitment` |
| `Branch` | `Organisasi` |
| `BranchStructure` | `Organisasi` |
| `Division` | `Organisasi` |
| `Greeting` | `Profil` |
| `Organization` | `Profil` |
| `Milestone` | `Profil` |

## 9. Label dan Icon Resource

| Model | Navigation Label | Model Label | Plural Model Label | Navigation Group | Icon |
| --- | --- | --- | --- | --- | --- |
| `User` | `Pengguna` | `Pengguna` | `Pengguna` | `Pengguna` | `heroicon-o-users` |
| `Faq` | `FAQ` | `FAQ` | `FAQ` | `Konten` | `heroicon-o-question-mark-circle` |
| `Count` | `Statistik` | `Statistik` | `Statistik` | `Konten` | `heroicon-o-chart-bar` |
| `Recruitment` | `Recruitment` | `Recruitment` | `Recruitment` | `Recruitment` | `heroicon-o-user-plus` |
| `Status` | `Status Recruitment` | `Status Recruitment` | `Status Recruitment` | `Master Data` | `heroicon-o-check-circle` |
| `Blog` | `Blog` | `Blog` | `Blog` | `Konten` | `heroicon-o-newspaper` |
| `Category` | `Kategori Blog` | `Kategori Blog` | `Kategori Blog` | `Master Data` | `heroicon-o-tag` |
| `Branch` | `Branch` | `Branch` | `Branch` | `Organisasi` | `heroicon-o-building-office-2` |
| `BranchStructure` | `Struktur Cabang` | `Struktur Cabang` | `Struktur Cabang` | `Organisasi` | `heroicon-o-user-group` |
| `Division` | `Divisi` | `Divisi` | `Divisi` | `Organisasi` | `heroicon-o-squares-2x2` |
| `Greeting` | `Sambutan` | `Sambutan` | `Sambutan` | `Profil` | `heroicon-o-chat-bubble-left-right` |
| `Organization` | `Organisasi` | `Organisasi` | `Organisasi` | `Profil` | `heroicon-o-home-modern` |
| `Milestone` | `Milestone` | `Milestone` | `Milestone` | `Profil` | `heroicon-o-calendar-days` |

## 10. Standar Implementasi

Setelah command resource dijalankan:

- Rapikan resource class agar sesuai pola modular Filament.
- Sesuaikan `navigationGroup`, `navigationIcon`, `navigationLabel`, `modelLabel`, dan `pluralModelLabel`.
- Rapikan form schema.
- Rapikan table schema.
- Tambahkan infolist untuk halaman detail.
- Tambahkan kolom audit `createdBy`, `updatedBy`, dan `deletedBy` pada semua table resource domain.
- Aktifkan query tanpa `SoftDeletingScope` untuk resource domain.
- Pertahankan dukungan soft delete pada table action dan filter.
- Pastikan form tidak menginput manual `created_by`, `updated_by`, dan `deleted_by`.

Catatan:

- Audit user otomatis diisi oleh trait `AuditedBySoftDelete`.
- Kolom `active` boleh tampil di form sebagai toggle.
- Kolom `deleted_by` hanya relevan untuk data yang sudah soft delete.
- Field upload menyimpan path file sesuai rancangan database.

## 11. Kolom Audit Table

Semua table resource domain wajib menambahkan kolom:

```php
TextColumn::make('createdBy.name')
    ->label('Dibuat Oleh')
    ->badge()
    ->description(fn ($record) => $record->created_at?->format('d M Y H:i'))
    ->sortable(),

TextColumn::make('updatedBy.name')
    ->label('Diubah Oleh')
    ->badge()
    ->description(fn ($record) => $record->updated_at?->format('d M Y H:i'))
    ->sortable()
    ->toggleable(isToggledHiddenByDefault: true),

TextColumn::make('deletedBy.name')
    ->label('Dihapus Oleh')
    ->badge()
    ->description(fn ($record) => $record->deleted_at?->format('d M Y H:i'))
    ->sortable()
    ->toggleable(isToggledHiddenByDefault: true),
```

Ketentuan:

- `Dibuat Oleh` tampil default di table.
- `Diubah Oleh` dan `Dihapus Oleh` dibuat toggleable agar table tetap ringkas.
- Relasi audit berasal dari trait `AuditedBySoftDelete`.

## 12. Action dan Filter Table

Action resource domain:

- `ViewAction`
- `EditAction`
- `DeleteAction`
- `RestoreAction`
- `ForceDeleteAction`

Bulk action resource domain:

- `DeleteBulkAction`
- `RestoreBulkAction`
- `ForceDeleteBulkAction`

Filter:

- Filter `active`.
- Filter soft delete atau trashed.
- Filter `is_dpp` untuk `Branch` dan `Division`.
- Filter `branch_id` untuk `Recruitment`, `Blog`, dan `BranchStructure`.
- Filter `category_id` untuk `Blog`.
- Filter `status_id` untuk `Recruitment`.
- Filter `division_id` untuk `BranchStructure`.
- Filter tanggal untuk resource yang punya kolom tanggal seperti `Milestone.year`.

Catatan:

- `ForceDeleteAction` boleh disembunyikan dari role non-super-admin.
- `UserResource` tidak perlu action soft delete selama tabel `users` belum memakai soft delete.
- Tombol `ViewAction` pada table list dihilangkan untuk resource ringkas berikut: `Count`, `Faq`, `Category`, `Status`, `Milestone`, `Greeting`, dan `BlogImage`.

## 13. Standar Upload File

Field upload wajib memakai `FileUpload`.

Contoh konfigurasi:

```php
FileUpload::make('thumbnail')
    ->label('Thumbnail')
    ->image()
    ->disk('public')
    ->directory('blog')
    ->visibility('public')
    ->preserveFilenames()
    ->maxSize(2048);
```

Ketentuan:

- Gunakan `disk('public')` untuk semua upload gambar dan dokumen.
- Gunakan `directory()` sesuai nama tabel atau konteks resource.
- Database hanya menyimpan path file, bukan binary file.
- Jalankan `php artisan storage:link` agar file di disk public bisa diakses dari browser.

Mapping directory upload:

| Resource | Field | Disk | Directory |
| --- | --- | --- | --- |
| `RecruitmentResource` | `ektm` | `public` | `recruitment/ektm` |
| `RecruitmentResource` | `cv` | `public` | `recruitment/cv` |
| `BlogResource` | `thumbnail` | `public` | `blog/thumbnail` |
| `BlogResource` relation manager `Gambar Blog` | `image` | `public` | `blog/image` |
| `BranchResource` | `thumbnail` | `public` | `branch` |
| `BranchStructureResource` | `image` | `public` | `branch_structure` |
| `DivisionResource` | `logo` | `public` | `division/logo` |
| `DivisionResource` | `image` | `public` | `division/image` |
| `GreetingResource` | `image` | `public` | `greeting` |
| `OrganizationResource` | `logo` | `public` | `organization` |

## 14. Form Per Resource

### 14.1 User

Field:

- `name`
- `branch_id`
- `email`
- `password`
- role Spatie Permission

Catatan:

- `branch_id` memakai select relasi ke `Branch`.
- Password wajib saat create.
- Password saat edit opsional.
- Role user dikelola melalui Spatie Permission.
- Tidak perlu field `level`.
- Tidak perlu field `active` selama tabel `users` belum memakai base column.

### 14.2 Faq

Field:

- `question`
- `answer`
- `active`

Catatan:

- `question` memakai text input.
- `answer` boleh memakai textarea agar jawaban lebih nyaman diedit.

### 14.3 Count

Field:

- `name`
- `digit`
- `active`

Catatan:

- `name` maksimal 32 karakter.
- `digit` maksimal 10 karakter sesuai database.

### 14.4 Status

Field:

- `name`
- `description`
- `active`

Catatan:

- `name` wajib unik.
- `description` memakai textarea.

### 14.5 Category

Field:

- `name`
- `description`
- `active`

Catatan:

- `name` wajib unik.
- `description` opsional.

### 14.6 Recruitment

Field:

- `nim`
- `name`
- `semester`
- `ektm`
- `email`
- `instagram`
- `no_wa`
- `description`
- `branch_id`
- `follow_dpc`
- `cv`
- `status_id`
- `active`

Catatan:

- `branch_id` memakai select relasi ke `Branch`.
- `status_id` memakai select relasi ke `Status`.
- `ektm` dan `cv` memakai `FileUpload`.
- `ektm` dan `cv` wajib diisi pada form publik.
- `follow_dpc` berupa gambar dan otomatis dikonversi ke WebP.
- `ektm` menerima gambar atau PDF. Gambar dikonversi ke WebP, PDF tetap disimpan sebagai PDF.
- `cv` hanya menerima PDF.
- `no_wa` di table, infolist, dan export ditampilkan sebagai link WhatsApp `wa.me` dengan format nomor Indonesia `62`.
- Verifikasi recruitment dilakukan via bulk action dan mengubah `status_id` menjadi `2`, lalu mengirim email verifikasi.
- Export recruitment memakai action table dan berjalan langsung tanpa queue.
- Role id `3` hanya melihat data sesuai `branch_id`; role lain melihat semua data.
- `description` memakai textarea.

### 14.7 Blog

Field:

- `branch_id`
- `title`
- `slug`
- `thumbnail`
- `quotes`
- `body`
- `category_id`
- `active`

Catatan:

- `branch_id` memakai select relasi ke `Branch`.
- `category_id` memakai select relasi ke `Category`.
- `slug` wajib unik dan dapat dibuat otomatis dari `title`.
- `thumbnail` memakai `FileUpload`.
- `quotes` opsional.
- `body` memakai rich editor atau textarea besar.

### 14.8 BlogImage

Field:

- `blog_id`
- `image`
- `description`
- `active`

Catatan:

- `blog_id` memakai select relasi ke `Blog`.
- `image` memakai `FileUpload`.

### 14.9 Branch

Field:

- `name`
- `location`
- `thumbnail`
- `description`
- `grup_wa`
- `sektor`
- `sosial_media`
- `is_dpp`
- `active`

Catatan:

- `thumbnail` memakai `FileUpload`.
- `description` memakai rich editor.
- `sosial_media` memakai field fixed per platform dengan state path JSON seperti `sosial_media.instagram`, `sosial_media.website`, `sosial_media.youtube`, `sosial_media.linkedin`, `sosial_media.tiktok`, `sosial_media.facebook`, dan `sosial_media.wa`.
- Link kosong tidak perlu tampil di FE.
- `is_dpp` dan `active` memakai toggle.

### 14.10 Division

Field:

- `name`
- `logo`
- `image`
- `description`
- `job_description`
- `is_dpp`
- `active`

Catatan:

- `logo` dan `image` memakai `FileUpload`.
- `description` memakai rich editor.
- `job_description` memakai repeater karena bertipe JSON.

### 14.11 BranchStructure

Field:

- `branch_id`
- `name`
- `division_id`
- `position`
- `sort`
- `image`
- `no_wa`
- `active`

Catatan:

- `branch_id` memakai select relasi ke `Branch`.
- `division_id` memakai select relasi ke `Division` dan opsional.
- `position` memakai dropdown dari daftar posisi tetap.
- `sort` tidak tampil sebagai input. Nilainya otomatis diisi dari `position` melalui helper `BranchStructurePosition` dan event `saving` pada model.
- `image` memakai `FileUpload`.

Daftar posisi struktur cabang:

| Urutan | Posisi |
| --- | --- |
| 1 | Ketua |
| 2 | Wakil Ketua |
| 3 | Sekertaris 1 |
| 4 | Sekertaris 2 |
| 5 | Bendahara |
| 6 | Koor Div Pendidikan |
| 7 | Koor Div RSDM |
| 8 | Koor Div Litbang |
| 9 | Koor Div Kominfo |
| 10 | Koor Div Sosmas |
| 11 | Koor Div PSDM |

### 14.12 Greeting

Field:

- `name`
- `position`
- `body`
- `image`
- `active`

Catatan:

- `body` memakai textarea atau rich editor.
- `image` memakai `FileUpload`.

### 14.13 Organization

Field:

- `name`
- `kode_org`
- `logo`
- `thumbnail`
- `description`
- `mision`
- `vision`
- `purpose`
- `address`
- `sosial_media`
- `email`
- `no_tlpn`
- `active`

Catatan:

- `logo` memakai `FileUpload`.
- `thumbnail` memakai `FileUpload` atau URL/path gambar sesuai kebutuhan tampilan profil organisasi.
- `mision` tetap mengikuti nama kolom ERD.
- `mision` memakai repeater list dengan item `value`, sehingga data tersimpan sebagai array daftar misi.
- `sosial_media` memakai field fixed per platform dengan state path JSON seperti `sosial_media.instagram`, `sosial_media.website`, `sosial_media.youtube`, `sosial_media.linkedin`, `sosial_media.tiktok`, `sosial_media.facebook`, `sosial_media.wa`, dan `sosial_media.email`.
- Link kosong tidak perlu tampil di FE.
- `description` dan `purpose` memakai textarea.

### 14.14 Milestone

Field:

- `year`
- `list`
- `sort`
- `active`

Catatan:

- `sort` tidak tampil sebagai input form.
- Saat create, `sort` otomatis memakai nilai terbesar di database + 1.
- Urutan milestone diubah dari table dengan fitur drag reorder pada kolom `sort`.
- `year` memakai date picker.
- `list` memakai repeater dengan satu field `value`, tanpa input urutan di dalam repeater.

## 15. Table Per Resource

### 15.1 User

Kolom:

- `name`
- `branch.name`
- `email`
- role Spatie Permission
- `created_at`

### 15.2 Faq

Kolom:

- `question`
- `answer`
- `active`
- `createdBy`
- `updatedBy`

### 15.3 Count

Kolom:

- `name`
- `digit`
- `active`
- `createdBy`
- `updatedBy`

### 15.4 Status

Kolom:

- `name`
- `description`
- `active`
- `createdBy`
- `updatedBy`

### 15.5 Category

Kolom:

- `name`
- `description`
- `active`
- `createdBy`
- `updatedBy`

### 15.6 Recruitment

Kolom:

- `nim`
- `name`
- `email`
- `branch.name`
- `status.name`
- `active`
- `createdBy`
- `updatedBy`

### 15.7 Blog

Kolom:

- `title`
- `slug`
- `branch.name`
- `category.name`
- `thumbnail`
- `active`
- `createdBy`
- `updatedBy`

### 15.8 BlogImage

Kolom:

- `blog.title`
- `image`
- `description`
- `active`
- `createdBy`
- `updatedBy`

### 15.9 Branch

Kolom:

- `name`
- `location`
- `sektor`
- `is_dpp`
- `active`
- `createdBy`
- `updatedBy`

### 15.10 Division

Kolom:

- `name`
- `is_dpp`
- `active`
- `createdBy`
- `updatedBy`

### 15.11 BranchStructure

Kolom:

- `name`
- `branch.name`
- `division.name`
- `sort`
- `position`
- `no_wa`
- `active`
- `createdBy`
- `updatedBy`

### 15.12 Greeting

Kolom:

- `name`
- `position`
- `image`
- `active`
- `createdBy`
- `updatedBy`

### 15.13 Organization

Kolom:

- `name`
- `kode_org`
- `email`
- `no_tlpn`
- `active`
- `createdBy`
- `updatedBy`

### 15.14 Milestone

Kolom:

- `sort`
- `year`
- `active`
- `createdBy`
- `updatedBy`

Catatan:

- Table memakai `defaultSort('sort')` dan `reorderable('sort')`.

## 16. Infolist Per Resource

### 16.1 User

Tampilkan:

- nama
- branch
- email
- role
- tanggal dibuat

### 16.2 Faq

Tampilkan:

- pertanyaan
- jawaban
- status aktif
- audit data

### 16.3 Count

Tampilkan:

- nama statistik
- nilai statistik
- status aktif
- audit data

### 16.4 Recruitment

Tampilkan:

- NIM
- nama
- semester
- e-KTM
- email
- Instagram
- nomor WhatsApp
- deskripsi
- branch
- follow DPC
- CV
- status
- audit data

### 16.5 Status

Tampilkan:

- nama status
- deskripsi
- status aktif
- audit data

### 16.6 Blog

Tampilkan:

- branch
- judul
- slug
- thumbnail
- quotes
- isi blog
- kategori
- audit data

### 16.7 BlogImage

Tampilkan:

- blog
- gambar
- deskripsi
- audit data

### 16.8 Category

Tampilkan:

- nama kategori
- deskripsi
- audit data

### 16.9 Branch

Tampilkan:

- nama branch
- lokasi
- thumbnail
- deskripsi
- grup WhatsApp
- sektor
- sosial media
- status DPP
- audit data

### 16.10 BranchStructure

Tampilkan:

- branch
- nama pengurus
- divisi
- urutan
- posisi
- foto
- nomor WhatsApp
- audit data

### 16.11 Division

Tampilkan:

- nama divisi
- logo
- gambar
- deskripsi
- job description
- status DPP
- audit data

### 16.12 Greeting

Tampilkan:

- nama
- posisi
- isi sambutan
- gambar
- audit data

### 16.13 Organization

Tampilkan:

- nama organisasi
- kode organisasi
- logo
- deskripsi
- misi
- visi
- tujuan
- alamat
- sosial media
- email
- nomor telepon
- audit data

### 16.14 Milestone

Tampilkan:

- urutan
- tahun/tanggal
- daftar milestone
- audit data

## 17. Relation Manager

Relation manager yang disarankan:

- `BlogResource` memiliki relation manager untuk `BlogImage`.
- `BranchResource` memiliki relation manager `StructuresRelationManager` untuk mengelola `BranchStructure` dari halaman detail Branch.
- `BranchResource` dapat memiliki relation manager untuk `Blog`, `Recruitment`, dan `User`.
- `DivisionResource` dapat memiliki relation manager untuk `BranchStructure`.
- `CategoryResource` dapat memiliki relation manager untuk `Blog`.
- `StatusResource` dapat memiliki relation manager untuk `Recruitment`.

Catatan:

- Relation manager `Blog -> Gambar Blog` sudah dipakai sebagai pengganti resource mandiri `BlogImageResource`.
- Relation manager `Branch -> BranchStructure` memakai form section, infolist section, audit section, soft delete action/filter, dan tidak menginput manual `created_by`, `updated_by`, atau `deleted_by`.

## 17.1 Resource Organisasi Single Record

Ketentuan khusus `OrganizationResource`:

- Data organisasi dianggap single record.
- Menu `Organisasi` tidak menampilkan table/list.
- Route index `/admin/organizations` langsung redirect ke halaman view record organisasi pertama.
- Jika record organisasi belum ada, route index boleh redirect ke halaman create sebagai fallback.
- Halaman view/infolist menjadi halaman utama untuk membaca data organisasi.
- Halaman edit tetap tersedia untuk mengubah data organisasi.
- Seeder `OrganizationSeeder` wajib menyiapkan satu record awal agar halaman organisasi langsung bisa dibuka.

## 18. Catatan Khusus Repo

- Database mengikuti `docs/database.md`.
- Nama tabel domain tidak memakai akhiran `s`.
- Model domain wajib menulis `protected $table` eksplisit.
- Model domain memakai `protected $guarded = ['id'];`, bukan `$fillable`.
- Resource `User` mengarah ke tabel auth bawaan `users`, bukan `admin`.
- Permission panel dikelola Spatie Permission.
- Semua tabel domain memakai soft delete dari `$this->base($table);`.
- Semua resource domain harus mengaktifkan query tanpa `SoftDeletingScope` agar data trashed bisa dikelola dari Filament.
- Kolom `active` digunakan untuk status tampil atau tidak tampil pada halaman publik.
- Field upload wajib memakai `FileUpload`, disk `public`, dan `directory()` sesuai mapping.

## 19. Catatan Aman Testing dan Database

- Jangan menjalankan `migrate:fresh`, `migrate:fresh --seed`, atau `db:wipe` pada database lokal yang berisi data kerja tanpa backup.
- Jika ingin testing resource, gunakan database testing terpisah.
- Pastikan storage link sudah dibuat sebelum mengetes upload gambar.
- Pastikan user id `1` tersedia karena trait audit memiliki fallback ke user id `1`.
- Pastikan akun super admin dibuat lewat seeder sebelum panel dipakai.

## 20. Urutan Pengerjaan

Urutan implementasi resource:

1. Install Filament dan buat panel admin.
2. Install Spatie Permission dan pasang `HasRoles` pada model `User`.
3. Pastikan model dan migration sesuai `docs/database.md`.
4. Generate resource master data: `Category`, `Status`, `Branch`, dan `Division`.
5. Generate resource konten: `Faq`, `Count`, `Blog`, `BlogImage`, dan `Greeting`.
6. Generate resource organisasi: `BranchStructure`, `Organization`, dan `Milestone`.
7. Generate resource transaksi atau pendaftaran: `Recruitment`.
8. Generate dan rapikan `UserResource`.
9. Tambahkan policy atau permission gate sesuai role Spatie.

Alasan:

- Master data dan relasi dibuat lebih dulu.
- Konten dan organisasi bisa dikerjakan setelah relasi utama tersedia.
- User dan permission dirapikan setelah panel admin dan role tersedia.

# Konsep Integrasi Data Publik Website HIMSI

## 1. Tujuan

Dokumen ini menjelaskan konsep umum integrasi data dari database ke website publik HIMSI.

Dokumen dibuat agar bisa dipakai untuk:

- Home,
- Tentang Kami,
- Cabang,
- Blog / Artikel,
- Kontak,
- section Divisi,
- section FAQ,
- data publik lain yang nanti ditambahkan.

Tahap awal implementasi tetap fokus pada 5 halaman publik:

1. Home
2. Tentang Kami
3. Cabang
4. Blog / Artikel
5. Kontak

Catatan:

- Divisi tidak dibuat sebagai halaman sendiri. Divisi hanya menjadi section atau data pendukung.
- FAQ tidak dibuat sebagai halaman sendiri. FAQ hanya menjadi section di Home.
- Recruitment belum dibuat pada tahap awal, baik list maupun form.
- Kontak dibuat sebagai halaman informatif, bukan form pesan, karena database saat ini belum memiliki tabel pesan kontak.

## 2. Prinsip Umum

Semua data publik mengikuti prinsip:

- data dikelola dari Filament admin,
- frontend publik hanya membaca data yang `active = true`,
- data soft deleted tidak tampil,
- query database dilakukan di controller atau service,
- Blade hanya menerima data siap tampil,
- Blade tidak menulis query model langsung,
- URL gambar dan format tanggal disiapkan sebelum masuk Blade,
- halaman list memakai pagination jika data bisa bertambah banyak,
- halaman detail menampilkan 404 jika data tidak aktif atau tidak ditemukan,
- relasi yang tampil di halaman harus di-eager load.

## 3. Alur Integrasi

Alur umum:

```text
Route
-> Controller
-> Model Query
-> Data Mapper / Presenter
-> Blade Page
-> Blade Component
```

Tanggung jawab:

| Bagian | Tanggung Jawab |
| --- | --- |
| Route | mengarahkan URL ke controller |
| Controller | mengambil data dan menyiapkan view data |
| Model Query | filter `active`, relasi, sorting, pagination |
| Data Mapper | membentuk data siap tampil |
| Blade Page | menyusun layout halaman |
| Blade Component | menampilkan card, list, empty state, dan section kecil |

## 4. Pola Query Publik

Query publik minimal:

```php
Model::query()
    ->where('active', true);
```

Untuk list:

```php
Model::query()
    ->where('active', true)
    ->latest()
    ->paginate(12);
```

Untuk relasi:

```php
Blog::query()
    ->with(['category', 'branch'])
    ->where('active', true)
    ->whereHas('category', fn ($query) => $query->where('active', true))
    ->whereHas('branch', fn ($query) => $query->where('active', true));
```

Catatan:

- Model yang memakai `SoftDeletes` otomatis tidak mengambil data trashed.
- Jika resource punya kolom urutan, sorting mengikuti kolom tersebut, misalnya `milestone.sort`.
- Jika resource punya relasi yang juga memakai `active`, relasi harus ikut difilter.
- Untuk blog, sorting default memakai `created_at` karena tabel saat ini belum punya kolom tanggal publikasi khusus.

## 5. Resolver Gambar

Kolom gambar/foto publik bisa berisi:

- URL eksternal dummy, contoh `https://picsum.photos/...`,
- path upload Filament di disk public, contoh `blog/thumbnail/contoh.jpg`,
- `null`.

Semua controller sebaiknya memakai resolver yang sama.

Aturan resolver:

- jika nilai kosong, pakai placeholder,
- jika nilai diawali `http://` atau `https://`, pakai langsung,
- selain itu anggap sebagai file dari storage public.

Konsep helper:

```php
use Illuminate\Support\Facades\Storage;

function public_image_url(?string $path, string $fallback = '/images/placeholder.jpg'): string
{
    if (blank($path)) {
        return $fallback;
    }

    if (str($path)->startsWith(['http://', 'https://'])) {
        return $path;
    }

    return Storage::disk('public')->url($path);
}
```

Catatan:

- Implementasi boleh berupa helper global, service kecil, trait presenter, atau private method controller.
- Jangan merangkai `/storage/...` langsung di banyak Blade.
- Untuk upload Filament, pastikan `php artisan storage:link` sudah dibuat.

## 6. Pola Mapping Data

Controller sebaiknya mengubah model menjadi array siap tampil.

Format umum card:

```php
[
    'title' => 'Judul atau nama data',
    'description' => 'Ringkasan pendek',
    'image_url' => public_image_url($record->thumbnail),
    'detail_url' => route('nama-route.show', $record),
    'meta' => 'Kategori, cabang, lokasi, atau info pendek lain',
]
```

Format umum detail:

```php
[
    'title' => 'Judul atau nama data',
    'description' => 'Isi utama',
    'image_url' => public_image_url($record->thumbnail),
    'sections' => [],
    'meta' => [],
]
```

Catatan:

- Nama key view data boleh disesuaikan per halaman.
- Yang penting Blade tidak perlu melakukan query atau formatting berat.
- JSON seperti `mision`, `sosial_media`, `job_description`, dan `list` dikirim sebagai array siap tampil.

## 7. Route Publik

Route publik tahap awal:

```php
use App\Http\Controllers\AboutController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BranchController;
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
```

Catatan:

- Tidak ada route `/divisi` pada tahap awal.
- Tidak ada route `/faq` pada tahap awal.
- Tidak ada route `/recruitment` pada tahap awal.
- Tidak ada `POST /kontak` pada tahap awal.

## 8. Controller Publik

Pola controller list:

```php
public function index()
{
    $records = Model::query()
        ->where('active', true)
        ->latest()
        ->paginate(12)
        ->through(fn ($record) => $this->mapCard($record));

    return view('pages.nama-data.index', [
        'records' => $records,
    ]);
}
```

Pola controller detail:

```php
public function show(Model $record)
{
    abort_unless($record->active, 404);

    return view('pages.nama-data.show', [
        'record' => $this->mapDetail($record),
    ]);
}
```

Catatan:

- Method mapper bisa private method di controller untuk tahap awal.
- Jika mapper dipakai banyak controller, pindahkan ke presenter atau service.

## 9. Empty State

Setiap halaman list atau section dinamis harus punya empty state.

Contoh kondisi:

- blog belum tersedia,
- cabang belum tersedia,
- data divisi belum tersedia,
- FAQ belum tersedia,
- kontak cabang belum tersedia.

Aturan:

- jangan tampilkan halaman kosong,
- jangan tampilkan error teknis,
- pesan empty state harus ramah dan jelas.

## 10. Integrasi ke Home

Home mengambil ringkasan dari beberapa resource.

Data tahap awal:

- satu organisasi aktif,
- count aktif,
- satu sambutan aktif terbaru,
- divisi aktif,
- cabang aktif pilihan,
- 3 blog terbaru,
- FAQ aktif pilihan.

Contoh konsep:

```php
$organization = Organization::query()
    ->where('active', true)
    ->latest()
    ->first();

$counts = Count::query()
    ->where('active', true)
    ->latest()
    ->limit(4)
    ->get();

$latestBlogs = Blog::query()
    ->with(['category', 'branch'])
    ->where('active', true)
    ->latest()
    ->limit(3)
    ->get();

$divisions = Division::query()
    ->where('active', true)
    ->orderBy('name')
    ->limit(4)
    ->get();

$branches = Branch::query()
    ->where('active', true)
    ->latest()
    ->limit(6)
    ->get();

$faqs = Faq::query()
    ->where('active', true)
    ->latest()
    ->limit(6)
    ->get();
```

## 11. Implementasi Tahap Awal

### 11.1 Home

Model:

- `App\Models\Organization`
- `App\Models\Count`
- `App\Models\Greeting`
- `App\Models\Division`
- `App\Models\Branch`
- `App\Models\Blog`
- `App\Models\Faq`

Route:

```php
Route::get('/', [HomeController::class, 'index'])->name('home');
```

View:

- `resources/views/pages/home.blade.php`

Data utama:

```php
[
    'organization' => $this->mapOrganization($organization),
    'counts' => $counts->map(fn ($count) => $this->mapCount($count)),
    'greeting' => $this->mapGreeting($greeting),
    'divisions' => $divisions->map(fn ($division) => $this->mapDivisionCard($division)),
    'branches' => $branches->map(fn ($branch) => $this->mapBranchCard($branch)),
    'latest_blogs' => $latestBlogs->map(fn ($blog) => $this->mapBlogCard($blog)),
    'faqs' => $faqs->map(fn ($faq) => $this->mapFaq($faq)),
]
```

### 11.2 Tentang Kami

Model:

- `App\Models\Organization`
- `App\Models\Greeting`
- `App\Models\Milestone`
- `App\Models\Division`

Route:

```php
Route::get('/tentang-kami', [AboutController::class, 'index'])->name('about.index');
```

View:

- `resources/views/pages/about.blade.php`

Data utama:

```php
[
    'organization' => [
        'name' => $organization->name,
        'code' => $organization->kode_org,
        'logo_url' => public_image_url($organization->logo),
        'thumbnail_url' => public_image_url($organization->thumbnail),
        'description' => $organization->description,
        'vision' => $organization->vision,
        'missions' => $organization->mision ?? [],
        'purpose' => $organization->purpose,
        'address' => $organization->address,
        'social_links' => $organization->sosial_media ?? [],
    ],
    'milestones' => $milestones,
    'greeting' => $greeting,
    'divisions' => $divisions,
]
```

### 11.3 Cabang

Model:

- `App\Models\Branch`

Route:

```php
Route::get('/cabang', [BranchController::class, 'index'])->name('branch.index');
Route::get('/cabang/{branch}', [BranchController::class, 'show'])->name('branch.show');
```

View:

- `resources/views/pages/branch/index.blade.php`
- `resources/views/pages/branch/show.blade.php`

Query index:

```php
$search = request('search');
$sector = request('sektor');

$branches = Branch::query()
    ->where('active', true)
    ->when($search, function ($query) use ($search) {
        $query->where(function ($query) use ($search) {
            $query
                ->where('name', 'like', "%{$search}%")
                ->orWhere('location', 'like', "%{$search}%")
                ->orWhere('sektor', 'like', "%{$search}%");
        });
    })
    ->when($sector, fn ($query) => $query->where('sektor', $sector))
    ->latest()
    ->paginate(12);
```

Data card:

```php
[
    'name' => $branch->name,
    'location' => $branch->location,
    'description' => str($branch->description)->limit(140)->toString(),
    'thumbnail_url' => public_image_url($branch->thumbnail),
    'sector' => $branch->sektor,
    'is_dpp' => $branch->is_dpp,
    'detail_url' => route('branch.show', $branch),
]
```

Data detail:

```php
[
    'name' => $branch->name,
    'location' => $branch->location,
    'thumbnail_url' => public_image_url($branch->thumbnail),
    'description' => $branch->description,
    'whatsapp_url' => $branch->grup_wa,
    'sector' => $branch->sektor,
    'social_links' => $branch->sosial_media ?? [],
    'structures' => $branch->structures->map(fn ($structure) => [
        'name' => $structure->name,
        'position' => $structure->position,
        'division' => $structure->division?->name,
        'image_url' => public_image_url($structure->image),
        'whatsapp' => $structure->no_wa,
    ]),
]
```

### 11.4 Blog / Artikel

Model:

- `App\Models\Blog`
- `App\Models\Category`
- `App\Models\BlogImage`

Route:

```php
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{blog:slug}', [BlogController::class, 'show'])->name('blog.show');
```

View:

- `resources/views/pages/blog/index.blade.php`
- `resources/views/pages/blog/show.blade.php`

Query index:

```php
$search = request('search');
$categoryId = request('category');

$blogs = Blog::query()
    ->with(['category', 'branch'])
    ->where('active', true)
    ->whereHas('category', fn ($query) => $query->where('active', true))
    ->when($search, function ($query) use ($search) {
        $query->where(function ($query) use ($search) {
            $query
                ->where('title', 'like', "%{$search}%")
                ->orWhere('body', 'like', "%{$search}%")
                ->orWhere('quotes', 'like', "%{$search}%");
        });
    })
    ->when($categoryId, fn ($query) => $query->where('category_id', $categoryId))
    ->latest()
    ->paginate(12);
```

Data card:

```php
[
    'title' => $blog->title,
    'slug' => $blog->slug,
    'excerpt' => str(strip_tags($blog->body))->limit(140)->toString(),
    'thumbnail_url' => public_image_url($blog->thumbnail),
    'category' => $blog->category?->name,
    'branch' => $blog->branch?->name,
    'formatted_date' => $blog->created_at?->format('d M Y'),
    'detail_url' => route('blog.show', $blog),
]
```

Data detail:

```php
[
    'title' => $blog->title,
    'quotes' => $blog->quotes,
    'content' => $blog->body,
    'thumbnail_url' => public_image_url($blog->thumbnail),
    'category' => $blog->category?->name,
    'branch' => $blog->branch?->name,
    'formatted_date' => $blog->created_at?->format('d M Y'),
    'images' => $blog->images->map(fn ($image) => [
        'image_url' => public_image_url($image->image),
        'description' => $image->description,
    ]),
]
```

### 11.5 Kontak

Model:

- `App\Models\Organization`
- `App\Models\Branch`

Route:

```php
Route::get('/kontak', [ContactController::class, 'index'])->name('contact.index');
```

View:

- `resources/views/pages/contact.blade.php`

Data:

```php
[
    'organization' => [
        'name' => $organization->name,
        'email' => $organization->email,
        'phone' => $organization->no_tlpn,
        'address' => $organization->address,
        'social_links' => $organization->sosial_media ?? [],
    ],
    'branches' => $branches->map(fn ($branch) => [
        'name' => $branch->name,
        'location' => $branch->location,
        'whatsapp_url' => $branch->grup_wa,
        'social_links' => $branch->sosial_media ?? [],
    ]),
]
```

Catatan:

- Halaman kontak tahap awal tidak membuat form.
- Tidak ada `POST /kontak`.
- Jika nanti butuh pesan pengunjung, buat tabel dan resource baru untuk pesan kontak.

## 12. Resource Berikutnya

Resource yang bisa diintegrasikan setelah tahap awal:

- recruitment publik,
- form pesan kontak,
- detail divisi jika nanti memang dibutuhkan,
- halaman FAQ jika jumlah FAQ sudah banyak,
- pencarian global.

Catatan:

- Recruitment sudah memiliki tabel, tetapi belum masuk scope FE awal.
- Form kontak belum bisa menyimpan data karena belum ada tabel pesan kontak.
- Detail divisi tidak dibuat karena divisi saat ini cukup sebagai section.

## 13. Seeder Pendukung

Seeder awal yang mendukung tampilan publik:

- `Database\Seeders\OrganizationSeeder`
- `Database\Seeders\CountSeeder`
- `Database\Seeders\DivisionSeeder`
- `Database\Seeders\BranchSeeder`
- `Database\Seeders\CategorySeeder`
- `Database\Seeders\BlogSeeder`
- `Database\Seeders\FaqSeeder`
- `Database\Seeders\StatusSeeder`

Command:

```bash
php artisan db:seed
```

Catatan:

- Seeder memakai pola aman dijalankan berulang selama memakai `updateOrCreate`, `firstOrCreate`, atau pengecekan unik.
- Data dummy gambar blog bisa memakai URL eksternal.
- Data upload final sebaiknya dikelola dari Filament.

## 14. Prioritas Implementasi

Urutan yang disarankan:

1. Buat resolver gambar publik.
2. Buat layout publik.
3. Buat `HomeController`.
4. Buat `AboutController`.
5. Buat `BranchController`.
6. Buat `BlogController`.
7. Buat `ContactController`.
8. Tambahkan route publik.
9. Buat Blade Home.
10. Buat Blade Tentang Kami.
11. Buat Blade Cabang index dan detail.
12. Buat Blade Blog index dan detail.
13. Buat Blade Kontak.
14. Sambungkan data ke section Home.
15. Rapikan pagination, search, filter, dan empty state.

## 15. Batasan Tahap Awal

Belum perlu:

- halaman divisi,
- halaman FAQ,
- halaman recruitment,
- form recruitment,
- form kontak,
- login publik,
- komentar blog,
- pencarian full text,
- dashboard anggota,
- absensi kegiatan,
- pembayaran.

Tahap awal cukup memastikan pola integrasi data publik rapi dan bisa dipakai ulang untuk resource berikutnya.

# Strategi Cache Data Publik Website HIMSI

## 1. Tujuan

Dokumen ini menjadi acuan strategi cache untuk data publik Website HIMSI.

Model yang masuk scope:

1. `Blog`
2. `BlogImage`
3. `Branch`
4. `BranchStructure`
5. `Organization`
6. `Milestone`
7. `Division`
8. `Greeting`
9. `Faq`
10. `Count`

Target cache:

- mengurangi query berulang di halaman publik,
- mempercepat render Home, Tentang Kami, Cabang, Blog, dan Detail,
- tetap menjaga data cepat berubah saat admin mengedit dari Filament,
- tidak membuat logic cache tersebar di banyak model secara berantakan.

## 2. Prinsip Best Practice

### Cache data siap view, bukan Eloquent mentah

Untuk frontend publik, cache paling ideal berisi array yang sudah siap dikirim ke Blade.

Contoh:

```php
Cache::remember('public:home:v1', now()->addMinutes(30), function () {
    return [
        'hero' => [...],
        'counts' => [...],
        'greeting' => [...],
        'divisions' => [...],
        'branches' => [...],
        'blogs' => [...],
        'faqs' => [...],
    ];
});
```

Alasannya:

- Blade tetap bersih,
- query dan mapping hanya jalan saat cache miss,
- tidak menyimpan object Eloquent yang bisa membawa relasi/state tidak perlu,
- data lebih stabil untuk serialization di Redis/file cache.

### Invalidation dipusatkan

Pola lama seperti ini boleh untuk proyek kecil:

```php
protected static function booted()
{
    static::saved(function ($blog) {
        Cache::forget('home_data');
    });

    static::deleted(function ($blog) {
        Cache::forget('home_data');
    });
}
```

Tapi untuk project ini lebih baik tidak menulis `Cache::forget()` manual berulang di semua model.

Masalah pola lama:

- key cache tersebar dan sulit dilacak,
- kalau satu model mempengaruhi banyak halaman, mudah lupa key lain,
- nama key seperti `home_data` terlalu umum,
- tidak menangani `restored`, `forceDeleted`, atau perubahan relasi,
- model jadi terlalu tahu detail halaman frontend.

Rekomendasi:

- buat class khusus untuk key dan invalidation,
- model cukup memanggil satu method domain,
- controller hanya memakai service/cache repository.

## 3. Struktur Yang Disarankan

Buat folder:

```text
app/Support/PublicCache/
├── PublicCacheKey.php
└── PublicCacheInvalidator.php
```

Opsional tahap berikut:

```text
app/Services/PublicData/
├── HomeData.php
├── AboutData.php
├── BlogData.php
└── BranchData.php
```

Tanggung jawab:

| Class | Tanggung Jawab |
| --- | --- |
| `PublicCacheKey` | semua nama key cache publik |
| `PublicCacheInvalidator` | mapping model berubah ke key cache yang harus dihapus |
| `HomeData`, `AboutData`, dll | query, mapping, dan `Cache::remember()` per halaman |

## 4. Naming Key

Gunakan prefix jelas:

```text
public:home:v1
public:about:v1
public:branch:index:{hash}:v1
public:branch:show:{id}:v1
public:blog:index:{hash}:v1
public:blog:show:{slug}:v1
public:division:show:{id}:v1
public:contact:v1
```

Catatan:

- `v1` dipakai supaya mudah invalidasi besar saat struktur data berubah. Jika mapping berubah signifikan, naikkan ke `v2`.
- Untuk halaman dengan query string, gunakan hash dari filter/search/page.
- Jangan menyimpan key dinamis tanpa daftar indeks jika cache driver tidak support tag.

Contoh key index blog:

```php
'public:blog:index:'.md5(json_encode([
    'search' => $request->query('search'),
    'category' => $request->query('category'),
    'page' => $request->query('page', 1),
])).':v1'
```

## 5. Cache Tags

Kalau production memakai Redis atau Memcached, gunakan cache tags:

```php
Cache::tags(['public', 'home'])->remember('public:home:v1', now()->addMinutes(30), fn () => [...]);
Cache::tags(['public', 'home'])->flush();
```

Kelebihan:

- invalidasi lebih rapi,
- bisa flush berdasarkan domain: `home`, `blog`, `branch`,
- tidak perlu simpan daftar key dinamis.

Catatan penting:

- Laravel file cache tidak mendukung tags.
- Jika hosting masih memakai `CACHE_STORE=file`, gunakan daftar key manual atau key versioning.

Rekomendasi production:

```env
CACHE_STORE=redis
```

Jika belum siap Redis, tetap bisa pakai `Cache::forget()` dengan key statis dan TTL pendek untuk key dinamis.

## 6. TTL Rekomendasi

Gunakan TTL walaupun sudah ada invalidation.

| Cache | TTL | Alasan |
| --- | ---: | --- |
| Home | 30 menit | sering dikunjungi, data admin tidak berubah per detik |
| Tentang Kami | 1 jam | profil organisasi relatif stabil |
| Blog index | 10-15 menit | dipengaruhi search, kategori, pagination |
| Blog detail | 1 jam | detail artikel stabil sampai diedit |
| Cabang index | 30 menit | data cabang relatif stabil |
| Cabang detail | 30 menit | struktur cabang bisa berubah dari admin |
| Divisi detail | 1 jam | relatif stabil |
| Kontak | 1 jam | hanya organisasi |

TTL bukan pengganti invalidation. TTL adalah fallback kalau invalidation terlewat.

## 7. Mapping Model ke Cache

| Model Berubah | Cache Yang Harus Dihapus |
| --- | --- |
| `Organization` | Home, Tentang Kami, Kontak |
| `Count` | Home |
| `Greeting` | Home, Tentang Kami |
| `Division` | Home, Tentang Kami, Detail Divisi, Detail Cabang |
| `Milestone` | Tentang Kami |
| `Faq` | Home |
| `Branch` | Home, Cabang Index, Detail Cabang terkait, Blog Index, Blog Detail terkait |
| `BranchStructure` | Detail Cabang terkait |
| `Blog` | Home, Blog Index, Blog Detail terkait, Detail Cabang terkait |
| `BlogImage` | Blog Detail terkait |

Catatan:

- Perubahan `active`, soft delete, dan restore wajib dianggap perubahan publik.
- Perubahan `Branch` bisa mempengaruhi blog karena blog menampilkan nama cabang.
- Perubahan `Division` bisa mempengaruhi struktur cabang karena struktur cabang menampilkan nama divisi.

## 8. Event Model

Kalau tetap memakai model event, pakai semua event yang relevan:

```php
static::saved(fn ($model) => PublicCacheInvalidator::forModel($model));
static::deleted(fn ($model) => PublicCacheInvalidator::forModel($model));
static::restored(fn ($model) => PublicCacheInvalidator::forModel($model));
static::forceDeleted(fn ($model) => PublicCacheInvalidator::forModel($model));
```

Lebih rapi lagi: buat trait:

```text
app/Traits/FlushesPublicCache.php
```

Isi trait:

```php
trait FlushesPublicCache
{
    public static function bootFlushesPublicCache(): void
    {
        static::saved(fn ($model) => PublicCacheInvalidator::forModel($model));
        static::deleted(fn ($model) => PublicCacheInvalidator::forModel($model));
        static::restored(fn ($model) => PublicCacheInvalidator::forModel($model));
        static::forceDeleted(fn ($model) => PublicCacheInvalidator::forModel($model));
    }
}
```

Lalu model cukup:

```php
use FlushesPublicCache;
```

## 9. Strategi Invalidation

### Opsi A: Redis Cache Tags

Ini opsi terbaik jika production sudah memakai Redis.

Mapping tag:

| Data | Tags |
| --- | --- |
| Home | `public`, `home` |
| About | `public`, `about` |
| Blog Index | `public`, `blog` |
| Blog Detail | `public`, `blog`, `blog:{id}` |
| Branch Index | `public`, `branch` |
| Branch Detail | `public`, `branch`, `branch:{id}` |
| Division Detail | `public`, `division`, `division:{id}` |
| Contact | `public`, `contact` |

Contoh invalidasi:

```php
public static function blogChanged(Blog $blog): void
{
    Cache::tags(['home'])->flush();
    Cache::tags(['blog'])->flush();
    Cache::tags(['branch:'.$blog->branch_id])->flush();
}
```

### Opsi B: Key Versioning

Jika cache store tidak support tags, gunakan version key.

Contoh:

```php
$version = Cache::get('public:home:version', 1);
$key = "public:home:v{$version}";
```

Saat data berubah:

```php
Cache::increment('public:home:version');
```

Kelebihan:

- tidak perlu `forget()` banyak key dinamis,
- key lama akan hilang sendiri karena TTL,
- aman untuk file cache.

Kekurangan:

- cache lama tetap tinggal sampai expired.

### Opsi C: Manual Forget

Pakai hanya untuk key statis:

```php
Cache::forget('public:home:v1');
Cache::forget('public:about:v1');
```

Untuk key dinamis seperti blog index dengan search/page, manual forget cepat jadi sulit.

## 10. Rekomendasi Untuk Project Ini

Rekomendasi praktis:

1. Tahap awal pakai key versioning agar tidak bergantung Redis.
2. Buat `PublicCacheKey` dan `PublicCacheInvalidator`.
3. Controller publik pindahkan query+mapping ke service kecil per halaman.
4. Cache output array siap view.
5. Model pakai trait `FlushesPublicCache`.
6. Jika nanti production pakai Redis, upgrade invalidation ke cache tags.

Ini lebih scalable daripada `Cache::forget('home_data')` di tiap model, tapi tetap cukup sederhana untuk project sekarang.

## 11. Contoh Alur Home

Controller:

```php
public function index(): View
{
    return view('pages.home', HomeData::get());
}
```

Service:

```php
class HomeData
{
    public static function get(): array
    {
        return Cache::remember(
            PublicCacheKey::home(),
            now()->addMinutes(30),
            fn () => self::build(),
        );
    }

    private static function build(): array
    {
        // query Organization, Count, Greeting, Division, Branch, Blog, Faq
        // map ke array siap view
    }
}
```

Key:

```php
class PublicCacheKey
{
    public static function home(): string
    {
        return 'public:home:v'.Cache::get('public:home:version', 1);
    }
}
```

Invalidation:

```php
class PublicCacheInvalidator
{
    public static function home(): void
    {
        Cache::increment('public:home:version');
    }
}
```

## 12. Prioritas Implementasi

Urutan kerja yang disarankan:

1. Buat `PublicCacheKey`.
2. Buat `PublicCacheInvalidator`.
3. Buat trait `FlushesPublicCache`.
4. Pasang trait ke 10 model scope.
5. Cache halaman Home terlebih dahulu.
6. Cache Tentang Kami.
7. Cache Blog detail dan Cabang detail.
8. Baru cache index yang punya filter/search/pagination.

Jangan mulai dari cache semua halaman sekaligus. Mulai dari Home karena paling banyak mengambil data dan paling sering dibuka.

## 13. Checklist Testing

- Edit Organization dari Filament, Home/Tentang/Kontak berubah.
- Edit Count, Home berubah.
- Edit Greeting, Home dan Tentang berubah.
- Edit Division, Home/Tentang/Detail Divisi berubah.
- Edit Milestone, Tentang berubah.
- Edit FAQ, Home berubah.
- Edit Branch, Home/Cabang/Detail Cabang berubah.
- Edit BranchStructure, Detail Cabang berubah.
- Edit Blog, Home/Blog/Detail Blog/Detail Cabang berubah.
- Edit BlogImage, Detail Blog berubah.
- Soft delete dan restore punya efek invalidasi yang sama.

## 14. Catatan Penting

- Jangan cache halaman admin Filament.
- Jangan cache data user-specific di key publik.
- Jangan menyimpan object Request di cache.
- Jangan cache response redirect.
- Jangan cache data preview draft jika nanti ada fitur draft.
- Pastikan cache key memasukkan query string untuk halaman list.
- Gunakan `php artisan cache:clear` hanya untuk maintenance, bukan mekanisme utama setiap update data.

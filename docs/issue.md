# Issue: 504 Gateway Timeout pada Halaman Home

## Status

🔴 **Open** — belum terselesaikan

---

## Deskripsi

Halaman home (`/`) mengalami 504 Gateway Timeout secara konsisten di server Hostinger. Halaman lain (`/about`, `/recruitment`, `/login`, dll.) berjalan normal. Laravel log kosong — tidak ada error yang tercatat, menandakan PHP-FPM timeout sebelum Laravel sempat menulis log apapun.

---

## Environment

| Item         | Detail                                          |
| ------------ | ----------------------------------------------- |
| Server       | Hostinger Shared Hosting                        |
| Web Server   | Nginx + PHP-FPM                                 |
| Laravel root | `/home/u301495856/repositories/himsi/WEB-HIMSI` |
| Cache driver | `file` (`CACHE_STORE=file`)                     |
| APP_ENV      | production                                      |

---

## Kronologi Diagnosis

### Hipotesis 1 — Eloquent serialization di AppServiceProvider ❌ (sudah difiks, bukan penyebab utama)

`AppServiceProvider` lama memakai `Cache::remember()` yang menyimpan raw Eloquent object (`Organization`, `Division`). Saat unserialize, PHP crash karena class belum di-load autoloader.

**Fix yang sudah dilakukan:**

- Pindah query logic ke `app/Support/PublicData/GlobalData.php`
- `AppServiceProvider` sekarang hanya memanggil `GlobalData::load()` — tidak ada `Cache::remember()` di sini
- `GlobalData` menggunakan static `$loaded` flag (per-request deduplication, tanpa cross-request cache)

**Hasil:** Fix sudah di-deploy tapi 504 di home masih terjadi.

### Hipotesis 2 — Stale cache file (serialized Eloquent object) ❌ (sudah diclear)

Cache file lama di `storage/framework/cache/data/` mungkin masih mengandung serialized Eloquent object dari versi kode sebelumnya.

**Fix yang sudah dilakukan:**

- Jalankan `php artisan optimize:clear` — tidak berhasil menghapus cache
- Hapus manual: `rm -rf storage/framework/cache/data/27 storage/framework/cache/data/85 storage/framework/cache/data/fa`

**Hasil:** Cache bersih, tapi 504 masih terjadi.

### Hipotesis 3 — Redis tidak tersedia ❌ (tidak relevan)

Jika `CACHE_DRIVER=redis` tapi Redis tidak tersedia, `Cache::remember()` di `HomeController` akan hang.

**Hasil:** `CACHE_STORE=file`, bukan Redis. Tidak relevan.

### Hipotesis 4 — `Cache::remember()` closure timeout ⚠️ (belum dikonfirmasi — ini suspect utama)

`HomeController::index()` adalah **satu-satunya** controller yang memakai `Cache::remember()`. Closure-nya menjalankan 8+ query sekaligus. Jika satu query lambat atau hang, seluruh closure timeout → cache tidak pernah tersimpan → setiap request retry closure → 504 terus-menerus.

Query yang paling curiga (belum diukur):

```php
// Load 12 blog + semua images-nya (bisa banyak)
$activityBlogs = Blog::query()
    ->with(['images' => fn ($query) => $query->where('active', true), 'category', 'branch'])
    ->where('active', true)
    ->whereHas('category', fn ($q) => $q->where('active', true)->where('name', 'Kegiatan'))
    ->latest()
    ->limit(12)
    ->get();
```

---

## File Terkait

| File                                      | Keterangan                                                         |
| ----------------------------------------- | ------------------------------------------------------------------ |
| `app/Http/Controllers/HomeController.php` | Controller home — berisi `Cache::remember()` dengan 8+ query       |
| `app/Support/PublicData/GlobalData.php`   | Static query untuk Organization & Division (sudah difix, no cache) |
| `app/Providers/AppServiceProvider.php`    | Hanya wiring GlobalData ke View composer (sudah difix)             |
| `app/helpers.php`                         | `public_image_url()` — sudah dikonfirmasi ringan, bukan penyebab   |

---

## Langkah Selanjutnya

### 1. Ukur waktu tiap query (via tinker)

```bash
cd /home/u301495856/repositories/himsi/WEB-HIMSI && php artisan tinker
```

Jalankan satu per satu:

```php
// Query 1 — Organization
$s = microtime(true); App\Models\Organization::where('active', true)->latest()->first(); echo round((microtime(true)-$s)*1000).'ms'.PHP_EOL;

// Query 2 — Blog latest
$s = microtime(true); App\Models\Blog::with(['category','branch'])->where('active', true)->limit(3)->get(); echo round((microtime(true)-$s)*1000).'ms'.PHP_EOL;

// Query 3 — Activity blogs (CURIGA)
$s = microtime(true); App\Models\Blog::with(['images' => fn($q) => $q->where('active', true), 'category', 'branch'])->where('active', true)->whereHas('category', fn($q) => $q->where('active', true)->where('name', 'Kegiatan'))->limit(12)->get(); echo round((microtime(true)-$s)*1000).'ms'.PHP_EOL;

// Query 4 — Branch
$s = microtime(true); App\Models\Branch::where('active', true)->latest()->limit(10)->get(); echo round((microtime(true)-$s)*1000).'ms'.PHP_EOL;
```

### 2. Jika ada query lambat — tambah index di migration

Kolom yang perlu index:

- `blogs.active`
- `blogs.created_at`
- `blog_categories.active`, `blog_categories.name`
- `blog_images.active`, `blog_images.blog_id`

### 3. Jika semua query cepat — periksa view rendering

Kemungkinan ada loop atau logic di `resources/views/pages/home.blade.php` yang lambat.

### 4. Jika tetap timeout — pisah query activity gallery

Pindahkan `activityBlogs` ke endpoint terpisah yang di-load via AJAX/lazy load, sehingga tidak memblok render halaman utama.

### 5. Cek PHP max_execution_time di server

```bash
php -i | grep max_execution_time
```

Kalau nilainya kecil (misal 30 detik) dan query total melebihinya, akan selalu timeout.

---

## Root Cause Summary (sementara)

`HomeController::index()` menggunakan `Cache::remember()` dengan closure yang menjalankan banyak query berat. Saat cache kosong (pertama kali atau setelah clear), closure harus selesai dalam batas timeout PHP-FPM/nginx. Jika tidak selesai tepat waktu → 504 → cache tidak pernah tersimpan → setiap request mengulang proses yang sama.

Halaman lain tidak terdampak karena tidak menggunakan `Cache::remember()`.

# Issue: 504 Gateway Timeout pada Halaman Home

## Status

🟢 **Resolved** — root cause dikonfirmasi, fix sudah diterapkan

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

### Hipotesis 4 — Infinite loop di dalam `Cache::remember()` closure ✅ CONFIRMED — ROOT CAUSE

**Hasil diagnosis manual di server production:**

- Semua query diukur satu per satu via tinker → semuanya cepat: Organization 13ms, Blog latest 3ms, Activity blogs + whereHas 4ms, Branch 1ms. Query **bukan** penyebab, tidak perlu optimasi index.
- Full render `HomeController::index()` dengan cache dikosongkan (`Cache::forget`) → **proses hang total tanpa error, tanpa timeout, harus Ctrl+C manual.** Ini konsisten dengan infinite loop CPU-bound (bukan network timeout).

**Kode bermasalah:**

```php
$rawItems = $activitiesGallery->take(8)->values()->all();
$allItems = $rawItems;
while (count($allItems) < 10) {           // ← selalu true kalau $rawItems = []
    $allItems = array_merge($allItems, $rawItems); // ← array_merge([], []) = []
}
```

Saat tidak ada blog kategori "Kegiatan" dengan images aktif → `$activitiesGallery` kosong → `$rawItems = []` → `count($allItems)` selalu 0 → kondisi `< 10` selalu `true` → **infinite loop CPU-bound** → PHP-FPM hang → nginx 504.

---

## File Terkait

| File                                      | Keterangan                                                         |
| ----------------------------------------- | ------------------------------------------------------------------ |
| `app/Http/Controllers/HomeController.php` | Controller home — berisi `Cache::remember()` dengan 8+ query       |
| `app/Support/PublicData/GlobalData.php`   | Static query untuk Organization & Division (sudah difix, no cache) |
| `app/Providers/AppServiceProvider.php`    | Hanya wiring GlobalData ke View composer (sudah difix)             |
| `app/helpers.php`                         | `public_image_url()` — sudah dikonfirmasi ringan, bukan penyebab   |

---

## Fix yang Diterapkan

### 1. `app/Http/Controllers/HomeController.php`

Guard infinite loop: saat `$rawItems` kosong, isi dengan 10 dummy item (card akan tampil icon placeholder via fallback yang sudah ada di komponen).

```php
// SEBELUM — infinite loop kalau $rawItems kosong
$rawItems = $activitiesGallery->take(8)->values()->all();
$allItems = $rawItems;
while (count($allItems) < 10) {
    $allItems = array_merge($allItems, $rawItems);
}

// SESUDAH
$rawItems = $activitiesGallery->take(8)->values()->all();

if (empty($rawItems)) {
    $dummy = [
        'id' => null, 'image_url' => '', 'title' => 'Dokumentasi Kegiatan',
        'slug' => null, 'description' => 'Foto dokumentasi kegiatan HIMSI UBSI',
        'branch_name' => 'HIMSI UBSI', 'category_name' => 'KEGIATAN',
        'formatted_date' => date('d M Y'), 'detail_url' => '#',
    ];
    $allItems = array_fill(0, 10, $dummy);
} else {
    $allItems = $rawItems;
    while (count($allItems) < 10) {
        $allItems = array_merge($allItems, $rawItems);
    }
}
```

### 2. `resources/views/components/home/activities-gallery.blade.php`

Tidak ada perubahan — section tetap selalu muncul. Saat data kosong, marquee menampilkan dummy card dengan icon placeholder (fallback sudah ada di `activities-gallery-card.blade.php`).

---

## Root Cause Summary

Infinite loop CPU-bound di `HomeController::index()` terjadi saat `$activitiesGallery` kosong (tidak ada blog kategori "Kegiatan" dengan images aktif). Loop `while (count($allItems) < 10)` tidak pernah terminate karena `array_merge([], [])` selalu menghasilkan array kosong. PHP-FPM hang total → nginx 504 tanpa error log karena exception tidak pernah dilempar.

Halaman lain tidak terdampak karena tidak memiliki loop serupa.

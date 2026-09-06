# AI Chat dengan RAG (Retrieval-Augmented Generation)

## Overview

Fitur AI Chat memungkinkan pengunjung website HIMSI berinteraksi dengan asisten AI yang memiliki pengetahuan spesifik tentang organisasi. Admin dapat mengatur perilaku AI, mengunggah sumber pengetahuan, dan mendefinisikan aturan guardrail melalui panel Filament.

**Stack utama:**

- LLM: Groq (`llama-3.3-70b-versatile`) via `openai-php/laravel` dengan base URL override
- Embedding: OpenAI `text-embedding-3-small` (tier gratis cukup untuk skala HIMSI)
- Parser PDF: `smalot/pdfparser`
- Parser Excel: `phpoffice/phpspreadsheet`
- Frontend: Alpine.js widget (tanpa iframe, tanpa persistent process)
- Hosting: shared hosting Hostinger — **tidak ada queue worker, tidak ada stream**

> **Groq tidak punya PHP SDK**, tapi API-nya OpenAI-compatible. Cukup set `OPENAI_BASE_URI=api.groq.com/openai/v1` dan `OPENAI_API_KEY=gsk_xxx` di `.env`, pakai `openai-php/laravel` seperti biasa.

---

## Database Schema

### `ai_configs`

Satu baris aktif; mengontrol perilaku global chatbot.

| Kolom              | Tipe      | Keterangan                                        |
| ------------------ | --------- | ------------------------------------------------- |
| `id`               | bigint PK |                                                   |
| `system_prompt`    | text      | Instruksi dasar untuk AI (persona, batasan topik) |
| `model`            | string    | Contoh: `llama-3.3-70b-versatile`, `gpt-4o-mini`  |
| `temperature`      | float     | 0.0–1.0                                           |
| `max_tokens`       | int       | Batas panjang respons                             |
| `is_enabled`       | boolean   | Aktif/nonaktif seluruh widget                     |
| `greeting_message` | string    | Pesan pembuka saat chat dibuka                    |
| `rules`            | json      | Guardrail rules (lihat bagian Rules)              |
| `created_at`       | timestamp |                                                   |
| `updated_at`       | timestamp |                                                   |

### `ai_knowledge_sources`

Setiap baris = satu dokumen/sumber pengetahuan.

| Kolom           | Tipe           | Keterangan                                                   |
| --------------- | -------------- | ------------------------------------------------------------ |
| `id`            | bigint PK      |                                                              |
| `title`         | string         | Nama sumber (contoh: "AD/ART HIMSI 2025")                    |
| `source_type`   | enum           | `text`, `pdf`, `excel`, `url`                                |
| `file_path`     | string\|null   | Path file di storage (untuk pdf/excel)                       |
| `raw_content`   | longtext\|null | Teks mentah hasil parse                                      |
| `status`        | enum           | `pending`, `processing`, `ready`, `failed`                   |
| `is_active`     | boolean        | Apakah diikutkan dalam RAG lookup                            |
| `error_message` | string\|null   | Pesan error jika parsing/embedding gagal                     |
| `processed_at`  | timestamp\|null | Waktu terakhir berhasil diproses (untuk cek idempotency)    |
| `created_at`    | timestamp      |                                                              |
| `updated_at`    | timestamp      |                                                              |

### `ai_knowledge_chunks`

Setiap baris = satu potongan teks + vektor embeddingnya.

| Kolom         | Tipe                      | Keterangan                                              |
| ------------- | ------------------------- | ------------------------------------------------------- |
| `id`          | bigint PK                 |                                                         |
| `source_id`   | FK → ai_knowledge_sources |                                                         |
| `chunk_index` | int                       | Urutan chunk dalam sumber                               |
| `content`     | text                      | Teks chunk (±500 token)                                 |
| `embedding`   | json                      | Array float (1536 dimensi untuk text-embedding-3-small) |
| `created_at`  | timestamp                 |                                                         |

### `ai_chat_logs`

Satu baris per pasangan tanya-jawab. Session dilacak dengan UUID.

| Kolom            | Tipe      | Keterangan                                                                     |
| ---------------- | --------- | ------------------------------------------------------------------------------ |
| `id`             | bigint PK |                                                                                |
| `session_id`     | uuid      | Dibuat di frontend saat pertama kali chat, disimpan di sessionStorage          |
| `question`       | text      | Pertanyaan user                                                                |
| `answer`         | text      | Jawaban AI                                                                     |
| `sources_used`   | json      | Judul knowledge chunk yang dipakai sebagai konteks RAG                         |
| `entity_context` | json      | Data DB yang diinjeksi (branch/blog realtime, lihat Structured Data Injection) |
| `model`          | string    | Model yang menjawab                                                            |
| `ip_address`     | string    | Untuk audit                                                                    |
| `created_at`     | timestamp |                                                                                |

Contoh isi `sources_used`:

```json
["AD/ART HIMSI 2025", "Visi Misi DPP 2024"]
```

Contoh isi `entity_context`:

```json
{
    "branch": {
        "name": "HIMSI Slipi",
        "location": "Jakarta Barat",
        "sektor": "DKI Jakarta"
    },
    "blogs": [
        {
            "title": "Pelantikan Pengurus Baru",
            "slug": "pelantikan-pengurus-baru"
        }
    ]
}
```

---

## Rules / Guardrail

Rules disimpan di kolom `rules` (JSON) pada tabel `ai_configs`. Admin atur lewat Filament, tidak perlu hardcode.

**Struktur `rules`:**

```json
{
    "banned_words": ["anjing", "bangsat", "babi"],
    "banned_topics": ["politik", "SARA", "agama"],
    "max_question_length": 500,
    "block_message": "Maaf, pertanyaan kamu tidak bisa saya jawab. Silakan tanya hal lain seputar HIMSI."
}
```

**Cara kerja — pre-processing sebelum ke LLM:**

```
User kirim pesan
        │
        ▼
[Guard: panjang > max_question_length?] → tolak
        │
        ▼
[Guard: mengandung banned_words?] → tolak dengan block_message
        │
        ▼
[Guard: menyebut banned_topics?] → tolak dengan block_message
        │
        ▼
[Lanjut ke RAG + Entity Injection + LLM]
```

Pengecekan ini murni PHP di `AiChatService` — **tidak buang token API sama sekali** karena ditolak sebelum request keluar.

> Tips: `banned_words` pakai `str_contains` case-insensitive. `banned_topics` bisa pakai keyword list atau diserahkan ke `system_prompt` untuk kasus yang lebih nuanced.

---

## Structured Data Injection (Entity Detection)

Berbeda dari RAG (embedding similarity), ini adalah **lookup langsung ke DB** ketika user menyebut entitas yang dikenal sistem (nama cabang, kategori blog, dll).

**Flow:**

```
User: "ceritain dong tentang cabang Slipi"
        │
        ▼
[Load semua nama branch dari cache (ttl 60 menit)]
        │
        ▼
[Cocokkan dengan pertanyaan: str_contains / similar_text]
        │
   "Slipi" terdeteksi sebagai branch
        │
        ▼
[Query realtime:]
  Branch::where('name', 'like', '%slipi%')->first()
  Blog::where('branch_id', $branch->id)
       ->where('active', true)
       ->latest()->limit(3)->get()
        │
        ▼
[Inject ke prompt sebagai "Live Data Context"]
        │
        ▼
[Lanjut ke LLM dengan konteks yang sudah diperkaya]
```

**Kenapa tidak murni RAG untuk ini?**

RAG cocok untuk dokumen statis (PDF, teks). Tapi data branch dan blog bersifat dinamis — bisa berubah kapan saja. Structured injection memastikan AI selalu dapat data terkini langsung dari DB, bukan dari snapshot dokumen yang mungkin sudah basi.

**Entitas yang bisa dideteksi:**
| Entitas | Sumber data | Data yang diinjeksi |
|---------|-------------|---------------------|
| Nama Branch | `branches` table | name, location, sektor, description, grup_wa |
| Blog/Kegiatan | `blogs` table (filter by branch) | title, slug, category, formatted_date |

Semua ini dihandle di `AiChatService::resolveEntityContext()`.

---

## RAG Pipeline: Upload → Siap Digunakan

### Trigger Proses Embedding

**1. Otomatis saat create/save** (via Filament `afterCreate` hook / observer)

```
Admin klik Simpan → status = processing → parse → chunk → embed → status = ready
                                                                         │
                                                                    processed_at = now()
```

Synchronous dan blocking — admin nunggu sampai selesai. Acceptable di panel admin, bukan halaman publik.

**2. Tombol "Proses Ulang"** (Filament table action) — untuk:
- `status = failed` (proses pertama gagal)
- Konten diedit, perlu re-embed ulang
- Timeout saat pertama kali (dokumen sangat besar)

**3. Notifikasi gagal** — jika proses gagal, Filament menampilkan:
- Badge merah `failed` di kolom status tabel
- Filament notification (`Notification::make()->danger()`) muncul di layar admin
- Kolom `error_message` diisi pesan error spesifik (agar admin tahu apa yang salah)
- Banner warning di atas tabel jika ada source dengan `status = failed`

### Idempotency — Mencegah Double Embedding

Sebelum proses dimulai, selalu cek status terlebih dahulu:

```php
// Di ProcessKnowledgeSource::handle()
if ($source->status === 'processing') {
    return; // Ada proses yang sedang jalan, skip
}
if ($source->status === 'ready' && !$forceReprocess) {
    return; // Sudah diproses, skip kecuali dipaksa lewat tombol "Proses Ulang"
}

$source->update(['status' => 'processing']);
// ... proses ...
```

`forceReprocess = true` hanya di-set dari tombol "Proses Ulang" di Filament.

Sebelum embed ulang, **hapus dulu chunks lama** milik source tersebut:

```php
$source->chunks()->delete(); // DELETE WHERE source_id = ?
// baru insert chunks baru
```

Ini mencegah duplikasi chunk di tabel `ai_knowledge_chunks`.

### Flow Lengkap

```
Admin upload file / input teks
        │
        ▼
[KnowledgeSource disimpan, status=pending]
        │
        ▼
[Cek idempotency: status = processing/ready? → skip]
        │
        ▼
[Set status = processing]
        │
        ▼
[Hapus chunks lama jika ada]
        │
   ┌────┴────┐
   │  Parse  │
   │ PDF     │ → smalot/pdfparser
   │ Excel   │ → phpoffice/phpspreadsheet
   │ URL     │ → file_get_contents + strip_tags
   │ Text    │ → langsung digunakan
   └────┬────┘
        │
        ▼
[Split jadi chunks ~500 token, overlap 50 token]
        │
        ▼
[Embed tiap chunk via OpenAI Embeddings API]
        │
        ▼
[Simpan ke ai_knowledge_chunks dengan embedding JSON]
        │
        ▼
[status=ready, processed_at=now(), error_message=null]
        │
   jika gagal di mana saja:
        ▼
[status=failed, error_message="pesan error"]
[Filament notification: danger]
```

> **Catatan hosting:** Proses ini synchronous, dijalankan langsung di request lifecycle (tidak pakai queue). Cron job opsional sebagai safety net untuk membersihkan source yang masih `pending` terlalu lama.

---

## Query Flow Lengkap: User Bertanya → AI Menjawab

```
User kirim pesan
        │
        ▼
[1. PRE-PROCESSING: Rules Guard]
   - cek panjang pertanyaan
   - cek banned_words
   - cek banned_topics
   → jika trigger: return block_message, STOP
        │
        ▼
[2. ENTITY DETECTION: Structured Data Injection]
   - cocokkan nama branch dari DB
   - jika ditemukan: query branch + blog terbaru
   - simpan sebagai entity_context
        │
        ▼
[3. RAG: Semantic Search]
   - embed pertanyaan via OpenAI
   - hitung cosine similarity dengan semua chunk aktif
   - ambil top 5 chunk tertinggi
        │
        ▼
[4. PROMPT ASSEMBLY]
   system_prompt
   + rules reminder (dari ai_configs)
   + [jika ada] Live Data (entity_context)
   + [jika ada] Knowledge Context (RAG chunks)
   + riwayat percakapan (dari request)
   + pertanyaan user
        │
        ▼
[5. CALL LLM: Groq / OpenAI]
        │
        ▼
[6. LOG: simpan ke ai_chat_logs]
   session_id, question, answer, sources_used, entity_context, model, ip
        │
        ▼
[7. RETURN JSON ke frontend]
```

### Cosine Similarity (PHP)

```php
function cosineSimilarity(array $a, array $b): float
{
    $dot = array_sum(array_map(fn ($x, $y) => $x * $y, $a, $b));
    $normA = sqrt(array_sum(array_map(fn ($x) => $x ** 2, $a)));
    $normB = sqrt(array_sum(array_map(fn ($x) => $x ** 2, $b)));
    return ($normA * $normB) ? $dot / ($normA * $normB) : 0.0;
}
```

---

## Filament Admin: Kemampuan yang Diatur

### Halaman Config (`AiConfigResource`)

- Edit `system_prompt` (textarea panjang)
- Pilih `model` (select: llama-3.3-70b-versatile, gpt-4o-mini, gpt-4o, dll)
- Slider `temperature`
- Input `max_tokens`
- Toggle `is_enabled`
- Input `greeting_message`
- Kelola `rules`: banned words (tag input), banned topics, max length, block message

### Halaman Knowledge Sources (`AiKnowledgeSourceResource`)

- Upload file PDF/Excel atau input URL/teks bebas
- Lihat status parsing (`pending` / `processing` / `ready` / `failed`)
- Toggle `is_active` per sumber
- Action: **Proses Ulang** (re-parse + re-embed)
- Action: **Lihat Chunks** (modal: tampilkan semua chunk hasil split)
- Hapus sumber (cascade hapus chunks)

### Halaman Chat Logs (`AiChatLogResource`)

- Tabel: session_id, pertanyaan, jawaban (truncated), model, ip, waktu
- Filter: by session_id, by date range
- Detail view: tampilkan full question + answer + sources_used + entity_context sebagai JSON yang readable
- Bisa dipakai untuk evaluasi kualitas jawaban AI

---

## Frontend Widget

Alpine.js floating chat widget di pojok kanan bawah:

```html
<div x-data="aiChat()" class="fixed bottom-6 right-6 z-50">
    <!-- Tombol buka/tutup -->
    <!-- Panel chat: riwayat + input -->
</div>
```

- Generate `session_id` (UUID) saat pertama buka, simpan ke `sessionStorage`
- Kirim `session_id` + pertanyaan + riwayat percakapan via `fetch('/ai/chat', { method: 'POST' })`
- Tidak ada streaming (shared hosting tidak support SSE/chunked response)
- Riwayat tampilan disimpan di memory Alpine (hilang saat refresh), permanen ada di DB
- Tidak perlu login

---

## Routes

```php
Route::post('/ai/chat', [AiChatController::class, 'chat'])->middleware('throttle:20,1');
```

Rate limit 20 request/menit per IP untuk mencegah penyalahgunaan.

---

## File yang Akan Dibuat

```
app/
├── Models/
│   ├── AiConfig.php
│   ├── AiKnowledgeSource.php
│   ├── AiKnowledgeChunk.php
│   └── AiChatLog.php
├── Http/Controllers/
│   └── AiChatController.php
├── Services/
│   ├── AiEmbeddingService.php       ← embed text via OpenAI
│   ├── AiKnowledgeService.php       ← parse, chunk, retrieve (RAG)
│   ├── AiGuardService.php           ← rules pre-processing
│   ├── AiEntityService.php          ← entity detection + DB lookup
│   └── AiChatService.php            ← orchestrator: guard → entity → RAG → prompt → LLM → log
├── Console/Commands/
│   └── ProcessKnowledgeSources.php  ← artisan ai:process-sources
└── Filament/Resources/
    ├── AiConfigResource.php
    ├── AiKnowledgeSourceResource.php
    └── AiChatLogResource.php

database/migrations/
├── xxxx_create_ai_configs_table.php
├── xxxx_create_ai_knowledge_sources_table.php
├── xxxx_create_ai_knowledge_chunks_table.php
└── xxxx_create_ai_chat_logs_table.php

resources/views/components/ai/
└── chat-widget.blade.php
```

---

## Estimasi Biaya

| Kegiatan                                 | Biaya           |
| ---------------------------------------- | --------------- |
| Embedding 1 dokumen ~10 halaman (OpenAI) | ~$0.001         |
| Embedding per pertanyaan user (OpenAI)   | ~$0.00001       |
| LLM per percakapan via Groq              | **$0** (gratis) |
| LLM per percakapan via GPT-4o-mini       | ~$0.0003        |

Untuk skala HIMSI (ratusan interaksi/bulan) dengan Groq: **mendekati $0/bulan**.

**Groq vs OpenAI LLM:**
| | Groq (llama-3.3-70b) | GPT-4o-mini |
|-|----------------------|-------------|
| Biaya | Gratis | ~$0.0003/chat |
| Kecepatan | Sangat cepat | Normal |
| Kualitas Bahasa Indo | Baik | Sangat baik |
| PHP SDK | Pakai openai-php (base URL override) | Native |

---

## Kompatibilitas Shared Hosting

| Kebutuhan                       | Status                                        |
| ------------------------------- | --------------------------------------------- |
| Queue worker persistent         | ❌ Tidak perlu (pakai Artisan command + cron) |
| WebSocket / SSE                 | ❌ Tidak perlu (fetch biasa)                  |
| Ekstensi PHP khusus             | ✅ Hanya `json`, `curl` — sudah ada           |
| Outbound HTTP (OpenAI/Groq API) | ✅ Hostinger mengizinkan                      |
| Cron job                        | ✅ Tersedia di Hostinger panel                |
| Database                        | ✅ MySQL biasa                                |

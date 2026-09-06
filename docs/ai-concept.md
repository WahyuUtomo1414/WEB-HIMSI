# Konsep AI yang Dipakai di HIMSI

## 1. Gambaran Besar

AI di project ini bukan AI yang "belajar sendiri" — kita **tidak melatih model**. Yang kita lakukan adalah memanfaatkan model LLM yang sudah ada (Groq/Llama) dan memberikan **konteks yang relevan** sebelum model menjawab. Teknik ini disebut **RAG (Retrieval-Augmented Generation)**.

Alur sederhananya:

```
User nanya
    ↓
Cek aturan (guardrail)
    ↓
Cari data relevan (RAG + entity detection)
    ↓
Rakitin prompt lengkap
    ↓
Kirim ke Groq → dapat jawaban
    ↓
Simpan log → kirim ke user
```

---

## 2. Konsep-Konsep Utama

### LLM (Large Language Model)
Model bahasa besar yang bisa memahami dan menghasilkan teks. Yang kita pakai: **Llama 3.3 70B** via **Groq** (gratis, cepat). Model ini yang "ngobrol" dengan user.

### Embedding
Proses mengubah teks menjadi **deretan angka (vektor)** yang merepresentasikan makna teks tersebut. Teks yang maknanya mirip akan menghasilkan angka yang mirip.

```
"kapan HIMSI berdiri?"      → [0.12, -0.45, 0.87, 0.33, ...]
"HIMSI didirikan tahun 2015" → [0.11, -0.43, 0.85, 0.31, ...]  ← mirip
"cara daftar anggota"        → [0.91,  0.23, -0.12, 0.67, ...] ← jauh
```

Yang kita pakai: **OpenAI `text-embedding-3-small`** (berbayar, tapi murah). Embedding hanya diperlukan untuk fitur knowledge base.

### RAG (Retrieval-Augmented Generation)
Teknik "kasih contekan" ke LLM sebelum menjawab. Tanpa RAG, LLM hanya tahu dari pengetahuan umum trainingnya. Dengan RAG, LLM bisa menjawab berdasarkan dokumen spesifik HIMSI yang kita upload.

```
Tanpa RAG: "Apa program kerja HIMSI?" → LLM jawab dari pengetahuan umum (bisa ngawur)
Dengan RAG: → ambil chunk dokumen proker HIMSI → LLM jawab berdasarkan dokumen itu
```

### Cosine Similarity
Cara mengukur seberapa "mirip" dua vektor embedding. Nilainya antara -1 sampai 1, makin mendekati 1 makin mirip maknanya. Kita pakai ini untuk menentukan chunk mana yang paling relevan dengan pertanyaan user.

### Chunk
Dokumen yang di-upload dipotong jadi potongan-potongan kecil (~2000 karakter dengan overlap 200 karakter). Ini karena LLM punya batas panjang input, dan kita hanya mau kirim bagian yang relevan saja, bukan seluruh dokumen.

### Entity Detection
Cara mendeteksi apakah user menyebut entitas spesifik (nama branch HIMSI). Tidak pakai embedding — cukup dengan string matching (`mb_stripos`). Kalau terdeteksi, langsung query DB untuk data terbaru. Ini lebih akurat untuk data yang dinamis (branch, blog) karena tidak bergantung pada dokumen yang sudah di-embed.

### Guardrail
Filter pertanyaan sebelum dikirim ke LLM. Mengecek:
- Panjang pertanyaan (max karakter)
- Kata-kata terlarang (`banned_words`)
- Topik terlarang (`banned_topics`)

Kalau trigger → langsung return `block_message`, tidak sampai ke LLM.

---

## 3. Struktur Folder

```
app/
├── Models/
│   ├── AiConfig.php              → Konfigurasi AI (model, temperature, system prompt, rules)
│   ├── AiKnowledgeSource.php     → Sumber dokumen yang di-upload (PDF, text, URL, Excel)
│   ├── AiKnowledgeChunk.php      → Potongan dokumen hasil proses + embedding-nya
│   └── AiChatLog.php             → Log semua percakapan user (read-only, buat audit)
│
├── Services/
│   ├── AiGuardService.php        → Filter pertanyaan (guardrail/rules)
│   ├── AiEmbeddingService.php    → Ubah teks jadi vektor + hitung cosine similarity
│   ├── AiKnowledgeService.php    → Proses dokumen (parse → chunk → embed → simpan)
│   ├── AiEntityService.php       → Deteksi nama branch → query DB realtime
│   └── AiChatService.php         → Orkestrator utama (koordinasi semua service)
│
├── Http/Controllers/
│   └── AiChatController.php      → Endpoint POST /ai/chat (validasi request → panggil service)
│
├── Console/Commands/
│   └── ProcessKnowledgeSources.php → Artisan command untuk proses ulang knowledge source
│
└── Filament/Resources/
    ├── AiConfigs/                → Admin: atur model, system prompt, rules, toggle on/off
    ├── AiKnowledgeSources/       → Admin: upload dokumen, lihat status proses, proses ulang
    └── AiChatLogs/               → Admin: lihat riwayat percakapan (read-only)

database/migrations/
├── ..._create_ai_config_table.php
├── ..._create_ai_knowledge_source_table.php
├── ..._create_ai_knowledge_chunk_table.php
└── ..._create_ai_chat_log_table.php

database/seeders/
└── AiConfigSeeder.php            → Buat record ai_config default (idempotent)

resources/views/components/ai/
└── chat-widget.blade.php         → UI floating chat (Alpine.js)
```

---

## 4. Penjelasan Tiap File

### `AiConfig` (Model + Tabel)
Menyimpan satu record konfigurasi AI yang aktif. Diisi lewat panel Filament.

| Kolom | Fungsi |
|---|---|
| `system_prompt` | Instruksi karakter AI ("kamu adalah asisten HIMSI...") |
| `model` | Nama model Groq yang dipakai (misal: `llama-3.3-70b-versatile`) |
| `temperature` | Kreativitas jawaban (0 = konsisten, 1 = lebih variatif) |
| `max_tokens` | Batas panjang jawaban |
| `is_enabled` | On/off seluruh fitur AI chat |
| `greeting_message` | Pesan pertama yang muncul saat chat dibuka |
| `rules` | JSON berisi `banned_words`, `banned_topics`, `max_question_length`, `block_message` |

### `AiKnowledgeSource` (Model + Tabel)
Sumber dokumen yang ingin "diajarkan" ke AI. Mendukung 4 tipe:
- `text` → teks langsung diketik di form
- `pdf` → file PDF di-upload
- `excel` → file Excel di-upload
- `url` → URL website, kontennya di-fetch otomatis

Status prosesnya: `pending` → `processing` → `ready` / `failed`

### `AiKnowledgeChunk` (Model + Tabel)
Hasil pemotongan dokumen. Satu source bisa menghasilkan banyak chunk. Setiap chunk menyimpan:
- `content` → teks potongannya
- `embedding` → array angka hasil embedding (bisa ribuan angka)
- `chunk_index` → urutan potongan dalam dokumen asli

### `AiChatLog` (Model + Tabel)
Rekaman semua percakapan. Tidak ada soft delete, tidak bisa diedit. Menyimpan:
- `session_id` → UUID per tab browser (dari `sessionStorage`)
- `question` + `answer` → percakapannya
- `sources_used` → chunk mana yang dipakai sebagai konteks
- `entity_context` → data branch/blog apa yang diinjek
- `model` + `ip_address` → untuk audit

---

### `AiGuardService`
Dipanggil **pertama kali** sebelum proses apapun. Kalau pertanyaan melanggar rules → langsung return pesan blokir, tidak lanjut ke LLM. Hemat biaya API.

### `AiEmbeddingService`
Pakai **OpenAI API** (bukan Groq, karena Groq tidak punya embedding). Dua fungsi:
- `embed(string $text): array` → kirim teks ke OpenAI, dapat array angka
- `cosineSimilarity(array $a, array $b): float` → hitung kemiripan dua vektor

### `AiKnowledgeService`
Punya dua tanggung jawab besar:
1. **`processSource()`** → ambil dokumen, parse, potong jadi chunks, embed tiap chunk, simpan ke DB
2. **`retrieveChunks()`** → diberi embedding pertanyaan, hitung similarity ke semua chunk di DB, return top 5 yang paling mirip

### `AiEntityService`
Muat semua nama branch dari cache (60 menit). Kalau pertanyaan user mengandung nama branch → query DB langsung untuk data branch + blog terbaru. Ini untuk memastikan data yang dikasih ke AI selalu up-to-date, tidak bergantung pada dokumen yang mungkin sudah usang.

### `AiChatService` (Orkestrator)
File ini yang mengkoordinasi semua service. Urutannya:

```
1. Guard check          → AiGuardService::check()
2. Entity detection     → AiEntityService::resolve()
3. RAG retrieval        → AiEmbeddingService::embed() + AiKnowledgeService::retrieveChunks()
4. Rakitin prompt       → system_prompt + entity context + RAG chunks + history
5. Panggil Groq         → OpenAI facade (via base URL override ke Groq)
6. Simpan log           → AiChatLog::create()
7. Return jawaban
```

RAG dibungkus try-catch — kalau embedding gagal (misal OPENAI_EMBEDDING_KEY tidak diset), chat tetap jalan tanpa konteks knowledge base.

### `AiChatController`
Endpoint tunggal `POST /ai/chat`. Hanya:
1. Validasi request (question, session_id, history)
2. Panggil `AiChatService::chat()`
3. Return JSON

Throttle: max 20 request per menit per IP.

### `ProcessKnowledgeSources` (Artisan Command)
Untuk menjalankan proses embedding lewat terminal / cron job:

```bash
php artisan ai:process-sources           # proses semua yang pending/failed
php artisan ai:process-sources --id=3    # proses source tertentu
php artisan ai:process-sources --force   # proses ulang meski sudah ready
```

### `chat-widget.blade.php`
UI chat di frontend. Pakai Alpine.js inline (tidak ada file JS terpisah). Yang terjadi saat page load:
1. Generate UUID → simpan di `sessionStorage` sebagai `session_id`
2. Tampilkan `greeting_message` dari config
3. Saat user kirim pesan → `fetch('/ai/chat')` dengan CSRF token
4. Tampilkan loading (3 titik bouncing) sambil tunggu response
5. Append jawaban AI ke daftar pesan

Widget hanya di-render jika `$globalAiEnabled` = `true` (dicek di `public.blade.php`).

---

## 5. Alur Lengkap: User Nanya Sampai Dapat Jawaban

```
[Browser]
User ketik pertanyaan → klik kirim

[chat-widget.blade.php]
fetch POST /ai/chat {
    question: "kapan HIMSI berdiri?",
    session_id: "uuid-xxx",
    history: [...6 pesan terakhir]
}

[AiChatController]
Validasi → panggil AiChatService::chat()

[AiChatService]
  Step 1: AiGuardService::check()
          → cek banned_words, panjang, banned_topics
          → lolos? lanjut

  Step 2: AiEntityService::resolve("kapan HIMSI berdiri?")
          → tidak ada nama branch → return []

  Step 3: AiEmbeddingService::embed("kapan HIMSI berdiri?")
          → [0.12, -0.45, 0.87, ...]
          → AiKnowledgeService::retrieveChunks(embedding, topN=5)
          → bandingkan dengan semua chunk di DB
          → return 5 chunk paling mirip

  Step 4: Rakitin prompt:
          [system_prompt]
          [5 chunk relevan dari knowledge base]
          [history 6 pesan terakhir]
          [pertanyaan user]

  Step 5: OpenAI facade → Groq API
          → dapat jawaban teks

  Step 6: AiChatLog::create(...)
          → simpan ke DB

  Step 7: return ['answer' => '...', 'blocked' => false]

[Browser]
Tampilkan jawaban di chat panel
```

---

## 6. Kenapa Dua API?

| | Groq | OpenAI |
|---|---|---|
| Dipakai untuk | Chat / generate jawaban | Embedding saja |
| Model | Llama 3.3 70B | text-embedding-3-small |
| Alasan dipilih | Gratis, sangat cepat | Groq tidak punya embedding |
| Env var | `OPENAI_API_KEY` + `OPENAI_BASE_URL` | `OPENAI_EMBEDDING_KEY` + `OPENAI_EMBEDDING_BASE_URI` |

Groq gratis dengan rate limit yang cukup longgar untuk skala HIMSI. OpenAI embedding sangat murah (~$0.02 per 1 juta token) dan hanya dipanggil saat ada dokumen baru yang di-upload, bukan setiap kali user chat.

---

## 7. Tanpa OpenAI Embedding

Kalau belum mau setup OpenAI:
- Chat AI tetap jalan (via Groq)
- Entity detection tetap jalan (branch/blog dari DB)
- Guardrail tetap jalan
- **Knowledge base tidak bisa diproses** → RAG tidak aktif
- Jawaban AI hanya berdasarkan `system_prompt` + data entity dari DB

Cukup set `OPENAI_EMBEDDING_KEY` di `.env` kalau sudah siap aktifkan knowledge base.

# Task List: Implementasi AI Chat + RAG

Referensi arsitektur: `docs/ai-chat.md`
Konvensi migration & model: `docs/database.md`
Konvensi Filament resource: `docs/filament-resource.md`

Status: `[ ]` belum · `[x]` selesai · `[-]` skip/tidak perlu

---

## 1. Install Package

- [x] `composer require openai-php/laravel`
- [x] `composer require smalot/pdfparser`
- [x] `composer require phpoffice/phpspreadsheet`
- [x] Publish config OpenAI: `php artisan vendor:publish --provider="OpenAI\Laravel\ServiceProvider"`
- [x] Tambahkan env di `.env` dan `.env.example`:
    ```
    OPENAI_API_KEY=
    OPENAI_BASE_URI=api.groq.com/openai/v1
    OPENAI_EMBEDDING_KEY=
    OPENAI_EMBEDDING_BASE_URI=api.openai.com/v1
    AI_EMBEDDING_MODEL=text-embedding-3-small
    AI_CHAT_MODEL=llama-3.3-70b-versatile
    ```

---

## 2. Migration

Konvensi: pakai `BaseModelSoftDeleteDefault` + `$this->base($table)` untuk tabel yang dikelola admin. Tabel auto-generated (chunk, log) tidak perlu audit/soft delete.

Urutan buat:

- [x] `create_ai_config_table`

    ```php
    Schema::create('ai_config', function (Blueprint $table) {
        $table->id();
        $table->text('system_prompt');
        $table->string('model', 64)->default('llama-3.3-70b-versatile');
        $table->float('temperature')->default(0.7);
        $table->unsignedInteger('max_tokens')->default(1024);
        $table->boolean('is_enabled')->default(true);
        $table->string('greeting_message')->nullable();
        $table->json('rules')->nullable();
        $this->base($table);
    });
    ```

- [x] `create_ai_knowledge_source_table`

    ```php
    Schema::create('ai_knowledge_source', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->enum('source_type', ['text', 'pdf', 'excel', 'url']);
        $table->string('file_path')->nullable();
        $table->longText('raw_content')->nullable();
        $table->enum('status', ['pending', 'processing', 'ready', 'failed'])->default('pending');
        $table->boolean('is_active')->default(true);
        $table->text('error_message')->nullable();
        $table->timestamp('processed_at')->nullable();
        $this->base($table);
    });
    ```

- [x] `create_ai_knowledge_chunk_table`

    ```php
    Schema::create('ai_knowledge_chunk', function (Blueprint $table) {
        $table->id();
        $table->foreignId('source_id')->constrained('ai_knowledge_source')->cascadeOnDelete();
        $table->unsignedInteger('chunk_index');
        $table->text('content');
        $table->json('embedding');
        $table->timestamps();
    });
    ```

- [x] `create_ai_chat_log_table`

    ```php
    Schema::create('ai_chat_log', function (Blueprint $table) {
        $table->id();
        $table->uuid('session_id')->index();
        $table->text('question');
        $table->text('answer');
        $table->json('sources_used')->nullable();
        $table->json('entity_context')->nullable();
        $table->string('model', 64)->nullable();
        $table->string('ip_address', 45)->nullable();
        $table->timestamp('created_at')->useCurrent();
    });
    ```

- [x] Jalankan `php artisan migrate`

---

## 3. Model

Konvensi: `AuditedBySoftDelete` + `HasFactory` + `SoftDeletes` untuk tabel admin. `protected $table` eksplisit. `protected $guarded = ['id']`. Tidak pakai `$fillable`.

- [x] `app/Models/AiConfig.php`
    - Traits: `AuditedBySoftDelete`, `HasFactory`, `SoftDeletes`
    - `protected $table = 'ai_config'`
    - Cast: `rules → array`, `is_enabled → boolean`

- [x] `app/Models/AiKnowledgeSource.php`
    - Traits: `AuditedBySoftDelete`, `HasFactory`, `SoftDeletes`
    - `protected $table = 'ai_knowledge_source'`
    - Cast: `processed_at → datetime`, `is_active → boolean`
    - Relasi: `hasMany(AiKnowledgeChunk::class, 'source_id')`

- [x] `app/Models/AiKnowledgeChunk.php`
    - Traits: `HasFactory`
    - `protected $table = 'ai_knowledge_chunk'`
    - Cast: `embedding → array`
    - Relasi: `belongsTo(AiKnowledgeSource::class, 'source_id')`

- [x] `app/Models/AiChatLog.php`
    - Traits: `HasFactory`
    - `protected $table = 'ai_chat_log'`
    - `public $timestamps = false` (hanya `created_at`)
    - Cast: `sources_used → array`, `entity_context → array`

---

## 4. Services

- [ ] `app/Services/AiGuardService.php`
    - Method: `check(string $question, array $rules): ?string`
    - Cek panjang, banned_words (case-insensitive), banned_topics
    - Return `null` jika lolos, return `block_message` jika trigger

- [ ] `app/Services/AiEmbeddingService.php`
    - Method: `embed(string $text): array`
    - Pakai `OPENAI_EMBEDDING_KEY` + `OPENAI_EMBEDDING_BASE_URI` (selalu OpenAI, bukan Groq)
    - Method: `cosineSimilarity(array $a, array $b): float`

- [ ] `app/Services/AiKnowledgeService.php`
    - Method: `processSource(AiKnowledgeSource $source, bool $force = false): void`
        - Idempotency guard: cek status `processing` atau `ready` tanpa force
        - Set `status = processing`
        - Hapus chunks lama: `$source->chunks()->delete()`
        - Parse sesuai `source_type` (text/pdf/excel/url)
        - Split jadi chunks ~500 token dengan overlap 50 token
        - Embed tiap chunk via `AiEmbeddingService::embed()`
        - Bulk insert ke `ai_knowledge_chunk`
        - Set `status = ready`, `processed_at = now()`, `error_message = null`
        - Catch exception → set `status = failed`, isi `error_message`
    - Method: `retrieveChunks(array $questionEmbedding, int $topN = 5): array`
        - Ambil semua chunk dari source `is_active = true` dan `status = ready`
        - Hitung cosine similarity tiap chunk
        - Return top N chunk diurutkan similarity tertinggi

- [ ] `app/Services/AiEntityService.php`
    - Method: `resolve(string $question): array`
    - Load semua nama branch dari cache (ttl 60 menit)
    - Cocokkan dengan `mb_stripos` atau `similar_text`
    - Jika ditemukan: query `Branch` + `Blog` (limit 3, active, latest)
    - Return array `['branch' => [...], 'blogs' => [...]]` atau `[]`

- [ ] `app/Services/AiChatService.php` ← orchestrator utama
    - Method: `chat(string $question, string $sessionId, array $history, string $ip): array`
    - Urutan: Guard → Entity → RAG → Prompt Assembly → LLM → Log → Return
    - Inject `AiGuardService`, `AiEmbeddingService`, `AiKnowledgeService`, `AiEntityService`
    - Ambil config dari `AiConfig::where('active', true)->first()`
    - Return `['answer' => '...', 'blocked' => false]`

---

## 5. Artisan Command

- [ ] `app/Console/Commands/ProcessKnowledgeSources.php`
    - Command: `ai:process-sources`
    - Signature: `ai:process-sources {--id= : Process specific source by id} {--force : Force re-process even if status=ready}`
    - Tanpa `--id`: proses semua yang `status = pending` atau `failed`
    - Dengan `--id`: proses source spesifik
    - Pakai `AiKnowledgeService::processSource()`

---

## 6. Controller & Routes

- [ ] `app/Http/Controllers/AiChatController.php`
    - Method: `chat(Request $request): JsonResponse`
    - Validasi: `question` required string max 1000, `session_id` required uuid, `history` array
    - Panggil `AiChatService::chat()`
    - Return JSON

- [ ] Tambahkan route di `routes/web.php`:
    ```php
    Route::post('/ai/chat', [AiChatController::class, 'chat'])
        ->middleware('throttle:20,1')
        ->name('ai.chat');
    ```

---

## 7. Filament Resources

Konvensi: modular (Schemas terpisah), label bahasa Indonesia, soft delete support, audit columns.
Navigation group: `AI Chat` (group baru).

- [x] `AiConfigResource`
    - Icon: `heroicon-o-cpu-chip`
    - Label: `Konfigurasi AI` / `Konfigurasi AI` / `Konfigurasi AI`
    - Single record (mirip `OrganizationResource`): index redirect ke view/edit record pertama
    - Pages: `View`, `Edit` (+ `Create` sebagai fallback)
    - Form fields:
        - Section `Pengaturan Model`: `model` (select), `temperature` (slider 0–1), `max_tokens` (number)
        - Section `Pesan`: `greeting_message` (text), `system_prompt` (textarea panjang)
        - Section `Guardrail Rules`:
            - `rules.banned_words` (TagsInput)
            - `rules.banned_topics` (TagsInput)
            - `rules.max_question_length` (number, default 500)
            - `rules.block_message` (text)
        - Section `Status`: `is_enabled` (toggle), `active` (toggle)

- [x] `AiKnowledgeSourceResource`
    - Icon: `heroicon-o-document-text`
    - Label: `Sumber Pengetahuan` / `Sumber Pengetahuan` / `Sumber Pengetahuan`
    - Pages: `List`, `Create`, `View`, `Edit`
    - Soft delete: ya (pakai `BaseModelSoftDeleteDefault`)
    - Form fields:
        - Section `Informasi`: `title`, `source_type` (select enum)
        - Section `Konten`: tampilkan field sesuai `source_type`:
            - `text` → `raw_content` (textarea)
            - `pdf` / `excel` → `file_path` (FileUpload, disk `public`, directory `ai/knowledge`)
            - `url` → `file_path` (text input URL)
        - Section `Status`: `is_active` (toggle), `active` (toggle)
    - Table columns: `title`, `source_type` (badge), `status` (badge warna), `is_active` (toggle), `processed_at`, audit columns
    - Table actions tambahan: **"Proses Ulang"** (action yang memanggil `AiKnowledgeService::processSource($record, force: true)`)
    - Notifikasi gagal: tampilkan banner warning di atas tabel jika ada source dengan `status = failed`
    - `afterCreate` hook: panggil `AiKnowledgeService::processSource($record)` → tampilkan Filament notification sukses/gagal
    - Filter: `status`, `source_type`, `is_active`

- [x] `AiChatLogResource`
    - Icon: `heroicon-o-chat-bubble-left-right`
    - Label: `Log Chat AI` / `Log Chat AI` / `Log Chat AI`
    - Pages: `List`, `View` saja (tidak bisa create/edit dari Filament)
    - Tidak ada soft delete
    - Table columns: `session_id` (truncated), `question` (limit 60 char), `model` (badge), `ip_address`, `created_at`
    - View/Infolist: tampilkan full `question`, `answer`, `sources_used` (JSON formatted), `entity_context` (JSON formatted), `model`, `ip_address`, `created_at`
    - Filter: `model`, `created_at` (date range), `session_id` (text search)
    - Tidak ada action create/edit/delete dari tabel (read-only)

---

## 8. Frontend Widget

- [ ] `resources/views/components/ai/chat-widget.blade.php`
    - Alpine.js `x-data="aiChatWidget()"`
    - Tombol FAB pojok kanan bawah (toggle buka/tutup)
    - Panel chat: header, area pesan scroll, input + tombol kirim
    - Generate `session_id` UUID saat pertama mount, simpan ke `sessionStorage`
    - Kirim via `fetch('/ai/chat', { method: 'POST', ... })` dengan CSRF token
    - Tampilkan loading indicator saat menunggu response
    - Tampilkan `greeting_message` dari config saat pertama buka
    - Widget tidak tampil jika `is_enabled = false`
    - Warna mengikuti palet project: `#001b79`, `#0453cd`, `#eef4ff`

- [ ] Include widget di `resources/views/layouts/public.blade.php`
    - Cek `is_enabled` dari config (via view composer atau helper)
    - Render widget hanya jika enabled

---

## 9. View Composer / Helper (Opsional)

- [ ] Tambahkan View Composer untuk inject `ai_enabled` ke semua view publik
    - Atau tambahkan helper `ai_config()` seperti pattern yang sudah ada di project
    - Cache config selama 5 menit agar tidak query DB tiap request

---

## Urutan Pengerjaan yang Disarankan

1. Install packages
2. Migration + `php artisan migrate`
3. Models
4. Services (mulai dari `AiEmbeddingService` → `AiGuardService` → `AiKnowledgeService` → `AiEntityService` → `AiChatService`)
5. Artisan command (untuk testing pipeline tanpa Filament)
6. Controller + routes
7. Filament: `AiConfigResource` → `AiKnowledgeSourceResource` → `AiChatLogResource`
8. Frontend widget
9. View Composer/Helper untuk `is_enabled` check

---

## Catatan Deploy ke Server

### Filament Shield — Generate Permission Resource Baru

Setelah deploy, jalankan command ini di server untuk mendaftarkan permission 3 resource AI yang baru:

```bash
php artisan shield:generate --resource=AiConfigResource,AiKnowledgeSourceResource,AiChatLogResource --panel=admin
```

**Aman dijalankan** — hanya menambah permission baru, tidak menghapus permission atau assignment role yang sudah ada.

Alternatif (generate ulang semua resource sekaligus, tetap aman):

```bash
php artisan shield:generate --all --panel=admin
```

**Jangan jalankan** perintah berikut karena akan reset semua permission dan role:

```bash
php artisan shield:install --fresh  # BERBAHAYA: menghapus semua permission lama
```

Setelah shield:generate selesai, buka panel Filament → Shield → assign permission group **AI Chat** ke role yang berhak (super_admin biasanya sudah otomatis dapat akses).

### Env Vars Baru

Tambahkan ke `.env` server sebelum deploy:

```
OPENAI_API_KEY=gsk_xxx          # Groq API key (untuk chat)
OPENAI_BASE_URI=api.groq.com/openai/v1
OPENAI_EMBEDDING_KEY=sk-xxx     # OpenAI API key (untuk embedding)
OPENAI_EMBEDDING_BASE_URI=api.openai.com/v1
AI_EMBEDDING_MODEL=text-embedding-3-small
AI_CHAT_MODEL=llama-3.3-70b-versatile
```

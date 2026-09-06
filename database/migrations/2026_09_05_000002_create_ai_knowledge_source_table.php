<?php

use App\Traits\BaseModelSoftDeleteDefault;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    use BaseModelSoftDeleteDefault;

    public function up(): void
    {
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
    }

    public function down(): void
    {
        Schema::dropIfExists('ai_knowledge_source');
    }
};

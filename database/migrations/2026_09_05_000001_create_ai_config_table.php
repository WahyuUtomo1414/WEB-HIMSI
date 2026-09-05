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
    }

    public function down(): void
    {
        Schema::dropIfExists('ai_config');
    }
};

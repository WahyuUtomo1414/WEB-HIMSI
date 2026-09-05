<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
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
    }

    public function down(): void
    {
        Schema::dropIfExists('ai_chat_log');
    }
};

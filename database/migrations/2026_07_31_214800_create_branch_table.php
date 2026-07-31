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
        Schema::create('branch', function (Blueprint $table) {
            $table->id();
            $table->string('name', 128);
            $table->string('location', 128);
            $table->string('thumbnail', 128);
            $table->text('description');
            $table->string('grup_wa', 128);
            $table->string('sektor', 128);
            $table->json('sosial_media');
            $table->boolean('is_dpp')->default(false)->index();
            $this->base($table);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('branch');
    }
};

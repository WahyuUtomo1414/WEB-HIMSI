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
        Schema::create('division', function (Blueprint $table) {
            $table->id();
            $table->string('name', 128);
            $table->string('logo', 128);
            $table->string('image', 128);
            $table->text('description');
            $table->json('job_description');
            $table->boolean('is_dpp')->default(false)->index();
            $this->base($table);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('division');
    }
};

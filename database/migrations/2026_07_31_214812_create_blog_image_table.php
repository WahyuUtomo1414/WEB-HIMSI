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
        Schema::create('blog_image', function (Blueprint $table) {
            $table->id();
            $table->foreignId('blog_id')->constrained('blog')->cascadeOnDelete();
            $table->string('image');
            $table->string('description');
            $this->base($table);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blog_image');
    }
};

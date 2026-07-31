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
        Schema::create('blog', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained('branch');
            $table->string('title', 128);
            $table->string('slug', 128);
            $table->string('thumbnail');
            $table->string('quotes')->nullable();
            $table->text('body');
            $table->foreignId('category_id')->constrained('category');
            $this->base($table);

            $table->index(['branch_id', 'category_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blog');
    }
};

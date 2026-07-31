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
        Schema::create('milestone', function (Blueprint $table) {
            $table->id();
            $table->integer('sort')->index();
            $table->date('year');
            $table->json('list');
            $this->base($table);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('milestone');
    }
};

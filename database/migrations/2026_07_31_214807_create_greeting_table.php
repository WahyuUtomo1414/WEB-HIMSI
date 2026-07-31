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
        Schema::create('greeting', function (Blueprint $table) {
            $table->id();
            $table->string('name', 128);
            $table->string('position', 128);
            $table->text('body');
            $table->string('image');
            $this->base($table);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('greeting');
    }
};

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
        Schema::create('contact', function (Blueprint $table) {
            $table->id();
            $table->string('name', 128);
            $table->string('email', 128);
            $table->string('subject');
            $table->text('message');
            $this->base($table);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact');
    }
};

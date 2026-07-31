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
        Schema::create('organization', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('kode_org', 128);
            $table->string('logo', 128);
            $table->text('description');
            $table->json('mision');
            $table->string('vision');
            $table->text('purpose');
            $table->string('address');
            $table->json('sosial_media');
            $table->string('email', 128);
            $table->string('no_tlpn', 18);
            $this->base($table);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('organization');
    }
};

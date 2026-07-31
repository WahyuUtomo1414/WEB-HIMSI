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
        Schema::create('branch_structure', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained('branch');
            $table->string('name', 128);
            $table->foreignId('division_id')->nullable()->constrained('division');
            $table->string('position', 128);
            $table->string('image');
            $table->string('no_wa', 18);
            $this->base($table);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('branch_structure');
    }
};

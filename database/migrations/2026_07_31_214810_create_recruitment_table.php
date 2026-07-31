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
        Schema::create('recruitment', function (Blueprint $table) {
            $table->id();
            $table->string('nim', 10)->index();
            $table->string('name', 128);
            $table->string('semester', 16);
            $table->string('ektm', 128);
            $table->string('email', 128)->index();
            $table->string('instagram', 128);
            $table->string('no_wa', 16);
            $table->text('description');
            $table->foreignId('branch_id')->constrained('branch');
            $table->string('follow_dpc', 128);
            $table->string('cv', 128)->nullable();
            $table->foreignId('status_id')->constrained('status');
            $this->base($table);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recruitment');
    }
};

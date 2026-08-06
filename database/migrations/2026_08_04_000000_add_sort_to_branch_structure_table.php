<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('branch_structure', 'sort')) {
            return;
        }

        Schema::table('branch_structure', function (Blueprint $table) {
            $table->unsignedInteger('sort')->default(0)->after('division_id');
        });
    }

    public function down(): void
    {
        if (! Schema::hasColumn('branch_structure', 'sort')) {
            return;
        }

        Schema::table('branch_structure', function (Blueprint $table) {
            $table->dropColumn('sort');
        });
    }
};

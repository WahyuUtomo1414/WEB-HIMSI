<?php

use App\Support\BranchStructurePosition;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('branch_structure', 'sort')) {
            Schema::table('branch_structure', function (Blueprint $table) {
                $table->unsignedInteger('sort')->default(0)->after('division_id');
            });
        }

        foreach (BranchStructurePosition::SORT_BY_POSITION as $position => $sort) {
            DB::table('branch_structure')
                ->where('position', $position)
                ->update(['sort' => $sort]);
        }
    }

    public function down(): void
    {
        //
    }
};

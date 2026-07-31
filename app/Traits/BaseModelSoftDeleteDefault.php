<?php

namespace App\Traits;

use Illuminate\Database\Schema\Blueprint;

trait BaseModelSoftDeleteDefault
{
    public function base(Blueprint $table): void
    {
        $table->boolean('active')->default(true);
        $table->unsignedBigInteger('created_by')->default(1)->index();
        $table->unsignedBigInteger('updated_by')->nullable()->index();
        $table->unsignedBigInteger('deleted_by')->nullable()->index();
        $table->timestamps();
        $table->softDeletes();
    }
}

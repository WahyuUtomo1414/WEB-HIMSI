<?php

namespace App\Models;

use App\Traits\AuditedBySoftDelete;
use App\Traits\FlushesPublicCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Division extends Model
{
    use AuditedBySoftDelete, FlushesPublicCache, HasFactory, SoftDeletes;

    protected $table = 'division';

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'job_description' => 'array',
            'is_dpp' => 'boolean',
        ];
    }

    public function structures(): HasMany
    {
        return $this->hasMany(BranchStructure::class, 'division_id');
    }

    public function recruitments(): HasMany
    {
        return $this->hasMany(Recruitment::class, 'division_id');
    }
}

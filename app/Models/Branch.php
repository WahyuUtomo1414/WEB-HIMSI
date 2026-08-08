<?php

namespace App\Models;

use App\Traits\AuditedBySoftDelete;
use App\Traits\FlushesPublicCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use AuditedBySoftDelete, FlushesPublicCache, HasFactory, SoftDeletes;

    protected $table = 'branch';

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'sosial_media' => 'array',
            'is_dpp' => 'boolean',
        ];
    }

    public function blogs(): HasMany
    {
        return $this->hasMany(Blog::class, 'branch_id');
    }

    public function recruitments(): HasMany
    {
        return $this->hasMany(Recruitment::class, 'branch_id');
    }

    public function structures(): HasMany
    {
        return $this->hasMany(BranchStructure::class, 'branch_id');
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'branch_id');
    }
}

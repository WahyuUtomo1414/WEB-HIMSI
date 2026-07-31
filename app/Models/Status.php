<?php

namespace App\Models;

use App\Traits\AuditedBySoftDelete;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model
{
    use AuditedBySoftDelete, HasFactory, SoftDeletes;

    protected $table = 'status';

    protected $guarded = ['id'];

    public function recruitments(): HasMany
    {
        return $this->hasMany(Recruitment::class, 'status_id');
    }
}

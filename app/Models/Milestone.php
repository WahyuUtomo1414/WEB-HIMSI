<?php

namespace App\Models;

use App\Traits\AuditedBySoftDelete;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Milestone extends Model
{
    use AuditedBySoftDelete, HasFactory, SoftDeletes;

    protected $table = 'milestone';

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'year' => 'date',
            'list' => 'array',
        ];
    }
}

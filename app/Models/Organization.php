<?php

namespace App\Models;

use App\Traits\AuditedBySoftDelete;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organization extends Model
{
    use AuditedBySoftDelete, HasFactory, SoftDeletes;

    protected $table = 'organization';

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'mision' => 'array',
            'sosial_media' => 'array',
        ];
    }
}

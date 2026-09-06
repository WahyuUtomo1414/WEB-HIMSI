<?php

namespace App\Models;

use App\Traits\AuditedBySoftDelete;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AiConfig extends Model
{
    use AuditedBySoftDelete, HasFactory, SoftDeletes;

    protected $table = 'ai_config';

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'rules' => 'array',
            'is_enabled' => 'boolean',
            'temperature' => 'float',
        ];
    }
}

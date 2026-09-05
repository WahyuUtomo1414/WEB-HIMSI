<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AiChatLog extends Model
{
    use HasFactory;

    protected $table = 'ai_chat_log';

    protected $guarded = ['id'];

    public $timestamps = false;

    protected function casts(): array
    {
        return [
            'sources_used' => 'array',
            'entity_context' => 'array',
            'created_at' => 'datetime',
        ];
    }
}

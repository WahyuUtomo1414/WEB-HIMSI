<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AiKnowledgeChunk extends Model
{
    use HasFactory;

    protected $table = 'ai_knowledge_chunk';

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'embedding' => 'array',
        ];
    }

    public function source(): BelongsTo
    {
        return $this->belongsTo(AiKnowledgeSource::class, 'source_id');
    }
}

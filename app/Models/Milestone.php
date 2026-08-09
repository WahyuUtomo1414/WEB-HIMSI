<?php

namespace App\Models;

use App\Support\MilestoneList;
use App\Traits\AuditedBySoftDelete;
use App\Traits\FlushesPublicCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Milestone extends Model
{
    use AuditedBySoftDelete, FlushesPublicCache, HasFactory, SoftDeletes;

    protected $table = 'milestone';

    protected $guarded = ['id'];

    protected static function booted(): void
    {
        static::creating(function (Milestone $milestone): void {
            if (filled($milestone->sort)) {
                return;
            }

            $milestone->sort = ((int) static::withTrashed()->max('sort')) + 1;
        });

        static::saving(function (Milestone $milestone): void {
            $milestone->list = MilestoneList::normalize($milestone->list);
        });
    }

    protected function casts(): array
    {
        return [
            'year' => 'date',
            'list' => 'array',
        ];
    }
}

<?php

namespace App\Traits;

use App\Support\PublicCache\PublicCacheInvalidator;

trait FlushesPublicCache
{
    public static function bootFlushesPublicCache(): void
    {
        static::saved(fn ($model) => PublicCacheInvalidator::forModel($model));
        static::deleted(fn ($model) => PublicCacheInvalidator::forModel($model));
        static::restored(fn ($model) => PublicCacheInvalidator::forModel($model));
        static::forceDeleted(fn ($model) => PublicCacheInvalidator::forModel($model));
    }
}

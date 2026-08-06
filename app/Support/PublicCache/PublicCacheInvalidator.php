<?php

namespace App\Support\PublicCache;

use App\Models\Blog;
use App\Models\BlogImage;
use App\Models\Branch;
use App\Models\BranchStructure;
use App\Models\Count;
use App\Models\Division;
use App\Models\Faq;
use App\Models\Greeting;
use App\Models\Milestone;
use App\Models\Organization;
use Illuminate\Database\Eloquent\Model;

class PublicCacheInvalidator
{
    public static function forModel(Model $model): void
    {
        match (true) {
            $model instanceof Organization => self::bump(['home', 'about', 'contact']),
            $model instanceof Count => self::bump(['home']),
            $model instanceof Greeting => self::bump(['home', 'about']),
            $model instanceof Division => self::bump(['home', 'about', 'division', 'branch']),
            $model instanceof Milestone => self::bump(['about']),
            $model instanceof Faq => self::bump(['home']),
            $model instanceof Branch => self::bump(['home', 'branch', 'blog']),
            $model instanceof BranchStructure => self::bump(['branch']),
            $model instanceof Blog => self::bump(['home', 'blog', 'branch']),
            $model instanceof BlogImage => self::bump(['blog']),
            default => null,
        };
    }

    private static function bump(array $scopes): void
    {
        foreach (array_unique($scopes) as $scope) {
            PublicCacheKey::bump($scope);
        }
    }
}

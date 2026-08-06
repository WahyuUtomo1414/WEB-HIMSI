<?php

namespace App\Support\PublicCache;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PublicCacheKey
{
    public static function home(): string
    {
        return 'public:home:v'.self::version('home');
    }

    public static function about(): string
    {
        return 'public:about:v'.self::version('about');
    }

    public static function contact(): string
    {
        return 'public:contact:v'.self::version('contact');
    }

    public static function branchIndex(Request $request): string
    {
        return 'public:branch:index:'.self::requestHash($request, ['search', 'sektor', 'type']).':v'.self::version('branch');
    }

    public static function branchShow(int|string $branchId): string
    {
        return 'public:branch:show:'.$branchId.':v'.self::version('branch');
    }

    public static function blogIndex(Request $request): string
    {
        return 'public:blog:index:'.self::requestHash($request, ['search', 'category', 'page']).':v'.self::version('blog');
    }

    public static function blogShow(string $slug): string
    {
        return 'public:blog:show:'.$slug.':v'.self::version('blog');
    }

    public static function divisionShow(int|string $divisionId): string
    {
        return 'public:division:show:'.$divisionId.':v'.self::version('division');
    }

    private static function version(string $scope): int
    {
        return (int) Cache::get(self::versionKey($scope), 1);
    }

    public static function bump(string $scope): void
    {
        if (! Cache::has(self::versionKey($scope))) {
            Cache::put(self::versionKey($scope), 1);
        }

        Cache::increment(self::versionKey($scope));
    }

    private static function versionKey(string $scope): string
    {
        return 'public:cache-version:'.$scope;
    }

    private static function requestHash(Request $request, array $keys): string
    {
        $payload = [];

        foreach ($keys as $key) {
            $payload[$key] = $request->query($key, $key === 'page' ? 1 : '');
        }

        return md5(json_encode($payload));
    }
}

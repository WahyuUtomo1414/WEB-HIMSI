<?php

namespace App\Support\PublicData;

use App\Models\Division;
use App\Models\Organization;
use Illuminate\Database\Eloquent\Collection;

class GlobalData
{
    private static bool $loaded = false;

    private static ?Organization $organization = null;

    private static ?Collection $divisions = null;

    public static function load(): void
    {
        if (self::$loaded) {
            return;
        }

        self::$loaded = true;

        try {
            self::$organization = Organization::query()
                ->where('active', true)
                ->latest()
                ->first();

            self::$divisions = Division::query()
                ->where('active', true)
                ->orderBy('name')
                ->limit(6)
                ->get();
        } catch (\Throwable) {
            self::$divisions = new Collection();
        }
    }

    public static function organization(): ?Organization
    {
        return self::$organization;
    }

    public static function divisions(): Collection
    {
        return self::$divisions ?? new Collection();
    }
}

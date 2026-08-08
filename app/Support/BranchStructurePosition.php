<?php

namespace App\Support;

class BranchStructurePosition
{
    public const SORT_BY_POSITION = [
        'Ketua' => 1,
        'Wakil Ketua' => 2,
        'Sekertaris 1' => 3,
        'Sekertaris 2' => 4,
        'Bendahara' => 5,
        'Koor Div Pendidikan' => 6,
        'Koor Div RSDM' => 7,
        'Koor Div Litbang' => 8,
        'Koor Div Kominfo' => 9,
        'Koor Div Sosmas' => 10,
        'Koor Div PSDM' => 11,
    ];

    public static function options(): array
    {
        return collect(array_keys(self::SORT_BY_POSITION))
            ->mapWithKeys(fn (string $position): array => [$position => $position])
            ->all();
    }

    public static function sortFor(?string $position): int
    {
        return self::SORT_BY_POSITION[$position ?? ''] ?? 99;
    }
}

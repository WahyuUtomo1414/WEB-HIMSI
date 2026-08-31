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
        'Bendahara 2' => 6,
        'Koor Div Pendidikan' => 7,
        'Koor Div RSDM' => 8,
        'Koor Div Litbang' => 9,
        'Koor Div Kominfo' => 10,
        'Koor Div Sosmas' => 11,
        'Koor Div PSDM' => 12,
    ];

    public static function options(): array
    {
        return collect(array_keys(self::SORT_BY_POSITION))
            ->mapWithKeys(fn (string $position): array => [$position => $position])
            ->all();
    }

    public static function optionsFor(bool $isDpp): array
    {
        $excluded = $isDpp
            ? ['Koor Div RSDM', 'Koor Div Litbang']
            : ['Koor Div Sosmas', 'Koor Div PSDM'];

        return collect(array_keys(self::SORT_BY_POSITION))
            ->reject(fn (string $position): bool => in_array($position, $excluded))
            ->mapWithKeys(fn (string $position): array => [$position => $position])
            ->all();
    }

    public static function sortFor(?string $position): int
    {
        return self::SORT_BY_POSITION[$position ?? ''] ?? 99;
    }
}

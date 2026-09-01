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
        'Staff Pendidikan' => 8,
        'Koor Div RSDM' => 9,
        'Staff RSDM' => 10,
        'Koor Div Litbang' => 11,
        'Staff Litbang' => 12,
        'Koor Div Kominfo' => 13,
        'Staff Kominfo' => 14,
        'Koor Div Sosmas' => 15,
        'Staff Sosmas' => 16,
        'Koor Div PSDM' => 17,
        'Staff PSDM' => 18,
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
            ? ['Koor Div RSDM', 'Staff RSDM', 'Koor Div Litbang', 'Staff Litbang']
            : ['Koor Div Sosmas', 'Staff Sosmas', 'Koor Div PSDM', 'Staff PSDM'];

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

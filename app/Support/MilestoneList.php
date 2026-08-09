<?php

namespace App\Support;

class MilestoneList
{
    public static function normalize(mixed $items): array
    {
        if (! is_array($items)) {
            return [];
        }

        return collect($items)
            ->map(function (mixed $item): ?array {
                if (is_array($item)) {
                    $value = $item['value'] ?? reset($item);

                    return filled($value) ? ['value' => $value] : null;
                }

                return filled($item) ? ['value' => $item] : null;
            })
            ->filter()
            ->values()
            ->all();
    }
}

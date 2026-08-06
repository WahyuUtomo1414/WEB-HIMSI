<?php

namespace App\Filament\Resources\Recruitments\Support;

class WhatsAppFormatter
{
    public static function normalize(?string $number): ?string
    {
        if (blank($number)) {
            return null;
        }

        $number = preg_replace('/\D+/', '', $number);

        if (blank($number)) {
            return null;
        }

        if (str_starts_with($number, '0')) {
            return '62'.substr($number, 1);
        }

        if (str_starts_with($number, '8')) {
            return '62'.$number;
        }

        return $number;
    }

    public static function url(?string $number): ?string
    {
        $normalized = self::normalize($number);

        return filled($normalized) ? 'https://wa.me/'.$normalized : null;
    }
}

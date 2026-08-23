<?php

use Illuminate\Support\Facades\Storage;

if (! function_exists('public_image_url')) {
    function public_image_url(?string $path, string $fallback = '/images/placeholder.svg'): string
    {
        if (blank($path)) {
            return $fallback;
        }

        if (str($path)->startsWith(['http://', 'https://'])) {
            return $path;
        }

        if (str($path)->startsWith(['/images/', 'images/'])) {
            return str($path)->startsWith('/') ? $path : '/' . $path;
        }

        return Storage::disk('public')->url($path);
    }
}

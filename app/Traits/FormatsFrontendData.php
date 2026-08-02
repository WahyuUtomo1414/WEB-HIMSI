<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait FormatsFrontendData
{
    /**
     * Format file or image path to full public URL.
     */
    protected function formatImageUrl(?string $path, string $fallback = '/images/placeholder.svg'): string
    {
        if (empty($path)) {
            return $fallback;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        if (str_starts_with($path, '/images/') || str_starts_with($path, 'images/')) {
            return asset(ltrim($path, '/'));
        }

        return Storage::url($path);
    }
}

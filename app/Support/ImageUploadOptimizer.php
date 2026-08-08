<?php

namespace App\Support;

use Filament\Forms\Components\BaseFileUpload;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Throwable;

class ImageUploadOptimizer
{
    /**
     * Store a Filament image upload as WebP and return the relative storage path.
     */
    public static function storeWebp(
        BaseFileUpload $component,
        TemporaryUploadedFile $file,
        int $maxWidth = 1600,
        int $quality = 85,
    ): ?string {
        if (! self::isSupportedImage($file)) {
            return $component->saveUploadedFile($file);
        }

        try {
            Image::configure(['driver' => 'gd']);

            $image = Image::make($file->getRealPath())->orientate();

            if ($image->width() > $maxWidth) {
                $image->resize($maxWidth, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
            }

            $directory = trim((string) $component->getDirectory(), '/');
            $filename = Str::ulid().'.webp';
            $path = trim($directory.'/'.$filename, '/');

            $component->getDisk()->put($path, (string) $image->encode('webp', $quality));

            if ($component->getVisibility() === 'public') {
                rescue(fn () => $component->getDisk()->setVisibility($path, 'public'), report: false);
            }

            return $path;
        } catch (Throwable $exception) {
            Log::error('Error converting image upload to WebP: '.$exception->getMessage(), [
                'filename' => $file->getClientOriginalName(),
                'mime' => $file->getMimeType(),
                'disk' => $component->getDiskName(),
                'directory' => $component->getDirectory(),
            ]);

            return $component->saveUploadedFile($file);
        }
    }

    public static function storeUploadedWebp(
        UploadedFile $file,
        string $disk,
        string $directory,
        int $maxWidth = 1600,
        int $quality = 85,
    ): string {
        if (! self::isSupportedImage($file)) {
            return $file->store($directory, $disk);
        }

        try {
            Image::configure(['driver' => 'gd']);

            $image = Image::make($file->getRealPath())->orientate();

            if ($image->width() > $maxWidth) {
                $image->resize($maxWidth, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
            }

            $path = trim(trim($directory, '/').'/'.Str::ulid().'.webp', '/');

            Storage::disk($disk)->put($path, (string) $image->encode('webp', $quality));
            Storage::disk($disk)->setVisibility($path, 'public');

            return $path;
        } catch (Throwable $exception) {
            Log::error('Error converting uploaded image to WebP: '.$exception->getMessage(), [
                'filename' => $file->getClientOriginalName(),
                'mime' => $file->getMimeType(),
                'disk' => $disk,
                'directory' => $directory,
            ]);

            return $file->store($directory, $disk);
        }
    }

    private static function isSupportedImage(UploadedFile $file): bool
    {
        return in_array($file->getMimeType(), [
            'image/jpeg',
            'image/png',
            'image/webp',
        ], true);
    }
}

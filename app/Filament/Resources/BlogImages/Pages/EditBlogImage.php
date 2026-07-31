<?php

namespace App\Filament\Resources\BlogImages\Pages;

use App\Filament\Resources\BlogImages\BlogImageResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditBlogImage extends EditRecord
{
    protected static string $resource = BlogImageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make()->label('Lihat'),
            DeleteAction::make()->label('Hapus'),
            ForceDeleteAction::make()->label('Hapus'),
            RestoreAction::make()->label('Pulihkan'),
        ];
    }
}

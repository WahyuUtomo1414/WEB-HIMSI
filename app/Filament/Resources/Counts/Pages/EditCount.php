<?php

namespace App\Filament\Resources\Counts\Pages;

use App\Filament\Resources\Counts\CountResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditCount extends EditRecord
{
    protected static string $resource = CountResource::class;

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

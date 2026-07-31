<?php

namespace App\Filament\Resources\Counts\Pages;

use App\Filament\Resources\Counts\CountResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewCount extends ViewRecord
{
    protected static string $resource = CountResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()->label('Edit'),
        ];
    }
}

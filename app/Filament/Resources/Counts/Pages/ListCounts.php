<?php

namespace App\Filament\Resources\Counts\Pages;

use App\Filament\Resources\Counts\CountResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCounts extends ListRecords
{
    protected static string $resource = CountResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('Buat'),
        ];
    }
}

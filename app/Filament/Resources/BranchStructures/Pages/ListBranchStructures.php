<?php

namespace App\Filament\Resources\BranchStructures\Pages;

use App\Filament\Resources\BranchStructures\BranchStructureResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBranchStructures extends ListRecords
{
    protected static string $resource = BranchStructureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('Buat'),
        ];
    }
}

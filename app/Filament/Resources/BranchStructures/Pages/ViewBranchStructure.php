<?php

namespace App\Filament\Resources\BranchStructures\Pages;

use App\Filament\Resources\BranchStructures\BranchStructureResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewBranchStructure extends ViewRecord
{
    protected static string $resource = BranchStructureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()->label('Edit'),
        ];
    }
}

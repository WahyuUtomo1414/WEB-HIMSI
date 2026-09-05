<?php

namespace App\Filament\Resources\AiConfigs\Pages;

use App\Filament\Resources\AiConfigs\AiConfigResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewAiConfig extends ViewRecord
{
    protected static string $resource = AiConfigResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()->label('Edit'),
        ];
    }
}

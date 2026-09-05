<?php

namespace App\Filament\Resources\AiConfigs\Pages;

use App\Filament\Resources\AiConfigs\AiConfigResource;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditAiConfig extends EditRecord
{
    protected static string $resource = AiConfigResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make()->label('Lihat'),
        ];
    }
}

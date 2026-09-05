<?php

namespace App\Filament\Resources\AiChatLogs\Pages;

use App\Filament\Resources\AiChatLogs\AiChatLogResource;
use Filament\Resources\Pages\ViewRecord;

class ViewAiChatLog extends ViewRecord
{
    protected static string $resource = AiChatLogResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}

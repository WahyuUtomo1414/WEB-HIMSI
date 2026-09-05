<?php

namespace App\Filament\Resources\AiChatLogs\Pages;

use App\Filament\Resources\AiChatLogs\AiChatLogResource;
use Filament\Resources\Pages\ListRecords;

class ListAiChatLogs extends ListRecords
{
    protected static string $resource = AiChatLogResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}

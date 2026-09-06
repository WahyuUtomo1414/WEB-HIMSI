<?php

namespace App\Filament\Resources\AiKnowledgeSources\Pages;

use App\Filament\Resources\AiKnowledgeSources\AiKnowledgeSourceResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewAiKnowledgeSource extends ViewRecord
{
    protected static string $resource = AiKnowledgeSourceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()->label('Edit'),
        ];
    }
}

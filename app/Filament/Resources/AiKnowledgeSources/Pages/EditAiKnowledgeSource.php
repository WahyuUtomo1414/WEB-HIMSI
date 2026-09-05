<?php

namespace App\Filament\Resources\AiKnowledgeSources\Pages;

use App\Filament\Resources\AiKnowledgeSources\AiKnowledgeSourceResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditAiKnowledgeSource extends EditRecord
{
    protected static string $resource = AiKnowledgeSourceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make()->label('Lihat'),
            DeleteAction::make()->label('Hapus'),
            ForceDeleteAction::make()->label('Hapus Permanen'),
            RestoreAction::make()->label('Pulihkan'),
        ];
    }
}

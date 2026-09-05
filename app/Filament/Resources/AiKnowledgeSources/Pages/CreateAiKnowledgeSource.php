<?php

namespace App\Filament\Resources\AiKnowledgeSources\Pages;

use App\Filament\Resources\AiKnowledgeSources\AiKnowledgeSourceResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateAiKnowledgeSource extends CreateRecord
{
    protected static string $resource = AiKnowledgeSourceResource::class;

    protected function afterCreate(): void
    {
        $record = $this->record;

        try {
            app(\App\Services\AiKnowledgeService::class)->processSource($record);

            Notification::make()
                ->title('Sumber berhasil diproses')
                ->body("Embedding selesai. Sumber \"{$record->title}\" siap digunakan.")
                ->success()
                ->send();
        } catch (\Throwable $e) {
            Notification::make()
                ->title('Gagal memproses sumber')
                ->body($e->getMessage())
                ->danger()
                ->persistent()
                ->send();
        }
    }
}

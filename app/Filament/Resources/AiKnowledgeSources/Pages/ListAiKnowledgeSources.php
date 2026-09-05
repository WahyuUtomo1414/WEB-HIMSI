<?php

namespace App\Filament\Resources\AiKnowledgeSources\Pages;

use App\Filament\Resources\AiKnowledgeSources\AiKnowledgeSourceResource;
use App\Models\AiKnowledgeSource;
use Filament\Actions\CreateAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;

class ListAiKnowledgeSources extends ListRecords
{
    protected static string $resource = AiKnowledgeSourceResource::class;

    public function mount(): void
    {
        parent::mount();

        $failedCount = AiKnowledgeSource::query()->where('status', 'failed')->count();

        if ($failedCount > 0) {
            Notification::make()
                ->title("{$failedCount} sumber gagal diproses")
                ->body('Klik "Proses Ulang" pada baris yang berstatus Failed untuk mencoba lagi.')
                ->warning()
                ->persistent()
                ->send();
        }
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('Tambah Sumber'),
        ];
    }
}

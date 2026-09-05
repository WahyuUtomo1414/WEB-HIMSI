<?php

namespace App\Filament\Resources\AiConfigs\Pages;

use App\Filament\Resources\AiConfigs\AiConfigResource;
use App\Models\AiConfig;
use Filament\Resources\Pages\ListRecords;

class ListAiConfigs extends ListRecords
{
    protected static string $resource = AiConfigResource::class;

    public function mount(): void
    {
        $config = AiConfig::query()->where('active', true)->first() ?? AiConfig::query()->first();

        $this->redirect($config
            ? AiConfigResource::getUrl('view', ['record' => $config])
            : AiConfigResource::getUrl('create'));
    }
}

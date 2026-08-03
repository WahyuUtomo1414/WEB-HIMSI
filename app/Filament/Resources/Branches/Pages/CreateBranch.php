<?php

namespace App\Filament\Resources\Branches\Pages;

use App\Filament\Resources\Branches\BranchResource;
use Filament\Resources\Pages\CreateRecord;

class CreateBranch extends CreateRecord
{
    protected static string $resource = BranchResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['sosial_media'] = $this->normalizeSocialMedia($data['sosial_media'] ?? []);

        return $data;
    }

    private function normalizeSocialMedia(array $socialMedia): array
    {
        $normalized = [];

        foreach ($socialMedia as $key => $value) {
            if (is_array($value)) {
                $platform = $value['platform'] ?? null;
                $url = $value['url'] ?? $value['value'] ?? null;
            } else {
                $platform = is_string($key) ? $key : null;
                $url = $value;
            }

            if (filled($platform) && filled($url)) {
                $normalized[(string) $platform] = $url;
            }
        }

        return $normalized;
    }
}

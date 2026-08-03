<?php

namespace App\Filament\Resources\Organizations\Pages;

use App\Filament\Resources\Organizations\OrganizationResource;
use Filament\Resources\Pages\CreateRecord;

class CreateOrganization extends CreateRecord
{
    protected static string $resource = OrganizationResource::class;

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

<?php

namespace App\Filament\Resources\Organizations\Pages;

use App\Filament\Resources\Organizations\OrganizationResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditOrganization extends EditRecord
{
    protected static string $resource = OrganizationResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['sosial_media'] = $this->normalizeSocialMedia($data['sosial_media'] ?? []);

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['sosial_media'] = $this->normalizeSocialMedia($data['sosial_media'] ?? []);

        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make()->label('Lihat'),
            DeleteAction::make()->label('Hapus'),
            ForceDeleteAction::make()->label('Hapus'),
            RestoreAction::make()->label('Pulihkan'),
        ];
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

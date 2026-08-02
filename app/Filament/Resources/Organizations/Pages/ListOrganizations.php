<?php

namespace App\Filament\Resources\Organizations\Pages;

use App\Filament\Resources\Organizations\OrganizationResource;
use App\Models\Organization;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListOrganizations extends ListRecords
{
    protected static string $resource = OrganizationResource::class;

    public function mount(): void
    {
        $organization = Organization::query()->first();

        $this->redirect($organization
            ? OrganizationResource::getUrl('view', ['record' => $organization])
            : OrganizationResource::getUrl('create'));
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('Buat'),
        ];
    }
}

<?php

namespace App\Filament\Resources\BlogImages\Pages;

use App\Filament\Resources\BlogImages\BlogImageResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewBlogImage extends ViewRecord
{
    protected static string $resource = BlogImageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()->label('Edit'),
        ];
    }
}

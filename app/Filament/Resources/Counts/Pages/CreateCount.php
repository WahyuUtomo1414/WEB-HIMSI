<?php

namespace App\Filament\Resources\Counts\Pages;

use App\Filament\Resources\Counts\CountResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCount extends CreateRecord
{
    protected static string $resource = CountResource::class;
}

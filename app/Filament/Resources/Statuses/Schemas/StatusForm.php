<?php

namespace App\Filament\Resources\Statuses\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class StatusForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')->label('Nama Status')->maxLength(128)->required()->unique(ignoreRecord: true),
            Textarea::make('description')->label('Deskripsi')->required()->columnSpanFull(),
            Toggle::make('active')->label('Aktif')->default(true)->required(),
        ]);
    }
}

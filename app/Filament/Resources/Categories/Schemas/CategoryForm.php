<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')->label('Nama Kategori')->maxLength(128)->required()->unique(ignoreRecord: true),
            Textarea::make('description')->label('Deskripsi')->columnSpanFull(),
            Toggle::make('active')->label('Aktif')->default(true)->required(),
        ]);
    }
}

<?php

namespace App\Filament\Resources\Branches\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class BranchForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')->label('Nama Branch')->maxLength(128)->required(),
            TextInput::make('location')->label('Lokasi')->maxLength(128)->required(),
            FileUpload::make('thumbnail')->label('Thumbnail')->image()->disk('public')->directory('branch')->visibility('public')->preserveFilenames()->maxSize(2048)->required(),
            Textarea::make('description')->label('Deskripsi')->required()->columnSpanFull(),
            TextInput::make('grup_wa')->label('Grup WhatsApp')->maxLength(128)->required(),
            TextInput::make('sektor')->label('Sektor')->maxLength(128)->required(),
            KeyValue::make('sosial_media')->label('Sosial Media')->keyLabel('Platform')->valueLabel('URL')->required()->columnSpanFull(),
            Toggle::make('is_dpp')->label('DPP')->default(false)->required(),
            Toggle::make('active')->label('Aktif')->default(true)->required(),
        ]);
    }
}

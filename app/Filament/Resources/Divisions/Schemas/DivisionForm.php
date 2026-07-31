<?php

namespace App\Filament\Resources\Divisions\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class DivisionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')->label('Nama Divisi')->maxLength(128)->required(),
            FileUpload::make('logo')->label('Logo')->image()->disk('public')->directory('division/logo')->visibility('public')->preserveFilenames()->maxSize(2048)->required(),
            FileUpload::make('image')->label('Gambar')->image()->disk('public')->directory('division/image')->visibility('public')->preserveFilenames()->maxSize(2048)->required(),
            Textarea::make('description')->label('Deskripsi')->required()->columnSpanFull(),
            KeyValue::make('job_description')->label('Job Description')->keyLabel('Urutan')->valueLabel('Deskripsi')->required()->columnSpanFull(),
            Toggle::make('is_dpp')->label('DPP')->default(false)->required(),
            Toggle::make('active')->label('Aktif')->default(true)->required(),
        ]);
    }
}

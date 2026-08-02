<?php

namespace App\Filament\Resources\Greetings\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class GreetingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Informasi Utama')
                ->schema([
                    TextInput::make('name')->label('Nama')->maxLength(128)->required(),
                    TextInput::make('position')->label('Posisi')->maxLength(128)->required(),
                    RichEditor::make('body')->label('Isi Sambutan')->required()->columnSpanFull(),
                    FileUpload::make('image')->label('Gambar')->image()->disk('public')->directory('greeting')->visibility('public')->preserveFilenames()->maxSize(2048)->required(),
                    Toggle::make('active')->label('Aktif')->default(true)->required(),
                ])
                ->columns(2)
                ->columnSpanFull(),
        ]);
    }
}

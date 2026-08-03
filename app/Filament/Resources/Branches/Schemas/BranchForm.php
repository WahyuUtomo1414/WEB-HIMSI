<?php

namespace App\Filament\Resources\Branches\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BranchForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Informasi Utama')
                ->schema([
                    TextInput::make('name')->label('Nama Branch')->maxLength(128)->required(),
                    TextInput::make('location')->label('Lokasi')->maxLength(128)->required(),
                    FileUpload::make('thumbnail')->label('Thumbnail')->image()->disk('public')->directory('branch')->visibility('public')->preserveFilenames()->maxSize(2048)->required(),
                    Textarea::make('description')->label('Deskripsi')->required()->columnSpanFull(),
                    TextInput::make('grup_wa')->label('Grup WhatsApp')->maxLength(128)->required(),
                    TextInput::make('sektor')->label('Sektor')->maxLength(128)->required(),
                    Section::make('Sosial Media')
                        ->schema([
                            TextInput::make('sosial_media.instagram')->label('Instagram')->url()->maxLength(255),
                            TextInput::make('sosial_media.website')->label('Website')->url()->maxLength(255),
                            TextInput::make('sosial_media.youtube')->label('YouTube')->url()->maxLength(255),
                            TextInput::make('sosial_media.linkedin')->label('LinkedIn')->url()->maxLength(255),
                            TextInput::make('sosial_media.tiktok')->label('TikTok')->url()->maxLength(255),
                            TextInput::make('sosial_media.facebook')->label('Facebook')->url()->maxLength(255),
                            TextInput::make('sosial_media.wa')->label('WhatsApp')->maxLength(255),
                        ])
                        ->columns(2)
                        ->columnSpanFull(),
                    Toggle::make('is_dpp')->label('DPP')->default(false)->required(),
                    Toggle::make('active')->label('Aktif')->default(true)->required(),
                ])
                ->columns(2)
                ->columnSpanFull(),
        ]);
    }
}

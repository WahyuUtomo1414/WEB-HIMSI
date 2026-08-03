<?php

namespace App\Filament\Resources\Branches\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
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
                    Repeater::make('sosial_media')
                        ->label('Sosial Media')
                        ->schema([
                            Select::make('platform')
                                ->label('Platform')
                                ->options([
                                    'instagram' => 'Instagram',
                                    'email' => 'Email',
                                    'linkedin' => 'LinkedIn',
                                    'tiktok' => 'TikTok',
                                    'youtube' => 'YouTube',
                                    'facebook' => 'Facebook',
                                    'wa' => 'WhatsApp',
                                ])
                                ->required(),
                            TextInput::make('url')
                                ->label('Link / Username / Nomor')
                                ->required()
                                ->maxLength(255),
                        ])
                        ->columns(2)
                        ->addActionLabel('Tambah Sosial Media')
                        ->defaultItems(0)
                        ->reorderable()
                        ->columnSpanFull(),
                    Toggle::make('is_dpp')->label('DPP')->default(false)->required(),
                    Toggle::make('active')->label('Aktif')->default(true)->required(),
                ])
                ->columns(2)
                ->columnSpanFull(),
        ]);
    }
}

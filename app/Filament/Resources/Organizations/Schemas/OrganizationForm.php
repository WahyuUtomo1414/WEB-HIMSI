<?php

namespace App\Filament\Resources\Organizations\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class OrganizationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Informasi Utama')
                ->schema([
                    TextInput::make('name')->label('Nama Organisasi')->maxLength(255)->required(),
                    TextInput::make('kode_org')->label('Kode Organisasi')->maxLength(128)->required(),
                    FileUpload::make('logo')->label('Logo')->image()->disk('public')->directory('organization')->visibility('public')->preserveFilenames()->maxSize(2048)->required(),
                    FileUpload::make('thumbnail')->label('Thumbnail')->image()->disk('public')->directory('organization/thumbnail')->visibility('public')->preserveFilenames()->maxSize(2048)->required(),
                    Textarea::make('description')->label('Deskripsi')->required()->columnSpanFull(),
                    Repeater::make('mision')
                        ->label('Misi')
                        ->schema([
                            Textarea::make('value')
                                ->label('Misi')
                                ->required()
                                ->columnSpanFull(),
                        ])
                        ->addActionLabel('Tambah Misi')
                        ->defaultItems(1)
                        ->reorderable()
                        ->required()
                        ->columnSpanFull(),
                    TextInput::make('vision')->label('Visi')->maxLength(255)->required()->columnSpanFull(),
                    Textarea::make('purpose')->label('Tujuan')->required()->columnSpanFull(),
                    TextInput::make('address')->label('Alamat')->maxLength(255)->required()->columnSpanFull(),
                    Repeater::make('sosial_media')
                        ->label('Sosial Media')
                        ->schema([
                            TextInput::make('value')
                                ->label('Kontak atau URL')
                                ->required()
                                ->maxLength(255),
                        ])
                        ->addActionLabel('Tambah Sosial Media')
                        ->defaultItems(1)
                        ->reorderable()
                        ->required()
                        ->columnSpanFull(),
                    TextInput::make('email')->label('Email')->email()->maxLength(128)->required(),
                    TextInput::make('no_tlpn')->label('Nomor Telepon')->maxLength(18)->required(),
                    Toggle::make('active')->label('Aktif')->default(true)->required(),
                ])
                ->columns(2)
                ->columnSpanFull(),
        ]);
    }
}

<?php

namespace App\Filament\Resources\Organizations\Schemas;

use App\Support\ImageUploadOptimizer;
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
                    FileUpload::make('logo')->label('Logo')->image()->disk('public')->directory('organization')->visibility('public')->maxSize(2048)->helperText('Format gambar. Maksimal 2 MB. Rekomendasi 512 x 512 px. Otomatis dikonversi ke WebP.')->saveUploadedFileUsing(fn ($component, $file) => ImageUploadOptimizer::storeWebp($component, $file, maxWidth: 512, quality: 90))->required(),
                    FileUpload::make('thumbnail')->label('Thumbnail')->image()->disk('public')->directory('organization/thumbnail')->visibility('public')->maxSize(2048)->helperText('Format gambar. Maksimal 2 MB. Rekomendasi 1600 x 900 px. Otomatis dikonversi ke WebP.')->saveUploadedFileUsing(fn ($component, $file) => ImageUploadOptimizer::storeWebp($component, $file, maxWidth: 1600, quality: 85))->required(),
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
                    Section::make('Sosial Media')
                        ->schema([
                            TextInput::make('sosial_media.instagram')->label('Instagram')->url()->maxLength(255),
                            TextInput::make('sosial_media.website')->label('Website')->url()->maxLength(255),
                            TextInput::make('sosial_media.youtube')->label('YouTube')->url()->maxLength(255),
                            TextInput::make('sosial_media.linkedin')->label('LinkedIn')->url()->maxLength(255),
                            TextInput::make('sosial_media.tiktok')->label('TikTok')->url()->maxLength(255),
                            TextInput::make('sosial_media.facebook')->label('Facebook')->url()->maxLength(255),
                            TextInput::make('sosial_media.wa')->label('WhatsApp')->maxLength(255),
                            TextInput::make('sosial_media.email')->label('Email Sosial')->email()->maxLength(255),
                        ])
                        ->columns(2)
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

<?php

namespace App\Filament\Resources\Divisions\Schemas;

use App\Support\ImageUploadOptimizer;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class DivisionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Informasi Utama')
                ->schema([
                    TextInput::make('name')->label('Nama Divisi')->maxLength(128)->required(),
                    FileUpload::make('logo')->label('Logo')->image()->disk('public')->directory('division/logo')->visibility('public')->maxSize(2048)->helperText('Format gambar. Maksimal 2 MB. Rekomendasi 512 x 512 px. Otomatis dikonversi ke WebP.')->saveUploadedFileUsing(fn ($component, $file) => ImageUploadOptimizer::storeWebp($component, $file, maxWidth: 512, quality: 90))->required(),
                    FileUpload::make('image')->label('Gambar')->image()->disk('public')->directory('division/image')->visibility('public')->maxSize(2048)->helperText('Format gambar. Maksimal 2 MB. Rekomendasi 1600 x 900 px. Otomatis dikonversi ke WebP.')->saveUploadedFileUsing(fn ($component, $file) => ImageUploadOptimizer::storeWebp($component, $file, maxWidth: 1600, quality: 85))->required(),
                    Textarea::make('description')->label('Deskripsi')->required()->columnSpanFull(),
                    KeyValue::make('job_description')->label('Job Description')->keyLabel('Urutan')->valueLabel('Deskripsi')->required()->columnSpanFull(),
                    Toggle::make('is_dpp')->label('DPP')->default(false)->required(),
                    Toggle::make('active')->label('Aktif')->default(true)->required(),
                ])
                ->columns(2)
                ->columnSpanFull(),
        ]);
    }
}

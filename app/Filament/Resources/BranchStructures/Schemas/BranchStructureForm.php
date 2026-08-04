<?php

namespace App\Filament\Resources\BranchStructures\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BranchStructureForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Informasi Utama')
                ->schema([
                    Select::make('branch_id')->label('Branch')->relationship('branch', 'name')->searchable()->preload()->required(),
                    TextInput::make('name')->label('Nama Pengurus')->maxLength(128)->required(),
                    Select::make('division_id')->label('Divisi')->relationship('division', 'name')->searchable()->preload(),
                    TextInput::make('sort')->label('Urutan')->numeric()->default(0)->minValue(0)->required(),
                    TextInput::make('position')->label('Posisi')->maxLength(128)->required(),
                    FileUpload::make('image')->label('Foto')->image()->disk('public')->directory('branch_structure')->visibility('public')->preserveFilenames()->maxSize(2048)->required(),
                    TextInput::make('no_wa')->label('Nomor WhatsApp')->maxLength(18)->required(),
                    Toggle::make('active')->label('Aktif')->default(true)->required(),
                ])
                ->columns(2)
                ->columnSpanFull(),
        ]);
    }
}

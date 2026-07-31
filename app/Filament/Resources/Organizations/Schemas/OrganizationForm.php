<?php

namespace App\Filament\Resources\Organizations\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class OrganizationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')->label('Nama Organisasi')->maxLength(255)->required(),
            TextInput::make('kode_org')->label('Kode Organisasi')->maxLength(128)->required(),
            FileUpload::make('logo')->label('Logo')->image()->disk('public')->directory('organization')->visibility('public')->preserveFilenames()->maxSize(2048)->required(),
            Textarea::make('description')->label('Deskripsi')->required()->columnSpanFull(),
            KeyValue::make('mision')->label('Misi')->keyLabel('Urutan')->valueLabel('Misi')->required()->columnSpanFull(),
            TextInput::make('vision')->label('Visi')->maxLength(255)->required()->columnSpanFull(),
            Textarea::make('purpose')->label('Tujuan')->required()->columnSpanFull(),
            TextInput::make('address')->label('Alamat')->maxLength(255)->required()->columnSpanFull(),
            KeyValue::make('sosial_media')->label('Sosial Media')->keyLabel('Platform')->valueLabel('URL')->required()->columnSpanFull(),
            TextInput::make('email')->label('Email')->email()->maxLength(128)->required(),
            TextInput::make('no_tlpn')->label('Nomor Telepon')->maxLength(18)->required(),
            Toggle::make('active')->label('Aktif')->default(true)->required(),
        ]);
    }
}

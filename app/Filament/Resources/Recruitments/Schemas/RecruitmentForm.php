<?php

namespace App\Filament\Resources\Recruitments\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class RecruitmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Informasi Utama')
                ->schema([
                    TextInput::make('nim')->label('NIM')->maxLength(10)->required(),
                    TextInput::make('name')->label('Nama')->maxLength(128)->required(),
                    TextInput::make('semester')->label('Semester')->maxLength(16)->required(),
                    FileUpload::make('ektm')->label('e-KTM')->disk('public')->directory('recruitment/ektm')->visibility('public')->preserveFilenames()->maxSize(2048)->required(),
                    TextInput::make('email')->label('Email')->email()->maxLength(128)->required(),
                    TextInput::make('instagram')->label('Instagram')->maxLength(128)->required(),
                    TextInput::make('no_wa')->label('Nomor WhatsApp')->maxLength(16)->required(),
                    Textarea::make('description')->label('Deskripsi')->required()->columnSpanFull(),
                    Select::make('branch_id')->label('Cabang')->relationship('branch', 'name')->searchable()->preload()->required(),
                    FileUpload::make('follow_dpc')->label('Bukti Follow DPC')->image()->disk('public')->directory('recruitment/follow_dpc')->visibility('public')->preserveFilenames()->maxSize(3072)->required(),
                    FileUpload::make('cv')->label('CV')->disk('public')->directory('recruitment/cv')->visibility('public')->preserveFilenames()->maxSize(4096),
                    Select::make('status_id')->label('Status')->relationship('status', 'name')->searchable()->preload()->required(),
                ])
                ->columns(2)
                ->columnSpanFull(),
        ]);
    }
}

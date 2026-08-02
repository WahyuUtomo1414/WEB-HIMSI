<?php

namespace App\Filament\Resources\Recruitments\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class RecruitmentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Utama')
                    ->schema([
                        TextEntry::make('nim')->label('NIM'),
                        TextEntry::make('name')->label('Nama'),
                        TextEntry::make('semester')->label('Semester'),
                        TextEntry::make('email')->label('Email'),
                        TextEntry::make('instagram')->label('Instagram'),
                        TextEntry::make('no_wa')->label('Nomor WhatsApp'),
                        TextEntry::make('branch.name')->label('Branch'),
                        TextEntry::make('status.name')->label('Status')->badge(),
                        TextEntry::make('follow_dpc')->label('Follow DPC'),
                        TextEntry::make('ektm')->label('e-KTM'),
                        TextEntry::make('cv')->label('CV')->placeholder('-'),
                        TextEntry::make('description')->label('Deskripsi')->columnSpanFull(),
                        IconEntry::make('active')->label('Aktif')->boolean(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
                Section::make('Audit Data')
                    ->schema([
                        TextEntry::make('createdBy.name')->label('Dibuat Oleh')->badge()->placeholder('-'),
                        TextEntry::make('created_at')->label('Dibuat Pada')->dateTime('d M Y H:i')->placeholder('-'),
                        TextEntry::make('updatedBy.name')->label('Diubah Oleh')->badge()->placeholder('-'),
                        TextEntry::make('updated_at')->label('Diubah Pada')->dateTime('d M Y H:i')->placeholder('-'),
                        TextEntry::make('deletedBy.name')->label('Dihapus Oleh')->badge()->placeholder('-'),
                        TextEntry::make('deleted_at')->label('Dihapus Pada')->dateTime('d M Y H:i')->placeholder('-'),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }
}

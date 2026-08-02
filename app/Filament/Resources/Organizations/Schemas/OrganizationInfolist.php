<?php

namespace App\Filament\Resources\Organizations\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class OrganizationInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Utama')
                    ->schema([
                        TextEntry::make('name')->label('Nama Organisasi'),
                        TextEntry::make('kode_org')->label('Kode Organisasi'),
                        ImageEntry::make('logo')->label('Logo')->disk('public'),
                        ImageEntry::make('thumbnail')->label('Thumbnail')->disk('public'),
                        TextEntry::make('email')->label('Email'),
                        TextEntry::make('no_tlpn')->label('Nomor Telepon'),
                        TextEntry::make('vision')->label('Visi')->columnSpanFull(),
                        TextEntry::make('description')->label('Deskripsi')->columnSpanFull(),
                        RepeatableEntry::make('mision')
                            ->label('Misi')
                            ->schema([
                                TextEntry::make('value')
                                    ->label('')
                                    ->bulleted(),
                            ])
                            ->contained(false)
                            ->columnSpanFull(),
                        TextEntry::make('purpose')->label('Tujuan')->columnSpanFull(),
                        TextEntry::make('address')->label('Alamat')->columnSpanFull(),
                        RepeatableEntry::make('sosial_media')
                            ->label('Sosial Media')
                            ->schema([
                                TextEntry::make('value')
                                    ->label('')
                                    ->bulleted(),
                            ])
                            ->contained(false)
                            ->columnSpanFull(),
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

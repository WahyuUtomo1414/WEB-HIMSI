<?php

namespace App\Filament\Resources\Branches\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BranchInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Utama')
                    ->schema([
                        TextEntry::make('name')->label('Nama Branch'),
                        TextEntry::make('location')->label('Lokasi'),
                        ImageEntry::make('thumbnail')->label('Thumbnail')->disk('public'),
                        TextEntry::make('grup_wa')->label('Grup WhatsApp'),
                        TextEntry::make('sektor')->label('Sektor'),
                        IconEntry::make('is_dpp')->label('DPP')->boolean(),
                        TextEntry::make('description')->label('Deskripsi')->columnSpanFull(),
                        Section::make('Sosial Media')
                            ->schema([
                                TextEntry::make('sosial_media.instagram')->label('Instagram')->url(fn ($state) => $state)->openUrlInNewTab()->placeholder('-'),
                                TextEntry::make('sosial_media.website')->label('Website')->url(fn ($state) => $state)->openUrlInNewTab()->placeholder('-'),
                                TextEntry::make('sosial_media.youtube')->label('YouTube')->url(fn ($state) => $state)->openUrlInNewTab()->placeholder('-'),
                                TextEntry::make('sosial_media.linkedin')->label('LinkedIn')->url(fn ($state) => $state)->openUrlInNewTab()->placeholder('-'),
                                TextEntry::make('sosial_media.tiktok')->label('TikTok')->url(fn ($state) => $state)->openUrlInNewTab()->placeholder('-'),
                                TextEntry::make('sosial_media.facebook')->label('Facebook')->url(fn ($state) => $state)->openUrlInNewTab()->placeholder('-'),
                                TextEntry::make('sosial_media.wa')->label('WhatsApp')->url(fn ($state) => $state)->openUrlInNewTab()->placeholder('-'),
                            ])
                            ->columns(2)
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

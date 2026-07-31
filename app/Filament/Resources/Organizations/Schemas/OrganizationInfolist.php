<?php

namespace App\Filament\Resources\Organizations\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class OrganizationInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')->label('Nama Organisasi'),
                TextEntry::make('kode_org')->label('Kode Organisasi'),
                ImageEntry::make('logo')->label('Logo')->disk('public'),
                TextEntry::make('email')->label('Email'),
                TextEntry::make('no_tlpn')->label('Nomor Telepon'),
                TextEntry::make('vision')->label('Visi')->columnSpanFull(),
                TextEntry::make('description')->label('Deskripsi')->columnSpanFull(),
                TextEntry::make('mision')->label('Misi')->formatStateUsing(fn ($state): string => json_encode($state, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES))->columnSpanFull(),
                TextEntry::make('purpose')->label('Tujuan')->columnSpanFull(),
                TextEntry::make('address')->label('Alamat')->columnSpanFull(),
                TextEntry::make('sosial_media')->label('Sosial Media')->formatStateUsing(fn ($state): string => json_encode($state, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES))->columnSpanFull(),
                IconEntry::make('active')->label('Aktif')->boolean(),
                TextEntry::make('createdBy.name')->label('Dibuat Oleh')->badge()->placeholder('-'),
                TextEntry::make('created_at')->label('Dibuat Pada')->dateTime('d M Y H:i')->placeholder('-'),
                TextEntry::make('updatedBy.name')->label('Diubah Oleh')->badge()->placeholder('-'),
                TextEntry::make('updated_at')->label('Diubah Pada')->dateTime('d M Y H:i')->placeholder('-'),
                TextEntry::make('deletedBy.name')->label('Dihapus Oleh')->badge()->placeholder('-'),
                TextEntry::make('deleted_at')->label('Dihapus Pada')->dateTime('d M Y H:i')->placeholder('-'),
            ]);
    }
}

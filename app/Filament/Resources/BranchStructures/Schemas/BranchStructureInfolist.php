<?php

namespace App\Filament\Resources\BranchStructures\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class BranchStructureInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('branch.name')->label('Branch'),
                TextEntry::make('name')->label('Nama Pengurus'),
                TextEntry::make('division.name')->label('Divisi')->placeholder('-'),
                TextEntry::make('position')->label('Posisi'),
                ImageEntry::make('image')->label('Foto')->disk('public'),
                TextEntry::make('no_wa')->label('Nomor WhatsApp'),
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

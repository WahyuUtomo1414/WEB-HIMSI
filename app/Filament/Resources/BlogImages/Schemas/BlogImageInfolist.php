<?php

namespace App\Filament\Resources\BlogImages\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class BlogImageInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('blog.title')->label('Blog'),
                ImageEntry::make('image')->label('Gambar')->disk('public'),
                TextEntry::make('description')->label('Deskripsi')->columnSpanFull(),
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

<?php

namespace App\Filament\Resources\Blogs\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class BlogInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('branch.name')->label('Branch'),
                TextEntry::make('category.name')->label('Kategori'),
                TextEntry::make('title')->label('Judul'),
                TextEntry::make('slug')->label('Slug'),
                ImageEntry::make('thumbnail')->label('Thumbnail')->disk('public'),
                TextEntry::make('quotes')->label('Quotes')->placeholder('-'),
                TextEntry::make('body')->label('Isi Blog')->html()->columnSpanFull(),
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

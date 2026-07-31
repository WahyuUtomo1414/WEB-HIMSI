<?php

namespace App\Filament\Resources\BlogImages\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class BlogImageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('blog_id')->label('Blog')->relationship('blog', 'title')->searchable()->preload()->required(),
            FileUpload::make('image')->label('Gambar')->image()->disk('public')->directory('blog/image')->visibility('public')->preserveFilenames()->maxSize(2048)->required(),
            TextInput::make('description')->label('Deskripsi')->maxLength(255)->required()->columnSpanFull(),
            Toggle::make('active')->label('Aktif')->default(true)->required(),
        ]);
    }
}

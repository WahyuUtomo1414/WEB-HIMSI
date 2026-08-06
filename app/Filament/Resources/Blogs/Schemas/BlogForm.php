<?php

namespace App\Filament\Resources\Blogs\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BlogForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Informasi Utama')
                ->schema([
                    Select::make('branch_id')->label('Branch')->relationship('branch', 'name')->searchable()->preload()->required(),
                    TextInput::make('title')->label('Judul')->maxLength(128)->required(),
                    TextInput::make('slug')->label('Slug')->maxLength(128)->required()->unique(ignoreRecord: true),
                    FileUpload::make('thumbnail')->label('Thumbnail')->image()->disk('public')->directory('blog/thumbnail')->visibility('public')->preserveFilenames()->maxSize(2048)->helperText('Format gambar. Maksimal 2 MB. Rekomendasi 1600 x 900 px.')->required(),
                    TextInput::make('quotes')->label('Quotes')->maxLength(255),
                    RichEditor::make('body')->label('Isi Blog')->required()->columnSpanFull(),
                    Select::make('category_id')->label('Kategori')->relationship('category', 'name')->searchable()->preload()->required(),
                    Toggle::make('active')->label('Aktif')->default(true)->required(),
                ])
                ->columns(2)
                ->columnSpanFull(),
        ]);
    }
}

<?php

namespace App\Filament\Resources\BlogImages;

use App\Filament\Resources\BlogImages\Pages\CreateBlogImage;
use App\Filament\Resources\BlogImages\Pages\EditBlogImage;
use App\Filament\Resources\BlogImages\Pages\ListBlogImages;
use App\Filament\Resources\BlogImages\Pages\ViewBlogImage;
use App\Filament\Resources\BlogImages\Schemas\BlogImageForm;
use App\Filament\Resources\BlogImages\Schemas\BlogImageInfolist;
use App\Filament\Resources\BlogImages\Tables\BlogImagesTable;
use App\Models\BlogImage;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class BlogImageResource extends Resource
{
    protected static ?string $model = BlogImage::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-photo';

    protected static string|UnitEnum|null $navigationGroup = 'Konten';

    protected static ?string $navigationLabel = 'Gambar Blog';

    protected static ?string $modelLabel = 'Gambar Blog';

    protected static ?string $pluralModelLabel = 'Gambar Blog';

    protected static ?string $recordTitleAttribute = 'description';

    public static function form(Schema $schema): Schema
    {
        return BlogImageForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return BlogImageInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BlogImagesTable::configure($table);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBlogImages::route('/'),
            'create' => CreateBlogImage::route('/create'),
            'view' => ViewBlogImage::route('/{record}'),
            'edit' => EditBlogImage::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}

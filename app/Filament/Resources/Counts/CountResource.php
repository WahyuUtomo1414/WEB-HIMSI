<?php

namespace App\Filament\Resources\Counts;

use App\Filament\Resources\Counts\Pages\CreateCount;
use App\Filament\Resources\Counts\Pages\EditCount;
use App\Filament\Resources\Counts\Pages\ListCounts;
use App\Filament\Resources\Counts\Pages\ViewCount;
use App\Filament\Resources\Counts\Schemas\CountForm;
use App\Filament\Resources\Counts\Schemas\CountInfolist;
use App\Filament\Resources\Counts\Tables\CountsTable;
use App\Models\Count;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class CountResource extends Resource
{
    protected static ?string $model = Count::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-chart-bar';

    protected static string|UnitEnum|null $navigationGroup = 'Konten';

    protected static ?string $navigationLabel = 'Statistik';

    protected static ?string $modelLabel = 'Statistik';

    protected static ?string $pluralModelLabel = 'Statistik';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return CountForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CountInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CountsTable::configure($table);
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
            'index' => ListCounts::route('/'),
            'create' => CreateCount::route('/create'),
            'view' => ViewCount::route('/{record}'),
            'edit' => EditCount::route('/{record}/edit'),
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

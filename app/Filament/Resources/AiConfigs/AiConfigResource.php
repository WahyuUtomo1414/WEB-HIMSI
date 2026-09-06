<?php

namespace App\Filament\Resources\AiConfigs;

use App\Filament\Resources\AiConfigs\Pages\CreateAiConfig;
use App\Filament\Resources\AiConfigs\Pages\EditAiConfig;
use App\Filament\Resources\AiConfigs\Pages\ListAiConfigs;
use App\Filament\Resources\AiConfigs\Pages\ViewAiConfig;
use App\Filament\Resources\AiConfigs\Schemas\AiConfigForm;
use App\Filament\Resources\AiConfigs\Schemas\AiConfigInfolist;
use App\Models\AiConfig;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class AiConfigResource extends Resource
{
    protected static ?string $model = AiConfig::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-cpu-chip';

    protected static string|UnitEnum|null $navigationGroup = 'AI Chat';

    protected static ?string $navigationLabel = 'Konfigurasi AI';

    protected static ?string $modelLabel = 'Konfigurasi AI';

    protected static ?string $pluralModelLabel = 'Konfigurasi AI';

    protected static ?string $recordTitleAttribute = 'model';

    public static function form(Schema $schema): Schema
    {
        return AiConfigForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return AiConfigInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([])->recordActions([])->toolbarActions([]);
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAiConfigs::route('/'),
            'create' => CreateAiConfig::route('/create'),
            'view' => ViewAiConfig::route('/{record}'),
            'edit' => EditAiConfig::route('/{record}/edit'),
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

<?php

namespace App\Filament\Resources\AiKnowledgeSources;

use App\Filament\Resources\AiKnowledgeSources\Pages\CreateAiKnowledgeSource;
use App\Filament\Resources\AiKnowledgeSources\Pages\EditAiKnowledgeSource;
use App\Filament\Resources\AiKnowledgeSources\Pages\ListAiKnowledgeSources;
use App\Filament\Resources\AiKnowledgeSources\Pages\ViewAiKnowledgeSource;
use App\Filament\Resources\AiKnowledgeSources\Schemas\AiKnowledgeSourceForm;
use App\Filament\Resources\AiKnowledgeSources\Schemas\AiKnowledgeSourceInfolist;
use App\Filament\Resources\AiKnowledgeSources\Tables\AiKnowledgeSourcesTable;
use App\Models\AiKnowledgeSource;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class AiKnowledgeSourceResource extends Resource
{
    protected static ?string $model = AiKnowledgeSource::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-document-text';

    protected static string|UnitEnum|null $navigationGroup = 'AI Chat';

    protected static ?string $navigationLabel = 'Sumber Pengetahuan';

    protected static ?string $modelLabel = 'Sumber Pengetahuan';

    protected static ?string $pluralModelLabel = 'Sumber Pengetahuan';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return AiKnowledgeSourceForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return AiKnowledgeSourceInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AiKnowledgeSourcesTable::configure($table);
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
            'index' => ListAiKnowledgeSources::route('/'),
            'create' => CreateAiKnowledgeSource::route('/create'),
            'view' => ViewAiKnowledgeSource::route('/{record}'),
            'edit' => EditAiKnowledgeSource::route('/{record}/edit'),
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

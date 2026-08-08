<?php

namespace App\Filament\Resources\BranchStructures;

use App\Filament\Resources\BranchStructures\Pages\CreateBranchStructure;
use App\Filament\Resources\BranchStructures\Pages\EditBranchStructure;
use App\Filament\Resources\BranchStructures\Pages\ListBranchStructures;
use App\Filament\Resources\BranchStructures\Pages\ViewBranchStructure;
use App\Filament\Resources\BranchStructures\Schemas\BranchStructureForm;
use App\Filament\Resources\BranchStructures\Schemas\BranchStructureInfolist;
use App\Filament\Resources\BranchStructures\Tables\BranchStructuresTable;
use App\Models\BranchStructure;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class BranchStructureResource extends Resource
{
    protected static ?string $model = BranchStructure::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-user-group';

    protected static string|UnitEnum|null $navigationGroup = 'Organisasi';

    protected static ?string $navigationLabel = 'Struktur Branch';

    protected static ?string $modelLabel = 'Struktur Branch';

    protected static ?string $pluralModelLabel = 'Struktur Branch';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return BranchStructureForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return BranchStructureInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BranchStructuresTable::configure($table);
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);

        if (auth()->check() && ! auth()->user()->hasRole('super_admin') && auth()->user()->branch_id) {
            $query->where('branch_id', auth()->user()->branch_id);
        }

        return $query;
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
            'index' => ListBranchStructures::route('/'),
            'create' => CreateBranchStructure::route('/create'),
            'view' => ViewBranchStructure::route('/{record}'),
            'edit' => EditBranchStructure::route('/{record}/edit'),
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

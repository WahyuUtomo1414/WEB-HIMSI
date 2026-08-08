<?php

namespace App\Filament\Resources\Recruitments;

use App\Filament\Resources\Recruitments\Pages\CreateRecruitment;
use App\Filament\Resources\Recruitments\Pages\EditRecruitment;
use App\Filament\Resources\Recruitments\Pages\ListRecruitments;
use App\Filament\Resources\Recruitments\Pages\ViewRecruitment;
use App\Filament\Resources\Recruitments\Schemas\RecruitmentForm;
use App\Filament\Resources\Recruitments\Schemas\RecruitmentInfolist;
use App\Filament\Resources\Recruitments\Tables\RecruitmentsTable;
use App\Models\Recruitment;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use UnitEnum;

class RecruitmentResource extends Resource
{
    protected static ?string $model = Recruitment::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-user-plus';

    protected static string|UnitEnum|null $navigationGroup = 'Rekrutmen';

    protected static ?string $navigationLabel = 'Rekrutmen';

    protected static ?string $modelLabel = 'Rekrutmen';

    protected static ?string $pluralModelLabel = 'Rekrutmen';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return RecruitmentForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return RecruitmentInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RecruitmentsTable::configure($table);
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);

        return static::scopeQueryForBranchRole($query);
    }

    public static function scopeQueryForBranchRole(Builder $query): Builder
    {
        $user = Auth::user();

        if (! $user) {
            return $query->whereRaw('1 = 0');
        }

        if ($user->roles()->whereKey(3)->exists()) {
            return $query->where('branch_id', $user->branch_id);
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
            'index' => ListRecruitments::route('/'),
            'create' => CreateRecruitment::route('/create'),
            'view' => ViewRecruitment::route('/{record}'),
            'edit' => EditRecruitment::route('/{record}/edit'),
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

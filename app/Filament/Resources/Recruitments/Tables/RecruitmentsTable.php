<?php

namespace App\Filament\Resources\Recruitments\Tables;

use App\Filament\Resources\Recruitments\Support\RecruitmentActions;
use App\Filament\Resources\Recruitments\Support\RecruitmentExport;
use App\Models\Branch;
use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class RecruitmentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nim')->label('NIM')->searchable()->sortable(),
                TextColumn::make('name')->label('Nama')->searchable()->sortable(),
                TextColumn::make('email')->label('Email')->searchable(),
                TextColumn::make('branch.name')->label('Cabang')->searchable()->sortable(),
                TextColumn::make('status.name')->label('Status')->badge()->searchable()->sortable(),
                TextColumn::make('createdBy.name')
                    ->label('Dibuat Oleh')
                    ->getStateUsing(fn ($record) => (int) $record->created_by === 1
                        ? 'System'
                        : ($record->createdBy?->name ?? 'System'))
                    ->badge()
                    ->description(fn ($record) => $record->created_at?->format('d M Y H:i'))
                    ->sortable(),
                TextColumn::make('updatedBy.name')
                    ->label('Diubah Oleh')
                    ->badge()
                    ->description(fn ($record) => $record->updated_at?->format('d M Y H:i'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deletedBy.name')
                    ->label('Dihapus Oleh')
                    ->badge()
                    ->description(fn ($record) => $record->deleted_at?->format('d M Y H:i'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                TrashedFilter::make()->label('Data Terhapus'),
                SelectFilter::make('branch_id')
                    ->label('Cabang')
                    ->options(fn () => self::branchFilterOptions())
                    ->searchable()
                    ->preload(),
                SelectFilter::make('status_id')->label('Status')->relationship('status', 'name')->searchable()->preload(),
            ])
            ->headerActions([
                Action::make('export_excel')
                    ->label('Ekspor Excel')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('warning')
                    ->action(fn ($livewire) => RecruitmentExport::download($livewire->getTableQueryForExport())),
            ])
            ->recordActions([
                ViewAction::make()->label('Lihat'),
                EditAction::make()->label('Edit'),
                DeleteAction::make()->label('Hapus'),
                RestoreAction::make()->label('Pulihkan'),
                ForceDeleteAction::make()->label('Hapus Permanen'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    BulkAction::make('verify_selected')
                        ->label('Verifikasi')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->requiresConfirmation()
                        ->modalHeading('Verifikasi pendaftar terpilih')
                        ->modalDescription('Status pendaftar terpilih akan diubah menjadi terverifikasi dan email notifikasi akan dikirim satu per satu.')
                        ->modalSubmitActionLabel('Ya, verifikasi')
                        ->action(fn ($records) => RecruitmentActions::verifyMany($records))
                        ->deselectRecordsAfterCompletion(),
                    DeleteBulkAction::make()->label('Hapus'),
                    RestoreBulkAction::make()->label('Pulihkan'),
                    ForceDeleteBulkAction::make()->label('Hapus Permanen'),
                ]),
            ]);
    }

    private static function branchFilterOptions(): array
    {
        $user = Auth::user();

        if (! $user) {
            return [];
        }

        $query = Branch::query()->orderBy('name');

        if ($user->roles()->whereKey(3)->exists()) {
            $query->whereKey($user->branch_id);
        }

        return $query->pluck('name', 'id')->toArray();
    }
}

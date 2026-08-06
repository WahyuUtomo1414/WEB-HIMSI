<?php

namespace App\Filament\Resources\Branches\RelationManagers;

use App\Support\ImageUploadOptimizer;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StructuresRelationManager extends RelationManager
{
    protected static string $relationship = 'structures';

    protected static ?string $title = 'Struktur Branch';

    protected static ?string $modelLabel = 'Struktur Branch';

    protected static ?string $pluralModelLabel = 'Struktur Branch';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Utama')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Pengurus')
                            ->maxLength(128)
                            ->required(),
                        Select::make('division_id')
                            ->label('Divisi')
                            ->relationship('division', 'name')
                            ->searchable()
                            ->preload(),
                        TextInput::make('sort')
                            ->label('Urutan')
                            ->numeric()
                            ->default(0)
                            ->minValue(0)
                            ->required(),
                        TextInput::make('position')
                            ->label('Posisi')
                            ->maxLength(128)
                            ->required(),
                        FileUpload::make('image')
                            ->label('Foto')
                            ->image()
                            ->disk('public')
                            ->directory('branch_structure')
                            ->visibility('public')
                            ->maxSize(2048)
                            ->helperText('Format gambar. Maksimal 2 MB. Rekomendasi 1000 x 1000 px. Otomatis dikonversi ke WebP.')
                            ->saveUploadedFileUsing(fn ($component, $file) => ImageUploadOptimizer::storeWebp($component, $file, maxWidth: 1000, quality: 85))
                            ->required(),
                        TextInput::make('no_wa')
                            ->label('Nomor WhatsApp')
                            ->maxLength(18)
                            ->required(),
                        Toggle::make('active')
                            ->label('Aktif')
                            ->default(true)
                            ->required(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Utama')
                    ->schema([
                        TextEntry::make('name')->label('Nama Pengurus'),
                        TextEntry::make('division.name')->label('Divisi')->placeholder('-'),
                        TextEntry::make('sort')->label('Urutan'),
                        TextEntry::make('position')->label('Posisi'),
                        ImageEntry::make('image')->label('Foto')->disk('public'),
                        TextEntry::make('no_wa')->label('Nomor WhatsApp'),
                        IconEntry::make('active')->label('Aktif')->boolean(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
                Section::make('Audit Data')
                    ->schema([
                        TextEntry::make('createdBy.name')->label('Dibuat Oleh')->badge()->placeholder('-'),
                        TextEntry::make('created_at')->label('Dibuat Pada')->dateTime('d M Y H:i')->placeholder('-'),
                        TextEntry::make('updatedBy.name')->label('Diubah Oleh')->badge()->placeholder('-'),
                        TextEntry::make('updated_at')->label('Diubah Pada')->dateTime('d M Y H:i')->placeholder('-'),
                        TextEntry::make('deletedBy.name')->label('Dihapus Oleh')->badge()->placeholder('-'),
                        TextEntry::make('deleted_at')->label('Dihapus Pada')->dateTime('d M Y H:i')->placeholder('-'),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')->label('Nama Pengurus')->searchable()->sortable(),
                TextColumn::make('division.name')->label('Divisi')->placeholder('-')->searchable()->sortable(),
                TextColumn::make('sort')->label('Urutan')->numeric()->sortable(),
                TextColumn::make('position')->label('Posisi')->searchable(),
                ImageColumn::make('image')->label('Foto')->disk('public'),
                TextColumn::make('no_wa')->label('Nomor WhatsApp')->searchable(),
                IconColumn::make('active')->label('Aktif')->boolean()->sortable(),
                TextColumn::make('createdBy.name')
                    ->label('Dibuat Oleh')
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
            ->filters([
                TernaryFilter::make('active')->label('Status Aktif'),
                TrashedFilter::make()->label('Data Terhapus'),
                SelectFilter::make('division_id')->label('Divisi')->relationship('division', 'name')->searchable()->preload(),
            ])
            ->defaultSort('sort')
            ->headerActions([
                CreateAction::make()->label('Buat'),
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
                    DeleteBulkAction::make()->label('Hapus'),
                    RestoreBulkAction::make()->label('Pulihkan'),
                    ForceDeleteBulkAction::make()->label('Hapus Permanen'),
                ]),
            ])
            ->modifyQueryUsing(fn (Builder $query) => $query
                ->withoutGlobalScopes([
                    SoftDeletingScope::class,
                ]));
    }
}

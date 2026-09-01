<?php

namespace App\Filament\Resources\BranchStructures\Schemas;

use App\Models\Branch;
use App\Support\BranchStructurePosition;
use App\Support\ImageUploadOptimizer;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class BranchStructureForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Informasi Utama')
                ->schema([
                    Select::make('branch_id')
                        ->label('Cabang')
                        ->relationship('branch', 'name')
                        ->searchable()
                        ->preload()
                        ->required()
                        ->live()
                        ->afterStateUpdated(function (Set $set): void {
                            $set('position', null);
                            $set('division_id', null);
                        }),
                    TextInput::make('name')->label('Nama Pengurus')->maxLength(128)->required(),
                    Select::make('division_id')
                        ->label('Divisi')
                        ->relationship(
                            name: 'division',
                            titleAttribute: 'name',
                            modifyQueryUsing: function ($query, Get $get) {
                                $branchId = $get('branch_id');
                                if (! $branchId) {
                                    return $query->whereRaw('1 = 0');
                                }
                                $branch = Branch::find($branchId);
                                if (! $branch) {
                                    return $query->whereRaw('1 = 0');
                                }

                                $excluded = $branch->is_dpp
                                    ? ['Divisi RSDM', 'Divisi Litbang']
                                    : ['Divisi PSDM', 'Divisi Sosmas'];

                                return $query->whereNotIn('name', $excluded);
                            }
                        )
                        ->disabled(fn (Get $get): bool => ! $get('branch_id'))
                        ->placeholder(fn (Get $get): string => $get('branch_id') ? 'Pilih salah satu opsi' : 'Pilih cabang terlebih dahulu')
                        ->searchable()
                        ->preload(),
                    Hidden::make('sort')
                        ->default(99)
                        ->dehydrateStateUsing(fn (Get $get): int => BranchStructurePosition::sortFor($get('position'))),
                    Select::make('position')
                        ->label('Posisi')
                        ->options(function (Get $get): array {
                            $branchId = $get('branch_id');
                            if (! $branchId) {
                                return [];
                            }
                            $branch = Branch::find($branchId);
                            if (! $branch) {
                                return [];
                            }

                            return BranchStructurePosition::optionsFor($branch->is_dpp);
                        })
                        ->disabled(fn (Get $get): bool => ! $get('branch_id'))
                        ->placeholder(fn (Get $get): string => $get('branch_id') ? 'Pilih salah satu opsi' : 'Pilih cabang terlebih dahulu')
                        ->searchable()
                        ->live()
                        ->afterStateUpdated(fn (Set $set, ?string $state): mixed => $set('sort', BranchStructurePosition::sortFor($state)))
                        ->required(),
                    FileUpload::make('image')->label('Foto')->image()->disk('public')->directory('branch_structure')->visibility('public')->maxSize(2048)->helperText('Format gambar. Maksimal 2 MB. Rekomendasi 1000 x 1000 px. Otomatis dikonversi ke WebP.')->saveUploadedFileUsing(fn ($component, $file) => ImageUploadOptimizer::storeWebp($component, $file, maxWidth: 1000, quality: 85))->required(),
                    TextInput::make('no_wa')->label('Nomor WhatsApp')->maxLength(18)->required(),
                    Toggle::make('active')->label('Aktif')->default(true)->required(),
                ])
                ->columns(2)
                ->columnSpanFull(),
        ]);
    }
}

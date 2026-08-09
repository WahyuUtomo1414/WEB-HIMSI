<?php

namespace App\Filament\Resources\Milestones\Schemas;

use App\Support\MilestoneList;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class MilestoneForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Informasi Utama')
                ->schema([
                    DatePicker::make('year')->label('Tahun/Tanggal')->required(),
                    Repeater::make('list')
                        ->label('Daftar Milestone')
                        ->schema([
                            Textarea::make('value')
                                ->label('Milestone')
                                ->required()
                                ->columnSpanFull(),
                        ])
                        ->afterStateHydrated(fn (Repeater $component, mixed $state) => $component->state(MilestoneList::normalize($state)))
                        ->addActionLabel('Tambah Milestone')
                        ->defaultItems(1)
                        ->reorderable()
                        ->required()
                        ->columnSpanFull(),
                    Toggle::make('active')->label('Aktif')->default(true)->required(),
                ])
                ->columns(2)
                ->columnSpanFull(),
        ]);
    }
}

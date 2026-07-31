<?php

namespace App\Filament\Resources\Milestones\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class MilestoneForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('sort')->label('Urutan')->numeric()->required(),
            DatePicker::make('year')->label('Tahun/Tanggal')->required(),
            KeyValue::make('list')->label('Daftar Milestone')->keyLabel('Urutan')->valueLabel('Milestone')->required()->columnSpanFull(),
            Toggle::make('active')->label('Aktif')->default(true)->required(),
        ]);
    }
}

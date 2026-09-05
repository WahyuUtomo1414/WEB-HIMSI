<?php

namespace App\Filament\Resources\AiKnowledgeSources\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AiKnowledgeSourceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Informasi')
                ->schema([
                    TextInput::make('title')
                        ->label('Judul Sumber')
                        ->required()
                        ->maxLength(255)
                        ->placeholder('Contoh: AD/ART HIMSI 2025'),
                    Select::make('source_type')
                        ->label('Tipe Sumber')
                        ->options([
                            'text' => 'Teks Langsung',
                            'pdf' => 'File PDF',
                            'excel' => 'File Excel',
                            'url' => 'URL / Tautan',
                        ])
                        ->required()
                        ->live(),
                ])
                ->columns(2)
                ->columnSpanFull(),

            Section::make('Konten')
                ->schema([
                    Textarea::make('raw_content')
                        ->label('Isi Teks')
                        ->rows(12)
                        ->required()
                        ->columnSpanFull()
                        ->visible(fn ($get) => $get('source_type') === 'text'),

                    FileUpload::make('file_path')
                        ->label('File PDF')
                        ->acceptedFileTypes(['application/pdf'])
                        ->disk('public')
                        ->directory('ai/knowledge')
                        ->visibility('public')
                        ->maxSize(10240)
                        ->helperText('Maks 10 MB. Format: PDF.')
                        ->required()
                        ->columnSpanFull()
                        ->visible(fn ($get) => $get('source_type') === 'pdf'),

                    FileUpload::make('file_path')
                        ->label('File Excel')
                        ->acceptedFileTypes([
                            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                            'application/vnd.ms-excel',
                        ])
                        ->disk('public')
                        ->directory('ai/knowledge')
                        ->visibility('public')
                        ->maxSize(10240)
                        ->helperText('Maks 10 MB. Format: .xlsx atau .xls.')
                        ->required()
                        ->columnSpanFull()
                        ->visible(fn ($get) => $get('source_type') === 'excel'),

                    TextInput::make('file_path')
                        ->label('URL')
                        ->url()
                        ->required()
                        ->columnSpanFull()
                        ->placeholder('https://...')
                        ->helperText('Konten halaman akan diambil dan diproses otomatis.')
                        ->visible(fn ($get) => $get('source_type') === 'url'),
                ])
                ->columnSpanFull(),

            Section::make('Status')
                ->schema([
                    Toggle::make('is_active')
                        ->label('Ikutkan dalam Pencarian AI')
                        ->helperText('Nonaktifkan untuk mengecualikan sumber ini dari RAG lookup.')
                        ->default(true),
                    Toggle::make('active')
                        ->label('Aktif')
                        ->default(true),
                ])
                ->columns(2)
                ->columnSpanFull(),
        ]);
    }
}

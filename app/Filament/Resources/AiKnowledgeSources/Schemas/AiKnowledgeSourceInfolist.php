<?php

namespace App\Filament\Resources\AiKnowledgeSources\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AiKnowledgeSourceInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Informasi')
                ->schema([
                    TextEntry::make('title')->label('Judul Sumber'),
                    TextEntry::make('source_type')
                        ->label('Tipe Sumber')
                        ->badge()
                        ->formatStateUsing(fn ($state) => match ($state) {
                            'text' => 'Teks',
                            'pdf' => 'PDF',
                            'excel' => 'Excel',
                            'url' => 'URL',
                            default => $state,
                        }),
                    TextEntry::make('status')
                        ->label('Status Embedding')
                        ->badge()
                        ->color(fn ($state) => match ($state) {
                            'ready' => 'success',
                            'processing' => 'warning',
                            'failed' => 'danger',
                            default => 'gray',
                        }),
                    TextEntry::make('processed_at')->label('Diproses Pada')->dateTime('d M Y H:i')->placeholder('Belum diproses'),
                ])
                ->columns(2)
                ->columnSpanFull(),

            Section::make('Konten')
                ->schema([
                    TextEntry::make('file_path')->label('File / URL')->placeholder('-'),
                    TextEntry::make('raw_content')->label('Isi Teks')->placeholder('-')->columnSpanFull()->limit(500),
                    TextEntry::make('error_message')
                        ->label('Pesan Error')
                        ->placeholder('Tidak ada error')
                        ->color('danger')
                        ->columnSpanFull()
                        ->visible(fn ($record) => filled($record?->error_message)),
                ])
                ->columns(1)
                ->columnSpanFull(),

            Section::make('Status')
                ->schema([
                    IconEntry::make('is_active')->label('Ikut RAG Lookup')->boolean(),
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
}

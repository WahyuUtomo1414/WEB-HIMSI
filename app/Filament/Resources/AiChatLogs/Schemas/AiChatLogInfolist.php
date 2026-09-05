<?php

namespace App\Filament\Resources\AiChatLogs\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AiChatLogInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Percakapan')
                ->schema([
                    TextEntry::make('question')->label('Pertanyaan User')->columnSpanFull(),
                    TextEntry::make('answer')->label('Jawaban AI')->columnSpanFull(),
                ])
                ->columnSpanFull(),

            Section::make('Konteks yang Digunakan')
                ->schema([
                    TextEntry::make('sources_used')
                        ->label('Knowledge Chunks (RAG)')
                        ->listWithLineBreaks()
                        ->placeholder('Tidak ada')
                        ->columnSpanFull(),
                    TextEntry::make('entity_context')
                        ->label('Data Entitas (Branch/Blog)')
                        ->formatStateUsing(fn ($state) => $state ? json_encode($state, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) : '-')
                        ->columnSpanFull(),
                ])
                ->columnSpanFull(),

            Section::make('Metadata')
                ->schema([
                    TextEntry::make('session_id')->label('Session ID')->copyable(),
                    TextEntry::make('model')->label('Model AI')->badge(),
                    TextEntry::make('ip_address')->label('IP Address'),
                    TextEntry::make('created_at')->label('Waktu')->dateTime('d M Y H:i:s'),
                ])
                ->columns(2)
                ->columnSpanFull(),
        ]);
    }
}

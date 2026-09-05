<?php

namespace App\Filament\Resources\AiConfigs\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AiConfigInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Pengaturan Model')
                ->schema([
                    TextEntry::make('model')->label('Model AI')->badge(),
                    TextEntry::make('temperature')->label('Temperature'),
                    TextEntry::make('max_tokens')->label('Maks Token'),
                ])
                ->columns(3)
                ->columnSpanFull(),

            Section::make('Pesan')
                ->schema([
                    TextEntry::make('greeting_message')->label('Pesan Sambutan')->placeholder('-'),
                    TextEntry::make('system_prompt')->label('System Prompt')->columnSpanFull(),
                ])
                ->columns(1)
                ->columnSpanFull(),

            Section::make('Guardrail Rules')
                ->schema([
                    TextEntry::make('rules.banned_words')
                        ->label('Kata Terlarang')
                        ->listWithLineBreaks()
                        ->placeholder('Tidak ada'),
                    TextEntry::make('rules.banned_topics')
                        ->label('Topik Terlarang')
                        ->listWithLineBreaks()
                        ->placeholder('Tidak ada'),
                    TextEntry::make('rules.max_question_length')->label('Maks Panjang Pertanyaan'),
                    TextEntry::make('rules.block_message')->label('Pesan Blokir')->placeholder('-'),
                ])
                ->columns(2)
                ->columnSpanFull(),

            Section::make('Status')
                ->schema([
                    IconEntry::make('is_enabled')->label('Widget AI Aktif')->boolean(),
                    IconEntry::make('active')->label('Konfigurasi Aktif')->boolean(),
                ])
                ->columns(2)
                ->columnSpanFull(),

            Section::make('Audit Data')
                ->schema([
                    TextEntry::make('createdBy.name')->label('Dibuat Oleh')->badge()->placeholder('-'),
                    TextEntry::make('created_at')->label('Dibuat Pada')->dateTime('d M Y H:i')->placeholder('-'),
                    TextEntry::make('updatedBy.name')->label('Diubah Oleh')->badge()->placeholder('-'),
                    TextEntry::make('updated_at')->label('Diubah Pada')->dateTime('d M Y H:i')->placeholder('-'),
                ])
                ->columns(2)
                ->columnSpanFull(),
        ]);
    }
}

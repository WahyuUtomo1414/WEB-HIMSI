<?php

namespace App\Filament\Resources\AiConfigs\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AiConfigForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Pengaturan Model')
                ->schema([
                    Select::make('model')
                        ->label('Model AI')
                        ->options([
                            'llama-3.3-70b-versatile' => 'Groq — llama-3.3-70b-versatile (Gratis)',
                            'llama-3.1-8b-instant' => 'Groq — llama-3.1-8b-instant (Gratis, Cepat)',
                            'gpt-4o-mini' => 'OpenAI — gpt-4o-mini',
                            'gpt-4o' => 'OpenAI — gpt-4o',
                        ])
                        ->default('llama-3.3-70b-versatile')
                        ->required(),
                    TextInput::make('temperature')
                        ->label('Temperature')
                        ->numeric()
                        ->minValue(0)
                        ->maxValue(1)
                        ->step(0.1)
                        ->default(0.7)
                        ->helperText('0 = deterministik, 1 = sangat kreatif')
                        ->required(),
                    TextInput::make('max_tokens')
                        ->label('Maks Token Respons')
                        ->numeric()
                        ->minValue(256)
                        ->maxValue(4096)
                        ->default(1024)
                        ->required(),
                ])
                ->columns(3)
                ->columnSpanFull(),

            Section::make('Pesan')
                ->schema([
                    TextInput::make('greeting_message')
                        ->label('Pesan Sambutan')
                        ->placeholder('Halo! Ada yang bisa saya bantu seputar HIMSI?')
                        ->maxLength(255),
                    Textarea::make('system_prompt')
                        ->label('System Prompt')
                        ->rows(8)
                        ->required()
                        ->columnSpanFull()
                        ->helperText('Instruksi dasar untuk AI: persona, batasan topik, cara menjawab.'),
                ])
                ->columns(1)
                ->columnSpanFull(),

            Section::make('Guardrail Rules')
                ->description('Aturan untuk memblokir pertanyaan yang tidak sesuai sebelum dikirim ke AI.')
                ->schema([
                    TagsInput::make('rules.banned_words')
                        ->label('Kata Terlarang')
                        ->placeholder('Tambah kata lalu tekan Enter')
                        ->helperText('Pertanyaan yang mengandung kata ini akan diblokir.')
                        ->columnSpanFull(),
                    TagsInput::make('rules.banned_topics')
                        ->label('Topik Terlarang')
                        ->placeholder('Tambah topik lalu tekan Enter')
                        ->helperText('Pertanyaan yang menyebut topik ini akan diblokir.')
                        ->columnSpanFull(),
                    TextInput::make('rules.max_question_length')
                        ->label('Maks Panjang Pertanyaan (karakter)')
                        ->numeric()
                        ->default(500)
                        ->minValue(100)
                        ->maxValue(2000),
                    TextInput::make('rules.block_message')
                        ->label('Pesan Blokir')
                        ->default('Maaf, pertanyaan kamu tidak bisa saya jawab. Silakan tanya hal lain seputar HIMSI.')
                        ->maxLength(500),
                ])
                ->columns(2)
                ->columnSpanFull(),

            Section::make('Status')
                ->schema([
                    Toggle::make('is_enabled')
                        ->label('Widget AI Aktif')
                        ->helperText('Nonaktifkan untuk menyembunyikan chat widget dari semua halaman publik.')
                        ->default(true),
                    Toggle::make('active')
                        ->label('Konfigurasi Aktif')
                        ->helperText('Hanya satu konfigurasi yang boleh aktif sekaligus.')
                        ->default(true),
                ])
                ->columns(2)
                ->columnSpanFull(),
        ]);
    }
}

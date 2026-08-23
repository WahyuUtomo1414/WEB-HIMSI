<?php

namespace App\Filament\Resources\Recruitments\Schemas;

use App\Filament\Resources\Recruitments\Support\WhatsAppFormatter;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Storage;

class RecruitmentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Data Mahasiswa')
                    ->schema([
                        TextEntry::make('nim')->label('NIM'),
                        TextEntry::make('name')->label('Nama'),
                        TextEntry::make('semester')->label('Semester'),
                        TextEntry::make('email')->label('Email'),
                        TextEntry::make('instagram')->label('Instagram'),
                        TextEntry::make('no_wa')
                            ->label('Nomor WhatsApp')
                            ->formatStateUsing(fn ($state) => WhatsAppFormatter::normalize($state) ?? '-')
                            ->url(fn ($state) => WhatsAppFormatter::url($state))
                            ->openUrlInNewTab()
                            ->badge(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
                Section::make('Cabang dan Status')
                    ->schema([
                        TextEntry::make('branch.name')->label('Cabang')->badge()->placeholder('-'),
                        TextEntry::make('division.name')->label('Divisi')->badge()->placeholder('-'),
                        TextEntry::make('status.name')->label('Status')->badge(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
                Section::make('Berkas Pendaftaran')
                    ->schema([
                        ImageEntry::make('follow_dpc')
                            ->label('Preview Bukti Follow DPC')
                            ->disk('public')
                            ->hidden(fn ($state) => ! self::isImagePath($state)),
                        TextEntry::make('follow_dpc')
                            ->label('Bukti Follow DPC')
                            ->formatStateUsing(fn ($state) => filled($state) ? 'Lihat berkas' : '-')
                            ->url(fn ($state) => self::fileUrl($state))
                            ->openUrlInNewTab()
                            ->badge()
                            ->placeholder('-'),
                        ImageEntry::make('ektm')
                            ->label('Preview e-KTM')
                            ->disk('public')
                            ->hidden(fn ($state) => ! self::isImagePath($state)),
                        TextEntry::make('ektm')
                            ->label('e-KTM')
                            ->formatStateUsing(fn ($state) => filled($state) ? 'Lihat berkas' : '-')
                            ->url(fn ($state) => self::fileUrl($state))
                            ->openUrlInNewTab()
                            ->badge()
                            ->placeholder('-'),
                        TextEntry::make('cv')
                            ->label('CV')
                            ->formatStateUsing(fn ($state) => filled($state) ? 'Lihat berkas' : '-')
                            ->url(fn ($state) => self::fileUrl($state))
                            ->openUrlInNewTab()
                            ->badge()
                            ->placeholder('-'),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
                Section::make('Motivasi')
                    ->schema([
                        TextEntry::make('description')->label('Deskripsi')->placeholder('-'),
                    ])
                    ->columnSpanFull(),
                Section::make('Audit Data')
                    ->schema([
                        TextEntry::make('createdBy.name')
                            ->label('Dibuat Oleh')
                            ->getStateUsing(fn ($record) => (int) $record->created_by === 1
                                ? 'System'
                                : ($record->createdBy?->name ?? 'System'))
                            ->badge()
                            ->placeholder('System'),
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

    private static function fileUrl(?string $path): ?string
    {
        if (blank($path)) {
            return null;
        }

        if (str($path)->startsWith(['http://', 'https://'])) {
            return $path;
        }

        return Storage::disk('public')->url($path);
    }

    private static function isImagePath(?string $path): bool
    {
        if (blank($path)) {
            return false;
        }

        return in_array(strtolower(pathinfo(parse_url($path, PHP_URL_PATH) ?? $path, PATHINFO_EXTENSION)), [
            'jpg',
            'jpeg',
            'png',
            'webp',
            'gif',
        ], true);
    }
}

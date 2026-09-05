<?php

namespace App\Filament\Resources\AiChatLogs;

use App\Filament\Resources\AiChatLogs\Pages\ListAiChatLogs;
use App\Filament\Resources\AiChatLogs\Pages\ViewAiChatLog;
use App\Filament\Resources\AiChatLogs\Schemas\AiChatLogInfolist;
use App\Filament\Resources\AiChatLogs\Tables\AiChatLogsTable;
use App\Models\AiChatLog;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use UnitEnum;

class AiChatLogResource extends Resource
{
    protected static ?string $model = AiChatLog::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static string|UnitEnum|null $navigationGroup = 'AI Chat';

    protected static ?string $navigationLabel = 'Log Chat AI';

    protected static ?string $modelLabel = 'Log Chat AI';

    protected static ?string $pluralModelLabel = 'Log Chat AI';

    protected static ?string $recordTitleAttribute = 'question';

    public static function infolist(Schema $schema): Schema
    {
        return AiChatLogInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AiChatLogsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAiChatLogs::route('/'),
            'view' => ViewAiChatLog::route('/{record}'),
        ];
    }
}

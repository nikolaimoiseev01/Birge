<?php

namespace App\Filament\Resources\TelegramPosts\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class TelegramPostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('telegram_message_id')
                    ->tel()
                    ->required()
                    ->numeric(),
                TextInput::make('chat_id')
                    ->required(),
                Textarea::make('text')
                    ->columnSpanFull(),
                DateTimePicker::make('published_at'),
            ]);
    }
}

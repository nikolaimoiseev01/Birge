<?php

namespace App\Filament\Resources\TelegramPosts;

use App\Filament\Resources\TelegramPosts\Pages\CreateTelegramPost;
use App\Filament\Resources\TelegramPosts\Pages\EditTelegramPost;
use App\Filament\Resources\TelegramPosts\Pages\ListTelegramPosts;
use App\Filament\Resources\TelegramPosts\Schemas\TelegramPostForm;
use App\Filament\Resources\TelegramPosts\Tables\TelegramPostsTable;
use App\Models\TelegramPost;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TelegramPostResource extends Resource
{
    protected static ?string $model = TelegramPost::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'text';

    public static function form(Schema $schema): Schema
    {
        return TelegramPostForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TelegramPostsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTelegramPosts::route('/'),
            'create' => CreateTelegramPost::route('/create'),
            'edit' => EditTelegramPost::route('/{record}/edit'),
        ];
    }
}

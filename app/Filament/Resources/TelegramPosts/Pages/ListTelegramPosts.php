<?php

namespace App\Filament\Resources\TelegramPosts\Pages;

use App\Filament\Resources\TelegramPosts\TelegramPostResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTelegramPosts extends ListRecords
{
    protected static string $resource = TelegramPostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

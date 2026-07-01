<?php

namespace App\Filament\Resources\TelegramPosts\Pages;

use App\Filament\Resources\TelegramPosts\TelegramPostResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTelegramPost extends EditRecord
{
    protected static string $resource = TelegramPostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}

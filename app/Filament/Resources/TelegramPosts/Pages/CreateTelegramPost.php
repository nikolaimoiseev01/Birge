<?php

namespace App\Filament\Resources\TelegramPosts\Pages;

use App\Filament\Resources\TelegramPosts\TelegramPostResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTelegramPost extends CreateRecord
{
    protected static string $resource = TelegramPostResource::class;
}

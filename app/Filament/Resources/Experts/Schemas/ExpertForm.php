<?php

namespace App\Filament\Resources\Experts\Schemas;

use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Schema;

class ExpertForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('email')
                    ->email()
                    ->label('Email'),
                SpatieMediaLibraryFileUpload::make('image')
                    ->collection('image')
                    ->image()
                    ->label('Аватар')
                    ->columnSpanFull(),
                Tabs::make('translations')
                    ->tabs([
                        Tabs\Tab::make('Русский')
                            ->schema([
                                TextInput::make('name.ru')
                                    ->required()
                                    ->maxLength(255)
                                    ->label('Имя'),
                                TextInput::make('description_short.ru')
                                    ->required()
                                    ->maxLength(255)
                                    ->label('Краткое описание'),
                                RichEditor::make('description.ru')
                                    ->required()
                                    ->label('Описание')
                                    ->columnSpanFull(),
                            ]),
                        Tabs\Tab::make('English')
                            ->schema([
                                TextInput::make('name.en')
                                    ->required()
                                    ->maxLength(255)
                                    ->label('Name'),
                                TextInput::make('description_short.en')
                                    ->required()
                                    ->maxLength(255)
                                    ->label('Short description'),
                                RichEditor::make('description.en')
                                    ->required()
                                    ->label('Описание')
                                    ->columnSpanFull(),
                            ]),
                        Tabs\Tab::make('Қазақша')
                            ->schema([
                                TextInput::make('name.kk')
                                    ->required()
                                    ->maxLength(255)
                                    ->label('Аты-жөні'),
                                TextInput::make('description_short.kk')
                                    ->required()
                                    ->maxLength(255)
                                    ->label('Қысқаша сипаттама'),
                                RichEditor::make('description.kk')
                                    ->required()
                                    ->label('Описание')
                                    ->columnSpanFull(),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}

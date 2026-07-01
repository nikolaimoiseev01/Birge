<?php

namespace App\Filament\Resources\Experts;

use App\Filament\Resources\Experts\Pages\CreateExpert;
use App\Filament\Resources\Experts\Pages\EditExpert;
use App\Filament\Resources\Experts\Pages\ListExperts;
use App\Filament\Resources\Experts\Schemas\ExpertForm;
use App\Filament\Resources\Experts\Tables\ExpertsTable;
use App\Models\Expert;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ExpertResource extends Resource
{
    protected static ?string $model = Expert::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserGroup;

    protected static ?string $navigationLabel = 'Эксперты';

    protected static ?string $modelLabel = 'Эксперт';

    protected static ?string $pluralModelLabel = 'Эксперты';

    public static function getRecordTitle($record): string
    {
        return $record->name['ru'] ?? $record->name['en'] ?? (is_array($record->name) ? reset($record->name) : $record->name);
    }

    public static function form(Schema $schema): Schema
    {
        return ExpertForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ExpertsTable::configure($table);
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
            'index' => ListExperts::route('/'),
            'create' => CreateExpert::route('/create'),
            'edit' => EditExpert::route('/{record}/edit'),
        ];
    }
}

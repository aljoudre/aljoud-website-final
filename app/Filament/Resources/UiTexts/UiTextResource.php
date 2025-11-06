<?php

namespace App\Filament\Resources\UiTexts;

use App\Filament\Resources\UiTexts\Pages\CreateUiText;
use App\Filament\Resources\UiTexts\Pages\EditUiText;
use App\Filament\Resources\UiTexts\Pages\ListUiTexts;
use App\Filament\Resources\UiTexts\Pages\ViewUiText;
use App\Filament\Resources\UiTexts\Schemas\UiTextForm;
use App\Filament\Resources\UiTexts\Schemas\UiTextInfolist;
use App\Filament\Resources\UiTexts\Tables\UiTextsTable;
use App\Models\UiText;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class UiTextResource extends Resource
{
    protected static ?string $model = UiText::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return UiTextForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return UiTextInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UiTextsTable::configure($table);
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
            'index' => ListUiTexts::route('/'),
            'create' => CreateUiText::route('/create'),
            'view' => ViewUiText::route('/{record}'),
            'edit' => EditUiText::route('/{record}/edit'),
        ];
    }
}

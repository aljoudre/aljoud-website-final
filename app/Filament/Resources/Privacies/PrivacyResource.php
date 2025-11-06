<?php

namespace App\Filament\Resources\Privacies;

use App\Filament\Resources\Privacies\Pages\CreatePrivacy;
use App\Filament\Resources\Privacies\Pages\EditPrivacy;
use App\Filament\Resources\Privacies\Pages\ListPrivacies;
use App\Filament\Resources\Privacies\Schemas\PrivacyForm;
use App\Filament\Resources\Privacies\Tables\PrivaciesTable;
use App\Models\Privacy;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PrivacyResource extends Resource
{
    protected static ?string $model = Privacy::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return PrivacyForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PrivaciesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function canCreate(): bool
    {
        return Privacy::count() === 0;
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPrivacies::route('/'),
            'create' => CreatePrivacy::route('/create'),
            'edit' => EditPrivacy::route('/{record}/edit'),
        ];
    }
}

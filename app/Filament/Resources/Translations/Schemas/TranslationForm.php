<?php

namespace App\Filament\Resources\Translations\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;

class TranslationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')->required(),
                TextInput::make('value')->required(),   
            ]);
    }
}

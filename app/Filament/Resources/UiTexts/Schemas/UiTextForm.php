<?php

namespace App\Filament\Resources\UiTexts\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use App\Models\Translation;

class UiTextForm
{
    public static function configure(Schema $schema): Schema
    {
        $translations = Translation::all();
        
        // Dynamically create a tab for each translation
        $languageTabs = $translations->map(function ($translation) {
            $langKey = $translation->value;
            $label = $translation->name;

            return Tab::make($label)
                ->schema([
                    Textarea::make("value.{$langKey}")
                        ->label("Value ({$label})")
                        ->rows(3)
                        ->required(),
                ]);
        })->toArray();

        return $schema
            ->components([
                Section::make('UI Text Configuration')
                    ->description('Manage UI text with translations')
                    ->schema([
                        TextInput::make('key')
                            ->label('Key')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->helperText('Unique identifier (e.g., navbar.home, footer.contact)'),
                        
                        Tabs::make('Translations')
                            ->tabs($languageTabs),
                    ])
                    ->collapsible(),
            ]);
    }
}

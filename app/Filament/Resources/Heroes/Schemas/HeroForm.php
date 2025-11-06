<?php

namespace App\Filament\Resources\Heroes\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use App\Models\Translation;
use Filament\Forms\Components\Textarea;

class HeroForm
{
    public static function configure(Schema $schema): Schema
    {
        // Fetch all translations from the database
        $translations = Translation::all();

        // Dynamically create a tab for each translation
        $languageTabs = $translations->map(function ($translation) {
            $langKey = $translation->value;
            $label = $translation->name;

            return Tab::make($label)
                ->schema([
                    TextInput::make("title.{$langKey}")
                        ->label("Title ({$label})")
                        ->required()
                        ->maxLength(255),
                    Textarea::make("subtitle.{$langKey}")
                        ->label("Subtitle ({$label})")
                        ->rows(3)
                        ->required(),
                ]);
        })->toArray();

        return $schema
            ->components([
                Section::make('Hero Content')
                    ->description('Manage hero section content with translations')
                    ->schema([
                        Tabs::make('Languages')
                            ->tabs($languageTabs),
                    ])
                    ->collapsible(),
                
                Section::make('Media')
                    ->description('Hero background image or video URL')
                    ->schema([
                        TextInput::make('media')
                            ->label('Media URL')
                            ->url()
                            ->helperText('Enter the URL for hero background image or video'),
                    ])
                    ->collapsible(),
            ]);
    }
}

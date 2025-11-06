<?php

namespace App\Filament\Resources\Abouts\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
 use Filament\Forms\Components\Group;
use App\Models\Translation;
use Filament\Schemas\Components\Section;

class AboutForm
{
    public static function configure(Schema $schema): Schema
    {
        // Fetch all translations from the database
        $translations = Translation::all();

        // Dynamically create a tab for each translation
        $languageTabs = $translations->map(function ($translation) {
            // Use translation name as tab label and key
            $langKey = $translation->value;
            $label = $translation->name;

            return Tab::make($label)
                ->schema([
                    TextInput::make("header.{$langKey}")
                        ->label("Header ({$label})")
                        ->required()
                        ->maxLength(255),
                    Textarea::make("content.{$langKey}")
                        ->label("Content ({$label})")
                        ->rows(10)
                        ->required(),
                ]);
        })->toArray();

        return $schema
            ->components([
                Section::make('About Content')
                    ->description('Manage the about section content with translations')
                    ->schema([
                        Tabs::make('Languages')
                            ->tabs($languageTabs),
                    ])
                    ->collapsible(),
                
                Section::make('Logo')
                    ->description('Upload the company logo')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('logo')
                            ->collection('logo')
                            ->image()
                            ->required()
                            ->helperText('Upload the company logo image'),
                    ])
                    ->collapsible(),
            ]);
    }
}

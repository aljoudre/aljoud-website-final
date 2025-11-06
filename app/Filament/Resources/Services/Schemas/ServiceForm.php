<?php

namespace App\Filament\Resources\Services\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;


use App\Models\Translation;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        $translations = Translation::all();

        // Language tabs for content fields
        $languageTabs = $translations->map(
            fn($translation) =>
            Tab::make($translation->name)
                ->schema([
                    TextInput::make("title.{$translation->value}")
                        ->label("Title ({$translation->name})")
                        ->required()
                        ->maxLength(255),
                    Textarea::make("description.{$translation->value}")
                        ->label("Description ({$translation->name})")
                        ->rows(4),
                ])
        )->toArray();

        return $schema->components([
            Section::make('Service Content')
                ->schema([
                    Tabs::make('Translations')
                        ->tabs($languageTabs)
                        ->columnSpanFull(),
                ]),
            
            Section::make('Service Icon')
                ->schema([
                    SpatieMediaLibraryFileUpload::make('icon')
                        ->collection('icon')
                        ->image()
                        ->maxFiles(1)
                        ->label('Service Icon')
                        ->helperText('Upload an icon for this service. If not set, space will be preserved but icon won\'t display.'),
                ]),
        ]);
    }
}

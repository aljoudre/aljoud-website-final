<?php

namespace App\Filament\Resources\Privacies\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use App\Models\Translation;
use Filament\Schemas\Components\Section;

class PrivacyForm
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
                        ->maxLength(255)
                        ->helperText('Privacy policy page title'),
                    RichEditor::make("content.{$langKey}")
                        ->label("Content ({$label})")
                        ->required()
                        ->toolbarButtons([
                            'bold',
                            'italic',
                            'underline',
                            'strike',
                            'bulletList',
                            'orderedList',
                            'link',
                            'blockquote',
                            'codeBlock',
                            'h2',
                            'h3',
                        ])
                        ->helperText('Full privacy policy content with markdown support'),
                ]);
        })->toArray();

        return $schema
            ->components([
                Section::make('Privacy Policy Content')
                    ->description('Manage the privacy policy content with translations and markdown support')
                    ->schema([
                        Tabs::make('Languages')
                            ->tabs($languageTabs),
                    ])
                    ->collapsible(),
            ]);
    }
}

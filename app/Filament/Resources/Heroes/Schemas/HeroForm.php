<?php

namespace App\Filament\Resources\Heroes\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use App\Models\Translation;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;

class HeroForm
{
    public static function configure(Schema $schema): Schema
    {
        $translations = Translation::all();

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

        // Refs for mutually exclusive video/image uploads + is_video toggle
        $videoField = SpatieMediaLibraryFileUpload::make('video')
            ->collection('video')
            ->disk('public')
            ->acceptedFileTypes(['video/*'])
            ->maxFiles(1)
            ->maxSize(40024) // 40MB in KB (40 * 1024), lower value if needed
            ->label('Hero Video')
            ->helperText('Upload video for hero section (Only one, Max 40MB)')
            ->reactive()
            ->afterStateUpdated(function ($state, $livewire, $set, $get) {
                // If video uploaded, set is_video to true.
                if (!empty($state)) {
                    $set('is_video', true);
                }
            });

        $imageField = SpatieMediaLibraryFileUpload::make('hero_image')
            ->collection('hero_image')
            ->disk('public')
            ->acceptedFileTypes(['image/*'])
            ->maxFiles(1)
            ->label('Hero Image')
            ->helperText('Upload image for hero section (Only one)')
            ->reactive()
            ->afterStateUpdated(function ($state, $livewire, $set, $get) {
                // If image uploaded, set is_video to false.
                if (!empty($state)) {
                    $set('is_video', false);
                }
            });

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
                    ->description('Hero background image or video upload (one required)')
                    ->schema([
                        Toggle::make('is_video')
                            ->label('Is Video')
                            ->helperText('Automatically switches based on upload (if Video uploaded = on, if Image uploaded = off)')
                            ->reactive(),
                        $videoField
                            ->required(fn ($get) => empty($get('hero_image'))), // Required if no image
                        $imageField
                            ->required(fn ($get) => empty($get('video'))), // Required if no video
                    ])
                    ->collapsible(),
            ]);
    }
}

<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
// use Filament\Infolists\Components\Grid;
// use Filament\Infolists\Components\Section;
use Filament\Schemas\Schema;
use App\Models\Translation;
use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;

class ProjectInfolist
{
    public static function configure(Schema $schema): Schema
    {
        // Fetch all translations from the database
        $translations = \App\Models\Translation::all();

        // Dynamically create a section for each translation
        $languageSections = $translations->map(function ($translation) {
            $langKey = $translation->value;
            $label = $translation->name;

            return Section::make($label)
                ->schema([
                    TextEntry::make("name.{$langKey}")
                        ->label("Name ({$label})"),
                    TextEntry::make("subtitle.{$langKey}")
                        ->label("Subtitle ({$label})"),
                    TextEntry::make("location.{$langKey}")
                        ->label("Location ({$label})"),
                    TextEntry::make("type.{$langKey}")
                        ->label("Type ({$label})"),
                    TextEntry::make("status.{$langKey}")
                        ->label("Status ({$label})"),
                ]);
        })->toArray();

        return $schema
            ->components([
                ...$languageSections,

                Grid::make([
                    'default' => 1,
                    'md' => 3,
                ])
                ->schema([
                    SpatieMediaLibraryImageEntry::make('project_logo')
                        ->label('Project Logo')
                        ->collection('project_logo')
                        ->columnSpan(1),
                    SpatieMediaLibraryImageEntry::make('project_image')
                        ->label('Main Project Image')
                        ->collection('project_image')
                        ->columnSpan(1),
                    // For gallery, show multiple images
                    SpatieMediaLibraryImageEntry::make('project_gallery')
                        ->label('Project Gallery')
                        ->collection('project_gallery')
                       
                        ->columnSpan(1),
                ])
                ->columns([
                    'default' => 1,
                    'md' => 3,
                ]),

                TextEntry::make('created_at')
                    ->label('Created At')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->label('Updated At')
                    ->dateTime(),
            ]);
    }
}

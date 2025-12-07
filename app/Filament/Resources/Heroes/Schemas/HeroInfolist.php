<?php

namespace App\Filament\Resources\Heroes\Schemas;

use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ViewEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class HeroInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Hero Content')
                    ->schema([
                        TextEntry::make('title')
                            ->label('Title')
                            ->formatStateUsing(function ($record) {
                                $locale = app()->getLocale();
                                return $record->translate('title', $locale);
                            }),
                        TextEntry::make('subtitle')
                            ->label('Subtitle')
                            ->formatStateUsing(function ($record) {
                                $locale = app()->getLocale();
                                return $record->translate('subtitle', $locale);
                            }),
                    ])
                    ->collapsible(),

                Section::make('Media')
                    ->schema([
                        TextEntry::make('media_url')
                            ->label('Media URL'),
                        // Video Preview
                        SpatieMediaLibraryImageEntry::make('video')
                            ->label('Video')
                            ->collection('video')
                            ->columnSpan(1),
                        // Hero Image Preview
                        SpatieMediaLibraryImageEntry::make('hero_image')
                            ->label('Hero Image')
                            ->collection('hero_image')
                            ->columnSpan(1),
                    ])
                    ->collapsible(),

                Section::make('Meta Data')
                    ->schema([
                        TextEntry::make('created_at')
                            ->label('Created At')
                            ->dateTime(),
                        TextEntry::make('updated_at')
                            ->label('Updated At')
                            ->dateTime(),
                    ])
                    ->collapsible(),
            ]);
    }
}

<?php

namespace App\Filament\Resources\Heroes\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class HeroInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('title')
                    ->formatStateUsing(function ($record) {
                        $locale = app()->getLocale();
                        return $record->translate('title', $locale);
                    }),
                TextEntry::make('subtitle')
                    ->formatStateUsing(function ($record) {
                        $locale = app()->getLocale();
                        return $record->translate('subtitle', $locale);
                    }),
                TextEntry::make('media'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}

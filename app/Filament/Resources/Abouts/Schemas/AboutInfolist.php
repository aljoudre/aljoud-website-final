<?php

namespace App\Filament\Resources\Abouts\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class AboutInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // TextEntry::make('title'),
                // TextEntry::make('description'),
                // ImageEntry::make('image'),
                // TextEntry::make('created_at')
                //     ->dateTime(),
                // TextEntry::make('updated_at')
                //     ->dateTime(),

                ...collect(array_keys($record->content ?? []))
                    ->map(fn($key) => TextEntry::make("content.$key")->label("Content ($key)"))
                    ->all(),
            ]);
    }
}

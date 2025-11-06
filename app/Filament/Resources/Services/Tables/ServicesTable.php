<?php

namespace App\Filament\Resources\Services\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class ServicesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                ImageColumn::make('icon')
                    ->label('Icon')
                    ->getStateUsing(function ($record) {
                        try {
                            $media = $record->getFirstMedia('icon');
                            return $media ? $media->getUrl() : null;
                        } catch (\Exception $e) {
                            return null;
                        }
                    })
                    ->circular()
                    ->size(40),
                TextColumn::make('title')
                    ->label('Title')
                    ->formatStateUsing(function ($state, $record) {
                        $locale = app()->getLocale();
                        return is_array($state) ? ($state[$locale] ?? $state['ar'] ?? $state['en'] ?? 'N/A') : $state;
                    })
                    ->searchable()
                    ->sortable(),
                TextColumn::make('description')
                    ->label('Description')
                    ->formatStateUsing(function ($state) {
                        $locale = app()->getLocale();
                        $text = is_array($state) ? ($state[$locale] ?? $state['ar'] ?? $state['en'] ?? '') : $state;
                        return \Illuminate\Support\Str::limit($text, 50);
                    })
                    ->limit(50)
                    ->wrap(),
                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Updated At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('id', 'desc');
    }
}

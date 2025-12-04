<?php

namespace App\Filament\Resources\ContactSettings\Tables;

use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ContactSettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('email')
                    ->label('Email')
                    ->default('—')
                    ->copyable()
                    ->searchable(),
                
                TextColumn::make('phone')
                    ->label('Phone')
                    ->default('—')
                    ->copyable()
                    ->searchable(),
                
                TextColumn::make('facebook')
                    ->label('Facebook')
                    ->default('—')
                    ->url(fn ($record) => $record->facebook)
                    ->openUrlInNewTab()
                    ->limit(30),
                
                TextColumn::make('twitter')
                    ->label('Twitter/X')
                    ->default('—')
                    ->url(fn ($record) => $record->twitter)
                    ->openUrlInNewTab()
                    ->limit(30),
                
                TextColumn::make('instagram')
                    ->label('Instagram')
                    ->default('—')
                    ->url(fn ($record) => $record->instagram)
                    ->openUrlInNewTab()
                    ->limit(30),
                
                TextColumn::make('linkedin')
                    ->label('LinkedIn')
                    ->default('—')
                    ->url(fn ($record) => $record->linkedin)
                    ->openUrlInNewTab()
                    ->limit(30),
                
                TextColumn::make('youtube')
                    ->label('YouTube')
                    ->default('—')
                    ->url(fn ($record) => $record->youtube)
                    ->openUrlInNewTab()
                    ->limit(30),
                
                TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->paginated([10, 25, 50]);
    }
}

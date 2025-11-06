<?php

namespace App\Filament\Resources\Contacts\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ContactForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('الاسم')
                    ->required()
                    ->disabled(fn ($record) => $record !== null),
                TextInput::make('phone')
                    ->label('الهاتف')
                    ->tel()
                    ->required()
                    ->disabled(fn ($record) => $record !== null),
                TextInput::make('email')
                    ->label('البريد الإلكتروني')
                    ->email()
                    ->required()
                    ->disabled(fn ($record) => $record !== null),
                Textarea::make('message')
                    ->label('الرسالة')
                    ->rows(5)
                    ->required()
                    ->disabled(fn ($record) => $record !== null),
                Toggle::make('read')
                    ->label('تم القراءة')
                    ->default(false),
            ]);
    }
}

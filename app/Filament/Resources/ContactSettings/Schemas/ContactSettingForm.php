<?php

namespace App\Filament\Resources\ContactSettings\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;

class ContactSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Contact Information')
                ->description('Fill in the contact information you want to display on the website. Only the first record will be used.')
                ->schema([
                    TextInput::make('email')
                        ->label('Email')
                        ->email()
                        ->placeholder('info@example.com')
                        ->helperText('Main email address'),
                    
                    TextInput::make('phone')
                        ->label('Phone')
                        ->tel()
                        ->placeholder('+966 50 123 4567')
                        ->helperText('Main phone number'),
                    
                    TextInput::make('facebook')
                        ->label('Facebook URL')
                        ->url()
                        ->placeholder('https://facebook.com/yourpage')
                        ->helperText('Full Facebook page URL'),
                    
                    TextInput::make('twitter')
                        ->label('Twitter / X URL')
                        ->url()
                        ->placeholder('https://twitter.com/yourhandle')
                        ->helperText('Full Twitter/X profile URL'),
                    
                    TextInput::make('instagram')
                        ->label('Instagram URL')
                        ->url()
                        ->placeholder('https://instagram.com/yourhandle')
                        ->helperText('Full Instagram profile URL'),
                    
                    TextInput::make('linkedin')
                        ->label('LinkedIn URL')
                        ->url()
                        ->placeholder('https://linkedin.com/company/yourcompany')
                        ->helperText('Full LinkedIn company/profile URL'),
                    
                    TextInput::make('youtube')
                        ->label('YouTube URL')
                        ->url()
                        ->placeholder('https://youtube.com/@yourchannel')
                        ->helperText('Full YouTube channel URL'),
                ]),
        ]);
    }
}

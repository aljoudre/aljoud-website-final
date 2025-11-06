<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use App\Models\Translation;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Illuminate\Support\Str;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        $translations = \App\Models\Translation::all();

        // Language tabs for content fields
        $languageTabs = $translations->map(
            fn($translation) =>
            Tab::make($translation->name)
                ->schema([
                    Grid::make([
                        'default' => 1,
                        'md' => 2,
                    ])->schema([
                        Textarea::make("name.{$translation->value}")
                            ->label("Name ({$translation->name})")
                            ->required(),
                        Textarea::make("subtitle.{$translation->value}")
                            ->label("Subtitle ({$translation->name})")
                            ->required(),
                        Textarea::make("location.{$translation->value}")
                            ->label("Location ({$translation->name})")
                            ->required(),
                        Textarea::make("type.{$translation->value}")
                            ->label("Type ({$translation->name})")
                            ->required(),
                        Textarea::make("status.{$translation->value}")
                            ->label("Status ({$translation->name})")
                            ->required(),
                        Textarea::make("description.{$translation->value}")
                            ->label("Full Description ({$translation->name})")
                            ->rows(8),
                        TextInput::make("header_description.{$translation->value}")
                            ->label("Header Description ({$translation->name})")
                            ->helperText('Brief description shown in header if header image is disabled'),
                        TextInput::make("owner.{$translation->value}")
                            ->label("Owner ({$translation->name})"),
                        TextInput::make("developer.{$translation->value}")
                            ->label("Developer ({$translation->name})"),
                        TextInput::make("contractor.{$translation->value}")
                            ->label("Contractor ({$translation->name})"),
                    ]),
                ])
        )->toArray();

        return $schema->components([
            Tabs::make('Project Management')
                ->tabs([
                    // Tab 1: Basic Info & Content
                    Tab::make('Basic Info')
                        ->icon('heroicon-o-information-circle')
                        ->schema([
                            Section::make('Project Identity')
                                ->schema([
                                    TextInput::make('uuid')
                                        ->disabled()
                                        ->default(fn() => (string) Str::uuid())
                                        ->helperText('Unique identifier for project URL'),
                                    Select::make('category')
                                        ->label('Project Category')
                                        ->options([
                                            'lands_auctions' => 'Lands & Auctions',
                                            'residential_commercial' => 'Residential & Commercial Towers',
                                        ])
                                        ->default('lands_auctions')
                                        ->required(),
                                    ColorPicker::make("status_color")
                                        ->label("Status Color")
                                        ->default("#005A58"),
                                ])
                                ->columns(3),
                            
                            Section::make('Project Content')
                                ->schema([
                                    Tabs::make('Translations')
                                        ->tabs($languageTabs)
                                        ->columnSpanFull(),
                                ]),
                            
                            Section::make('Project Stats/Units')
                                ->schema([
                                    Repeater::make('stats')
                                        ->relationship('stats')
                                        ->schema([
                                            Tabs::make('Stat Translations')
                                                ->tabs(
                                                    $translations->map(
                                                        fn($translation) =>
                                                        Tab::make($translation->name)
                                                            ->schema([
                                                                TextInput::make("title.{$translation->value}")
                                                                    ->label("Stat Title ({$translation->name})")
                                                                    ->required()
                                                                    ->helperText('e.g., "مساحة الأرض السكنية" or "Residential Land Area"'),
                                                            ])
                                                    )->toArray()
                                                )
                                                ->columnSpanFull(),
                                            Grid::make(2)
                                                ->schema([
                                                    TextInput::make('value')
                                                        ->label('Value')
                                                        ->required()
                                                        ->helperText('e.g., "0 م2" or "150 units"'),
                                                    TextInput::make('order')
                                                        ->label('Display Order')
                                                        ->numeric()
                                                        ->default(0),
                                                ]),
                                        ])
                                        ->columns(1)
                                        ->itemLabel(fn(array $state): ?string => $state['title']['ar'] ?? $state['title']['en'] ?? 'New Stat')
                                        ->collapsible()
                                        ->defaultItems(0)
                                        ->helperText('Add project statistics/units (e.g., area, number of units, etc.)'),
                                ]),
                        ]),

                    // Tab 2: Media
                    Tab::make('Media')
                        ->icon('heroicon-o-photo')
                        ->schema([
                            Section::make('Project Images')
                                ->schema([
                                    SpatieMediaLibraryFileUpload::make('project_image')
                                        ->collection('project_image')
                                        ->disk('public')
                                        ->image()
                                        ->maxFiles(1)
                                        ->maxSize(1024) // 1MB in KB
                                        ->required(fn ($record) => $record === null)
                                        ->label('Main Project Image (Card)')
                                        ->helperText('Required: Used in project cards and listings. Max size: 1MB'),

                                    SpatieMediaLibraryFileUpload::make('header_image')
                                        ->collection('header_image')
                                        ->disk('public')
                                        ->image()
                                        ->maxFiles(1)
                                        ->maxSize(1024) // 1MB in KB
                                        ->label('Hero Image')
                                        ->helperText('Main hero image for project detail page. Max size: 1MB'),

                                    SpatieMediaLibraryFileUpload::make('project_gallery')
                                        ->collection('project_gallery')
                                        ->disk('public')
                                        ->multiple()
                                        ->maxSize(1024) // 1MB in KB
                                        ->label('Gallery Images')
                                        ->helperText('Multiple images for gallery section. Max size per image: 1MB'),
                                ]),
                            
                            Section::make('Logos')
                                ->schema([
                                    Grid::make(['default' => 1, 'md' => 2, 'lg' => 4])
                                        ->schema([
                                            SpatieMediaLibraryFileUpload::make('project_logo')
                                                ->collection('project_logo')
                                                ->disk('public')
                                                ->image()
                                                ->maxFiles(1)
                                                ->maxSize(1024) // 1MB in KB
                                                ->label('Project Logo'),
                                            
                                            SpatieMediaLibraryFileUpload::make('marker_logo')
                                                ->collection('marker_logo')
                                                ->disk('public')
                                                ->image()
                                                ->maxFiles(1)
                                                ->maxSize(1024) // 1MB in KB
                                                ->label('Map Marker Logo')
                                                ->helperText('Custom logo for map marker (uses project logo if not set)'),
                                            
                                            SpatieMediaLibraryFileUpload::make('owner_logo')
                                                ->collection('owner_logo')
                                                ->disk('public')
                                                ->image()
                                                ->maxFiles(1)
                                                ->maxSize(1024) // 1MB in KB
                                                ->label('Owner Logo'),
                                            
                                            SpatieMediaLibraryFileUpload::make('developer_logo')
                                                ->collection('developer_logo')
                                                ->disk('public')
                                                ->image()
                                                ->maxFiles(1)
                                                ->maxSize(1024) // 1MB in KB
                                                ->label('Developer Logo'),
                                            
                                            SpatieMediaLibraryFileUpload::make('contractor_logo')
                                                ->collection('contractor_logo')
                                                ->disk('public')
                                                ->image()
                                                ->maxFiles(1)
                                                ->maxSize(1024) // 1MB in KB
                                                ->label('Contractor Logo'),
                                        ]),
                                ]),
                        ]),

                    // Tab 3: Map Configuration
                    Tab::make('Map')
                        ->icon('heroicon-o-map')
                        ->schema([
                            Section::make('Map Settings')
                                ->schema([
                                    Select::make('map_type')
                                        ->label('Map Type')
                                        ->options([
                                            'marker' => 'Marker (Single Point)',
                                            'polygon' => 'Polygon (Area)',
                                        ])
                                        ->default('marker')
                                        ->required()
                                        ->reactive()
                                        ->helperText('Choose marker for single point or polygon for area'),
                                    
                                    ColorPicker::make('polygon_color')
                                        ->label('Polygon Color')
                                        ->default('#005A58')
                                        ->visible(fn ($get) => $get('map_type') === 'polygon'),
                                    
                                    Grid::make(2)
                                        ->schema([
                                            TextInput::make('marker_lat')
                                                ->label('Marker Latitude')
                                                ->numeric()
                                                ->step('any')
                                                ->visible(fn ($get) => $get('map_type') === 'marker')
                                                ->helperText('Click on map to set'),
                                            
                                            TextInput::make('marker_lng')
                                                ->label('Marker Longitude')
                                                ->numeric()
                                                ->step('any')
                                                ->visible(fn ($get) => $get('map_type') === 'marker')
                                                ->helperText('Click on map to set'),
                                        ]),
                                    
                                    \Filament\Forms\Components\ViewField::make('map_editor')
                                        ->view('admin.map-editor')
                                        ->dehydrated(false)
                                        ->columnSpanFull(),
                                    
                                    Textarea::make('polygon_coordinates')
                                        ->label('Polygon Coordinates (JSON)')
                                        ->visible(fn ($get) => $get('map_type') === 'polygon')
                                        ->helperText('Auto-filled by map editor - Debug only')
                                        ->disabled(),
                                ]),
                        ]),

                    // Tab 4: Nearby Places & Button
                    Tab::make('Places & Actions')
                        ->icon('heroicon-o-map-pin')
                        ->schema([
                            Section::make('Nearby Places')
                                ->schema([
                                    Repeater::make('nearPlaces')
                                        ->relationship('nearPlaces')
                                        ->schema([
                                            Tabs::make('Place Translations')
                                                ->tabs(
                                                    $translations->map(
                                                        fn($translation) =>
                                                        Tab::make($translation->name)
                                                            ->schema([
                                                                TextInput::make("name.{$translation->value}")
                                                                    ->label("Place Name ({$translation->name})")
                                                                    ->required(),
                                                                Textarea::make("description.{$translation->value}")
                                                                    ->label("Description ({$translation->name})")
                                                                    ->rows(2),
                                                            ])
                                                    )->toArray()
                                                )
                                                ->columnSpanFull(),
                                            Grid::make(2)
                                                ->schema([
                                                    TextInput::make('time')
                                                        ->label('Time (minutes)')
                                                        ->numeric()
                                                        ->default(5)
                                                        ->required()
                                                        ->minValue(1)
                                                        ->maxValue(120)
                                                        ->helperText('Time in minutes to reach this place'),
                                                    TextInput::make('order')
                                                        ->label('Order')
                                                        ->numeric()
                                                        ->default(0),
                                                ]),
                                        ])
                                        ->columns(1)
                                        ->itemLabel(fn(array $state): ?string => $state['name']['ar'] ?? $state['name']['en'] ?? $state['name']['zh'] ?? 'New Place')
                                        ->collapsible()
                                        ->defaultItems(0),
                                ]),
                            
                            Section::make('Interest Registration Button')
                                ->schema([
                                    Repeater::make('buttons')
                                        ->relationship('buttons')
                                        ->schema([
                                            Grid::make(2)
                                                ->schema([
                                                    TextInput::make('title.ar')
                                                        ->label('Button Title (AR)')
                                                        ->required(),
                                                    TextInput::make('title.en')
                                                        ->label('Button Title (EN)')
                                                        ->required(),
                                                ]),
                                            Select::make('type')
                                                ->label('Button Type')
                                                ->options([
                                                    'form' => 'Interest Form (External Form URL)',
                                                    'external_url' => 'External URL',
                                                ])
                                                ->default('form')
                                                ->required()
                                                ->reactive(),
                                            TextInput::make('form_url')
                                                ->label('External Form URL')
                                                ->url()
                                                ->visible(fn ($get) => $get('type') === 'form')
                                                ->required(fn ($get) => $get('type') === 'form')
                                                ->helperText('Enter the external form URL (e.g., Google Forms)'),
                                            TextInput::make('url')
                                                ->label('URL')
                                                ->url()
                                                ->visible(fn ($get) => $get('type') === 'external_url')
                                                ->required(fn ($get) => $get('type') === 'external_url'),
                                            TextInput::make('order')
                                                ->label('Display Order')
                                                ->numeric()
                                                ->default(0),
                                        ])
                                        ->columns(1)
                                        ->itemLabel(fn(array $state): ?string => $state['title']['ar'] ?? $state['title']['en'] ?? 'New Button')
                                        ->collapsible()
                                        ->defaultItems(0)
                                        ->maxItems(1)
                                        ->helperText('One interest registration button allowed'),
                                ]),
                        ]),
                ])
                ->columnSpanFull(),
        ]);
    }
}

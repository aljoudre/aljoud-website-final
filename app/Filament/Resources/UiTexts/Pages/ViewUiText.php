<?php

namespace App\Filament\Resources\UiTexts\Pages;

use App\Filament\Resources\UiTexts\UiTextResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewUiText extends ViewRecord
{
    protected static string $resource = UiTextResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}

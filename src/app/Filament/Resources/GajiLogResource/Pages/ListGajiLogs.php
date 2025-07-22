<?php

namespace App\Filament\Resources\GajiLogResource\Pages;

use App\Filament\Resources\GajiLogResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGajiLogs extends ListRecords
{
    protected static string $resource = GajiLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

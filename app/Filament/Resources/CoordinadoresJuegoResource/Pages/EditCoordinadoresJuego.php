<?php

namespace App\Filament\Resources\CoordinadoresJuegoResource\Pages;

use App\Filament\Resources\CoordinadoresJuegoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCoordinadoresJuego extends EditRecord
{
    protected static string $resource = CoordinadoresJuegoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\CoordinadoresJuegoResource\Pages;

use App\Filament\Resources\CoordinadoresJuegoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCoordinadoresJuegos extends ListRecords
{
    protected static string $resource = CoordinadoresJuegoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

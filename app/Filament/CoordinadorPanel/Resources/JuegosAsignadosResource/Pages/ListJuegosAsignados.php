<?php

namespace App\Filament\CoordinadorPanel\Resources\JuegosAsignadosResource\Pages;

use App\Filament\CoordinadorPanel\Resources\JuegosAsignadosResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJuegosAsignados extends ListRecords
{
    protected static string $resource = JuegosAsignadosResource::class;

    protected function getActions(): array
    {
        return [];
    }
}

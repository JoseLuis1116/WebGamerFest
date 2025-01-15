<?php

namespace App\Filament\CoordinadorPanel\Resources\JuegosAsignadosResource\Pages;

use App\Filament\CoordinadorPanel\Resources\JuegosAsignadosResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJuegosAsignados extends EditRecord
{
    protected static string $resource = JuegosAsignadosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

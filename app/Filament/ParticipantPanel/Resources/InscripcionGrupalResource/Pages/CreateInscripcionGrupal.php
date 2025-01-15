<?php

namespace App\Filament\ParticipantPanel\Resources\InscripcionGrupalResource\Pages;

use App\Filament\ParticipantPanel\Resources\InscripcionGrupalResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateInscripcionGrupal extends CreateRecord
{
    protected static string $resource = InscripcionGrupalResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['IDLider'] = auth()->user()->id; // Asignar automáticamente el usuario actual como líder
        return $data;
    }
}

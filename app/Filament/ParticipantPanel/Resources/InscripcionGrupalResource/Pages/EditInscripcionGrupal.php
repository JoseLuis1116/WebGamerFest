<?php

namespace App\Filament\ParticipantPanel\Resources\InscripcionGrupalResource\Pages;

use App\Filament\ParticipantPanel\Resources\InscripcionGrupalResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInscripcionGrupal extends EditRecord
{
    protected static string $resource = InscripcionGrupalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

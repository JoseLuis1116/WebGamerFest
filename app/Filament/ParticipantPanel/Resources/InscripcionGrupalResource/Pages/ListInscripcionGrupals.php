<?php

namespace App\Filament\ParticipantPanel\Resources\InscripcionGrupalResource\Pages;

use App\Filament\ParticipantPanel\Resources\InscripcionGrupalResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInscripcionGrupals extends ListRecords
{
    protected static string $resource = InscripcionGrupalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

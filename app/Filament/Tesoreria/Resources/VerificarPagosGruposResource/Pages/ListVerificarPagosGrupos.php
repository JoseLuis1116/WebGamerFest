<?php

namespace App\Filament\Tesoreria\Resources\VerificarPagosGruposResource\Pages;

use App\Filament\Tesoreria\Resources\VerificarPagosGruposResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVerificarPagosGrupos extends ListRecords
{
    protected static string $resource = VerificarPagosGruposResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

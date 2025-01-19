<?php

namespace App\Filament\Tesoreria\Resources\VerificarPagosGruposResource\Pages;

use App\Filament\Tesoreria\Resources\VerificarPagosGruposResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVerificarPagosGrupos extends EditRecord
{
    protected static string $resource = VerificarPagosGruposResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

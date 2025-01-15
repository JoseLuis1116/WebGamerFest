<?php

namespace App\Filament\Tesoreria\Resources\VerificarPagosResource\Pages;

use App\Filament\Tesoreria\Resources\VerificarPagosResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVerificarPagos extends EditRecord
{
    protected static string $resource = VerificarPagosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

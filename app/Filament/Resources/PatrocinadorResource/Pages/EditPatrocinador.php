<?php

namespace App\Filament\Resources\PatrocinadorResource\Pages;

use App\Filament\Resources\PatrocinadorResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPatrocinador extends EditRecord
{
    protected static string $resource = PatrocinadorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

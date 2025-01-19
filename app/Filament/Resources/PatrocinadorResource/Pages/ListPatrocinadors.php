<?php

namespace App\Filament\Resources\PatrocinadorResource\Pages;

use App\Filament\Resources\PatrocinadorResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPatrocinadors extends ListRecords
{
    protected static string $resource = PatrocinadorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

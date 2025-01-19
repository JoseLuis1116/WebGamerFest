<?php

namespace App\Filament\CoordinadorPanel\Resources;

use App\Filament\CoordinadorPanel\Resources\JuegosAsignadosResource\Pages;
use App\Models\CoordinadorJuego;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class JuegosAsignadosResource extends Resource
{
    protected static ?string $model = CoordinadorJuego::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Gestion de Juegos';

    protected static ?string $label = 'Juego Asignado';

    protected static ?string $pluralLabel = 'Juegos Asignados';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('coordinador.name') // Cambiado a 'name'
                    ->label('Coordinador')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('juego.NombreJuego') // Asegúrate de que 'nombre' exista en la tabla juegos
                    ->label('Juego')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([])
            ->actions([])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJuegosAsignados::route('/'),
        ];
    }
}

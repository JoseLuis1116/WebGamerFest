<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CoordinadoresJuegoResource\Pages;
use App\Models\CoordinadorJuego;
use Filament\Forms; // Importación para formularios
use Filament\Resources\Resource; // Clase base para recursos
use Filament\Tables; // Para tablas y componentes

class CoordinadoresJuegoResource extends Resource
{
    protected static ?string $model = CoordinadorJuego::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Gestión de Coordinadores';

    protected static ?string $navigationLabel = 'Coordinadores Juegos';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('IDCoordinador')
                    ->label('Coordinador')
                    ->options(function () {
                        return \App\Models\Usuario::where('IDRol', 3) // Filtrar usuarios con rol de Coordinador
                            ->pluck('name', 'id'); // Cambia 'name' por el campo correcto
                    })
                    ->required(),
                Forms\Components\Select::make('IDJuego')
                    ->label('Juego')
                    ->relationship('juego', 'NombreJuego') // Cambia 'NombreJuego' por el campo correcto
                    ->required(),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('coordinador.name') // Cambia 'name' según el atributo del modelo coordinador
                    ->label('Coordinador'),
                Tables\Columns\TextColumn::make('juego.NombreJuego') // Cambia 'NombreJuego' para reflejar el campo correcto
                    ->label('Juego'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCoordinadoresJuegos::route('/'),
            'create' => Pages\CreateCoordinadoresJuego::route('/create'),
            'edit' => Pages\EditCoordinadoresJuego::route('/{record}/edit'),
        ];
    }
}

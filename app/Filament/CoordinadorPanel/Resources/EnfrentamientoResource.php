<?php

namespace App\Filament\CoordinadorPanel\Resources;

use App\Models\Enfrentamiento;
use App\Models\Inscripcion;
use App\Models\Usuario;
use App\Models\Juego;
use App\Models\CoordinadorJuego;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Filament\CoordinadorPanel\Resources\EnfrentamientoResource\Pages;

class EnfrentamientoResource extends Resource
{
    protected static ?string $model = Enfrentamiento::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('NombreJuego')
                    ->label('Juego')
                    ->default(function () {
                        $coordinadorId = auth()->user()->id; // Asume que el coordinador está autenticado
                        $juego = CoordinadorJuego::where('IDCoordinador', $coordinadorId)
                            ->with('juego')
                            ->first();

                        return $juego ? $juego->juego->NombreJuego : 'No asignado';
                    })
                    ->disabled(),

                Forms\Components\Hidden::make('IDJuego')
                    ->default(function () {
                        $coordinadorId = auth()->user()->id; // Asume que el coordinador está autenticado
                        return CoordinadorJuego::where('IDCoordinador', $coordinadorId)
                            ->pluck('IDJuego')
                            ->first();
                    }),

                Forms\Components\Hidden::make('participante1')
                    ->default(function () {
                        $coordinadorId = auth()->user()->id;
                        $juegoId = CoordinadorJuego::where('IDCoordinador', $coordinadorId)
                            ->pluck('IDJuego')
                            ->first();

                        $participantes = Inscripcion::where('estado', 'aprobado')
                            ->where('IDJuego', $juegoId)
                            ->with('usuario')
                            ->inRandomOrder()
                            ->take(2)
                            ->get();

                        return $participantes->first() ? $participantes->first()->usuario->id : null;
                    }),

                Forms\Components\Hidden::make('participante2')
                    ->default(function () {
                        $coordinadorId = auth()->user()->id;
                        $juegoId = CoordinadorJuego::where('IDCoordinador', $coordinadorId)
                            ->pluck('IDJuego')
                            ->first();

                        $participantes = Inscripcion::where('estado', 'aprobado')
                            ->where('IDJuego', $juegoId)
                            ->with('usuario')
                            ->inRandomOrder()
                            ->take(2)
                            ->get();

                        return $participantes->skip(1)->first() ? $participantes->skip(1)->first()->usuario->id : null;
                    }),

                Forms\Components\TextInput::make('nombre_participante1')
                    ->label('Participante 1')
                    ->default(function () {
                        $coordinadorId = auth()->user()->id;
                        $juegoId = CoordinadorJuego::where('IDCoordinador', $coordinadorId)
                            ->pluck('IDJuego')
                            ->first();

                        $participantes = Inscripcion::where('estado', 'aprobado')
                            ->where('IDJuego', $juegoId)
                            ->with('usuario')
                            ->inRandomOrder()
                            ->take(2)
                            ->get();

                        return $participantes->first() ? $participantes->first()->usuario->name : 'No disponible';
                    })
                    ->disabled(),

                Forms\Components\TextInput::make('nombre_participante2')
                    ->label('Participante 2')
                    ->default(function () {
                        $coordinadorId = auth()->user()->id;
                        $juegoId = CoordinadorJuego::where('IDCoordinador', $coordinadorId)
                            ->pluck('IDJuego')
                            ->first();

                        $participantes = Inscripcion::where('estado', 'aprobado')
                            ->where('IDJuego', $juegoId)
                            ->with('usuario')
                            ->inRandomOrder()
                            ->take(2)
                            ->get();

                        return $participantes->skip(1)->first() ? $participantes->skip(1)->first()->usuario->name : 'No disponible';
                    })
                    ->disabled(),

                Forms\Components\TextInput::make('ronda')
                    ->label('Ronda')
                    ->default(function () {
                        $coordinadorId = auth()->user()->id;
                        $juegoId = CoordinadorJuego::where('IDCoordinador', $coordinadorId)
                            ->pluck('IDJuego')
                            ->first();

                        $totalParticipantes = Inscripcion::where('estado', 'aprobado')
                            ->where('IDJuego', $juegoId)
                            ->count();

                        return ceil(log($totalParticipantes, 2)); // Número de rondas basado en eliminatorias
                    })
                    ->disabled(),

                Forms\Components\Hidden::make('fecha')
                    ->default(now()->format('Y-m-d H:i:s')),

                Forms\Components\TextInput::make('fecha_visible')
                    ->label('Fecha del enfrentamiento')
                    ->default(now()->format('Y-m-d H:i:s'))
                    ->disabled(),

                Forms\Components\Select::make('estado')
                    ->label('Estado')
                    ->options([
                        'pendiente' => 'Pendiente',
                        'finalizado' => 'Finalizado',
                    ])
                    ->default('pendiente')
                    ->required(),

                Forms\Components\TextInput::make('resultado')
                    ->label('Resultado'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('juego.NombreJuego')
                    ->label('Juego'),

                Tables\Columns\TextColumn::make('participanteUno.name')
                    ->label('Participante 1'),

                Tables\Columns\TextColumn::make('participanteDos.name')
                    ->label('Participante 2'),

                Tables\Columns\TextColumn::make('ronda')
                    ->label('Ronda'),

                Tables\Columns\TextColumn::make('fecha')
                    ->label('Fecha')
                    ->dateTime(),

                Tables\Columns\TextColumn::make('estado')
                    ->label('Estado'),

                Tables\Columns\TextColumn::make('resultado')
                    ->label('Resultado'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('IDJuego')
                    ->label('Juego')
                    ->options(Juego::pluck('NombreJuego', 'IDJuego')),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListEnfrentamientos::route('/'),
            'create' => Pages\CreateEnfrentamiento::route('/create'),
            'edit' => Pages\EditEnfrentamiento::route('/{record}/edit'),
        ];
    }
}

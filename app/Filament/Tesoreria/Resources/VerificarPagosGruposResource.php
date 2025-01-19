<?php

namespace App\Filament\Tesoreria\Resources;

use App\Filament\Tesoreria\Resources\VerificarPagosGruposResource\Pages;
use App\Models\Grupo;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;

class VerificarPagosGruposResource extends Resource
{
    protected static ?string $model = Grupo::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'Verificar Pagos Grupos';

    protected static ?string $pluralLabel = 'Inscripciones Grupales';

    public static function form(\Filament\Forms\Form $form): \Filament\Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('estado')
                    ->label('Estado')
                    ->options([
                        'Pendiente' => 'Pendiente',
                        'Verificado' => 'Verificado',
                    ])
                    ->required()
                    ->default('Pendiente'),
            ]);
    }

    public static function table(\Filament\Tables\Table $table): \Filament\Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre_equipo')
                    ->label('Nombre del Equipo')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('lider.name')
                    ->label('Líder del Equipo')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('juego.NombreJuego')
                    ->label('Juego')
                    ->sortable(),
                Tables\Columns\TextColumn::make('numero_comprobante')
                    ->label('Número de Comprobante'),
                Tables\Columns\BadgeColumn::make('estado')
                    ->label('Estado')
                    ->colors([
                        'primary' => 'Pendiente',
                        'success' => 'Verificado',
                    ])
                    ->sortable(),
                Tables\Columns\TextColumn::make('fecha_inscripcion')
                    ->label('Fecha de Inscripción')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('fecha_pago')
                    ->label('Fecha de Pago')
                    ->date(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('estado')
                    ->label('Estado')
                    ->options([
                        'Pendiente' => 'Pendiente',
                        'Verificado' => 'Verificado',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Editar Estado')
                    ->form([
                        Forms\Components\Select::make('estado')
                            ->label('Estado')
                            ->options([
                                'Pendiente' => 'Pendiente',
                                'Verificado' => 'Verificado',
                            ])
                            ->required(),
                    ]),
            ])
            ->bulkActions([]);
    }

    public static function getRelations(): array
    {
        return [];
    }
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVerificarPagosGrupos::route('/'),
            'edit' => Pages\EditVerificarPagosGrupos::route('/{record}/edit'),
        ];
    }
    
}

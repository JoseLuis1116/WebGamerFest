<?php

namespace App\Filament\ParticipantPanel\Resources\InscripcionGrupalResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use App\Models\Usuario;
use App\Models\IntegranteGrupo;
use App\Models\Grupo;

class IntegrantesRelationManager extends RelationManager
{
    protected static string $relationship = 'integrantesGrupo';

    protected static ?string $recordTitleAttribute = 'id_usuario';

    public function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Select::make('id_usuario')
                    ->label('Usuario')
                    ->options(function () {
                        // Obtener IDs de usuarios ya en la tabla integrantes_grupo
                        $usuariosEnIntegrantesGrupo = IntegranteGrupo::pluck('id_usuario')->toArray();

                        // Obtener IDs de usuarios registrados como líderes en la tabla grupos
                        $usuariosEnGrupos = Grupo::pluck('IDLider')->toArray();

                        // Filtrar usuarios que tienen rol de participante y no están en ambas tablas
                        return Usuario::where('IDRol', 4) // Supongamos que 3 es el ID del rol participante
                            ->whereNotIn('id', $usuariosEnIntegrantesGrupo)
                            ->whereNotIn('id', $usuariosEnGrupos)
                            ->pluck('name', 'id');
                    })
                    ->searchable()
                    ->required(),
            ]);
    }

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('usuario.name') // Asegúrate de que el campo 'name' es el correcto
                    ->label('Nombre del Usuario'),
            ])
            ->filters([
                // Agrega filtros adicionales si es necesario
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}

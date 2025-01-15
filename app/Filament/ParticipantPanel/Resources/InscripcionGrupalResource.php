<?php

namespace App\Filament\ParticipantPanel\Resources;

use App\Filament\ParticipantPanel\Resources\InscripcionGrupalResource\Pages;
use App\Filament\ParticipantPanel\Resources\InscripcionGrupalResource\RelationManagers;
use App\Models\Grupo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Carbon;
use Filament\Forms\Components\Select;

class InscripcionGrupalResource extends Resource
{
    protected static ?string $model = Grupo::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Torneos';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nombre_equipo')
                    ->required()
                    ->label('Nombre del Equipo'),

                Select::make('IDJuego')
                    ->relationship('juego', 'NombreJuego')
                    ->required()
                    ->label('Juego'),

                TextInput::make('numero_comprobante')
                    ->label('Número de Comprobante')
                    ->required()
                    ->placeholder('Ingrese el número de comprobante'),

                FileUpload::make('comprobante')
                    ->label('Comprobante de Pago')
                    ->image() // Restringe a solo imágenes
                    ->required()
                    ->directory('comprobantes') // Carpeta donde se guardarán los archivos
                    ->maxSize(1024), // Tamaño máximo en KB

                TextInput::make('estado')
                    ->default('Pendiente')
                    ->disabled()
                    ->label('Estado'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nombre_equipo')
                    ->label('Equipo')
                    ->searchable(),

                TextColumn::make('lider.name')
                    ->label('Líder')
                    ->sortable()
                    ->getStateUsing(fn($record) => $record->lider->name ?? 'Sin Líder'),

                TextColumn::make('integrantes')
                    ->label('Integrantes')
                    ->getStateUsing(function ($record) {
                        return $record->integrantesGrupo
                            ->map(fn($integrante) => $integrante->usuario->name ?? 'Sin Nombre')
                            ->join(', ');
                    }),

                BadgeColumn::make('estado')
                    ->label('Estado')
                    ->colors([
                        'success' => 'Aprobado',
                        'warning' => 'Pendiente',
                        'danger' => 'Rechazado',
                    ]),
            ])
            ->filters([
                Filter::make('estado')
                    ->label('Estado de Inscripción')
                    ->query(fn($query) => $query->where('estado', 'Pendiente')),
            ])
            ->defaultSort('nombre_equipo'); // Ordenar por defecto
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['fecha_inscripcion'] = Carbon::now()->toDateTimeString(); // Establece la fecha actual
        $data['fecha_pago'] = Carbon::now()->toDateTimeString(); // Establece la fecha actual
        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Se asegura de establecer las fechas al editar
        if (!isset($data['fecha_inscripcion'])) {
            $data['fecha_inscripcion'] = Carbon::now()->toDateTimeString();
        }

        if (!isset($data['fecha_pago'])) {
            $data['fecha_pago'] = Carbon::now()->toDateTimeString();
        }

        return $data;
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\IntegrantesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInscripcionGrupals::route('/'),
            'create' => Pages\CreateInscripcionGrupal::route('/create'),
            'edit' => Pages\EditInscripcionGrupal::route('/{record}/edit'),
        ];
    }
}

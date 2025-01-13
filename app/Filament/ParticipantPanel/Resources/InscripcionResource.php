<?php

namespace App\Filament\ParticipantPanel\Resources;

use App\Filament\ParticipantPanel\Resources\InscripcionResource\Pages;
use App\Filament\ParticipantPanel\Resources\InscripcionResource\RelationManagers;
use App\Models\Inscripcion;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\DateTimePicker;

class InscripcionResource extends Resource
{
    protected static ?string $model = Inscripcion::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Gestion de Inscripciones';

    protected static ?string $label = 'Inscribirse al torneo';

    protected static ?string $pluralLabel = 'Inscribirse al torneo';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('IDJuego')
                    ->relationship('juego', 'NombreJuego') // Usa 'NombreJuego' en lugar de 'nombre'
                    ->required()
                    ->label('Juego'),
                TextInput::make('Monto')
                    ->numeric()
                    ->required()
                    ->label('Monto'),
                TextInput::make('NumeroComprobante')
                    ->required()
                    ->unique('Inscripciones', 'NumeroComprobante')
                    ->label('Número de Comprobante'),
                FileUpload::make('ComprobantePago')
                    ->image()
                    ->required()
                    ->label('Comprobante de Pago'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('juego.NombreJuego')->label('Juego'),
                TextColumn::make('FechaInscripcion')->label('Fecha de Inscripción')->sortable(),
                TextColumn::make('Monto')->label('Monto')->sortable(),
                BadgeColumn::make('Estado')
                    ->label('Estado')
                    ->colors([
                        'warning' => 'pendiente', // Color para el estado "pendiente"
                        'success' => 'aprobado',  // Color para el estado "aprobado"
                    ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInscripcions::route('/'),
            'create' => Pages\CreateInscripcion::route('/create'),
            'edit' => Pages\EditInscripcion::route('/{record}/edit'),
        ];
    }
}

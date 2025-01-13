<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JuegoResource\Pages;
use App\Models\Juego;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea; // Importación agregada
use Filament\Forms\Components\Select; // Importación agregada
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\FileUpload;

class JuegoResource extends Resource
{
    protected static ?string $model = Juego::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('NombreJuego')
                    ->required()
                    ->label('Nombre del Juego'),
                Textarea::make('DescripcionJuego') // Corregido para que funcione con la importación
                    ->label('Descripción'),
                Select::make('IDCategoria')
                    ->relationship('categoria', 'TipoCategoria')
                    ->label('Categoría')
                    ->required(),
                Select::make('IDModalidad')
                    ->relationship('modalidad', 'TipoModalidad') // Relación definida en el modelo
                    ->label('Modalidad')
                    ->required(),
                FileUpload::make('ImagenJuego') // Campo para subir la imagen
                    ->label('Imagen del Juego')
                    ->image() // Indica que es un archivo de imagen
                    ->directory('juegos') // Carpeta de almacenamiento en `storage/app/public/juegos`
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('IDJuego')->label('ID'),
                TextColumn::make('NombreJuego')->label('Nombre'),
                TextColumn::make('categoria.TipoCategoria')->label('Categoría'),
                TextColumn::make('modalidad.TipoModalidad')->label('Modalidad'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListJuegos::route('/'),
            'create' => Pages\CreateJuego::route('/create'),
            'edit' => Pages\EditJuego::route('/{record}/edit'),
        ];
    }
}

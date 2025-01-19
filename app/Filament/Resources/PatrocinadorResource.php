<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PatrocinadorResource\Pages;
use App\Models\Patrocinador;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table; // Importación correcta para la clase Table

class PatrocinadorResource extends Resource
{
    protected static ?string $model = Patrocinador::class;

    protected static ?string $navigationIcon = 'heroicon-s-document'; // Ícono común disponible
    protected static ?string $navigationGroup = 'Gestion de Patrocinadores';

    protected static ?string $label = 'Gestionar Patrocinadores';

    protected static ?string $pluralLabel = 'Gestionar Patrocinadores';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('NombrePatrocinador')
                    ->label('Nombre')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('InformacionPatrocinador')
                    ->label('Información')
                    ->required(),
                Forms\Components\TextInput::make('UbicacionPatrocinador')
                    ->label('Ubicación')
                    ->maxLength(255),
                Forms\Components\FileUpload::make('LogoPatrocinador')
                    ->label('Logo')
                    ->directory('logos/patrocinadores')
                    ->image()
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('NombrePatrocinador')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('InformacionPatrocinador')
                    ->label('Información')
                    ->limit(50),
                Tables\Columns\TextColumn::make('UbicacionPatrocinador')
                    ->label('Ubicación'),
                Tables\Columns\ImageColumn::make('LogoPatrocinador')
                    ->label('Logo'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime(),
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
            'index' => Pages\ListPatrocinadors::route('/'),
            'create' => Pages\CreatePatrocinador::route('/create'),
            'edit' => Pages\EditPatrocinador::route('/{record}/edit'),
        ];
    }
}

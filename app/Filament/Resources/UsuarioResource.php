<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UsuarioResource\Pages;
use App\Models\Usuario;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class UsuarioResource extends Resource
{
    protected static ?string $model = Usuario::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Gestión de Usuarios';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Nombre completo')
                    ->disabled(),
                TextInput::make('email')
                    ->label('Correo electrónico')
                    ->disabled(),
                TextInput::make('Celular')
                    ->label('Celular')
                    ->disabled(),
                TextInput::make('Universidad')
                    ->label('Universidad')
                    ->disabled(),
                Select::make('IDRol')
                    ->label('Rol')
                    ->options([
                        2 => 'Tesorero',    // ID correspondiente al rol de "Tesorero"
                        3 => 'Coordinador', // ID correspondiente al rol de "Coordinador"
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID'),
                TextColumn::make('name')->label('Nombre completo'),
                TextColumn::make('email')->label('Correo electrónico'),
                TextColumn::make('rol.NombreRol')->label('Rol'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([]);

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
            'index' => Pages\ListUsuarios::route('/'),
            'edit' => Pages\EditUsuario::route('/{record}/edit'),
        ];
    }
}

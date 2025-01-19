<?php

namespace App\Filament\Tesoreria\Resources;

use App\Filament\Tesoreria\Resources\VerificarPagosResource\Pages;
use App\Models\Inscripcion;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class VerificarPagosResource extends Resource
{
    protected static ?string $model = Inscripcion::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Verificar Pagos';

    protected static ?string $pluralLabel = 'Pagos';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('IDUsuario')
                    ->label('Usuario')
                    ->relationship('usuario', 'name') // Relación para obtener el nombre del usuario
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('IDJuego')
                    ->label('Juego')
                    ->disabled(),
                Forms\Components\FileUpload::make('ComprobantePago')
                    ->label('Comprobante de Pago')
                    ->image() // Indica que es un archivo de imagen
                    ->directory('comprobantes') // Directorio donde se guardará la imagen
                    ->visibility('public') // Asegura que sea accesible públicamente
                    ->required(),
                Forms\Components\Select::make('Estado')
                    ->label('Estado')
                    ->options([
                        'pendiente' => 'Pendiente',
                        'aprobado' => 'Aprobado',
                        'rechazado' => 'Rechazado',
                    ])
                    ->required(),
            ]);
    }
    
    
    

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('IDUsuario')
                    ->label('Usuario'),
                Tables\Columns\TextColumn::make('IDJuego')
                    ->label('Juego'),
                Tables\Columns\TextColumn::make('Monto')
                    ->label('Monto')
                    ->money('USD'),
                Tables\Columns\TextColumn::make('NumeroComprobante')
                    ->label('Número de Comprobante'),
                Tables\Columns\BadgeColumn::make('Estado')
                    ->label('Estado')
                    ->colors([
                        'primary' => 'pendiente',
                        'success' => 'verificado',
                        'danger' => 'rechazado',
                    ]),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('Estado')
                    ->options([
                        'pendiente' => 'Pendiente',
                        'verificado' => 'Verificado',
                        'rechazado' => 'Rechazado',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVerificarPagos::route('/'),
            'create' => Pages\CreateVerificarPagos::route('/create'),
            'edit' => Pages\EditVerificarPagos::route('/{record}/edit'),
        ];
    }
}

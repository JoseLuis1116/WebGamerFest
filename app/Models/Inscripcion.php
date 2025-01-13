<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    use HasFactory;

    /**
     * El nombre de la tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'Inscripciones';

    /**
     * La clave primaria de la tabla.
     *
     * @var string
     */
    protected $primaryKey = 'IDInscripcion';

    /**
     * Los atributos que se pueden asignar de manera masiva.
     *
     * @var array
     */
    protected $fillable = [
        'IDUsuario',
        'IDJuego',
        'FechaInscripcion',
        'FechaPago',
        'Monto',
        'NumeroComprobante',
        'Estado',
        'ComprobantePago',
    ];

    /**
     * Los atributos que deben ser convertidos a tipos nativos.
     *
     * @var array
     */
    protected $casts = [
        'FechaInscripcion' => 'datetime',
        'FechaPago' => 'datetime',
        'Monto' => 'decimal:2',
    ];

    /**
     * Relación con el modelo Usuario (User).
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'IDUsuario');
    }

    /**
     * Relación con el modelo Juego.
     */
    public function juego()
    {
        return $this->belongsTo(Juego::class, 'IDJuego', 'IDJuego');
    }


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->IDUsuario = auth()->id(); // ID del usuario logueado
            $model->FechaInscripcion = now(); // Fecha del sistema
            $model->Estado = 'pendiente'; // Estado predeterminado
        });
    }
}

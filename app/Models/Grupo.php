<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;

    protected $table = 'Grupos';

    protected $primaryKey = 'IDGrupo';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'nombre_equipo',
        'IDLider',
        'IDJuego',
        'estado',
        'numero_comprobante',
        'comprobante',
        'fecha_inscripcion',
        'fecha_pago',
    ];

    /**
     * Evento para asignar valores automáticos.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($grupo) {
            $grupo->fecha_inscripcion = now();
            $grupo->fecha_pago = now();
        });
    }

    /**
     * Relación: Un grupo pertenece a un líder (usuario).
     */
    public function lider()
    {
        return $this->belongsTo(Usuario::class, 'IDLider', 'id'); // Ajusta 'id' si es necesario.
    }

    /**
     * Relación: Un grupo pertenece a un juego.
     */
    public function juego()
    {
        return $this->belongsTo(Juego::class, 'IDJuego', 'IDJuego');
    }

    /**
     * Relación: Un grupo tiene muchos integrantes.
     */
    public function integrantesGrupo()
    {
        return $this->hasMany(IntegranteGrupo::class, 'id_grupo', 'IDGrupo'); // 'id_grupo' es el nombre correcto en la tabla `integrantes_grupo`
    }

    protected static function booted()
    {
        static::addGlobalScope('withRelations', function ($query) {
            $query->with(['lider', 'integrantesGrupo.usuario']);
        });
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patrocinador extends Model
{
    use HasFactory;

    /**
     * El nombre de la tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'Patrocinadores';

    /**
     * La clave primaria de la tabla.
     *
     * @var string
     */
    protected $primaryKey = 'IDPatrocinador';

    /**
     * Indica si la clave primaria es incremental.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * El tipo de la clave primaria.
     *
     * @var string
     */
    protected $keyType = 'int';

    /**
     * Los atributos que se pueden asignar de forma masiva.
     *
     * @var array
     */
    protected $fillable = [
        'NombrePatrocinador',
        'InformacionPatrocinador',
        'UbicacionPatrocinador',
        'LogoPatrocinador',
    ];

    /**
     * Los atributos que deberían ser mutados a tipos nativos.
     *
     * @var array
     */
    protected $casts = [
        'LogoPatrocinador' => 'binary',
    ];

    /**
     * Indica si el modelo tiene marcas de tiempo.
     *
     * @var bool
     */
    public $timestamps = true;
}

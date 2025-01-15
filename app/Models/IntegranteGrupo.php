<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntegranteGrupo extends Model
{
    use HasFactory;

    /**
     * Tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'integrantes_grupo';

    /**
     * Clave primaria personalizada.
     *
     * @var string
     */
    protected $primaryKey = 'id_integrante';

    /**
     * Indica si la clave primaria es auto-incremental.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * Tipo de la clave primaria.
     *
     * @var string
     */
    protected $keyType = 'int';

    /**
     * Atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = [
        'id_grupo',
        'id_usuario',
    ];

    /**
     * Relación: Un integrante pertenece a un grupo.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'id_grupo', 'IDGrupo');
    }

    /**
     * Relación: Un integrante pertenece a un usuario.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id');
    }
}

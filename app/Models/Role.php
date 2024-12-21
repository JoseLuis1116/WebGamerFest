<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $fillable = ['NombreRol'];

    /**
     * Relación con el modelo Usuario.
     */
    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'IDRol', 'IDRol'); // 'IDRol' es la columna en usuarios que apunta a roles
    }
}


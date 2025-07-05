<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';

    protected $fillable = [
        'nombre',
        'apellido',
        'correo_electronico',
        'contraseña',
        'telefono',
        'red_social',
        'fecha_nacimiento',
    ];

    protected $hidden = [
        'contraseña',
    ];

    // Relación con el modelo Turno
    // Un usuario puede tener muchos turnos
    // Esto permite acceder a los turnos de un usuario
    // mediante $usuario->turnos
    public function turnos()
    {
        return $this->hasMany(Turno::class, 'usuario_id');
    }


}

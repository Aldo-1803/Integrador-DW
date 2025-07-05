<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
    protected $table = 'turnos';
    
    protected $fillable = [
        'fecha',
        'hora',
        'servicio',
        'usuario_id',
    ];

    // Relación con el modelo Usuario
    // Un turno pertenece a un usuario
    // Esto permite acceder al usuario asociado a un turno
    // mediante $turno->usuario
    // y también permite acceder a los turnos de un usuario
    // mediante $usuario->turnos
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $table = 'servicios';

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'duracion_estimada',
    ];

    // Relación con el modelo Turno
    // Un servicio puede tener muchos turnos
    // Esto permite acceder a los turnos de un servicio
    // mediante $servicio->turnos
    public function turnos()
    {
        return $this->hasMany(Turno::class, 'servicio_id');
    }

    // Relación con el modelo Usuario
    // Un servicio puede ser solicitado por un usuario
    // Esto permite acceder al usuario que solicitó un servicio
    // mediante $servicio->usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}

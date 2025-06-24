<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Timbrados extends Model
{
    protected $table = 'timbrados';

    protected $fillable = [
        'id',
        'servicio',
        'empresa',
        'ejercicio',
        'tipoPeriodo',
        'periodo',
        'empleados',
        'comentarios',
        'created_at',
        'fecha_resuelto',
        'fallas',
        'tipo_cancelado'
    ];
    
   
}
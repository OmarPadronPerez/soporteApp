<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mantenimiento extends Model
{
    use HasFactory;

    protected $table = 'mantenimiento';

    protected $fillable = [
        'LimpiezaFisica',
        'virus',
        'restauracion',
        'RespaldoCorreos',
        'RespaldoCarpetas',
        'FortiClient',
        'TeamViewer',
        'Zoom',
        'Office',
        'unidadesRed',
        'impresoras',
        'contraseña',
        'disco',
        'programasInicio',
        'Actualizacion',
        'inventario',
        'bateria',
        'updated_at'
    ];
}

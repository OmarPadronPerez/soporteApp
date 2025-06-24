<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresas extends Model
{
    use HasFactory;

    protected $table = 'empresas';
    
    protected $fillable = [
        'id', 
        'nombre',
        'activo',
        'usuario',
        'contrasena',
        'base_de_datos',
        'created_at',
        'updated_at'
    ];


}

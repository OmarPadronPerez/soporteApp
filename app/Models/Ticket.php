<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'tickets';
    
    protected $fillable = [
        'id', 
        'Creador_id', 
        'Falla',
        'Detalles',
        'resuelto_id',
        'Diagnostico',
        'Urgencia',
        'Archivo',
        'afectados',
        'fecha_creacion',
        'fecha_resuelto',
        'created_at',
        'updated_at'
    ];


    public function usuario (){
        return $this->belongsTo(user::class,'Creador_id');
    }
}

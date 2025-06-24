<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('timbrados', function (Blueprint $table) {
            $table->id();
            $table->string('servicio');
            $table->string('empresa');
            $table->string('ejercicio');
            $table->string('tipoPeriodo');
            $table->string('periodo');
            $table->string('empleados');
            $table->string('tipo_cancelado')->nullable();
            $table->string('comentarios');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('fecha_resuelto')->nullable();
            $table->timestamp('updated_at')->useCurrent();
            $table->string('Fallas')->nullable();
            
        });
        //
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

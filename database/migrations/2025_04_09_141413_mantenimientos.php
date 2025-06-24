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
        Schema::create('mantenimiento', function (Blueprint $table) {
            $table->id();
            $table->boolean('LimpiezaFisica')->nullable()->default(null);
            $table->boolean('virus')->nullable()->default(null);
            $table->boolean('restauracion')->nullable()->default(null);
            $table->boolean('RespaldoCorreos')->nullable()->default(null);
            $table->boolean('RespaldoCarpetas')->nullable()->default(null);
            $table->boolean('FortiClient')->nullable()->default(null);
            $table->boolean('TeamViewer')->nullable()->default(null);
            $table->boolean('Zoom')->nullable()->default(null);
            $table->boolean('Office')->nullable()->default(null);
            $table->boolean('unidadesRed')->nullable()->default(null);
            $table->boolean('impresoras')->nullable()->default(null);
            $table->boolean('contraseña')->nullable()->default(null);
            $table->boolean('disco')->nullable()->default(null);
            $table->boolean('programasInicio')->nullable()->default(null);
            $table->boolean('Actualizacion')->nullable()->default(null);
            $table->boolean('inventario')->nullable()->default(null);
            $table->boolean('bateria')->nullable()->default(null);
            $table->timestamp('updated_at')->useCurrent();
            
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

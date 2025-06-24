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
        //
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            //$table->unsignedInteger('Creador_id');
            $table->foreignId('Creador_id')->references('id')->on('users');
            $table->string('Falla');
            $table->string('Detalles');
            $table->integer('resuelto_id')->nullable();
            $table->integer('afectados')->nullable();
            //$table->foreignId('resuelto_id')->references('id')->on('users');
            $table->string('Diagnostico')->nullable();
            $table->string('Urgencia')->nullable();
            $table->string('Archivo')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->timestamp('fecha_resuelto')->nullable();

            
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

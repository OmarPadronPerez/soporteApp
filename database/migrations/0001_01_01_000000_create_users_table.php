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
        Schema::create('users', function (Blueprint $table) {
            $table->id('id');
            $table->string('name')->nullable(false);
            $table->string('lastName')->nullable(false);
            $table->string('lastName2')->nullable();
            $table->string('area')->nullable(false);
            $table->boolean('administrador')->nullable(false)->default(0);
            $table->string('extencion')->nullable();
            $table->string('password')->nullable(false);
            $table->string('user_vpn')->nullable();
            $table->string('pass_vpn')->nullable();
            $table->string('user_servidor')->nullable();
            $table->string('pass_servidor')->nullable(false);
            $table->string('correo')->nullable();
            $table->string('pass_correo')->nullable();
            $table->string('pass_pc')->nullable();
            $table->string('pass_aps')->nullable();
            $table->boolean('activo')->default(1);
            $table->rememberToken();
            $table->timestamps();

        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};

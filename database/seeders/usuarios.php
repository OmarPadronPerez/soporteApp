<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class usuarios extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            ['id'=>'311','name'=>'JAVIER OMAR','lastname'=>'PADRON','lastname2'=>'PEREZ',
            'area'=>'SOPORTE','administrador'=>'1','password'=>'$2y$12$xX355ZGZDH0koCukkUtde.Ff3gf3bQFQQv.y/QsLrEHDdsrLZjaXe',
            'user_vpn'=>'jpadron','pass_vpn'=>'VPN_0311_JP','user_servidor'=>'jpadron','pass_servidor'=>'ADM_0311_JP',
            'correo'=>'javier.padron@grupoabg.com','pass_correo'=>'MAIL_0311_JP','pass_pc'=>'ABG_54321_JP',
            'activo'=>'1','created_at'=>'2025-01-15 18:04:34' ,'updated_at'=>'2025-01-15 18:04:34'],
            
            ['id'=>'1','name'=>'GENERAL','lastname'=>'FALLA','lastname2'=>'-',
            'area'=>'SOPORTE','administrador'=>'0','password'=>'$2y$12$xX355ZGZD88koCukkUtde.Ff3gf3bQFQQv.y/QsLrEHDdsrLZjaXe',
            'user_vpn'=>'-','pass_vpn'=>'-','user_servidor'=>'-','pass_servidor'=>'-',
            'correo'=>'-','pass_correo'=>'-','pass_pc'=>'-',
            'activo'=>'0','created_at'=>'2025-01-15 18:04:34' ,'updated_at'=>'2025-01-15 18:04:34'],

        ]);

    }
}

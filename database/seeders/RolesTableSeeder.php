<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insertar roles predeterminados
        DB::table('Roles')->insert([
            ['NombreRol' => 'Administrador', 'created_at' => now(), 'updated_at' => now()],
            ['NombreRol' => 'Tesoreria', 'created_at' => now(), 'updated_at' => now()],
            ['NombreRol' => 'Coordinador', 'created_at' => now(), 'updated_at' => now()],
            ['NombreRol' => 'Participante', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}

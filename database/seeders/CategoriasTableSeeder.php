<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            ['TipoCategoria' => 'Individual', 'created_at' => now(), 'updated_at' => now()],
            ['TipoCategoria' => 'Grupal', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('Categorias')->insert($categorias);
    }
}

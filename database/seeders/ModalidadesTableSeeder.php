<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModalidadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modalidades = [
            ['TipoModalidad' => 'Presencial', 'created_at' => now(), 'updated_at' => now()],
            ['TipoModalidad' => 'Virtual', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('Modalidades')->insert($modalidades);
    }
}

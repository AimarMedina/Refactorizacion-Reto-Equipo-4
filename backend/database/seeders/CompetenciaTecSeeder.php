<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class CompetenciaTecSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cicloDaw = DB::table('ciclos')->where('nombre', 'DAW (Desarrollo de Aplicaciones Web)')->value('id_ciclo');

        DB::table('competencias_tec')->insert([
            ['descripcion' => 'Programación backend (Laravel/PHP)', 'id_ciclo' => $cicloDaw, 'created_at' => now(), 'updated_at' => now()],
            ['descripcion' => 'Frontend (HTML/CSS/Bootstrap)', 'id_ciclo' => $cicloDaw, 'created_at' => now(), 'updated_at' => now()],
            ['descripcion' => 'BBDD (MySQL) y diseño ER', 'id_ciclo' => $cicloDaw, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}

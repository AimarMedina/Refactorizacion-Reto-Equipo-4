<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class AsignaturaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cicloDaw = DB::table('ciclos')->where('nombre', 'DAW (Desarrollo de Aplicaciones Web)')->value('id_ciclo');

        DB::table('asignaturas')->insert([
            [
                'codigo_asignatura' => 'FCT',
                'nombre_asignatura' => 'Formación en Centros de Trabajo',
                'id_ciclo' => $cicloDaw,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'codigo_asignatura' => 'DIW',
                'nombre_asignatura' => 'Diseño de Interfaces Web',
                'id_ciclo' => $cicloDaw,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

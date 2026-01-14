<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class ResultadoAprendizajeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fct = DB::table('asignaturas')->where('codigo_asignatura', 'FCT')->value('id_asignatura');
        $diw = DB::table('asignaturas')->where('codigo_asignatura', 'DIW')->value('id_asignatura');

        DB::table('resultados_aprendizaje')->insert([
            ['descripcion' => 'RA1: Integración en la empresa y organización.', 'id_asignatura' => $fct, 'created_at' => now(), 'updated_at' => now()],
            ['descripcion' => 'RA2: Desarrollo de tareas técnicas siguiendo procedimientos.', 'id_asignatura' => $fct, 'created_at' => now(), 'updated_at' => now()],
            ['descripcion' => 'RA3: Documenta y comunica el trabajo realizado.', 'id_asignatura' => $fct, 'created_at' => now(), 'updated_at' => now()],
            ['descripcion' => 'RA1: Maquetación responsive.', 'id_asignatura' => $diw, 'created_at' => now(), 'updated_at' => now()],
            ['descripcion' => 'RA2: Accesibilidad y usabilidad.', 'id_asignatura' => $diw, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}

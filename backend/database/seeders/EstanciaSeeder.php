<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class EstanciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $alumnoId = DB::table('alumnos')->value('id_alumno');
        $tutorId = DB::table('tutores')->value('id_tutor');
        $instructorId = DB::table('instructores')->value('id_instructor');

        $empresas = DB::table('empresas')->pluck('id_empresa')->toArray();
        if (count($empresas) === 0) {
            return;
        }

        $cicloDaw = DB::table('ciclos')
            ->where('nombre', 'DAW (Desarrollo de Aplicaciones Web)')
            ->value('id_ciclo');

        $cursoId = null;

        if ($cicloDaw) {
            $cursoId = DB::table('cursos')
                ->where('id_ciclo', $cicloDaw)
                ->where('numero', 2)
                ->value('id_curso');
        }

        if (!$cursoId) {
            $cursoId = DB::table('cursos')->value('id_curso');
        }

        $yaHay = DB::table('estancias')->where('id_alumno', $alumnoId)->exists();
        if ($yaHay) {
            return;
        }

        $empresa1 = $empresas[0];
        $empresa2 = $empresas[count($empresas) > 1 ? 1 : 0];

        DB::table('estancias')->insert([
            [
                'puesto' => 'Desarrollador Web (Laravel)',
                'fecha_inicio' => now()->subDays(14)->toDateString(),
                'fecha_fin' => now()->addMonths(3)->toDateString(),
                'horas_totales' => 400,

                'id_alumno' => $alumnoId,
                'id_tutor' => $tutorId,
                'id_instructor' => $instructorId,
                'id_empresa' => $empresa1,
                'id_curso' => $cursoId,

                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'puesto' => 'Soporte / QA (Web)',
                'fecha_inicio' => now()->subDays(7)->toDateString(),
                'fecha_fin' => now()->addMonths(2)->toDateString(),
                'horas_totales' => 250,

                'id_alumno' => $alumnoId,
                'id_tutor' => $tutorId,
                'id_instructor' => $instructorId,
                'id_empresa' => $empresa2,
                'id_curso' => $cursoId,

                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstanciaSeeder extends Seeder
{
    public function run(): void
    {
        $empresaId = DB::table('empresas')->first()->id;
        $instructorId = DB::table('instructores')->first()->id;

        $alumnos = DB::table('alumnos')->pluck('id');

        foreach ($alumnos as $alumnoId) {
            DB::table('estancias')->insert([
                'puesto' => 'Desarrollador Web',
                'fecha_inicio' => now()->subDays(14)->toDateString(),
                'fecha_fin' => now()->addMonths(3)->toDateString(),
                'horas_totales' => 400,
                'alumno_id' => $alumnoId,
                'instructor_id' => $instructorId,
                'empresa_id' => $empresaId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}


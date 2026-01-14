<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class CursoSeeder extends Seeder
{
    public function run(): void
    {
        $ciclos = DB::table('ciclos')->get(['id_ciclo']);

        foreach ($ciclos as $ciclo) {
            DB::table('cursos')->insert([
                ['numero' => 1, 'id_ciclo' => $ciclo->id_ciclo, 'created_at' => now(), 'updated_at' => now()],
                ['numero' => 2, 'id_ciclo' => $ciclo->id_ciclo, 'created_at' => now(), 'updated_at' => now()],
            ]);
        }
    }
}

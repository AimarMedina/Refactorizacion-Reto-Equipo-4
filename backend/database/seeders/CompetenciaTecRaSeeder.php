<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class CompetenciaTecRaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $competencias = DB::table('competencias_tec')->pluck('id_competencia_tec')->toArray();
        $ras = DB::table('resultados_aprendizaje')->pluck('id_resultado')->toArray();

        $rows = [];
        foreach ($competencias as $c) {
            foreach ($ras as $ra) {
                $rows[] = ['id_competencia_tec' => $c, 'id_resultado' => $ra];
            }
        }

        DB::table('competencia_tec_ra')->insert($rows);
    }
}

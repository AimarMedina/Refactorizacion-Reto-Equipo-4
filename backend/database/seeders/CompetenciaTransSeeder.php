<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class CompetenciaTransSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ifc = DB::table('familias_profesionales')->where('codigo_familia', 'IFC')->value('id_familia');

        DB::table('competencias_trans')->insert([
            ['descripcion' => 'Responsabilidad', 'nivel' => '1-4', 'id_familia' => $ifc, 'created_at' => now(), 'updated_at' => now()],
            ['descripcion' => 'Trabajo en equipo', 'nivel' => '1-4', 'id_familia' => $ifc, 'created_at' => now(), 'updated_at' => now()],
            ['descripcion' => 'Comunicación', 'nivel' => '1-4', 'id_familia' => $ifc, 'created_at' => now(), 'updated_at' => now()],
            ['descripcion' => 'Autonomía', 'nivel' => '1-4', 'id_familia' => $ifc, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}

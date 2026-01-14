<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class CicloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ifc = DB::table('familias_profesionales')->where('codigo_familia', 'IFC')->value('id_familia');
        $ssc = DB::table('familias_profesionales')->where('codigo_familia', 'SSC')->value('id_familia');

        DB::table('ciclos')->insert([
            [
                'nombre' => 'DAW (Desarrollo de Aplicaciones Web)',
                'id_familia' => $ifc,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'DAM (Desarrollo de Aplicaciones Multiplataforma)',
                'id_familia' => $ifc,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Integración Social',
                'id_familia' => $ssc,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

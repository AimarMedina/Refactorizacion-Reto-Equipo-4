<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class FamiliaProfesionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $idCentro1 = DB::table('centros')->where('nombre', 'Egibide Arriaga')->value('id_centro');
        $idCentro2 = DB::table('centros')->where('nombre', 'Egibide Molinuevo')->value('id_centro');

        DB::table('familias_profesionales')->insert([
            [
                'nombre' => 'Informática y Comunicaciones',
                'codigo_familia' => 'IFC',
                'id_centro' => $idCentro1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Servicios Socioculturales y a la Comunidad',
                'codigo_familia' => 'SSC',
                'id_centro' => $idCentro2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

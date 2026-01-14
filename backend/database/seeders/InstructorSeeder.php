<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class InstructorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userInstructor = DB::table('users')->where('email', 'eneko.empresa@demo.com')->value('id');
        $empresa = DB::table('empresas')->where('cif', 'B12345678')->value('id_empresa');

        DB::table('instructores')->insert([
            'nombre' => 'Eneko',
            'apellidos' => 'Empresa',
            'telefono' => '600555666',
            'ciudad' => 'Vitoria-Gasteiz',
            'id_empresa' => $empresa,
            'user_id' => $userInstructor,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

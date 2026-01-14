<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class TutorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userTutorEgibideId = DB::table('users')
            ->where('email', 'danel.tutor@demo.com')
            ->value('id');

        DB::table('tutores')->insert([
            'nombre' => 'Danel',
            'apellidos' => 'Tutor',
            'telefono' => '600333444',
            'ciudad' => 'Vitoria-Gasteiz',
            'user_id' => $userTutorEgibideId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

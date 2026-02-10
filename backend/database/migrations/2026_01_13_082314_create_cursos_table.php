<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cursos', function (Blueprint $table) {
            $table->id();
            $table->string('numero', 50);
            $table->string('nombre', 150)->nullable();

            // Crear foreign key hacia ciclos
                        $table->foreignId('id_ciclo')
                ->constrained('ciclos')
                ->restrictOnDelete()->cascadeOnUpdate();

            // Campos opcionales adicionales del CSV
            $table->text('descripcion')->nullable();
            $table->string('modelo', 10)->nullable();
            $table->string('regimen', 10)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cursos');
    }
};

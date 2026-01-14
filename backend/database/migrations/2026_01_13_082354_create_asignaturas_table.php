<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('asignaturas', function (Blueprint $table) {
            $table->id('id_asignatura');
            $table->string('codigo_asignatura', 30)->unique();
            $table->string('nombre_asignatura', 150);
            $table->unsignedBigInteger('id_ciclo');
            $table->timestamps();

            $table->foreign('id_ciclo')
                ->references('id_ciclo')->on('ciclos')
                ->cascadeOnDelete()->cascadeOnUpdate();

            $table->unique(['id_ciclo', 'nombre_asignatura']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asignaturas');
    }
};

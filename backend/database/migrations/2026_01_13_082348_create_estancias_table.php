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
        Schema::create('estancias', function (Blueprint $table) {
            $table->id('id_estancia');

            $table->string('puesto', 150)->nullable();
            $table->date('fecha_inicio');
            $table->date('fecha_fin')->nullable();;
            $table->unsignedInteger('horas_totales');

            $table->unsignedBigInteger('id_alumno');
            $table->unsignedBigInteger('id_tutor')->nullable();       // tutor egibide
            $table->unsignedBigInteger('id_instructor')->nullable();  // tutor empresa
            $table->unsignedBigInteger('id_empresa');
            $table->unsignedBigInteger('id_curso');

            $table->timestamps();

            $table->foreign('id_alumno')->references('id_alumno')->on('alumnos')
                ->cascadeOnDelete()->cascadeOnUpdate();

            $table->foreign('id_tutor')->references('id_tutor')->on('tutores')
                ->nullOnDelete()->cascadeOnUpdate();

            $table->foreign('id_instructor')->references('id_instructor')->on('instructores')
                ->nullOnDelete()->cascadeOnUpdate();

            $table->foreign('id_empresa')->references('id_empresa')->on('empresas')
                ->restrictOnDelete()->cascadeOnUpdate();

            $table->foreign('id_curso')->references('id_curso')->on('cursos')
                ->restrictOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estancias');
    }
};

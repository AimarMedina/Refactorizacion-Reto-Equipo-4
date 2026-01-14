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
        Schema::create('notas_asignatura', function (Blueprint $table) {
            $table->id('id_nota_asignatura');
            $table->decimal('nota', 4, 2)->nullable();
            $table->year('anio');

            $table->unsignedBigInteger('id_alumno');
            $table->unsignedBigInteger('id_asignatura');

            $table->timestamps();

            $table->foreign('id_alumno')
                ->references('id_alumno')->on('alumnos')
                ->cascadeOnDelete()->cascadeOnUpdate();

            $table->foreign('id_asignatura')
                ->references('id_asignatura')->on('asignaturas')
                ->cascadeOnDelete()->cascadeOnUpdate();

            $table->unique(['id_alumno', 'id_asignatura', 'anio']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notas_asignatura');
    }
};

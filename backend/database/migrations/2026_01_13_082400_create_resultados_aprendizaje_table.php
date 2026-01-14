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
        Schema::create('resultados_aprendizaje', function (Blueprint $table) {
            $table->id('id_resultado');
            $table->text('descripcion');
            $table->unsignedBigInteger('id_asignatura');
            $table->timestamps();

            $table->foreign('id_asignatura')
                ->references('id_asignatura')->on('asignaturas')
                ->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resultados_aprendizaje');
    }
};

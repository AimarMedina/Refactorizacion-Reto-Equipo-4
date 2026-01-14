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
        Schema::create('competencia_tec_ra', function (Blueprint $table) {
            $table->unsignedBigInteger('id_competencia_tec');
            $table->unsignedBigInteger('id_resultado');

            $table->primary(['id_competencia_tec', 'id_resultado']);

            $table->foreign('id_competencia_tec')
                ->references('id_competencia_tec')->on('competencias_tec')
                ->cascadeOnDelete()->cascadeOnUpdate();

            $table->foreign('id_resultado')
                ->references('id_resultado')->on('resultados_aprendizaje')
                ->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competencia_tec_ra');
    }
};

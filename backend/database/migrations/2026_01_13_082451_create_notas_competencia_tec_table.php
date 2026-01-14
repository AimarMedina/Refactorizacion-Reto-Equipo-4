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
        Schema::create('notas_competencia_tec', function (Blueprint $table) {
            $table->id('id_nota_tec');
            $table->decimal('nota', 4, 2);

            $table->unsignedBigInteger('id_competencia_tec');
            $table->unsignedBigInteger('id_estancia');

            $table->timestamps();

            $table->foreign('id_competencia_tec')
                ->references('id_competencia_tec')->on('competencias_tec')
                ->cascadeOnDelete()->cascadeOnUpdate();

            $table->foreign('id_estancia')
                ->references('id_estancia')->on('estancias')
                ->cascadeOnDelete()->cascadeOnUpdate();

            $table->unique(['id_estancia', 'id_competencia_tec']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notas_competencia_tec');
    }
};

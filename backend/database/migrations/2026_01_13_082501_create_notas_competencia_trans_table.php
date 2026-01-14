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
        Schema::create('notas_competencia_trans', function (Blueprint $table) {
            $table->id('id_nota_trans');
            $table->decimal('nota', 4, 2)->nullable();

            $table->unsignedBigInteger('id_competencia_trans');
            $table->unsignedBigInteger('id_estancia');

            $table->timestamps();

            $table->foreign('id_competencia_trans')
                ->references('id_competencia_trans')->on('competencias_trans')
                ->cascadeOnDelete()->cascadeOnUpdate();

            $table->foreign('id_estancia')
                ->references('id_estancia')->on('estancias')
                ->cascadeOnDelete()->cascadeOnUpdate();

            $table->unique(['id_estancia', 'id_competencia_trans']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notas_competencia_trans');
    }
};

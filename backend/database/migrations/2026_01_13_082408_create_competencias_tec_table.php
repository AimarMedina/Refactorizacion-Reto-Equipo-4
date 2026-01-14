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
         Schema::create('competencias_tec', function (Blueprint $table) {
            $table->id('id_competencia_tec');
            $table->text('descripcion');
            $table->unsignedBigInteger('id_ciclo');
            $table->timestamps();

            $table->foreign('id_ciclo')
                ->references('id_ciclo')->on('ciclos')
                ->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competencias_tec');
    }
};

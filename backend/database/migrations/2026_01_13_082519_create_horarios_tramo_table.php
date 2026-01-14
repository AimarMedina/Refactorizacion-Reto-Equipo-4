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
        Schema::create('horarios_tramo', function (Blueprint $table) {
            $table->id('id_horario_tramo');
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->unsignedBigInteger('id_horario_dia');
            $table->timestamps();

            $table->foreign('id_horario_dia')
                ->references('id_horario_dia')->on('horarios_dia')
                ->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horarios_tramo');
    }
};

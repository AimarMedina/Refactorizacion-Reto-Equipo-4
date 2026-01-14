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
        Schema::create('horarios_dia', function (Blueprint $table) {
            $table->id('id_horario_dia');
            $table->enum('dia_semana', ['Lunes','Martes','Miercoles','Jueves','Viernes']);
            $table->unsignedBigInteger('id_estancia');
            $table->timestamps();

            $table->foreign('id_estancia')
                ->references('id_estancia')->on('estancias')
                ->cascadeOnDelete()->cascadeOnUpdate();

            $table->unique(['id_estancia', 'dia_semana']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horarios_dia');
    }
};

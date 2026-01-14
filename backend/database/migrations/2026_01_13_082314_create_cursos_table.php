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
        Schema::create('cursos', function (Blueprint $table) {
            $table->id('id_curso');
            $table->integer('numero');
            $table->unsignedBigInteger('id_ciclo');
            $table->timestamps();

            $table->foreign('id_ciclo')
                ->references('id_ciclo')->on('ciclos')
                ->restrictOnDelete()->cascadeOnUpdate();

            $table->unique(['id_ciclo', 'numero']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cursos');
    }
};

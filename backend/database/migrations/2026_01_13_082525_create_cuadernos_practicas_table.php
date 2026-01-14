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
        Schema::create('cuadernos_practicas', function (Blueprint $table) {
            $table->id('id_cuaderno');
            $table->string('archivo', 255)->nullable();
            $table->string('archivo_vacio', 255)->nullable();
            $table->unsignedBigInteger('id_estancia');
            $table->timestamps();

            $table->foreign('id_estancia')
                ->references('id_estancia')->on('estancias')
                ->cascadeOnDelete()->cascadeOnUpdate();

            $table->unique(['id_estancia']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuadernos_practicas');
    }
};

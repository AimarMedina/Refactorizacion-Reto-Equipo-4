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
        Schema::create('entregas', function (Blueprint $table) {
            $table->id('id_entrega');
            $table->string('archivo', 255);
            $table->date('fecha');
            $table->unsignedBigInteger('id_cuaderno');
            $table->timestamps();

            $table->foreign('id_cuaderno')
                ->references('id_cuaderno')->on('cuadernos_practicas')
                ->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entregas');
    }
};

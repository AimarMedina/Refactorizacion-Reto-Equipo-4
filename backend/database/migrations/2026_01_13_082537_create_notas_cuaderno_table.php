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
        Schema::create('notas_cuaderno', function (Blueprint $table) {
            $table->id('id_nota_cuaderno');
            $table->decimal('nota', 4, 2)->nullable();
            $table->unsignedBigInteger('id_cuaderno');
            $table->timestamps();

            $table->foreign('id_cuaderno')
                ->references('id_cuaderno')->on('cuadernos_practicas')
                ->cascadeOnDelete()->cascadeOnUpdate();

            $table->unique(['id_cuaderno']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notas_cuaderno');
    }
};

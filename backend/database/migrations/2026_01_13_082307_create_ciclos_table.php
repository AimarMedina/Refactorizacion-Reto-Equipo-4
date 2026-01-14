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
        Schema::create('ciclos', function (Blueprint $table) {
            $table->id('id_ciclo');
            $table->string('nombre', 150);
            $table->unsignedBigInteger('id_familia');
            $table->timestamps();

            $table->foreign('id_familia')
                ->references('id_familia')->on('familias_profesionales')
                ->restrictOnDelete()->cascadeOnUpdate();

            $table->unique(['id_familia', 'nombre']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ciclos');
    }
};

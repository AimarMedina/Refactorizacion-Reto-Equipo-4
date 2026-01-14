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
        Schema::create('competencias_trans', function (Blueprint $table) {
            $table->id('id_competencia_trans');
            $table->text('descripcion');
            $table->string('nivel', 50)->nullable();
            $table->unsignedBigInteger('id_familia');
            $table->timestamps();

            $table->foreign('id_familia')
                ->references('id_familia')->on('familias_profesionales')
                ->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competencias_trans');
    }
};

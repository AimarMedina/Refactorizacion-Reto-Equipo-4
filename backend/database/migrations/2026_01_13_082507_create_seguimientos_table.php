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
        Schema::create('seguimientos', function (Blueprint $table) {
            $table->id('id_seguimiento');
            $table->string('accion', 150);
            $table->date('fecha');
            $table->text('descripcion')->nullable();
            $table->string('via', 50)->nullable();
            $table->unsignedBigInteger('id_estancia');
            $table->timestamps();

            $table->foreign('id_estancia')
                ->references('id_estancia')->on('estancias')
                ->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seguimientos');
    }
};

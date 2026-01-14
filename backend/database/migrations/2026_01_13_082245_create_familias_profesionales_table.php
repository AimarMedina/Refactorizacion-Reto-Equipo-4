<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('familias_profesionales', function (Blueprint $table) {
            $table->id('id_familia');
            $table->string('nombre', 150);
            $table->string('codigo_familia', 30)->unique();
            $table->unsignedBigInteger('id_centro');
            $table->timestamps();

            $table->foreign('id_centro')
                ->references('id_centro')->on('centros')
                ->restrictOnDelete()->cascadeOnUpdate();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('familias_profesionales');
    }
};
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
        Schema::create('instructores', function (Blueprint $table) {
            $table->id('id_instructor');
            $table->string('nombre', 100);
            $table->string('apellidos', 150);
            $table->string('telefono', 20)->nullable();
            $table->string('ciudad', 120)->nullable();

            $table->unsignedBigInteger('id_empresa');
            $table->foreignId('user_id')->unique()->constrained('users')->cascadeOnDelete();

            $table->timestamps();

            $table->foreign('id_empresa')
                ->references('id_empresa')->on('empresas')
                ->restrictOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instructores');
    }
};

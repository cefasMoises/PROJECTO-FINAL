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
        Schema::create('notificacaos', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo', ['Alerta', 'Aviso'])->default('Alerta');
            $table->string('descricao');
            $table->foreignId('usuario_id')->constrained()->onDelete('cascade');
            $table->enum('estatus', ['ON', 'OFF'])->default('ON');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notificacaos');
    }
};

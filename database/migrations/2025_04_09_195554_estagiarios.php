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
        Schema::create('estagiarios', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('email')->nullable();
            $table->integer('tel')->nullable();
            $table->enum('sexo', ['M', 'F']);
            $table->text('foto');
            $table->string('bi', 14)->unique();
            $table->date('dt_nascimento');
            $table->unsignedBigInteger('instituto_id')->nullable()->default(null);
            $table->foreign('instituto_id')->references('id')->on('institutos')->onDelete('cascade');
            $table->foreignId('plano_estagio_id')->constrained()->onDelete('cascade');
            $table->text('documentos')->nullable();
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("estagiarios");
    }
};

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
        Schema::create('instrutores', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('email')->nullable();
            $table->integer('tel')->nullable();
            $table->enum('sexo', ['M', 'F']);
            $table->text("foto");
            $table->string("bi", 14)->unique();
            $table->text("documentos")->nullable();
            $table->text('especialidade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("instrutores");
        
    }
};

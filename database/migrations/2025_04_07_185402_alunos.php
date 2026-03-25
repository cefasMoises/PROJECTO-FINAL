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

        Schema::create('alunos', function (Blueprint $table) {

            $table->id();
            $table->string('nome');
            $table->string('email')->nullable();
            $table->integer('tel')->nullable();
            $table->date('dt_nascimento');
            $table->enum('estatus',['ON','OFF','OK'])->default('ON');
            $table->enum('sexo', ['M', 'F']);
            $table->text("foto");
            $table->string("bi", 14)->unique();
            $table->string("instituto",0)->nullable();
            $table->text("documento_aluno")->nullable();
            $table->timestamps();

        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("alunos");

    }
};

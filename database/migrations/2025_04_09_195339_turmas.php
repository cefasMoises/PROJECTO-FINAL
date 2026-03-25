<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('turmas', function (Blueprint $table) {

            $table->id();
            $table->string('nome')->unique();
            $table->integer('qtd_aluno');
            $table->enum('estatus',['DECORRENTE','FINALIZADO','CANCELLADO'])->default('DECORRENTE');
            $table->foreignId('curso_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('turmas');
    }
};

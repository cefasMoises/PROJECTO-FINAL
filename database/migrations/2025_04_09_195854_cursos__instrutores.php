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
        Schema::create('curso_instrutor', function (Blueprint $table) {

            $table->foreignId('curso_id')->constrained()->onDelete('cascade');
            $table->foreignId('instrutor_id')->constrained('instrutores')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("curso_instrutor");
    
    }
};

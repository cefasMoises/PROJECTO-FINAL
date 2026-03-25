<?php

use App\rules\UserAccess;
use App\rules\UserStates;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string("email")->unique();
            $table->string("nome", 50);
            $table->string("senha", 60);
            $table->enum("acesso", UserAccess::all())->default(UserAccess::getAdm());
            $table->enum("estatus", ['OFF', 'ON'])->default(UserStates::getOff());
            $table->timestamps();
        });

        // pre criar usuarios no sistema
        DB::table('usuarios')->insert([
            'email' => 'admin@gmail.com',
            'nome' => 'user_' . time(),
            'senha' => bcrypt('123456'),
        ]);

        DB::table('usuarios')->insert([
            'email' => 'pedagodica@gmail.com',
            'nome' => 'user_' . time(),
            'senha' => bcrypt('123456'),
            "acesso"=>UserAccess::getPDG()
        ]);

        DB::table('usuarios')->insert([
            'email' => 'financas@gmail.com',
            'nome' => 'user_' . time(),
            'senha' => bcrypt('123456'),
            'acesso'=> UserAccess::getFNC()
        ]);



    }

    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};

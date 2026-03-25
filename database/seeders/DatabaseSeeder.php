<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Curso;
use App\Models\Turma;
use App\Models\Aluno;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $curso1=Curso::create([
            'nome'=>"Informatica",
            'descricao'=>'area de TI'
        ]);

        for($n=0;$n<12;$n++){

          $aluno=Aluno::create([
                "nome"=>"aluno$n",
                'email'=>"example@gmail.com",
                "tel"=>'932809844',
                "sexo"=>'M',
                "bi"=>'092863',
                "dt_nascimento"=>'2004-12-12',
                "foto"=>'user.png'
            ]);

          $aluno->cursos()->attach($curso1);

        }
    }
}

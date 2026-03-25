<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;

class NotaController extends Controller
{
    public function index()
    { 

        return view("main.desempenho", ['alunos' => []]);
    }

    public function create(Request $dados) {}
    public function show($curso_id, $turma_id)
    {


        $curso = Curso::find($curso_id);
        $turmas = $curso->turmas()->find($turma_id);
        $alunos = $turmas->alunos()->get();

        // return $alunos;

        return view("main.desempenho", ['alunos' => $alunos]);
    }
}

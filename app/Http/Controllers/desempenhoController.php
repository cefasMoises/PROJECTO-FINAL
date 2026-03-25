<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Nota;
use App\Models\Turma;
use Illuminate\Http\Request;

class desempenhoController extends Controller
{
    public function index()
    {

        $cursos = Curso::all();

        return view("main.desempenho", ["cursos" => $cursos]);
    }
    public function show($id)
    {

        $turma = Turma::find($id);

        if ($turma != null) {
            return view("forms.desempenhoTurma", ["turma" => $turma]);
        }
    }
    public function create(Request $dados)
    {
        $processo = false;
    
        foreach ($dados->notas as $id => $valor) {
    
            $nota = Nota::find($id);
    
            if ($nota) {
                $nota->valor = is_array($valor) ? reset($valor) : $valor;
                $nota->save();
                $processo = true;
            } else {
                return redirect()->back()->with('error', "Nota com ID {$id} não encontrada.");
            }
        }
    
        if ($processo) {
            return redirect()->back()->with('sucess', 'Notas atualizadas com sucesso!');
        }
    
        return redirect()->back();
    }
    
}

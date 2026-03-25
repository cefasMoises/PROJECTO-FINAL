<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
use Exception;

class CursoController extends Controller
{

    public function index()
    {
        $cursos = Curso::all();
        return view('main.cursos', ['cursos' => $cursos]);
    }
    // -----------------------------------------------
    public function create(Request $dados)
    {

        $validar = $dados->nome != null;

        if ($validar) {

            try {

                $novo_curso = new Curso();
                $novo_curso->nome = "$dados->nome";
                $novo_curso->descricao = "$dados->descricao";
                $novo_curso->save();

                return redirect()->back()->with('sucess', 'novo curso criado com sucesso!');
            } catch (Exception $e) {

                return redirect()->back()->with('error', 'não foi possivel criar um novo curso,preencha de acordo aos criterios');
            }
        }

        return redirect()->back()->with('error', 'não foi possivel criar um novo curso,preencha de acordo aos criterios');
    }
    // -----------------------------------------------
    public function show($id)
    {
        $cursos_alunos = Curso::find($id);
        $nome_curso = $cursos_alunos->nome;
        $qtd_alunos = $cursos_alunos->count();
        $alunos = $cursos_alunos->alunos()->get();

        return view('main.cursos_alunos', ['alunos' => $alunos, 'curso' => $cursos_alunos]);
    }
    // -----------------------------------------------
    public function delete($id)
    {

        $curso_selecionado = Curso::find($id);


        if ($curso_selecionado) {

            if ($curso_selecionado->alunos()->count() <= 0) {

                $curso_selecionado->delete();
                return redirect('/cursos/')->with('sucess', 'curso deletado com sucesso!');
            } else {
                return redirect('/cursos/')->with('error', 'não se pode deletar um curso que contem alunos!');
            }
        }

        return redirect('/cursos/')->with('error', 'não foi possivel deletar o curso');
    }
    // -----------------------------------------------
    public function update(Request $dados)
    {

        $curso_selecionado = Curso::find($dados->id);

        if ($curso_selecionado) {

            try {

                $curso_selecionado->nome = $dados->nome;
                $curso_selecionado->descricao = $dados->descricao ?? '';
                $curso_selecionado->update();
                return redirect()->back()->with('sucess', 'curso atualizado com sucesso!');
            } catch (Exception $e) {

                return redirect()->back()->with('error', 'não foi possivel atualizar o curso!');
            }
        }
    }

}

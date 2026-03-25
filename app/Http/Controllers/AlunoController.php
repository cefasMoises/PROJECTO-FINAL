<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Curso;
use App\Models\Nota;
use Illuminate\Http\Request;

class AlunoController extends Controller
{

    private function uploadFicheiro($ficheiro, String $dir = 'uploads'): String
    {

        $arquivo = $ficheiro;
        $nome_ficheiro = time() . '.' . $arquivo->getClientOriginalExtension();
        $arquivo->move(public_path("$dir"), $nome_ficheiro);

        return $nome_ficheiro;
    }
    private function preencherAluno(Aluno $aluno, Request $dados): Aluno
    {



        if ($dados->all() != null) {

            $aluno->nome          = $dados->nome;
            $aluno->email         = $dados->email ?? '';
            $aluno->tel           = $dados->tel;
            $aluno->sexo          = $dados->sexo;
            $aluno->bi            = $dados->bi;
            $aluno->foto          = $this->uploadFicheiro($dados->file('foto'));
            $aluno->dt_nascimento = $dados->dt_nascimento;
        }


        return $aluno;
    }
    #--------------------------------------------------------------
    public function index()
    {

        $alunos = Aluno::all();
        $cursos = Curso::all();
        $_cursos = [];



        foreach ($cursos as $curso) {

            array_push($_cursos, ['label' => $curso->nome, 'value' => $curso->id]);
        }

        return view("main.alunos", ['alunos' => $alunos, 'cursos' => $_cursos]);
    }
    public function form()
    {
        $cursos = Curso::all();
        return view('forms.criarAluno', ['cursos' => $cursos]);
    }
    public function show($id)
    {

        $cursos = Curso::all();

        if (isset($id)) {

            $aluno_selecionado = Aluno::find($id);

            if ($aluno_selecionado != null) {

                return view('forms.editarAluno', ['cursos' => $cursos, 'aluno' => $aluno_selecionado]);
            } else {

                return redirect()->back();
            }
        }
    }
    public function create(Request $dados)
    {


        $aluno = $this->preencherAluno(new Aluno(), $dados);
        $aluno->estatus = 'OFF';


        try {
            $aluno->save();
            for ($n = 0; $n < 3; $n++) {

                $notas = new Nota();
                $notas->valor = 0;
                $notas->aluno()->associate($aluno);
                $notas->save();
            }

            $curso = Curso::find($dados->curso);
            $aluno->cursos()->attach($curso);

            return redirect()->back()->with('sucess', 'Aluno cadastrado com sucesso!');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'A operação falhou! ja existe um usuario com o mesmo numero de bi');
        }
    }
    public function update(Request $dados)
    {

        $curso = Curso::find($dados->curso);
        $aluno = $this->preencherAluno(Aluno::find($dados->id), $dados);


        if ($aluno->cursos()->get()[0]->id != $curso->id) {

            $curso_antigo = $aluno->cursos()->get()[0];
            $aluno->cursos()->detach($curso_antigo);
            $aluno->cursos()->attach($curso);
        }

        try {
            $aluno->update();
            return redirect()->back()->with('sucess', 'feito com sucesso!');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'a operação falhou!');
        }
    }
    public function delete($id)
    {

        if ($id != null) {

            $aluno_selecionado = Aluno::find($id);

            if ($aluno_selecionado != null) {

                $aluno_selecionado->delete();

                return redirect()->back()->with('sucess', 'registro deletado com sucesso');
            } else {

                return redirect()->back()->with('error', 'nao foi possivel executarao peracao');
            }
        }
        return redirect()->back();
    }
}

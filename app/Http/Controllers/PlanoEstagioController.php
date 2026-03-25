<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\PlanoEstagio;
use Illuminate\Http\Request;

class PlanoEstagioController extends Controller
{
    public function index()
    {

        $planos = PlanoEstagio::all();


        if ($planos == null) {


            $planos = [];
        }
        return view('main.planos', ['planos' => $planos]);
    }
    public function form()
    {



        $cursos = Curso::all();

        if ($cursos == null) {

            $cursos = [];
        }
        return view('forms.criarPlano', ['cursos' => $cursos]);
    }
    public function create(Request $dados)
    {


        // return $dados;


        if ($dados != null) {


            $novo_plano = new PlanoEstagio();
            $novo_plano->nome = $dados->nome;
            $novo_plano->duracao = $dados->duracao;

            $curso = Curso::find($dados->curso);
            $novo_plano->curso()->associate($curso);



            if ($novo_plano->save()) {

                return redirect()->back()->with('sucess', 'novo plano de estagio adicionado com sucesso!');
            } else {


                return redirect()->back()->with('error', 'não foi possivel registrar um novo plano de estagio!');
            }
        }
    }
    public function show($id)
    {



        $plano = PlanoEstagio::find($id);
        $cursos = Curso::all();

        if ($plano != null) {


            return view('forms.editarPlano', ['plano' => $plano, 'cursos' => $cursos]);
        }
        return redirect()->back();
    }
    public function update(Request $dados)
    {

        if ($dados != null) {


            $plano = PlanoEstagio::find($dados->id);
            $plano->nome = $dados->nome;
            $plano->duracao = $dados->duracao;




            if ($dados->curso != $plano->curso->id) {

                $curso = Curso::find($dados->curso);
                $plano->curso()->associate($curso);
            }




            if ($plano->update()) {

                return redirect()->back()->with('sucess', ' plano de estagio atualizado com sucesso!');
            } else {


                return redirect()->back()->with('error', 'não foi possivel atualizar o plano de estagio!');
            }
        }
        return redirect()->back();
    }
    public function delete(Request $dados)
    {

        if ($dados != null) {


            $plano = PlanoEstagio::find($dados->id);
            if ($plano != null) {

                $plano->delete();

                return redirect()->back()->with('sucess', 'plano de estagio deletado com sucesso!');
            }
        }
    }
}

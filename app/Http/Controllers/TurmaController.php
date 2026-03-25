<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Turma;
use App\Models\Curso;
use App\Models\Aluno;
use Illuminate\Support\Facades\Validator;


class TurmaController extends Controller
{
    
    public function index()
    {
        $turmas=Turma::with(['alunos','curso'])->get();
        $cursos=Curso::all();


        foreach ($turmas as $turma) {


            $curso_turma_id=$turma->curso()->get()[0]->id;
            $alunos_turma=$turma->alunos()->get();


            foreach ($alunos_turma as $aluno) {


                if($aluno->cursos()->get()[0]->id!=$curso_turma_id){

                    $turma->alunos()->detach($aluno);

                }
            }

        }

   
        return  view('main.turmas',['turmas'=>$turmas,'cursos'=>$cursos]);

    }
    public function show($id){

        $turma=Turma::find($id);
        $alunos=$turma->curso()->get()[0]->alunos()->get();
        $alunos_sem_turma=[];


        foreach ($alunos as $aluno ) {

            if(sizeof($aluno->turmas()->get())==0 && sizeof($aluno->pagamentos()->get())>0){

                array_push($alunos_sem_turma,$aluno);
            }
         

        }

        return view('main.turmas_aluno',['turma'=>$turma,'alunos'=>$alunos_sem_turma]);


    }
    public function store(Request $dados){


      


        if($dados->item==null) return redirect()->back()->with('error','nenhum aluno selecionado');

        $turma_selecionado=Turma::find($dados->id);
        $limit=$turma_selecionado->qtd_aluno;


        foreach ($dados->item as $id) {

            $alunos_turma_qtd=$turma_selecionado->alunos()->count();


            if($alunos_turma_qtd<$limit){

                $aluno=Aluno::find($id);
                $turma_selecionado->alunos()->attach($aluno);
                $turma_selecionado->save();
            }
            else{


                return redirect()->back()->with('error',"não foi possivel adicionar todos o aluno na turma devido ao liminte maximo de alunos!");
             }

        }


      

        return redirect()->back()->with('sucess',"novos alunos adicionados na turma com sucesso!");

    }
    public function create(Request $dados)
    {

        // return $dados;

          $validar=validator::make($dados->all(),
            ['nome'=>'required',
            'qtd_aluno'=>'required|max:32',
            'curso'=>'required'
            ]);



            if($validar->fails()) return redirect()->back()->with('error','preencha todos os campos obrigatorios');


            $curso=Curso::find($dados->curso);

            $nova_turma=new Turma();
            $nova_turma->nome=$dados->nome;
            $nova_turma->qtd_aluno=$dados->qtd_aluno;
            $nova_turma->curso()->associate($curso);
            $nova_turma->save();

            if($nova_turma->save()){

                 return redirect('/turmas/')->with('sucess','nova turma criada com sucesso!');
            }

       
        else{

            return redirect('/turmas/')->with('error','não foi possivel criar nova turma!');

        }
    }

    public function delete($id)
    {
        $turma=Turma::find($id);

        if($turma){

            $turma->delete();
            return redirect('/turmas/')->with('sucess','turma deletada com sucesso!');


        }
        else{
            return redirect('/turmas/')->with('error','não foi possivel deletar a turma!');

        }
    }

    public function update(Request $dados){




        $validar=validator::make($dados->all(),
            ['nome'=>'required',
            'qtd_aluno'=>'required|max:32',
            'curso'=>'required'
            ]);



        if($validar->fails()) return redirect()->back()->with('error','preencha todos os campos obrigatorios');
        $turma=Turma::find($dados->id);
        $curso=Curso::find($dados->curso);



        if($turma){

            $turma->update([
                'nome'=>$dados->nome,
                'qtd_aluno'=>$dados->qtd_aluno,
            ]);

            $turma->curso()->associate($curso);
            $turma->save();

            return redirect('/turmas/')->with('sucess','dados atualizados com sucesso!');

        }
        else{

            return redirect('/turmas/')->with('sucess','não foi possivel atualizar os dados');
        }
    }
}

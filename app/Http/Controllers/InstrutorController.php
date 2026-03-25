<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Instrutor;
use Illuminate\Http\Request;

class InstrutorController extends Controller
{


    public function preencherDados(Instrutor $instrutor, Request $dados)
    {
        // Upload da imagem
        $arquivo = $dados->file('foto');
        $nomeImagem = time() . '.' . $arquivo->getClientOriginalExtension();
        $arquivo->move(public_path('uploads'), $nomeImagem);

        //upload de documentos
        $arquivo = $dados->file('documentos');
        $nomeDocumento = time() . '.' . $arquivo->getClientOriginalExtension();
        $arquivo->move(public_path('uploads'), $nomeDocumento);

        $instrutor->nome = $dados->nome;
        $instrutor->email = $dados->email ?? "sem email";
        $instrutor->bi = $dados->bi;
        $instrutor->tel = $dados->tel;
        $instrutor->sexo = $dados->sexo;
        $instrutor->especialidade = $dados->especialidade;
        $instrutor->foto = $nomeImagem;
        $instrutor->documentos = $nomeDocumento;


        return $instrutor;
    }
    public function index()
    {



        $instrutores = Instrutor::all();

        return view("main.instrutores", ['instrutores' => $instrutores]);
    }

    public function show($id)
    {
        $curso = Curso::all();

        $instrutor = Instrutor::find($id);
        if ($instrutor != null) {



            // return $instrutor;

            return view('forms.editarInstrutor', ['cursos' => $curso, 'instrutor' => $instrutor]);
        }

        return redirect()->back();
    }

    public function form()
    {

        $cursos = Curso::all();

        return view('forms.criarInstrutor', ['cursos' => $cursos]);
    }

    public function create(Request $dados)
    {


        if ($dados->all() != null) {

            $curso = Curso::find($dados->curso);

            if ($curso == null) redirect()->back()->with('error', 'ocorreu um erro, verifique o curso');




            $novo_instrutor = $this->preencherDados(new Instrutor(), $dados);



            if ($novo_instrutor->save()) {

                $novo_instrutor->cursos()->attach($curso);
                return redirect()->back()->with("sucess", "novo instrutor registrado com sucesso!");
            } else return redirect()->back()->with("error", "não foi possivel registrar um novo instrutor");


            return redirect()->back();
        }
    }
    public function update(Request $dados)
    {


        // Encontra o instrutor pelo ID
        $curso = Curso::find($dados->curso);

        $instrutor = Instrutor::find($dados->id);

        if ($instrutor == null) return redirect()->back()->with('error', 'ocorreu um erro!');

        $instrutor = $this->preencherDados($instrutor, $dados);


        if ($instrutor->update()) {

            $instrutor->cursos()->detach($instrutor->cursos()->get()[0]);
            $instrutor->cursos()->attach($curso);

            return redirect()->back()->with("sucess", "instrutor atalizado com sucesso!");
        } else return redirect()->back()->with("error", "não foi possivel atualizar o  instrutor");


        return redirect()->back();
    }
    public function delete($id)
    {


        $instrutor = Instrutor::find($id);

        if ($instrutor != null) {

            $instrutor->delete();
            return redirect()->back()->with('sucess', 'instrutor deletado');
        }
    }
}

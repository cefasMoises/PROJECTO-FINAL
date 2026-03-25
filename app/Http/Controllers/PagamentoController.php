<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;
use App\Models\Curso;
use App\Models\Turma;
use App\Models\Aluno;
use App\Models\Pagamento;
use App\Models\Usuario;
use Illuminate\Support\Facades\Validator;


class PagamentoController extends Controller
{
    public function index()
    {

        $cursos = Curso::all();
        $alunos = null;
        $pagamentos = Pagamento::all();

        if (isset($_GET['nome']) && isset($_GET['curso'])) {

            $curso = Curso::find($_GET['curso']);

            $alunos = $curso->alunos()->where('nome', 'like', "%" . $_GET['nome'] . "%")->get();
        }


        return view('main.pagamentos', ['cursos' => $cursos, 'alunos' => $alunos, 'pagamentos' => $pagamentos]);
    }

    public function form(Request $id)
    {


        $aluno_id = $id->input('aluno_id') ?? null;
        $aluno = Aluno::find($aluno_id);
        return view('forms.criarPagamento', compact('aluno'));
    }

    public function show($id)
    {


        $pagamento = Pagamento::find($id);


        if ($pagamento != null) {

            $pdf = Pdf::loadView('pdf.ficha', ['pagamento' => $pagamento]);
            return $pdf->stream($pagamento->created_at);
        }
    }

    public function create(Request $dados)
    {



   



        if ($dados->all() != null) {


            $aluno = Aluno::find($dados->aluno_id);
            $usuario = Usuario::find($dados->usuario_id);



            if ($aluno != null && $usuario != null) {


                $arquivo = $dados->file('comprovativo');
                $nomeArquivo = time() . '_' . $arquivo->getClientOriginalName();
                $arquivo->move(public_path('uploads'), $nomeArquivo);

                try {

                    $novo_pagamento = new Pagamento();
                    $novo_pagamento->valor = $dados->valor;
                    $novo_pagamento->m_pagamento = $dados->m_pagamento;
                    $novo_pagamento->referencia = $dados->referencia;
                    $novo_pagamento->descricao = $dados->descricao;
                    $novo_pagamento->usuario()->associate($usuario);
                    $novo_pagamento->aluno()->associate($aluno);
                    $novo_pagamento->comprovativo = $nomeArquivo;
                    $aluno->estatus = 'ON';
                    $aluno->update();
                    $novo_pagamento->save();
                    return redirect()->back()->with('sucess', 'pagamento registrado com sucesso');

                } catch (\Exception $e) {


                    return redirect()->back()->with('error', 'verifique se inseriu o codigo certo do aluno! obs: o numero de referencia de pagamento não pode ser duplicado');
                }
            } else {

                return redirect()->back()->with('error', 'verifique se inseriu o codigo certo do aluno!');
            }


            return redirect()->back();
        }
    }
}

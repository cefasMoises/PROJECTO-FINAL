<?php

namespace App\Http\Controllers;

use App\Models\Instituto;
use Illuminate\Http\Request;

class InstitutoController extends Controller
{
    public function index()
    {
        $institutos = Instituto::all();
        return view('main.institutos', ['institutos' => $institutos]);
    }
    public function form()
    {

        return view('forms.criarInstituto');
    }
    public function show($id)
    {
        $instituto = Instituto::find($id);

        if ($instituto != null) {
            return view('forms.editarInstituto', ['instituto' => $instituto]);
        }
        return redirect()->back();
    }
    public function create(Request $dados)
    {


        $instituicao = new Instituto();
        $instituicao->nome = $dados->nome;
        $instituicao->email = $dados->email ?? '';
        $instituicao->nif = $dados->nif;


        if ($instituicao->save()) {
            return redirect()->back()->with('sucess', 'instuição registrada com sucesso!');
        } else {
            return redirect()->back()->with('error', 'não foi possivel registrar a instituição!');
        }
    }
    public function update(Request $dados)
    {
        $instituicao = Instituto::find($dados->id);
        $instituicao->nome = $dados->nome;
        $instituicao->email = $dados->email ?? '';
        $instituicao->nif = $dados->nif;


        if ($instituicao->update()) {
            return redirect()->back()->with('sucess', 'instuição atualizada com sucesso!');
        } else {
            return redirect()->back()->with('error', 'não foi possivel atualizar a instituição!');
        }
    }
    public function delete(Request $dados)
    {



        $instituto = Instituto::find($dados->id);

        if ($instituto != null) {

            if ($instituto->delete()) {
                return redirect()->back()->with('sucess', 'instuição deletada com sucesso!');
            } else {
                return redirect()->back()->with('error', 'não foi possivel deletar a instituição!');
            }
        }

        return redirect()->back();
    }
}

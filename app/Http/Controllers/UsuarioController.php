<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\rules\UserAccess;
use App\rules\UserStates;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{
    private function validarDados(Request $dados)
    {
        return Validator::make(
            $dados->all(),
            [
                'nome' => 'required|string',
                'email' => 'required|email|unique:usuarios,email',
                'senha' => 'required|min:6|confirmed',
                'acesso' => 'required'
            ],
            [
                'email.required' => 'o email é obrigatorio!',
                'email.email' => 'email invalido!',
                'email.unique' => 'ja existe um usuario com esse email!',
                'nome.required' => 'o nome é obrigatorio!',
                'senha.required' => 'a senha é obrigatoria!',
                'senha.min' => 'a senha deve conter no minimo 6 caracteres',
                'senha.confirmed' => 'as senhas não coincidem',
                'acesso.required' => 'selecione um nivel de acesso'
            ]
        );
    }

    public function index()
    {
        $acessos = UserAccess::all();
        $usuarios = Usuario::all();
        return view('main.usuarios', compact('usuarios', 'acessos'));
    }

    public function form()
    {


        $acessos = [["value" => UserAccess::getFNC(), "label" => "Finanças"], ["value" => UserAccess::getPDG(), "label" => "Pedagogica"]];
        return view('forms.criarUsuario', compact('acessos'));
    }

    public function edit($id)
    {
        $usuario = Usuario::findOrFail($id);
        $acessos = UserAccess::all();

        return view('forms.editarUsuario', compact('usuario', 'acessos'));
    }

    public function create(Request $dados)
    {
        $validar = $this->validarDados($dados);

        if ($validar->fails()) {
            return redirect()->back()
                ->withInput()
                ->with('error', $validar->errors()->first());
        }


        Usuario::create([
            'email' => $dados->email,
            'nome' => $dados->nome,
            'senha' => bcrypt($dados->senha),
            'acesso' => $dados->acesso
        ]);

        return redirect('/usuarios/')
            ->with('sucess', 'o novo usuario foi criado com sucesso!');
    }

    public function update(Request $dados)
    {
        $validar = Validator::make(
            $dados->all(),
            [
                'id' => 'required|exists:usuarios,id',
                'nome' => 'required|string',
                'senha' => 'required|min:6',
            ],
            [
                'nome.required' => 'preencha o campo nome!',
                'senha.required' => 'preencha o campo senha!',
                'senha.min' => 'a senha deve conter no minimo 6 caracteres',
            ]
        );

        if ($validar->fails()) {
            return redirect()->back()
                ->with('error', $validar->errors()->first());
        }

        $usuario = Usuario::findOrFail($dados->id);

        if (!password_verify($dados->senha, $usuario->senha)) {
            return redirect()->back()
                ->with('error', 'senha errada!');
        }

        $usuario->update([
            'nome' => $dados->nome,
            'estatus' => $dados->estatus ?? 'ON'
        ]);

        return redirect()->back()
            ->with('sucess', 'dados do usuario editado com sucesso!');
    }

    public function delete($id)
    {
        $usuario = Usuario::findOrFail($id);


        if ($usuario->acesso !== 'ADM') {

            $usuario->delete();
        } else {

            return redirect('/usuarios/')
                ->with('error', 'não é possivel deletar o admin do sistema!');
        }

        return redirect('/usuarios/')
            ->with('sucess', 'o usuario foi deletado com sucesso!');
    }

    public function password($id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('forms.senha', compact('usuario'));
    }

    public function passwordUpdate($id, Request $request)
    {
        $usuario = Usuario::findOrFail($id);

        $validar = Validator::make(
            $request->all(),
            [
                'senha' => 'required|min:6',
                'nova_senha' => 'required|min:6|same:nova_senha2',
                'nova_senha2' => 'required|min:6',
            ],
            [
                'nova_senha.same' => 'as duas senhas não são iguais'
            ]
        );

        if ($validar->fails()) {
            return redirect()->back()
                ->with('error', $validar->errors()->first());
        }

        if (!password_verify($request->senha, $usuario->senha)) {
            return redirect()->back()
                ->with('error', 'senha atual incorreta!');
        }

        $usuario->update([
            'senha' => bcrypt($request->nova_senha)
        ]);

        return redirect()->back()
            ->with('sucess', 'senha alterada com sucesso!');
    }


}
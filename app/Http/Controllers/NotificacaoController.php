<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class NotificacaoController extends Controller
{
    public function index(){

        $id=session()->get('user_id');
        $usuario=Usuario::find($id);
        $notificacao=$usuario->notificacoes()->get();
        return view("notificacoes",['notifications'=>$notificacao]);
    }
}

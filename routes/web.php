<?php

use Illuminate\Support\Facades\Route;
// end init
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CertificadosController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\PagamentoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\TurmaController;
use App\Http\Controllers\InstrutorController;
use App\Http\Controllers\EstagiariosController;
use App\Http\Controllers\InstitutoController;
use App\Http\Controllers\NotificacaoController;
use App\Http\Controllers\PlanoEstagioController;
use App\Http\Controllers\desempenhoController;
// controllers end
use App\Http\Middleware\UsuarioNaoLogado;
use App\Http\Middleware\UsuarioLogado;
use App\Http\Middleware\Admin;
use App\Http\Middleware\Pedagogia;
use App\Http\Middleware\Secretaria;

use App\Models\Aluno;




Route::get('/', [AuthController::class, 'index'])->middleware(UsuarioNaoLogado::class);


Route::middleware(UsuarioLogado::class)->group(function () {

    Route::get('/sair', [AuthController::class, 'sair']);
    Route::get('/back', function () {

        return redirect('/panel');
    });

    Route::get('/notifications', [NotificacaoController::class, 'index']);
});
Route::middleware([UsuarioLogado::class])->prefix('/instrutores')->group(function () {

    Route::get('/', [InstrutorController::class, 'index']);
    Route::get('/form', [InstrutorController::class, 'form']);
    Route::get('/{id}', [InstrutorController::class, 'show']);
    Route::post('/criar', [InstrutorController::class, 'create']);
    Route::post('/atualizar', [InstrutorController::class, 'update']);
    Route::get('/deletar/{id}', [InstrutorController::class, 'delete']);
});
Route::post('/entrar', [AuthController::class, 'entrar'])->middleware(UsuarioNaoLogado::class);



Route::middleware(UsuarioLogado::class)->get('/panel', function () {

    $registrosPorMes = Aluno::selectRaw('MONTH(created_at) as mes, COUNT(*) as total')
        ->whereYear('created_at', date('Y'))
        ->groupBy('mes')
        ->orderBy('mes')
        ->pluck('total', 'mes');
    $dadosMeses = [];
    for ($i = 1; $i <= 12; $i++) {
        $dadosMeses[] = $registrosPorMes[$i] ?? 0;
    }
    $dados = [
        "labels" => ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
        "datasets" => [
            [
                'type' => 'bar',
                'label' => 'Alunos',
                'data' => $dadosMeses,
                'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                'borderColor' => 'rgb(75, 192, 192)',
                'borderWidth' => 1,
            ]
        ]
    ];

    $turmas = App\Models\Turma::count();
    $cursos = App\Models\Curso::count();
    $alunos = App\Models\Aluno::count();

    $instrutores = App\Models\Instrutor::count();

    return view('main.dashboard', ['turmas' => $turmas, 'cursos' => $cursos, 'alunos' => $alunos, 'instrutores' => $instrutores, 'dados' => $dados]);
});
##nivel de acesso Secretaria
Route::middleware([Secretaria::class])->prefix("/alunos")->group(function () {

    Route::get("/", [AlunoController::class, 'index']);
    Route::get('/form', [AlunoController::class, 'form']);
    Route::post("/criar", [AlunoController::class, 'create']);
    Route::post('/atualizar', [AlunoController::class, 'update']);
    Route::get('/deletar/{id}', [AlunoController::class, 'delete']);
    Route::get('/{id}', [AlunoController::class, 'show']);
    Route::get('/ficha/{id}', [AlunoController::class, 'doc_pdf']);
});


Route::middleware([Secretaria::class])->prefix("/estagiarios")->group(function () {

    Route::get('/', [EstagiariosController::class, 'index']);
    Route::get('/form', [EstagiariosController::class, 'form']);
    Route::get('/{id}', [EstagiariosController::class, 'show']);
    Route::post('/criar', [EstagiariosController::class, 'create']);
    Route::post('/atualizar', [EstagiariosController::class, 'update']);
    Route::post('/deletar', [EstagiariosController::class, 'delete']);
});



Route::middleware([Secretaria::class])->prefix('/pagamentos')->group(function () {

    Route::get('/', [PagamentoController::class, 'index']);
    Route::get('/form/{id?}', [PagamentoController::class, 'form']);
    Route::post('/criar', [PagamentoController::class, 'create']);
    Route::get('/{id}', [PagamentoController::class, 'show']);
});
##------------------------------------------------------------------------------

##nivel de acesso pedagogia

Route::middleware([Pedagogia::class])->prefix("/faltas")->group(function () {

    Route::view('/', 'main.assiduidades');
});
Route::middleware([Pedagogia::class])->prefix("/certificados")->group(function () {

    Route::get('/', [CertificadosController::class, 'index']);
    Route::get('/{id}', [CertificadosController::class, 'show']);
});
Route::middleware([Pedagogia::class])->prefix('/desempenho')->group(function () {

    Route::get('/', [desempenhoController::class, 'index']);
    Route::get('/{id}', [desempenhoController::class, 'show']);
    Route::post('/criar', [desempenhoController::class, 'create']);
});


#-------------------------------------------------------------------------------
##niveis de aceso admin
Route::middleware([Admin::class])->prefix('/usuarios')->group(function () {

    Route::get('/', [UsuarioController::class, 'index']);
    Route::get('/form', [UsuarioController::class, 'form']);
    Route::get('/editar/{id}', [UsuarioController::class, 'edit']);
    Route::post('/criar', [UsuarioController::class, 'create']);
    Route::post('/atualizar', [UsuarioController::class, 'update']);
    Route::get('/deletar/{id}', [UsuarioController::class, 'delete']);
    Route::get('/senha/{id}', [UsuarioController::class, 'password']);
    Route::post('/senha/update/{id}', [UsuarioController::class,'passwordUpdate']);

});

Route::middleware([Admin::class, UsuarioLogado::class])->prefix('/cursos')->group(function () {

    Route::get('/', [CursoController::class, 'index']);
    Route::get('/alunos/{id}', [CursoController::class, 'show']);
    Route::post('/criar', [CursoController::class, 'create']);
    Route::post('/atualizar', [CursoController::class, 'update']);
    Route::get('/deletar/{id}', [CursoController::class, 'delete']);
});

Route::middleware([Secretaria::class, UsuarioLogado::class])->prefix('/turmas')->group(function () {

    Route::get('/', [TurmaController::class, 'index']);
    Route::post('/criar', [TurmaController::class, 'create']);
    Route::get('/alunos/{id}', [TurmaController::class, 'show']);
    Route::post('/atualizar', [TurmaController::class, 'update']);
    Route::post('/enturmar', [TurmaController::class, 'store']);
    Route::get('/deletar/{id}', [TurmaController::class, 'delete']);
});
Route::middleware([Admin::class, UsuarioLogado::class])->prefix('/planos')->group(function () {

    Route::get('/', [PlanoEstagioController::class, 'index']);
    Route::get('/form', [PlanoEstagioController::class, 'form']);

    Route::get('/{id}', [PlanoEstagioController::class, 'show']);
    Route::post('/criar', [PlanoEstagioController::class, 'create']);
    Route::post('/atualizar', [PlanoEstagioController::class, 'update']);
    Route::post('/deletar', [PlanoEstagioController::class, 'delete']);
});
Route::middleware([Admin::class])->prefix('/institutos')->group(function () {

    Route::get('/', [InstitutoController::class, 'index']);
    Route::get('/form', [InstitutoController::class, 'form']);
    Route::get('/{id}', [InstitutoController::class, 'show']);
    Route::post('/atualizar', [InstitutoController::class, 'update']);
    Route::post('/deletar', [InstitutoController::class, 'delete']);
    Route::post('/criar', [InstitutoController::class, 'create']);
});
    #-------------------------------------------------------------------------------------------

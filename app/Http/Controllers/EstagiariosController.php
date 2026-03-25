<?php
namespace App\Http\Controllers;

use App\Models\Estagiario;
use App\Models\Instituto;
use App\Models\PlanoEstagio;
use Doctrine\Inflector\Rules\Portuguese\Rules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



class EstagiariosController extends Controller
{




    public function index()
    {
        $estagiarios = Estagiario::all();
        return view('main.estagiarios', compact('estagiarios'));
    }

    public function form()
    {
        $select_planos = [];
        $select_institutos = [];

        foreach (PlanoEstagio::all() as $plano) {
            $select_planos[] = ['label' => $plano->nome, 'value' => $plano->id];
        }

        foreach (Instituto::all() as $instituto) {
            $select_institutos[] = ['label' => $instituto->nome, 'value' => $instituto->id];
        }



        return view('forms.criarEstagiario', compact('select_planos', 'select_institutos'));
    }

    public function create(Request $dados)
    {


        $validated = Validator::make(
            $dados->all(),
            [
                'nome' => ['required', 'string', 'min:3'],
                'email' => ['required', 'email', 'unique:estagiarios,email'],
                'telefone' => ['nullable', 'digits:9'],
                'bi'=>['required','min:14','max:14'],
                'plano' => ['required', 'integer'],
                'genero' => ['required'],
                'institutos' => ['required'],
                'foto' => ['required', 'image','max:2048'],
                'documentos' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:4096']
            ],
            [
                'nome.required' => 'O nome é obrigatório.',
                'nome.min' => 'O nome deve ter pelo menos 3 caracteres.',
                

                'email.required' => 'O email é obrigatório.',
                'email.email' => 'Email inválido.',
                'email.unique' => 'Este email já existe.',

                'telefone.digits' => 'O telefone deve ter exatamente 9 dígitos.',

                'plano.required' => 'O plano é obrigatório.',

                'genero.required' => 'O género é obrigatório.',
                'genero.in' => 'Género inválido.',

                'foto.required' => 'A foto é obrigatória.',
                'foto.image' => 'A foto deve ser uma imagem.',

                'documentos.required' => 'O documento é obrigatório.',
            ]
        );


        $path_image = $dados->file('foto')->storeAs('uploads', time() . $dados->file('foto')->extension());
        $path_doc = null;

        if ($dados->hasFile('documentos')) {

            $path_doc = $dados->file('documentos')->storeAs('uploads', time() . $dados->file('documentos')->extension());
        }


        // return [$dados->all(),$validated->errors()];


        if ($validated->fails()) {

            return redirect()->back()->with('error', $validated->errors()->first());
        }


        Estagiario::create([
            'nome' => $dados->input('nome'),
            'email' => $dados->input('email'),
            'bi'=>$dados->input('bi'),
            'tel' => $dados->input('telefone'),
            'genero' => $dados->input('genero'),
            'institutos' => $dados->input('institutos'),
            'plano_estagio_id'=>$dados->input('plano'),
            'dt_nascimento'=>date('Y-m-d',strtotime($dados->input('dt_nascimento'))),
            'foto' => $path_image,
            'documentos' => $path_doc
        ]);


        return redirect('/estagiarios/form')->with('sucess', 'registro feito com exito!');

    }

    public function show($id)
    {
        $estagiario = Estagiario::find($id);

        if ($estagiario) {
            $planos = PlanoEstagio::all();
            $institutos = Instituto::all();
            return view('forms.editarEstagiario', compact('planos', 'institutos', 'estagiario'));
        }

        return redirect()->back();
    }

    public function update(Request $dados)
    {
        $_estagiario = Estagiario::find($dados->id);

        if ($_estagiario) {


            $salvo = $_estagiario->save();

            return $salvo
                ? redirect()->back()->with('sucess', 'Estagiário registrado com sucesso!')
                : redirect()->back()->with('error', 'A operação falhou!');
        }

        return redirect()->back();
    }

    public function delete(Request $dados)
    {
        $estagiario = Estagiario::find($dados->id);

        if ($estagiario) {
            $estagiario->delete();
            return redirect()->back()->with('sucess', 'estagiario deletado com sucesso!');
        }

        return redirect()->back();
    }

    // =======================
    // Função reutilizável
    // =======================
    private function preencherDados(Request $dados)
    {


        return $dados;

        if ($dados->hasFile('foto')) {
            $estagiario->foto = $this->uploadFicheiro($dados->file('foto'));
        }

        if ($dados->hasFile('documentos')) {
            $estagiario->documentos = $this->uploadFicheiro($dados->file('documentos'));
        }

        $estagiario->instituto_id = $dados->instituto ?? null;
    }

    private function uploadFicheiro($ficheiro, $dir = 'uploads'): string
    {
        $nome = uniqid() . '_' . time() . '.' . $ficheiro->getClientOriginalExtension();
        $ficheiro->move(public_path($dir), $nome);
        return $nome;
    }
}

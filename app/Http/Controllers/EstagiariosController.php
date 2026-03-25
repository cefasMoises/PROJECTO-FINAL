<?php
namespace App\Http\Controllers;

use App\Models\Estagiario;
use App\Models\Instituto;
use App\Models\PlanoEstagio;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


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
                'email' => ['nullable', 'email', 'unique:estagiarios,email'],
                'telefone' => ['nullable', 'digits:9'],
                'bi' => ['required', "unique:estagiarios,bi", 'min:14', 'max:14'],
                'plano' => ['required', 'integer'],
                'genero' => ['required'],
                'institutos' => ['required'],
                'foto' => ['required', 'image', 'max:2048'],
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






        if ($validated->fails()) {

            return redirect()->back()->with('error', $validated->errors()->first());
        }


        $path_image = $this->uploadFicheiro($dados->file('foto'));
        $path_doc = null;

        if ($dados->hasFile('documentos')) {

            $path_image = $this->uploadFicheiro($dados->file('documentos'));

        }


        Estagiario::create([
            'nome' => $dados->input('nome'),
            'email' => $dados->input('email'),
            'bi' => $dados->input('bi'),
            'tel' => $dados->input('telefone'),
            'genero' => $dados->input('genero'),
            'institutos' => $dados->input('institutos'),
            'plano_estagio_id' => $dados->input('plano'),
            'dt_nascimento' => date('Y-m-d', strtotime($dados->input('dt_nascimento'))),
            'foto' => $path_image,
            'documentos' => $path_doc
        ]);


        return redirect('/estagiarios/form')->with('sucess', 'registro feito com exito!');

    }

    public function show($id)
    {
        $estagiario = Estagiario::find($id);

        $select_planos = [];
        $select_institutos = [];

        foreach (PlanoEstagio::all() as $plano) {
            $select_planos[] = ['label' => $plano->nome, 'value' => $plano->id];
        }

        foreach (Instituto::all() as $instituto) {
            $select_institutos[] = ['label' => $instituto->nome, 'value' => $instituto->id];
        }

        if ($estagiario) {

            return view('forms.editarEstagiario', compact('select_planos', 'select_institutos', 'estagiario'));
        }

        return redirect()->back();
    }


    public function update(Request $dados)
    {


    // return $dados;

        $validated = Validator::make($dados->all(), [
            'nome' => ['required', 'string', 'min:3'],

            'email' => [
                'nullable',
                'email',
                Rule::unique('estagiarios', 'email')->ignore($dados->id)
            ],

            'telefone' => ['nullable', 'digits:9'],

            'bi' => [
                'required',
                Rule::unique('estagiarios', 'bi')->ignore($dados->id)
            ],

            'plano' => ['required', 'integer'],
            'genero' => ['required'],
            'institutos' => ['required'],

            'foto' => ['nullable', 'image', 'max:2048'],
            'documentos' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:4096']
        ]);

        if ($validated->fails()) {
            return redirect()->back()->with('error', $validated->errors()->first());
        }

        $estagiario = Estagiario::findOrFail($dados->id);

        $path_image = null;
        $path_doc = null;

        if ($dados->hasFile('foto')) {
            $path_image = $this->uploadFicheiro($dados->file('foto'));
        }

        if ($dados->hasFile('documentos')) {
            $path_doc = $this->uploadFicheiro($dados->file('documentos'));
        }

        $estagiario->update([
            'nome' => $dados->input('nome'),
            'email' => $dados->input('email'),
            'bi' => $dados->input('bi'),
            'tel' => $dados->input('telefone'),
            'genero' => $dados->input('genero'),
            'institutos' => $dados->input('institutos'),
            'plano_estagio_id' => $dados->input('plano'),
            'dt_nascimento' => date('Y-m-d', strtotime($dados->input('dt_nascimento'))),

            'foto' => $path_image ?? $estagiario->foto,
            'documentos' => $path_doc ?? $estagiario->documentos
        ]);

        return redirect()->back()->with('sucess', 'registro atualizado com êxito!');
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


    private function uploadFicheiro(UploadedFile $file, $dir = 'uploads'): string
    {
        $name = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();

        $file->storeAs($dir, $name, 'public');

        return $dir . '/' . $name;
    }
}

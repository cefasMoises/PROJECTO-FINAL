<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Turma;
use Barryvdh\DomPDF\Facade\Pdf;

class CertificadosController extends Controller
{
    public function index()
    {
        return view('main.certificados', ['turmas' => Turma::all()]);
    }
    public function show($id)
    {


        $aluno = Aluno::find($id);
        if ($aluno) {
            $pdf = Pdf::loadView('pdf.certificado', ['aluno' => $aluno]);
            return $pdf->stream($aluno->created_at);
        }
        return redirect()->back();
    }
}

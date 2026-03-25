<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{



    protected $fillable=['nome','qtd_aluno','cursos_id'];
    
    public function alunos()
    {
        return $this->belongsToMany(Aluno::class);
    }
    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }
}

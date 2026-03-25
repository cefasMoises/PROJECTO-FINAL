<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{


    protected $fillabel=['nome','descricao'];

    public function alunos()
    {
        return $this->belongsToMany(Aluno::class);
    }
    public function instrutores()
    {
        return $this->belongsToMany(Instrutor::class);
    }
    public function turmas()
    {
        return $this->hasMany(Turma::class);
    }
}

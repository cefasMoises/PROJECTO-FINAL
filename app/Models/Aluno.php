<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// use App\Models\

class Aluno extends Model
{



    public function notas(){


        return $this->hasMany(Nota::class);
    }
    public function pagamentos()
    {
        return $this->hasMany(Pagamento::class);
    }
    public function Faltas()
    {
        return $this->hasMany(Falta::class);
    }
    public function turmas()
    {
        return $this->belongsToMany(Turma::class);
    }
    public function cursos()
    {
        return $this->belongsToMany(Curso::class);
    }

}

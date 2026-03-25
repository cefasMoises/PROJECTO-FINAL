<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{
    public function aluno()
    {
        return $this->belongsTo(Aluno::class);
    }
    public function usuario(){


        return $this->belongsTo(Usuario::class);
    }
}

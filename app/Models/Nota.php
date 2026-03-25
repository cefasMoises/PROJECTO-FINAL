<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    public function aluno()
    {
        return $this->belongsTo(Aluno::class);
    }
}

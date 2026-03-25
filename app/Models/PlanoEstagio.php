<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanoEstagio extends Model
{
    public function curso()
    {

        return $this->belongsTo(Curso::class);
    }
    function estagiarios()
    {
        return $this->hasMany(Estagiario::class);
    }
}

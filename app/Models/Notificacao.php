<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notificacao extends Model
{
    

    protected $fillable =['tipo','descricao','estatus'];
    
    public function usuario(){

        return $this->belongsTo(Usuario::class);
    }
}

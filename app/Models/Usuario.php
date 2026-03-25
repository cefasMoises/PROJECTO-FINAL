<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $fillable = ['nome', 'email','acesso', 'senha','estatus'];



    public function notificacoes(){

        return $this->hasMany(Notificacao::class);
    }
}

<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instrutor extends Model
{
    protected $table = 'instrutores';
    public function cursos()
    {
        return $this->belongsToMany(Curso::class);
    }
}

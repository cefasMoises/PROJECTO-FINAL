<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{


    protected $fillable = ['estagiario_id','usuario_id','valor','metodo','comprovativo','sumarios'];
    public function estagiario()
    {
        return $this->belongsTo(Estagiario::class);


    }
    public function usuario()
    {

        return $this->belongsTo(Usuario::class);
    }
}

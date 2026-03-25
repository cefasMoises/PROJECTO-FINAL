<?php



namespace App\Classes;





class Ficheiros {


    static function uploadFicheiro($ficheiro, String $dir = 'uploads'): String
    {

        $arquivo = $ficheiro;
        $nome_ficheiro = time() . '.' . $arquivo->getClientOriginalExtension();
        $arquivo->move(public_path("$dir"), $nome_ficheiro);

        return $nome_ficheiro;
    }


}
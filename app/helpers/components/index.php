<?php








if (!function_exists("voidStatus")) {


    function voidStatus(string $text = "Vazio...")
    {


        return <<<HTML

        <span class="rounded-lg p-2 text-sm bg-gray-200 border border-solid text-gray-600">{$text}</span>

        HTML;


    }

}
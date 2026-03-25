<?php

namespace App\rules;


enum UserStates
{
    case ON;
    case OFF;


    public static function getStateOn()
    {
        return self::ON->name;
    }
    public static function getOff()
    {

        return self::OFF->name;
    }
}








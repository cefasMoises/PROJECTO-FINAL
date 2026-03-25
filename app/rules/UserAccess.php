<?php

namespace App\rules;


enum UserAccess
{

    case ADM;
    case PDG;
    case FNC;


    public static function all(): array
    {
        return [self::ADM->name, self::PDG->name, self::FNC->name];
    }
    public static function getAdm(): string
    {

        return self::ADM->name;

    }
    public static function getPDG(): string
    {
        return self::PDG->name;
    }

    public static function getFNC(): string
    {
        return self::FNC->name;
    }

}
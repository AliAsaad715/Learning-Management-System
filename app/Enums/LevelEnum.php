<?php

namespace App\Enums;

enum LevelEnum : string
{
    case BEGINNER = 'beginner';
    case INTERMEDIATE = 'intermediate';
    case ADVANCED = 'advanced';
    case EXPERT = 'expert'; 

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}

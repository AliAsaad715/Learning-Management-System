<?php

namespace App\Enums;

enum RoleEnum : string
{
    case STUDENT = 'student';
    case TEACHER = 'teacher';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}

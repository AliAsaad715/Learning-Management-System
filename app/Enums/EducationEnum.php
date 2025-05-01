<?php

namespace App\Enums;

enum EducationEnum : string
{
    case NONE = 'none';
    case ELEMENTARY = 'elementary';
    case MIDDLE_SCHOOL = 'middle_school';   
    case HIGH_SCHOOL = 'high_school';
    case ASSOCIATE = 'associate';
    case UNDERGRADUATE = 'undergraduate';
    case BACHELOR = 'bachelor';
    case GRADUATE = 'graduate';
    case MASTER = 'master';
    case POSTGRADUATE = 'postgraduate';
    case DOCTORATE = 'doctorate';
    case PROFESSIONAL = 'professional';
    case OTHER = 'other';


    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}

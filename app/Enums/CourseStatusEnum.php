<?php

namespace App\Enums;

enum CourseStatusEnum : string
{
    case DRAFT = 'draft';

    case PENDING = 'pending';

    case APPROVED = 'approved';

    case REJECTED = 'rejected';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }


}

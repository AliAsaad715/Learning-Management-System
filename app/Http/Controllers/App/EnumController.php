<?php

namespace App\Http\Controllers\App;

use App\Enums\EducationEnum;
use App\Enums\LevelEnum;
use App\Responses\Response;
use Illuminate\Http\JsonResponse;

class EnumController extends Controller
{
    public function levels(): JsonResponse
    {
        $levels = LevelEnum::values();
        return Response::success($levels, 'Levels retrieved successfully');
    }

    public function educations(): JsonResponse
    {
        $educations = EducationEnum::values();
        return Response::success($educations, 'Educations retrieved successfully');
    }
}

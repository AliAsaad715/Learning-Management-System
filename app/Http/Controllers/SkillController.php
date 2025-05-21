<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use App\Responses\Response;
use Illuminate\Http\JsonResponse;

class SkillController extends Controller
{
    public function index(): JsonResponse
    {
        $skills = Skill::all();
        return Response::success($skills, 'Skills retrieved successfully');
    }
}

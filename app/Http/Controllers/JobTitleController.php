<?php

namespace App\Http\Controllers;

use App\Models\JobTitle;
use App\Models\Language;
use App\Responses\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class JobTitleController extends Controller
{
    public function index(): JsonResponse
    {
        $job_titles = JobTitle::all();
        return Response::success($job_titles, 'Countries retrieved successfully');
    }
}

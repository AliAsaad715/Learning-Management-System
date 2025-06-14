<?php

namespace App\Http\Controllers\App;

use App\Models\JobTitle;
use App\Responses\Response;
use Illuminate\Http\JsonResponse;

class JobTitleController extends Controller
{
    public function index(): JsonResponse
    {
        $job_titles = JobTitle::all();
        return Response::success($job_titles, 'Job titles retrieved successfully');
    }
}

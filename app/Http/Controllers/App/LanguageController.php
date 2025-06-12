<?php

namespace App\Http\Controllers\App;

use App\Models\Language;
use App\Responses\Response;
use Illuminate\Http\JsonResponse;

class LanguageController extends Controller
{
    public function index(): JsonResponse
    {
        $countries = Language::all();
        return Response::success($countries, 'Countries retrieved successfully');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Responses\Response;
use Illuminate\Http\JsonResponse;

class CountryController extends Controller
{
    public function index(): JsonResponse
    {
        $countries = Country::all();
        return Response::success($countries, 'Countries retrieved successfully');
    }
}

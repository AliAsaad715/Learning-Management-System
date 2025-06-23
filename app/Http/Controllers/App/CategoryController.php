<?php

namespace App\Http\Controllers\App;

use App\Models\Category;
use App\Responses\Response;
use Illuminate\Http\Request;


class CategoryController extends Controller
{

    public function indexCategory(){
        $categories = Category::get()->all();
        return Response::success($categories, 'get categories successfully');
    }

}


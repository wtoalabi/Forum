<?php

namespace App\Http\Controllers\Forum;

use Illuminate\Http\Request;
use App\Models\Forum\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryListCollection;

class CategoriesController extends Controller
{
    public function index (){
         $category = Category::where('id', '>',0)->withCount('threads')->get();
         return new CategoryListCollection($category);
    }
}

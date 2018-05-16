<?php

namespace App\Http\Controllers\Forum;

use App\Models\Forum\Thread;
use Illuminate\Http\Request;
use App\Models\Forum\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\ThreadsCollection;

class SingleCategoryThreadsController extends Controller
{
    public function index ($category){
         $category = Category::whereSlug($category)->first();
         $threads = Thread::where('category_id', $category->id)->latest()->paginate(10);
         return new ThreadsCollection($threads);
         
    }
}

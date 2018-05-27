<?php

namespace App\Http\Controllers\Forum;

use App\Models\Forum\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\SearchResultCollection;

class SearchController extends Controller
{
    public function index (){
         $query = request('search');
         $result = Thread::where('title', 'LIKE', "%$query%")
                        ->get()
                        ->take(4);
         //$result = DB::table('threads')->where('title', 'LIKE', "%$query%")->orWhere('body', 'LIKE', "%$query%")->get()->take(5);
         //dd($result);
         return new SearchResultCollection($result);
    }
}

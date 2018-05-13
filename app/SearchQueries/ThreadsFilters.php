<?php
namespace App\SearchQueries;

use App\User;
use App\Models\Forum\Thread;
use App\SearchQueries\Filters;

class ThreadsFilters extends Filters{

    protected $filters = ['popular'];

    public function popular ($request){
        return $this->builder->withCount('replies')
            ->orderBy('replies_count', 'desc')->get();
    }

    /* protected $filters= ['user_id', 'id', 'category_id'];

    public function user_id ($userID){
        $user = User::findOrFail($userID);
        return $threads = $this->builder->where('user_id',$user->id);
    }
    public function id ($threadID){
        return $this->builder->where('id', '>',$threadID);
    }
    
    public function category_id ($request){
       return $this->builder->where('category_id', $request);
    }
 */
    
    
}
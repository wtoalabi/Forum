<?php
namespace App\QueryFilters;

use App\User;
use App\Models\Forum\Thread;
use App\QueryFilters\Filter;
use App\Models\Forum\Category;


class ThreadsFilters extends Filter{

    protected $filters = ['sortByPopular','sortByUser','filterUnanswered','filterCategory'];

    public function sortByPopular (){
        return $this->builder->withCount('replies')
            ->orderBy('replies_count', 'desc')->get();
    }

    public function sortByUser (){
         $userID = $this->request->sortByUser;
         return $this->builder->where('user_id', $userID);
    }

    public function filterUnanswered (){
        return $this->builder->where('replies_count', 0);
    }

    public function filterCategory (){
        $category = Category::where('slug', $this->request->filterCategory)->first();
        //dd($categoryID);
        return $this->builder->where('category_id', $category->id);
    }
    
}
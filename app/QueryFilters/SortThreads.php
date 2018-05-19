<?php
namespace App\QueryFilters;
use Illuminate\Http\Request;
use App\QueryFilters\Filter;

class SortThreads extends Filter{

    protected $request;
    public function __construct (Request $request){
         $this->request = $request->get('sort');
        }
        
        public function by ($query){
        $this->query = $query;
         if(method_exists($this, $this->request)){
            $method = $this->request;
            $this->$method();
         }
    }

    public function popular (){
        return $this->query->withCount(['replies'])->orderBy('replies_count', 'desc');
    }

}
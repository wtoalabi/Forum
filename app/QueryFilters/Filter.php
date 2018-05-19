<?php

namespace App\QueryFilters;

use Illuminate\Http\Request;

abstract class Filter{

    protected $request;
    protected $builder;
    public function __construct (Request $request){
         $this->request = $request;
    }

    public function apply ($builder){
        $this->builder = $builder;
        //dd($this->getFilters());
        foreach($this->getFilters() as $filter => $value){
            if(method_exists($this, $filter)){
                $this->$filter($value);
            }
        }
        return $this->builder;
    } 

    public function getFilters (){
         return $this->request->only($this->filters);
    }
}
<?php

namespace App\Http\Controllers\search;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\GoodsModel;
class searchcontroller extends Controller
{
    public function check(){
        return view('search');
    }
    public function sec(Request $request){
       $word=$request->input('word');

      

    }
    public function card(){

    }
}

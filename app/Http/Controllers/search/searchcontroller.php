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

}

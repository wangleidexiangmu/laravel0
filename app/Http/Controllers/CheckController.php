<?php

namespace App\Http\Controllers;
use App\Model\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
class CheckController extends Controller
{
    public function check(){
    $info=[
        'token'=>'1fe60038f6ddbebd97f41d83e617f46b',
        'id'=>'3',
        'method'=>'AES-256-CBC',
        'key'=>'wanglei',
        'option'=>'OPENSSL_RAW_DATA',
        'iv'=>'1234567890qwerty' ,
        ];
        $data=ksort($info);
       $str=md5($data);
        $result = strtoupper($str);
        return $result;
    }
    protected function ToUrlParams()
    {
        $info=[
            'token'=>'1fe60038f6ddbebd97f41d83e617f46b',
            'id'=>'3',
            'method'=>'AES-256-CBC',
            'key'=>'wanglei',
            'option'=>'OPENSSL_RAW_DATA',
            'iv'=>'1234567890qwerty' ,
        ];
        $buff = "";
        foreach ( $info as $k => $v)
        {
            if($k != "sign" && $v != "" && !is_array($v)){
                $buff .= $k . "=" . $v . "&";
            }
        }
        $buff = trim($buff, "&");
        return $buff;
    }
    public function SetSign()
    {
        $sign = $this->check();
        return $sign;
    }
    public function yan(Request $request){
      $sign=true;
      if($sign==true){
          echo '成功';
      }else{
          echo '失败';
      }

    }

}

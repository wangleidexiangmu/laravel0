<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
class ConterController extends Controller
{
    public function ren(){
        return view('conter');
    }
    public function wther(Request $request){
        $data=json_encode($request->input());
        $method='AES-256-CBC';
        $key='wanglei';

        $option=OPENSSL_RAW_DATA;
        $iv='1234567890qwerty';
        $enc_str=openssl_encrypt($data,$method,$key,$option,$iv);
        $admin= base64_encode($enc_str);
        // echo $admin;
        $url ='http://test.1809a.com/day';

        //创建一个新curl
        $ch=curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POST,1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$admin);
        curl_setopt($ch,CURLOPT_HTTPHEADER,[
            'Content-Type:text/plain'
        ]);
        $res=curl_exec($ch);
        $code=curl_errno($ch);
        // var_dump($code);
        curl_close($ch);
    }
    public function day(){
        $mi=file_get_contents('php://input');
        //var_dump($mi);exit;
        $data=base64_decode($mi);
        $method='AES-256-CBC';
        $key='wanglei';

        $option=OPENSSL_RAW_DATA;
        $iv='1234567890qwerty';
        $enc_str=openssl_decrypt($data,$method,$key,$option,$iv);
        $res=json_decode($enc_str);
         $city=$res->name;
        $url='http://api.k780.com:88/?app=weather.future&weaid='.$city.'&&appkey=10003&sign=b59bc3ef6191eb9f747dd4e83c99f2a4&format=json';
        $ch = curl_init();
        //设置选项，包括URL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);

        //执行并获取HTML文档内容
        $output = curl_exec($ch);
        //释放curl句柄
        curl_close($ch);
        Redis::set($mi,$output);
        return json_encode($output,JSON_UNESCAPED_UNICODE);
    }
}

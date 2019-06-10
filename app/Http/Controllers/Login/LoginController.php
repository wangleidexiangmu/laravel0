<?php

namespace App\Http\Controllers\Login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\UserModel;
use Illuminate\Support\Facades\Redis;
class LoginController extends Controller
{

    public function login(){
        return view('login');
    }
    public function add(Request $request){
        session_start();
        $_SESSION['name']=$request->input('name');
        $data=json_encode($request->input());
        //var_dump($data);exit;

        $method='AES-256-CBC';
        $key='wanglei';

        $option=OPENSSL_RAW_DATA;
        $iv='1234567890qwerty';
        $enc_str=openssl_encrypt($data,$method,$key,$option,$iv);
        $admin= base64_encode($enc_str);
        // echo $admin;
        $url ='http://test.1809a.com/open';

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
    public function open(Request  $request){

     $mi=file_get_contents('php://input');
      // var_dump($mi);exit;
        $data=base64_decode($mi);
        $method='AES-256-CBC';
        $key='wanglei';

        $option=OPENSSL_RAW_DATA;
        $iv='1234567890qwerty';
        $enc_str=openssl_decrypt($data,$method,$key,$option,$iv);
        $res=json_decode($enc_str);
      //  var_dump($res);exit;
        $user=$res->name;

        $pass=$res->pwd;
       $name= UserModel::where(['name'=>$user,'pass'=>$pass])->first();
       $uid='number:'.$name['uid'];
        $number= Redis::incr($uid);
      // var_dump($number);
        Redis::expire($uid,180);
        if($number>20){
            echo '次数超限';
        }
       if($name){
           // echo "登录成功";
           $token = md5 ('logn' . 'logincontroller' .'open' .'.time().' );
          $key='uid:'.$name->uid;
           Redis::set($key,$token);
           Redis::expire($key,64800);

           $response=[
               'msg'=>'登录成功',
                'token'=>$token,
               'uid'=>$name->uid,
               'errno'=>0
           ];
           return json_encode($response);
       }else{
           $key=$_SERVER['REMOTE_ADDR'];
          $num= Redis::incr($key);
          //echo $key."次数".$num;
           echo '登录失败';
       }
    }



}

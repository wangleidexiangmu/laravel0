<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redis;
class conter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token=$request->input('token');
        // var_dump($token);
        $uid=$request->input('uid');
        //判断token是否为空
        if(empty($token)||empty($uid)){
            $response=[
                'errno'=>400002,
                'msg'=>'参数不完整'
            ];
            die(json_encode($response,JSON_UNESCAPED_UNICODE));
        }
        //验证是否有效
        $key='uid:'.$uid;
        // var_dump($key);
        $local_token=Redis::get($key);
       // var_dump($local_token);
        if($local_token){
            if($token==$local_token){
                $content='token:'.$token.'uid:'.$uid;
                $time=time();
                $str = $time . $content . "\n";

            }else{
                $response=[
                    'errno'=>400004,
                    'msg'=>'token无效'
                ];
                die(json_encode($response,JSON_UNESCAPED_UNICODE));
            }
        }else{
            $response=[
                'errno'=>400005,
                'msg'=>'请先登录'
            ];
            die(json_encode($response,JSON_UNESCAPED_UNICODE));
        }
        return $next($request);
    }
}

<?php

namespace App\Http\Controllers\search;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\UserModel;
class searchcontroller extends Controller
{
    public function check(){
        return view('search');
    }
    public function chat(){

        return view('chat');
    }
    public function ajax(){
        session_start();
      // var_dump($_SESSION);exit;
    if(isset($_POST['content'])){

        $filename = date("Ymd",time()).".txt";
        if(file_exists($filename)){
            $content = file_get_contents($filename);
            $data = json_decode($content,true);
            $con['name'] = $_SESSION["name"];
            $con['content'] = $_POST["content"];
            $data[] = $con;
            $file = fopen($filename,"w");
            fwrite($file,json_encode($data));
            fclose($file);
        }else{
            $file = fopen($filename,"w");
            $con['name'] = $_SESSION["name"];
            $con['content'] = $_POST["content"];
            $data[] = $con;
            fwrite($file,json_encode($data));
            fclose($file);
        }

    }




    }
    public function getphp(){
set_time_limit(0);
$filename = date("Ymd",time()).".txt";
if(file_exists($filename)){
    $content = file_get_contents($filename);
    $data = json_decode($content,true);
   // var_dump($data);exit;
    $count = count($data);

    if($_POST['msg'] == "one"){
        exit(json_encode($data));
    }

    while(true){

        $contents = file_get_contents($filename);
        $datas = json_decode($contents,true);
        $counts = count($datas);
        if($counts>$count){
            echo json_encode($datas);
            break;
        }
        usleep(300);
    }
}else{
    $file = fopen($filename,"w");
    $con['name'] = "系统消息";
    $con['content'] = "欢迎来到EPGO聊天室";
    $data[] = $con;
    fwrite($file,json_encode($data));
    fclose($file);

    exit(json_encode($data));

}


    }
}

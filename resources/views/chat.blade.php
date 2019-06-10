<html>
<head>
    <title>聊天室</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script src="/js/jquery-1.11.2.min.js"></script>
    <script>
        $(function(){
            $("#post").click(function(){

                var content=$("#content").val();
                if(!$.trim(content)){
                    alert('请填写内容');
                    return false;
                }
                $("#content").val("");

                $.post("http://test.1809a.com/ajax", {content:content});});
        })

        function getData(msg){
            if(msg == undefined)
            {
                msg = '';
            }
            $.post("http://test.1809a.com/getphp",{"msg":msg},function(data){
                //var myjson = eval("("+data+")");
                if(data){
                    var chatcontent = '';
                    var obj = eval('('+data+')');
                    $.each(obj,function(key,val){
                        chatcontent += "<div class='name'>"+val['name']+" 说:</div>";
                        chatcontent += "<div class='content'>"+val['content']+"</div>";
                    })
                    $("#chatshow").html(chatcontent);
                }

                getData();
            })
        }

        // function getUser(msg){
        //     if(msg == undefined){
        //         msg = '';
        //     }
        //     $.post("getuser.php",{"msg":msg},function(data){
        //         //var myjson = eval("("+data+")");
        //         if(data){
        //             var chatcontent = '';
        //             var obj = eval('('+data+')');
        //             $.each(obj,function(key,val){
        //                 chatcontent += "<div class='username'>"+val['username']+" 说:</div>";
        //                 chatcontent += "<div class='content'>"+val['content']+"</div>";
        //             })
        //             $("#chatshow").html(chatcontent);
        //         }
        //         getData();
        //     })
        // }

        getData("one");



        // $(function(){
        //     $("#userlist p").click(function(){
        //         $("#content").val("@"+$(this).text()+" ");
        //     })
        // })

        // $(function(){
        //     $(document).keypress(function(e){
        //         if(e.ctrlKey && e.which == 13 || e.which == 10) {

        //             var content=$("#content").val();
        //             if(!$.trim(content)){
        //                alert('请填写内容');
        //                return false;
        //             }
        //             $("#content").val("");
        //             $.post("ajax.php", {content:content});
        //         }
        //     })
        //     //alert(event.clientX+document.body.clientWidth);
        // })

        /*window.onbeforeunload=function (){
            //return("===onbeforeunload===");
            if(event.clientX>document.body.clientWidth && event.clientY < 0 || event.altKey){
                return("你关闭了浏览器");
            }else{
                return(document.body.clientWidth);
            }
        } */

    </script>
    <style>
        #chat{margin:0 auto;}
        #chatshow{width:500px;height:400px;overflow:auto;border:1px solid #ccc;float:left;}
        #userlist{width:100px;height:400px;overflow:auto;border:1px solid #ccc;float:left;margin-right:2px;}
        #userlist p{color:#0F0; cursor:pointer;}
        .clearboth{clear:both;}
        .username{font-weight:bold;color:#00F;font-size:12px;margin-bottom:3px;margin-top:8px;}
    </style>
</head>
<body>
<div id="chat">
    <div id="userlist">
        <div style="font-size:12px;font-weight:bold;">在线用户列表</div>
        <div class="userlist">
            <?php
            // $dsn = "mysql:host=localhost;dbname=test;charset=utf8'";
            //    $db = new PDO($dsn, 'root', 'root');
            $db = new PDO('mysql:dbname=test;host=192.168.239.1;charset=utf8', 'root', 'root');
            $rs = $db->prepare("select * from userreg where is_login = '1'");
            $rs->execute();
            while($row = $rs->fetch()){
                echo '<p>'.$row['name'].'</p>';
            }
            ?>
        </div>
    </div>
    <div id="chatshow"></div>
</div>
<div class="clearboth"></div>
<div>
    <textarea name="content" id="content" style="width:600px;height:100px"></textarea>
    <input type='button' name='tj' id="post" value='发布' >
</div>
</body>
</html>
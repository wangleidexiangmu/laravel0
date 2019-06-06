<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title></title>
    <script src="/js/mui.min.js"></script>


</head>
<body>
<div class="mui-button-row mui-input-group">登录页面</div>
<form class="mui-input-group">
    <div class="mui-input-row">
        <label>城市名</label>
        <input type="text" class="mui-input-clear" placeholder="请输入城市名"name='user_name' id='name'>
    </div>

    <div class="mui-button-row">
        <button type="button" class="mui-btn mui-btn-primary" id='login'>确认</button>
        <button type="button" class="mui-btn mui-btn-danger" >取消</button>
    </div>
</form>
<div class="mui-button-row mui-input-group">



</div>
<script type="text/javascript">
    document.getElementById("login").addEventListener('tap',function(){
        var name=document.getElementById('name').value;

        var url ='wther';
        mui.ajax({
            url:url,
            data:{
                name:name,
            },
            dataType:'json',//服务器返回json格式数据
            type:'get',//HTTP请求类型
            timeout:10000,//超时时间设置为10秒；
            success:function(data){
               alert(data);
                //服务器返回响应，根据响应结果，分析是否登录成功；

                    // mui.openWindow({
                    // 	url:"main.html"
                    // }
                    //);
                }

            })


    });

</script>
</body>
</html>
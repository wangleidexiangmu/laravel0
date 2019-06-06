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
        <label>用户名</label>
        <input type="text" class="mui-input-clear" placeholder="请输入用户名"name='user_name' id='name'>
    </div>
    <div class="mui-input-row">
        <label>密码</label>
        <input type="password" class="mui-input-password" placeholder="请输入密码" name='password' id='pwd'>
    </div>
    <div class="mui-button-row">
        <button type="button" class="mui-btn mui-btn-primary" id='login'>确认</button>
        <button type="button" class="mui-btn mui-btn-danger" >取消</button>
    </div>
</form>
<div class="mui-button-row mui-input-group">

    <button type="button" class="mui-btn mui-btn-warning" id='conter'><a href="http://test.1809a.com/ren">个人中心</a></button>

</div>
<script type="text/javascript">
    document.getElementById("login").addEventListener('tap',function(){
        var name=document.getElementById('name').value;
        var pwd=document.getElementById('pwd').value;

        var url ='http://test.1809a.com/add';
        mui.ajax({
            url:url,
            data:{
                name:name,
                pwd:pwd,
            },
            dataType:'json',//服务器返回json格式数据
            type:'post',//HTTP请求类型
            timeout:10000,//超时时间设置为10秒；
            success:function(data){
                alert(data.msg);
                //服务器返回响应，根据响应结果，分析是否登录成功；
                if(data.errno==0){
                    localStorage.setItem('token',data.token);
                    localStorage.setItem('uid',data.uid);
                    // mui.openWindow({
                    // 	url:"main.html"
                    // }
                    //);
                }

            },
            error:function(xhr,type,errorThrown){
                //异常处理；
                console.log(type);
            }
        });
    });

</script>
</body>
</html>
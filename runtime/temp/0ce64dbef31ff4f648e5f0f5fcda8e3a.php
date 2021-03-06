<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:74:"D:\AppServ\www\hf1707_zc\public/../application/admin\view\index\login.html";i:1517380580;}*/ ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>后台系统管理</title>
	<meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    
    <link rel="stylesheet" href="__STATIC__/css/admin/font.css">
	<link rel="stylesheet" href="__STATIC__/css/admin/xadmin.css">
</head>
<body class="login-bg">
    
    <div class="login">
        <div class="message">管理登录</div>
        <div id="darkbannerwrap"></div>
        
        <form method="post" class="layui-form" >
            <input value="1" id="account" placeholder="用户名"  type="text" lay-verify="required" class="layui-input" >
            <hr class="hr15">
            <input value="123" id="pwd" lay-verify="required" placeholder="密码"  type="password" class="layui-input">
            <hr class="hr15">
            <input id="vali" lay-verify="required" placeholder="验证码"  type="text" class="layui-input">
            <div><img id="code" src="<?php echo captcha_src(); ?>" alt="load error" onclick="validate()"></div>
            <hr class="hr15">
            <input value="登录" id="login" style="width:100%;" type="button">
            <span style="display: inline-block;height: 5px"></span>
            <a href="<?php echo url('admin/login/toMain'); ?>"><input value="返回众筹首页" style="width:100%;" type="button"></a>
            <hr class="hr20" >
        </form>
    </div>


    <!-- 底部结束 -->
    
</body>

<script type="text/javascript" src="__STATIC__/js/admin/jquery.min.js"></script>
<script src="__STATIC__/lib/layui/layui.js" charset="utf-8"></script>
<script type="text/javascript" src="__STATIC__/js/admin/xadmin.js"></script>


<script src="https://cdn.jsdelivr.net/npm/vue"></script>
<!--引用vue-->
<script src="__JS__/vue.js"></script>
<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<!--引用jq文件-->
<script src="__JS__/jquery-2.1.4.js"></script>
<script src="__JS__/bootstrap.min.js"></script>
<script>

    //验证码点击切换
    function validate(){
        //$(obj).attr('src','<?php echo captcha_src(); ?>?'+Math.random());
        $("#code").attr('src','<?php echo captcha_src(); ?>?'+Math.random());
    }
    //登录方法
    $("#login").click(function(){

        //数据库问题已解决
        var $data = {
            'account':$("#account").val(),
            'pwd':$("#pwd").val(),
            'vali':$("#vali").val()
        };
//        console.log($data);//打印数据
        $.ajax({
            url:'<?php echo url("admin/login/login"); ?>',//ajax访问地址
            data:$data,
            dataType:'json',//接收返回值json格式
            type:'post',
            success:function(res){

                if(res.code==10002||res.code==10000){
                    validate();
                }else if(res.code==10001){
                    //        本地页面跳转
                    //前台session存值供前台使用/从后台获取的数据转换未JSON格式
                    sessionStorage.setItem('adminInfo',JSON.stringify(res.data[0][0]));
//                    console.log(JSON.stringify(res.data[0][0]));
                    window.location.href = "<?php echo url('admin/login/adminMain'); ?>";
                }

            }
        })
    });


    //失焦验证
    //账号
    function loginBlur(){

    }
    //密码
    function pwdBlur(){

    }
    //验证码
    function valiBlur(){

    }
</script>

</html>
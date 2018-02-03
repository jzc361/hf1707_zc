<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:90:"D:\AppServ\www\hf170724_zc\hf1707_zc\public/../application/admin\view\index\loginView.html";i:1516963563;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <!--设置ie内核浏览器下的渲染模式-->
    <meta http-equiv="x-ua-compatible" content="IE=edge">

    <!--设置网页以webkit(极速模式)来渲染页面-->
    <meta name="renderer" content="webkit">

    <!--设置网页的宽度与访问设备一致,显示比例为1:1-->
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <!--
    __STATIC__自动定位到static/下
    __JS__自动定位到static/js/下
    __CSS__同理/css/下
    -->
    <title>Title</title>

    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <!--引用主页样式-->
    <link rel="stylesheet" href="__CSS__/main.css">
    <!--引用bootstrap-->
    <link rel="stylesheet" href="__CSS__/bootstrap.min.css">

    <style>
        /* 小屏幕（桌面显示器，大于等于 768px） */
        @media (min-width: 768px) and (max-width: 992px){
            .min{
                width: 500px;
                height: 600px;
            }
        }
        /* 中等屏幕（桌面显示器，大于等于 992px） */
        @media (min-width: 992px) and (max-width: 1200px){
            .middle{
                width: 500px;
                height: 600px;
            }
        }
        /* 大屏幕（大桌面显示器，大于等于 1200px） */
        @media (min-width: 1200px){
            .max{
                width: 500px;
                height: 400px;
                display: inline-block;
            }
            .max_pos{
                margin-top: 60px;
            }
            body{
                text-align: center;
            }
        }
    </style>
</head>
<body>

<div class="max middle min">
    <form class="form-horizontal max_pos">

        <h1 style="display: inline-block;margin-bottom: 15px">
            XX众筹后台管理系统
        </h1>
        <div class="form-group">
            <span class="col-sm-2"></span>
            <label for="account" class="col-sm-2 control-label">Account</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="account" placeholder="Account">
            </div>
            <span class="col-sm-2"></span>
        </div>
        <div class="form-group">
            <span class="col-sm-2"></span>
            <label for="account" class="col-sm-2 control-label">Password</label>
            <div class="col-sm-6">
                <input type="password" class="form-control" id="pwd" placeholder="Password">
            </div>
            <span class="col-sm-2"></span>
        </div>
        <div class="form-group">
            <span class="col-sm-2"></span>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="vali" placeholder="Validate">
            </div>
            <!--验证码-->
            <div class="col-sm-4"><img id="code" src="" alt="load error" onclick="validate(this)"></div>
            <span class="col-sm-3"></span>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <span class="col-sm-2"></span>
                <div class="col-sm-8">
                    <button id="login" onblur="loginBlur()" style="width: 100%" type="button" class="btn btn-default">登录</button>
                </div>
                <span class="col-sm-2"> </span>
            </div>
            <div class="col-sm-12">
                <span class="col-sm-2"> </span>
                <div class="col-sm-8">
                    <!--回到首页功能
                    url地址为login控制器,进入toMain方法
                    -->
                    <a href="<?php echo url('admin/login/toMain'); ?>"><button style="width: 100%" onclick="toMain()" type="button" class="btn btn-default">返回众筹首页</button></a>
                </div>
                <span class="col-sm-2"></span>
            </div>
        </div>

    </form>
</div>
</body>
</html>
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
//

    //登录方法
    $("#login").click(function(){
        var $data = {
            'account':$("#account").val(),
            'pwd':$("#pwd").val(),
            'vali':$("#vali").val()
        };
        $.ajax({
            url:'<?php echo url("index/login/login"); ?>',//ajax访问地址
            data:$data,
            dataType:'json',//接收返回值json格式
            type:'post',
            success:function(res){
                console.log(res);
                if(res.code!=0){
                    alert(res.msg);
                }
                else {

                    alert(res.msg);
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

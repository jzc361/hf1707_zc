<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:74:"D:\AppServ\www\tp505\public/../application/index\view\index\loginView.html";i:1516112883;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge"><!--设置ie内核浏览器下的渲染模式-->
    <meta name="renderer" content="webkit"><!--设置成网页以webkit(极速模式)来渲染页面-->
    <meta name="viewport" content="width=device-width,initial-scale=1"><!--设置网页宽度和访问设备宽度保持一致，且显示比例1:1，-->
    <title>问卷星登录</title>
    <link rel="stylesheet" href="__CSS__/bootstrap.min.css">
    <link rel="stylesheet" href="__CSS__/loginView.css">
    <script src="__JS__/angular.js"></script>
    <script src="__JS__/jquery-2.1.4.js"></script>
    <script src="__JS__/bootstrap.min.js"></script>
</head>
<body>
<div class="container-fluid login_bg">
    <!--<img src="img/loginView/bacg.jpg" class="img-responsive"  alt="图片加载失败">-->
    <div class="row" style="width: 100%;text-align: center ">
        <div class="col-md-3 col-sm-3 col-xs-6">
            <div style="float: left">
                <img src="__STATIC__/img/loginView/logo.png" class="img-responsive"  alt="图片加载失败">
            </div>
        </div>
        <div class="col-xs-6 visible-xs">
            <div style="float: right">
                <button type="button" class="btn btn-default">注册</button>
                <button type="button" class="btn btn-default">返回首页</button>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12"><!--col-xs-pull-3-->
            <form action="<?php echo url('/index/Index/login'); ?>" class="form-horizontal center-block login_form" name="myForm" id="loginForm" method="post" enctype="multipart/form-data">
                <h3 class="login_title">问卷星登录</h3>
                <div>
                    <i class="icon"></i>
                    <input name="account" class="form-control login_input" type="text" placeholder="用户名/Email/手机" value="admin1">
                </div>
                <div>
                    <i class="icon pwd"></i>
                    <input name="password" class="form-control login_input" type="password" placeholder="请输入登录密码" value="123456">
                </div>
                <div class="form-group">
                    <div  class="col-sm-6"><img src="<?php echo captcha_src(); ?>" onclick="this.src='<?php echo captcha_src(); ?>?'+Math.random()" alt="captcha" /></div>
                    <div class="col-sm-6">
                        <input name="code" class="form-control" type="text" placeholder="请输入验证码">
                    </div>
                </div>

                <div style="padding: 10px 45px;overflow: hidden">
                    <label style="float: left">
                        <input type="checkbox">
                        <span>下次自动登录</span>
                    </label>
                    <a href="#" style="float: right">忘记用户名/密码？</a>
                </div>

                <button  class="form-control btn btn-warning login_input no_padding" type="button" id="login">登录</button>
                <div>
                    <a href="" class="a reg">立即注册</a>
                </div>
                <div style="padding: 0 30px">
                    <div class="third-party-txt">
                        <em>第三方登录</em>
                    </div>
                    <div>
                        <a href="" onclick="wxLogin()"><img src="__STATIC__/img/loginView/qq.png" alt=""></a>
                    </div>
                </div>



            </form>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-3 hidden-xs">
            <div style="float: right">
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">注册</button>
                <button type="button" class="btn btn-default" id="toMain">返回首页</button>
            </div>
        </div>

    </div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">注册</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label for="inputAccount" class="col-sm-2 control-label">账号：</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputAccount" placeholder="请输入注册账号" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="col-sm-2 control-label">密码：</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="inputPassword" placeholder="请输入注册密码" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputConfirm" class="col-sm-2 control-label">密码：</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="inputConfirm" placeholder="请输入注册密码" />
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary">注册</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>

</body>

<!--<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>-->
<script>
    var loginUrl="<?php echo url('/index/Index/login'); ?>";
    var personalUrl="<?php echo url('/index/Index/showPersonal'); ?>";
    var mainUrl="<?php echo url('/index/Index/index'); ?>"
</script>
<script src="__JS__/loginView.js"></script>
<script>




//    var appId='wx808322a3b67b476e';
//    var appsecret='f9f72f3a0d265e90a2fd0e48dfe9a09d';
//    var redirectUri=encodeURIComponent('http://www.hf170724.top/wjx/index.php?do=showLoginView&type=Login');
//    console.log(159,redirectUri);

//    function wxLogin(){
//        window.location.href='https://open.weixin.qq.com/connect/oauth2/authorize?appid='+appId+'&redirect_uri='+redirectUri+'&response_type=code&scope=snsapi_userinfo&state=fromwechat#wechat_redirect';
//    }





</script>
</html>
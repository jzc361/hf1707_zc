<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:76:"D:\AppServ\www\hf1707_zc\public/../application/home\view\user\userLogin.html";i:1517639285;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>会员登录</title>
    <link rel="stylesheet" href="__CSS__/bootstrap.min.css">
    <link rel="stylesheet" href="__CSS__/userRegister.css">
    <script src="__JS__/angular.js"></script>
</head>
<body>
    <div class="head_1 z100" id="J_head">
        <div class="head_cont" style="background:#fff">
            <div class="wrap1000 constr clearfix">
                <div class="logo_1 f_l">
                    <a class="link" href="<?php echo url('index/Index'); ?>">首页</a>
                </div>
                <div class="f_yahei no-nav-text">登录</div>
            </div>
        </div>
    </div>

    <div class="my_shadow_bg container">
        <div class="blank"></div>
        <div class="dlmain" style="overflow:hidden">
            <div class="left f_l dlr" style="width:594px;_width:580px">
                <div class="link_dash f25 dlr1">
                    <ul class="nav myLine">
                        <li class="nav_item n_1  c" data="1">
                            用户注册
                        </li>
                    </ul>
                    <span class="f_r" style="font-size:14px;color:#8c8c8c;line-height:14px; margin-top:16px;">还没账号！<a href="showRegister" style="color:#0196db;"> 注册</a> </span>
                </div>
                <div class="item c_1" style="display: block;">
                    <form ng-app="myApp" ng-controller="login" id="user_login_form" name="user_login_form" action="" novalidate>

                        <div class="blank0"></div>
                        <div class="form_row control-group mycontrol-group">
                            <label class="title control-label"><span class="f_red">*</span>会员名称</label>
                            <input type="text" value="" class="textbox" name="user_name" ng-model="user_name" placeholder="请输入会员帐号" ng-blur="checkUser()" required>
                            <div class="tip_box">
                                <span style="color:red" ng-show="user_login_form.user_name.$dirty && user_login_form.user_name.$invalid">
                                    <span ng-show="user_login_form.user_name.$error.required">账号不能为空</span>
                                </span>
                            </div>
                        </div>
                        <div class="blank0"></div>
                        <div class="form_row control-group mycontrol-group">
                            <label class="title control-label"><span class="f_red">*</span>密&emsp;&emsp;码</label>
                            <input type="password" name="user_psd" ng-model="user_psd" class="textbox" placeholder="请输入密码" required>
                            <div class="tip_box">
                                <span style="color:red" ng-show="user_login_form.user_psd.$dirty && user_login_form.user_psd.$invalid">
                                    <span ng-show="user_login_form.user_psd.$error.required">密码不能为空</span>
                                </span>
                            </div>
                        </div>
                        <div class="form_row control-group mycontrol-group">
                            <label class="title control-label"><span class="f_red">*</span>验证码&emsp;</label>
                            <input type="text" name="code" ng-model="code" class="textbox" placeholder="验证码" maxlength="4" required style="width: 20%">
                            <img id="codeimg" src="<?php echo captcha_src(); ?>" alt="captcha" onclick="this.src='<?php echo captcha_src(); ?>?'+Math.random()"/>
                            <div class="tip_box" style="display: inline-block">
                                <span style="color:red" ng-show="user_register_form.code.$dirty">
                                    <span ng-show="user_register_form.code.$error.required">请输入验证码</span>
                                </span>
                            </div>
                        </div>
                        <div class="blank0"></div>
                        <div class="blank0"></div>
                        <div class="blank10"></div>
                        <div class="button_row do_register control-group">
                            <label class="title control-label"></label>
                            <input type="button" value="登录" name="submit_form" class="ui-button theme_bgcolor" id="btn_do_login" ng-click="login()" ng-disabled="user_login_form.$dirty && user_login_form.$invalid ">
                            <input type="hidden" value="1" name="ajax">
                            <div class="blank15"></div>
                        </div>
                    </form>
                </div>
            </div>
            <!--<div class="f_r dl" style="overflow:hidden">
                <div class="dl1">使用其他账号直接登录:</div>
                <div class="dl2">
                    <a href="https://api.weibo.com/oauth2/authorize?client_id=561737744&amp;redirect_uri=http%3A%2F%2Fzc.fanwe.com%2Fapi_callback.php%3Fc%3DSina&amp;response_type=code" title="新浪api登录接口">
                        <img src="http://127.0.0.1:8080/4stage/fangweizhongchouV1.53/public/attachment/201409/28/17/5427dbe4ec8b9.png" alt="新浪api登录接口">
                    </a>&nbsp;
                </div>
                <div class="dl2">
                    <a href="https://open.t.qq.com/cgi-bin/oauth2/authorize?client_id=&amp;redirect_uri=http%3A%2F%2F127.0.0.1%3A8080%2F4stage%2FfangweizhongchouV1.53%2Fapi_callback.php%3Fc%3DTencent&amp;response_type=code" title="腾讯微博登录插件">
                        <img src="http://127.0.0.1:8080/4stage/fangweizhongchouV1.53/public/attachment/201409/28/17/5427dbf38e616.png" alt="腾讯微博登录插件">
                    </a>&nbsp;
                </div>
            </div>-->
            <div class="blank"></div>
        </div>
    </div>
</body>
<script src="__JS__/jquery-2.1.4.js"></script>
<script src="__JS__/bootstrap.min.js"></script>
<script>
    var app=angular.module('myApp',[]);

    app.controller('login',function($scope,$http){
        //登录
        $scope.login=function(){
            $http.post('userLogin',
                    {'username':$scope.user_name,'userpsd':$scope.user_psd,'code':$scope.code}
            ).then(function(res){
                //登录成功--跳转
                if(res.data.code==10001){
                    alert(res.data.msg);
                    localStorage.userMsg=JSON.stringify(res.data.data);
                    location.href="<?php echo url('home/Index/index'); ?>";
//                    location.href='javascript:history.go(-1)';//回到上一页

                } else if(res.data.code==10002) {
                    //验证码错误--刷新验证码
                    alert(res.data.msg);
                    $('#codeimg').attr('src', '<?php echo captcha_src(); ?>?' + Math.random());
                }else {
                    //登录失败
                    alert(res.data.msg);
                    $('#codeimg').attr('src','<?php echo captcha_src(); ?>?'+Math.random());
                }
            });
        }
    });
</script>
</html>
<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:91:"D:\AppServ\www\hf170724_zc\hf1707_zc\public/../application/home\view\user\userRegister.html";i:1517457642;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>会员注册</title>
    <link rel="stylesheet" href="__CSS__/bootstrap.min.css">
    <link rel="stylesheet" href="__CSS__/userRegister.css">
    <script src="__JS__/angular.js"></script>
<!--    <link rel="stylesheet" href="__CSS__/userRegister2.css">-->
</head>
<body>
    <div class="head_1 z100" id="J_head">
        <div class="head_cont" style="background:#fff">
            <div class="wrap1000 constr clearfix">
                <div class="logo_1 f_l">
                    <a class="link" href="<?php echo url('index/Index'); ?>">首页</a>
                </div>
                <div class="f_yahei no-nav-text">注册</div>
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
                    <span class="f_r" style="font-size:14px;color:#8c8c8c;line-height:14px; margin-top:16px;">已是我们的会员！  <a href="showLogin" style="color:#0196db;"> 登录</a> </span>
                </div>
                <div class="item c_1" style="display: block;">
                    <form ng-app="myApp" ng-controller="register" id="user_register_form" name="user_register_form" action="" novalidate>

                        <div class="blank0"></div>
                        <div class="form_row control-group mycontrol-group">
                            <label class="title control-label"><span class="f_red">*</span>会员名称</label>
                            <input type="text" value="" class="textbox" name="user_name" ng-model="user_name" placeholder="请输入会员帐号" required>
                            <div class="tip_box">
                                <span style="color:red" ng-show="user_register_form.user_name.$dirty && user_register_form.user_name.$invalid || checkUser()">
                                    <span ng-show="user_register_form.user_name.$error.required">账号不能为空</span>
                                    <span ng-show="checkUser()">支持数字、字母和"_"组成，5-10个字符</span>
                                </span>
                            </div>
                        </div>
<!--                        <div class="form_row control-group mycontrol-group">
                            <label class="title control-label"><span class="f_red">*</span>电子邮箱</label>
                            <input type="text" class="textbox" name="email" placeholder="请正确输入电子邮箱，可用于密码找回">
                            &lt;!&ndash;<span class="holder_tip">请正确输入电子邮箱，可用于密码找回</span>&ndash;&gt;
                            <div class="tip_box"></div>
                        </div>-->
                        <div class="blank0"></div>
                        <div class="form_row control-group mycontrol-group">
                            <label class="title control-label"><span class="f_red">*</span>创建密码</label>
                            <input type="password" name="user_psd" ng-model="user_psd" class="textbox" placeholder="至少输入6个字符" ng-minlength="6" required>
                            <div class="tip_box">
                                <span style="color:red" ng-show="user_register_form.user_psd.$dirty && user_register_form.user_psd.$invalid">
                                    <span ng-show="user_register_form.user_psd.$error.required">密码不能为空</span>
                                    <span ng-show="user_register_form.user_psd.$error.minlength">密码不能少于6个字符</span>
                                </span>
                            </div>
                        </div>
                        <div class="blank0"></div>
                        <div class="form_row control-group mycontrol-group">
                            <label class="title control-label"><span class="f_red">*</span>确认密码</label>
                            <input type="password" name="user_repsd" ng-model="user_repsd" class="textbox" placeholder="至少输入6个字符" ng-minlength="6" required>
                            <!--<span class="holder_tip">至少输入4个字符</span>-->
                            <div class="tip_box">
                                <span style="color:red" ng-show="user_register_form.user_repsd.$dirty">
                                    <span ng-show="user_register_form.user_repsd.$error.required">不能为空</span>
                                    <span ng-show="user_repsd!=user_psd">两次密码输入不一致</span>
                                </span>
                            </div>
                        </div>
                        <div class="blank0"></div>
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
<!--                        <div class=" form_row control-group mycontrol-group">
                            <label for="signup-mobile control-label" class="title control-label"><span class="f_red">*</span>手机号码</label>
                            <input type="text" value="" class="textbox" id="settings-mobile" name="mobile" size="30" placeholder="请输入手机号码11位">
                            &lt;!&ndash;<span class="holder_tip">请输入手机号码11位</span>&ndash;&gt;
                            <div class="tip_box"></div>
                            <span class="f-input-tip"></span>
                        </div>
                        <div class="blank0"></div>
                        <div class="form_row control-group mycontrol-group">
                            <label for="signup-mobile-code" class="title control-label"><span class="f_red">*</span>手机验证</label>
                            <input type="text" id="settings-mobile-code" name="verify_coder" class="textbox f_l" style="width:50px;margin-right:10px">
                            <input type="button" value="获取验证码" class="send_sms_verify ui-button bg_red f_l" id="J_send_sms_verify" rel="ui-button">
                            <span class="f-input-tip"></span>
                            <div class="tip_box f_l"></div>
                        </div>-->
                        <div class="blank0"></div>
                        <div class="blank10"></div>
                        <div class="button_row do_register control-group">
                            <label class="title control-label"></label>
                            <input type="button" value="注册" name="submit_form" class="ui-button theme_bgcolor" id="btn_do_register" ng-click="register()" ng-disabled="user_register_form.$dirty && user_register_form.$invalid">
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
<!--<script>
    function checkName(){
        var user_name=$(':input[name="user_name"]').val();
        console.log(user_name);
        if(user_name=='')
        {
            username_tips.innerHTML='用户名不能为空';
            username_tips.style.color='red';
        }
        else
        {
            var zz="^[0-9a-zA-Z\_]+$";
            var reg=new RegExp(zz);
            var bool=reg.test(username);
            if(bool==false)
            {
                username_tips.innerHTML='用户名只能由数字、字母和"_"组成';
                username_tips.style.color='red';
            }
        }
    }
</script>-->
<script>
    var app=angular.module('myApp',[]);
    app.controller('register',function($scope,$http){
        //注册
        $scope.register=function(){
            $http.post('userRegister',
                    {'username':$scope.user_name,'userpsd':$scope.user_psd,'code':$scope.code}
            ).then(function(res){
                if(res.data.code==10011){
                    //注册成功
                    alert(res.data.msg);
                    location.href="<?php echo url('home/User/showLogin'); ?>";
                } else if(res.data.code==10002){
                    //验证码错误--刷新验证码
                    alert(res.data.msg);
                    $('#codeimg').attr('src','<?php echo captcha_src(); ?>?'+Math.random());
                }else {
                    alert(res.data.msg);
                    $('#codeimg').attr('src','<?php echo captcha_src(); ?>?'+Math.random());
                }
            });
        };

        //正则验证--用户名
        $scope.checkUser=function(){
            var username=$scope.user_name;
            var zz="[0-9a-zA-Z\_]{5,10}$";
            var reg=new RegExp(zz);
            var bool=reg.test(username);
            return !bool;
        }
    });

</script>
</html>
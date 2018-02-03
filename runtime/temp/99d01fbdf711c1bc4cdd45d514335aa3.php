<<<<<<< HEAD
<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:72:"D:\AppServ\www\hf1707_zc\public/../application/admin\view\chat\chat.html";i:1517136999;}*/ ?>
<!DOCTYPE html>
<html>
  
  <head>
    <meta charset="UTF-8">
    <title>欢迎页面-X-admin2.0</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    
    <link rel="stylesheet" href="__CSS__/admin/font.css">
    <link rel="stylesheet" href="__CSS__/admin/xadmin.css">
    <script type="text/javascript" src="__JS__/admin/jquery.min.js"></script>
    <script type="text/javascript" src="__STATIC__/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="__JS__/admin/xadmin.js"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
      <script src="__JS__/admin/html5.min.js"></script>
      <script src="__JS__/admin/respond.min.js"></script>
    <![endif]-->
  </head>
  
  <body>
    <div class="x-body">
        <form class="layui-form">
          <div class="layui-form-item">
              <label for="username" class="layui-form-label">
                  <span class="x-red">*</span>登录名
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="username" name="username" required="" lay-verify="required"
                  autocomplete="off" class="layui-input">
              </div>
              <div class="layui-form-mid layui-word-aux">
                  <span class="x-red">*</span>将会成为您唯一的登入名
              </div>
          </div>
          <div class="layui-form-item">
              <label for="phone" class="layui-form-label">
                  <span class="x-red">*</span>手机
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="phone" name="phone" required="" lay-verify="phone"
                  autocomplete="off" class="layui-input">
              </div>
              <div class="layui-form-mid layui-word-aux">
                  <span class="x-red">*</span>将会成为您唯一的登入名
              </div>
          </div>
          <div class="layui-form-item">
              <label for="L_email" class="layui-form-label">
                  <span class="x-red">*</span>邮箱
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="L_email" name="email" required="" lay-verify="email"
                  autocomplete="off" class="layui-input">
              </div>
              <div class="layui-form-mid layui-word-aux">
                  <span class="x-red">*</span>
              </div>
          </div>
          <div class="layui-form-item">
              <label class="layui-form-label"><span class="x-red">*</span>角色</label>
              <div class="layui-input-block">
                <input type="checkbox" name="like1[write]" lay-skin="primary" title="超级管理员" checked="">
                <input type="checkbox" name="like1[read]" lay-skin="primary" title="编辑人员">
                <input type="checkbox" name="like1[write]" lay-skin="primary" title="宣传人员" checked="">
              </div>
          </div>
          <div class="layui-form-item">
              <label for="L_pass" class="layui-form-label">
                  <span class="x-red">*</span>密码
              </label>
              <div class="layui-input-inline">
                  <input type="password" id="L_pass" name="pass" required="" lay-verify="pass"
                  autocomplete="off" class="layui-input">
              </div>
              <div class="layui-form-mid layui-word-aux">
                  6到16个字符
              </div>
          </div>
          <div class="layui-form-item">
              <label for="L_repass" class="layui-form-label">
                  <span class="x-red">*</span>确认密码
              </label>
              <div class="layui-input-inline">
                  <input type="password" id="L_repass" name="repass" required="" lay-verify="repass"
                  autocomplete="off" class="layui-input">
              </div>
          </div>
          <div class="layui-form-item">
              <label for="L_repass" class="layui-form-label">
              </label>
              <button  class="layui-btn" lay-filter="add" lay-submit="">
                  增加
              </button>
          </div>
      </form>
    </div>
    <script>
        layui.use(['form','layer'], function(){
            $ = layui.jquery;
          var form = layui.form
          ,layer = layui.layer;
        
          //自定义验证规则
          form.verify({
            nikename: function(value){
              if(value.length < 5){
                return '昵称至少得5个字符啊';
              }
            }
            ,pass: [/(.+){6,12}$/, '密码必须6到12位']
            ,repass: function(value){
                if($('#L_pass').val()!=$('#L_repass').val()){
                    return '两次密码不一致';
                }
            }
          });

          //监听提交
          form.on('submit(add)', function(data){
            console.log(data);
            //发异步，把数据提交给php
            layer.alert("增加成功", {icon: 6},function () {
                // 获得frame索引
                var index = parent.layer.getFrameIndex(window.name);
                //关闭当前frame
                parent.layer.close(index);
            });
            return false;
          });
          
          
        });
    </script>
  </body>

</html>
=======
<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:72:"D:\AppServ\www\hf1707_zc\public/../application/admin\view\chat\chat.html";i:1517584230;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" href="__CSS__/chat.css">
    <link rel="stylesheet" type="text/css" href="__STATIC__/font_Icon/iconfont.css">
</head>
<body>
<div id="myChat" style="left: 400px;"></div>
<!--<div class="chatContainer">-->
    <div id="chatlist" ref="chatBox">
        <!--头部-->
        <div class="chatBox-head">
            <div class="chatBox-head-one">
                <div class="chat-people">
                    <div class="ChatInfoHead">
                        <img id="headimg" src="__STATIC__/img/admin/icon01.png" alt="头像"/>
                    </div>
                    <div id="empname" class="ChatInfoName"></div>
                </div>
            </div>
        </div>
        <!--用户列表-->
        <div class="chatBox-info" style="height: 100%">
            <div class="chatBox-list" ref="chatBoxlist" style="height: 100%">
            </div>
        </div>
    </div>
<!--</div>-->
</body>
<script src="__JS__/jquery-2.1.4.js"></script>
<script>
    var empInfo=<?php echo $empInfo; ?>;
    var empid=empInfo[0]['empid'];
    var empheadimg=empInfo[0]['headimg'];
    var empname=empInfo[0]['empname'];
    $("#headimg").attr("src",'__STATIC__/'+empheadimg+'');
    $("#empname").text(empname);
    var staticUrl='__STATIC__';
</script>
<script src="__JS__/qqface.js"></script>
<script src="__JS__/myChat.js"></script>
<script src="__JS__/admin/connectServer.js"></script>



</html>
>>>>>>> 34ad97babe0adaf2628f386c5232ea510c7e3b79

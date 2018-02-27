<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:78:"D:\AppServ\www\hf1707_zc\public/../application/admin\view\controll\person.html";i:1519440615;}*/ ?>
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
    </head>
    <body>
        <div class="x-body" id="vueData">
            <blockquote style="font-size: 24px" class="layui-elem-quote">欢迎:{{admin.rolename}}</blockquote>
            <fieldset class="layui-elem-field">
              <legend>个人信息</legend>
              <div class="layui-field-box">
                <table class="layui-table" lay-even>
                    <tbody>
                        <tr>
                            <td>ID</td><td>{{admin.empid}}</td>
                        </tr>
                        <tr>
                            <td>昵称</td><td>{{admin.empname}}</td>
                        </tr>
                        <tr>
                            <td>员工</td><td>{{admin.rolename}}</td>
                        </tr>
                        <tr>
                            <td>员工详情</td><td>{{admin.roledetails}}</td>
                        </tr>
                        <tr>
                            <td>员工状态</td><td>{{admin.empstate}}</td>
                        </tr>
                        <tr>
                            <td>登录状态</td><td>{{admin.loginstate}}</td>
                        </tr>
                    </tbody>
                </table>
              </div>
            </fieldset>
            <!--<blockquote class="layui-elem-quote layui-quote-nm"></blockquote>-->
        </div>
    </body>
</html>
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
    if(sessionStorage.getItem('adminInfo').length>0){
        $adminInfo = sessionStorage.getItem('adminInfo');//获取SESSION用户信息
        //假修改的在线状态---------------------------------------------------------------
        $admindata = JSON.parse($adminInfo);
        $admindata.loginstate = '在线';
        //假修改的在线状态---------------------------------------------------------------
        var $vueData = new Vue({
            el:"#vueData",
            data:{
                'admin':$admindata
            },
            created: function () {

            }
        })
    }else {
        window.location.href = "<?php echo url('admin/controll/nologin'); ?>"
    }
</script>
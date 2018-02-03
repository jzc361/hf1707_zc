<<<<<<< HEAD
<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:74:"D:\AppServ\www\hf1707_zc\public/../application/admin\view\login\index.html";i:1517540074;}*/ ?>
=======
<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:74:"D:\AppServ\www\hf1707_zc\public/../application/admin\view\login\index.html";i:1517554623;}*/ ?>
>>>>>>> 34ad97babe0adaf2628f386c5232ea510c7e3b79
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <title>XX众筹管理系统</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="js代码" />
    <meta name="copyright" content="js代码" />
    <!--加载css-->
    <link rel="stylesheet" href="__CSS__/admin/font.css">
	<link rel="stylesheet" href="__CSS__/admin/xadmin.css">

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
</head>

<body>
    <!-- 顶部开始 -->
    <div class="container">
        <div class="logo"><a href="<?php echo url('admin/login/adminMain'); ?>">后台管理系统</a></div>
        <div class="left_open">
            <i title="展开左侧栏" class="iconfont">&#xe699;</i>
        </div>
        <ul class="layui-nav left fast-add" lay-filter="">
          <li class="layui-nav-item">
            <a href="javascript:;">+新增</a>
            <dl class="layui-nav-child"> <!-- 二级菜单 -->
                <!------------------------------------------------------------------------------------------------------------>
              <dd><a onclick="x_admin_show('资讯','<?php echo url('admin/index/index'); ?>')"><i class="iconfont">&#xe6a2;</i>资讯</a></dd>
              <dd><a onclick="x_admin_show('图片','http://www.baidu.com')"><i class="iconfont">&#xe6a8;</i>图片</a></dd>
               <dd><a onclick="x_admin_show('用户','http://www.baidu.com')"><i class="iconfont">&#xe6b8;</i>用户</a></dd>
            </dl>
          </li>
        </ul>
        <ul class="layui-nav right" lay-filter="">
            <li id="role" class="layui-nav-item to-index">

            </li>
            <li class="layui-nav-item">
                <a id="onlineName" href="javascript:;"></a>
                <dl class="layui-nav-child"> <!-- 二级菜单 -->
                    <!--弹框显示个人信息-->
                  <dd><a onclick="x_admin_show('个人信息','<?php echo url('admin/controll/person'); ?>')">个人信息</a></dd>
                    <!--退出事件-->
                  <dd><a onclick="quit()" href="#">切换帐号</a></dd>
                  <dd><a onclick="quit()" href="#">退出</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item to-index"><a href="<?php echo url('admin/login/toMain'); ?>">前台首页</a></li>
        </ul>
    </div>
    <!-- 顶部结束 -->
    <!-- 中部开始 -->
     <!-- 左侧菜单开始 -->
    <div class="left-nav">
      <div id="side-nav">
        <ul id="nav" v-for="menu in menuData">
            <li  v-for="rolemenu in menu" v-if="rolemenu.menufid==0">
                <a href="javascript:;">
                            <!--<i>小图标</i>-->
                            <!--<i class="iconfont">&#xe6b8;</i>-->
                        <cite>{{rolemenu.menuname}}</cite>

                        <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu" v-for="chilemenu in menu" v-if="rolemenu.menuid==chilemenu.menufid">
                    <li v-if="chilemenu.menuid!=10">
                        <a :_href="chilemenu.menuurl">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>{{chilemenu.menuname}}</cite>
                        </a>
                    </li>
                    <li v-if="chilemenu.menuid==10">
                        <a href="javascript:;">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>{{chilemenu.menuname}}</cite>
                            <i class="iconfont nav_right">&#xe697;</i>
                        </a>
                        <ul class="sub-menu" v-for="cchile in menu" v-if="cchile.menufid==10">
                            <li>
                                <a :_href="cchile.menuurl">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>{{cchile.menuname}}</cite>
                                </a>
                            </li >
                        </ul>
                    </li>
                    <!---->
                </ul>
            </li>
        </ul>
      </div>
    </div>
    <div class="page-content">
        <div class="layui-tab tab" lay-filter="xbs_tab" lay-allowclose="false">
            <ul class="layui-tab-title">
                <li>我的桌面</li>
            </ul>
            <div class="layui-tab-content">
                <div class="layui-tab-item layui-show">
                    <iframe src="<?php echo url('admin/controll/person'); ?>" frameborder="0" scrolling="yes" class="x-iframe"></iframe>
                </div>
            </div>
        </div>
    </div>
    <div class="page-content-bg"></div>
    <!--&lt;!&ndash; 右侧主体结束 &ndash;&gt;-->
    <!--&lt;!&ndash; 中部结束 &ndash;&gt;-->
    <!--&lt;!&ndash; 底部开始 &ndash;&gt;-->
    <div class="footer">
        <div class="copyright">Copyright ©2017 All Rights Reserved</div>
    </div>

    <!-- 底部结束 -->
</body>
<!--js加载-->
<script>
    //页面一加载就发送ajax到后台获取当前用户的权限内容

    $.ajax({
        url:'<?php echo url("admin/index/menuctrl"); ?>',//ajax访问地址
        data:'getMenu',
        dataType:'json',//接收返回值json格式
        type:'post',
        //设置同步请求/保证页面样式/效果正常显示/实现
        async: false,
        success:function(res){
            //绑定数据
            $getMenu = [];
//                  //返回数据
            for($i = 0;$i<res.length;$i++){
                $getMenu.push(res[$i]);
            }

//            console.log($getMenu);//检查数据用

            var $menu = new Vue({
                el:"#side-nav",
                data:{
                    'menuData':[$getMenu]
                },
                created: function () {

                }
            })
        }
    });
    //获取JSON格式的数据
    $getAdmin = JSON.parse(sessionStorage.getItem('adminInfo'));

    $('#onlineName').html($getAdmin['empname']);
    $('#role').html($getAdmin['rolename']);

function quit(){
    var $check = confirm('您确定要退出吗？');
    //确认注销
    if ($check==true)
    {
        //sessionStorage.clear('adminInfo');
        $.ajax({
            url: '<?php echo url("admin/controll/quit"); ?>',
            data:[],
            dataType:'json',
            type:'post',
            success:function (res){
                //console.log(res);
                //提示退出情况
                alert(res.msg);
                if(res.code==90011) {
                    //返回登录页面
                    window.location.href = "<?php echo url('admin/index/index'); ?>";
                }
            }
        });
    }
    else //取消退出注销
    {
        window.location.href = "#";
    }
}

    function showPerson(){
        $("#showframe").attr('src',"<?php echo url('admin/controll/person'); ?>");
    }

</script>
</html>
<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:75:"D:\AppServ\www\hf1707_zc\public/../application/home\view\user\userView.html";i:1517816700;s:72:"D:\AppServ\www\hf1707_zc\public/../application/home\view\public\nav.html";i:1519440615;s:75:"D:\AppServ\www\hf1707_zc\public/../application/home\view\public\footer.html";i:1517587242;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge"><!--设置ie内核浏览器下的渲染模式-->
    <meta name="renderer" content="webkit"><!--设置成网页以webkit(极速模式)来渲染页面-->
    <meta name="viewport" content="width=device-width,initial-scale=1"><!--设置网页宽度和访问设备宽度保持一致，且显示比例1:1，-->
    <title>个人中心</title>
    <!--<link rel="stylesheet" href="__CSS__/bootstrap.min.css">-->
    <link rel="stylesheet" href="__CSS__/home/userView.css">
    <!--<script src="__JS__/jquery-2.1.4.js"></script>-->
    <!--<script src="__JS__/bootstrap.min.js"></script>-->
</head>
<body>
<!-- 顶部开始 -->
<!--公共nav-->
<link rel="stylesheet" href="__CSS__/bootstrap.min.css">
<link rel="stylesheet" href="__CSS__/home/goTop.css">
<!--<link rel="stylesheet" href="__CSS__/home/mainView.css">-->
<script src="__JS__/jquery-2.1.4.js"></script>
<script src="__JS__/bootstrap.min.js"></script>

<nav class="navbar navbar-default" style="margin-bottom: 0" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
        </button>
        <a class="navbar-brand my_logo" href="<?php echo url('/home/Index/index'); ?>">众筹网</a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav my_nav">
            <li <?php if(in_array(($do), explode(',',"home/index/index,home/,home/index,index/"))): ?> class="active"<?php endif; ?>><!--||session('current')=='index'-->
            <a href="<?php echo url('home/Index/index'); ?>">首页</a>
            </li>
            <li <?php if($do=='home/project/proindex'): ?> class="active"<?php endif; ?>>
                <a href="<?php echo url('home/Project/proindex'); ?>">更多众筹</a>
            </li>
            <li <?php if($do=='home/project/prolimit'): ?> class="active"<?php endif; ?>>
                <a href="<?php echo url('home/Project/prolimit'); ?>">限时众筹</a>
            </li>
            <?php if(session('?zc_user')): ?>
            <li <?php if(in_array(($do), explode(',',"home/publishpro/jumptoprobasemsg,home/publishpro/jumptoaddreturn"))): ?>  class="active"<?php endif; ?>>
                <a href="<?php echo url('home/Publishpro/jumpToProBaseMsg'); ?>">发起项目</a>
                <!--<a href="#">联系我们</a>-->
            </li>
            <?php endif; ?>
            <!--<li class="dropdown">-->
            <!--<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown<strong class="caret"></strong></a>-->
            <!--<ul class="dropdown-menu">-->
            <!--<li>-->
            <!--<a href="#">Action</a>-->
            <!--</li>-->
            <!--<li>-->
            <!--<a href="#">Another action</a>-->
            <!--</li>-->
            <!--<li>-->
            <!--<a href="#">Something else here</a>-->
            <!--</li>-->
            <!--<li class="divider">-->
            <!--</li>-->
            <!--<li>-->
            <!--<a href="#">Separated link</a>-->
            <!--</li>-->
            <!--<li class="divider">-->
            <!--</li>-->
            <!--<li>-->
            <!--<a href="#">One more separated link</a>-->
            <!--</li>-->
            <!--</ul>-->
            <!--</li>-->
        </ul>
        <form class="navbar-form navbar-left" id="my_search" action="<?php echo url('project/proindex'); ?>" role="search" method="get">
            <div class="form-group">
                <input type="text" class="form-control" name="search" />
            </div> <button type="submit" class="btn btn-default">搜索</button>
        </form>
        <ul class="nav navbar-nav navbar-right">
            <?php if(!session('?zc_user')): ?>
            <li>
            <a href="<?php echo url('home/User/showLogin'); ?>"><span class="glyphicon glyphicon-log-in"></span> 登录</a>
            </li>
            <li>
            <a href="<?php echo url('home/User/showRegister'); ?>"><span class="glyphicon glyphicon-user"></span> 注册</a>
            </li>
            <?php else: ?>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo session('zc_user')['username'] ?><strong class="caret"></strong></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="<?php echo url('home/User/user'); ?>">个人设置</a>
                    </li>
                    <li>
                        <a href="<?php echo url('home/User/user'); ?>">项目管理(用户)</a>
                    </li>
                    <li>
                        <a href="<?php echo url('home/User/test'); ?>">查看通知(测试)</a>
                    </li>
                    <li>
                        <a href="<?php echo url('home/Letter/letter'); ?>">查看私信</a>
                    </li>
                    <li class="divider">
                    </li>
                    <li>
                        <a href="#">Separated link</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0)" onclick="exitLogin()"><span class="glyphicon glyphicon-log-in"></span> 退出</a>
            </li>
            <?php endif; ?>
        </ul>
    </div>

</nav>
<script>
    function exitLogin(){
        if(confirm("确认退出？")){
            if(localStorage.userMsg!=undefined){
                localStorage.removeItem('userMsg');
            }
            location.href="<?php echo url('home/User/exitLogin'); ?>";
        }
    }
</script>
<!-- 顶部结束 -->
<!--中间开始-->
<div class="visible-xs">
    <div class="container" style="padding: 10px 0">
        <div class="row">
            <div class="col-xs-offset-1 col-xs-11" >
                <div style="float: left">
                    <img src="__STATIC__/img/home/userView/noavatar_middle.gif" style="max-width: 55px" class="img-circle img-responsive">
                </div>
                <div style="float: left;margin-left: 10px">
                    <p>aaaa</p>
                    <p>账户余额：￥1000.00</p>
                </div>
            </div>
        </div>
    </div>


</div>
<div class="container ">
    <div class="dlmain Myhomepage"><!-- dlmain Myhomepage-->
        <!-- 左侧菜单开始 -->
        <div  class="col-xs-12 col-sm-2 homeleft pageleft" style="padding: 0"><!--class="homeleft pageleft f_l"-->
            <div class="menutitle">项目管理</div>
            <ul class="homemenulist">
                <li >
                    <a href="javascript:void(0)" mySrc="<?php echo url('/home/User/support'); ?>" >
                        <i></i>支持的项目
                    </a>
                </li>
                <!--<li >-->
                    <!--<a href="/zc4/index.php?ctl=account&act=mine_investor_status" class="a1">-->
                        <!--<i></i>投资的项目-->
                    <!--</a>-->
                <!--</li>-->
                <li >
                    <a href="javascript:void(0)" mySrc="<?php echo url('/home/User/myProject'); ?>" class="a2">
                        <i></i>我的项目
                    </a>
                </li>
                <li >
                    <a href="javascript:void(0)" mySrc="<?php echo url('/home/User/focus'); ?>"  class="a3">
                        <i></i>关注的项目
                    </a>
                </li>
                <!--<li >-->
                    <!--<a href="/zc4/index.php?ctl=account&act=recommend" class="a3">-->
                        <!--<i></i>推荐的项目-->
                    <!--</a>-->
                <!--</li>-->
                <li >
                    <a href="javascript:void(0)" mySrc="<?php echo url('/home/User/money'); ?>">
                        <i></i>资金管理
                    </a>
                </li>
            </ul>
            <div class="menutitle">个人设置</div>
            <ul class="homemenulist">
                <li class="select">
                    <a href="javascript:void(0)" mySrc="<?php echo url('/home/User/settings'); ?>" class="a5">
                        <i></i>资料修改
                    </a>
                </li>
                <li >
                    <a href="javascript:void(0)" mySrc="<?php echo url('/home/User/security'); ?>" class="a12">
                        <i></i>安全信息
                    </a>
                </li>
                <li >
                    <a href="javascript:void(0)" mySrc="<?php echo url('/home/User/address'); ?>" class="a8">
                        <i></i>收件地址管理
                    </a>
                </li>
                <li >
                    <a href="/zc4/index.php?ctl=settings&act=bind" class="a7">
                        <i></i>绑定设置
                    </a>
                </li>

            </ul>
        </div>
        <!-- 左侧菜单结束 -->
        <!-- 右侧主体开始 -->
        <div  class="col-xs-12 col-sm-10 homeright pageright hidden-xs"><!-- class="homeright pageright f_r"-->
            <iframe id="my_iframe" src='./settings.html' frameborder="0" scrolling="no" class="x-iframe"></iframe>
            <div class="blank"></div>
        </div>
        <!-- 右侧主体结束 -->
        <div class="blank"></div>
    </div>
</div>

<!--中间结束-->
<!-- 底部开始 -->
<!--公共footer-->
<link rel="stylesheet" href="__CSS__/home/goTop.css">
<link rel="stylesheet" href="__CSS__/home/mainView.css">
<script src="__JS__/home/gotop.js"></script>
<div>
    <!-- GOTOP -->
    <div>
        <div id="code"></div>
        <div id="code_img"></div>
        <a id="gotop" href="javascript:void(0)"></a>
    </div>
    <!-- GOTOP -->
    <div class="footer">
        <div class="container">
            <div class="col-sm-6">
                <div class="col-xs-3">
                    <p>关于我们</p>
                    <p>联系方式</p>
                    <p>关于我们</p>
                </div>
                <div class="col-xs-3">
                    <p>新手帮助</p>
                    <p>项目规范</p>
                    <p>常见问题</p>
                </div>
                <div class="col-xs-3">
                    <p>我有项目</p>
                    <p>我的项目</p>
                </div>
                <div class="col-xs-3">
                    <p>站点申明</p>
                    <p>版权申明</p>
                    <p>使用条款</p>
                </div>
            </div>
            <div class="col-sm-6"></div>
        </div>
    </div>
</div>
<!-- 底部结束 -->
</body>
<script>
    $homemenulist=$(".homemenulist");
    $(function(){
        $homemenulist.find('a').click(function(){
            $homemenulist.find('li').removeClass('select');
            $(this).parent('li').addClass('select');
            $("#my_iframe").prop('src',$(this).attr('mySrc'));
        });
    });
    $("#my_iframe").load(function () {
        var mainheight = $(this).contents().find("body").height() + 30;
        $(this).height(mainheight);
    });

</script>

</html>
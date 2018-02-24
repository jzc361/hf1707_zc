<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:78:"D:\AppServ\www\hf1707_zc\public/../application/home\view\project\prolimit.html";i:1517812780;s:76:"D:\AppServ\www\hf1707_zc\public/../application/home\view\public\chatDiv.html";i:1517757175;s:72:"D:\AppServ\www\hf1707_zc\public/../application/home\view\public\nav.html";i:1517636030;s:75:"D:\AppServ\www\hf1707_zc\public/../application/home\view\public\footer.html";i:1517587242;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>限时众筹</title>
    <!--<link rel="stylesheet" href="__CSS__/bootstrap.min.css">-->
    <link rel="stylesheet" href="__CSS__/project.css">
</head>
<body style="background: #f9f9f9;">
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="__CSS__/zzsc.css">
    <link rel="stylesheet" type="text/css" href="__CSS__/chat.css">
    <link rel="stylesheet" type="text/css" href="__STATIC__/font_Icon/iconfont.css">
</head>
<body>
<div id="myChat" style="left: 200px;"></div>
<div id="hisShow" class="contentR">
    <div id="hisContent"></div>
    <div id="page"></div>
</div>
<div>
    <div style="z-index: 10000000" class="qqserver" id="service" @click="getService">
        <div class="qqserver_fold" >
            <div></div>
        </div>
        <div class="qqserver-body" style="display: block;">
            <div class="qqserver-header" >
                <div></div>
                <!--<a href="<?php echo url('home/Publishpro/getServiceMsg'); ?>" ></a>-->
                <span class="qqserver_arrow" ></span>
            </div>
            <div>
                <ul>
                    <li v-for="x in serviceList" style="cursor: pointer;">
                        <div v-if="x.loginstate=='在线'" style="color: red">
                            <div  @click="showchat(x.empid,x.empname,x.headimg)">
                                <span>{{x.empname}}</span>
                                ({{x.loginstate}})
                                <!--<i>{{x.unreadcount}}</i>-->
                            </div>
                        </div>
                        <div  v-if="x.loginstate=='离线'" style="color: black">
                            <div @click="showchat(x.empid,x.empname,x.headimg)">
                                <span>{{x.empname}}</span>
                                ({{x.loginstate}})
                                <!--<i>{{x.unreadcount}}</i>-->
                            </div>
                        </div>
                        <br>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
</body>
<script src="__JS__/jquery-2.1.4.js"></script>
<script src="__JS__/vue.js"></script>
<script>
   var getServiceMsgUrl = "<?php echo url('home/publishpro/getServiceMsg'); ?>";
   var staticUrl='__STATIC__';
   var getHisUrl = "<?php echo url('admin/Chat/showChat'); ?>";
</script>
<script src="__JS__/qqface.js"></script>
<script src="__JS__/page.js"></script>
<script src="__JS__/myChat.js"></script>
<script src="__JS__/zzsc.js" ></script>
<!--</html>-->
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
<link rel="stylesheet" href="__CSS__/project.css">
<div class="center container">
    <div style="background-color: #fff;margin-bottom: 30px">
        <div class="list sortList">
            <!--分类列表-->
            <!--<span class="col-xs-1">分类：</span>-->
            <ul class="nav nav-pills col-xs-11">
                <!--<li role="presentation" class="active"><a href="prolimit">全部</a></li>-->
                <?php if(is_array($sortList) || $sortList instanceof \think\Collection || $sortList instanceof \think\Paginator): $i = 0; $__LIST__ = $sortList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sort): $mod = ($i % 2 );++$i;?>
                <li role="presentation" class="<?php if(cookie('limit_sortid')==$sort['sortid']): ?>active<?php endif; ?>"><a href="prolimit?sortid=<?php echo $sort['sortid']; ?>" class="<?php echo $sort['sortid']; ?>"><?php echo $sort['sortname']; ?></a></li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
        <div class="list stateList">
            <ul class="nav nav-pills col-xs-4" style="font-size: 12px">
                <li role="presentation" class="<?php if(!cookie('limit_stateid')): ?>active<?php endif; ?>"><a href="prolimit">所有项目</a></li>
                <?php if(is_array($limstaList) || $limstaList instanceof \think\Collection || $limstaList instanceof \think\Paginator): $i = 0; $__LIST__ = $limstaList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$state): $mod = ($i % 2 );++$i;?>
                <li role="presentation" <?php if(cookie('limit_stateid')==$state['limitstateid']): ?>class="active"<?php endif; ?>><a href="prolimit?stateid=<?php echo $state['limitstateid']; if(cookie('limit_sortid')): ?>&sortid=<?php echo $sortid; endif; ?>"><?php echo $state['limitstatename']; ?></a></li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
    </div>
    <div class="showPro">
        <?php if(is_array($pro) || $pro instanceof \think\Collection || $pro instanceof \think\Paginator): $i = 0; $__LIST__ = $pro;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>
        <div class="proList col-sm-2">
            <!--项目图片-->
            <div class="proimg">
                <a href="prodetails?proid=<?php echo $value['projectid']; ?>">
                    <img src="__STATIC__/<?php echo $value['projectimg']; ?>" alt="" class="img-responsive" style="margin: auto">
                </a>
            </div>
            <!--项目名-->
            <div class="proname">
                <h4><a href="prodetails?proid=<?php echo $value['projectid']; ?>"><?php echo $value['projectname']; ?></a></h4>
                <!--显示众筹状态-->
                <div style="display: block">
                    <div>
                        <?php if($value['limitstatename']=='众筹中'): ?><span class="common-sprite">众筹中</span><?php endif; if($value['limitstatename']=='未开始'): ?><span class="common-fail">未开始</span><?php endif; if($value['limitstatename']=='已结束'): ?><span class="common-fail">已结束</span> <?php endif; ?>
                    </div>
                </div>
            </div>
            <!--脚-->
            <div class="intro" style="font-size: 14px">
                <div class="col-sm-3"></div>
                <div class="col-sm-3">
                    <p>￥<?php echo $value['price']; ?></p>
                    <p>支持金额</p>
                </div>
                <div class="col-sm-6">
                    <p><?php echo $value['endtime']; ?></p>
                    <p>结束时间</p>
                </div>
            </div>
        </div>
        <div class="space col-sm-1"></div>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
</div>
<div align="center"><?php echo $pro->render(); ?></div>
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
</body>
<script src="__JS__/jquery-2.1.4.js"></script>
<script src="__JS__/bootstrap.min.js"></script>
</html>
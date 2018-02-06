<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:76:"D:\AppServ\www\hf1707_zc\public/../application/home\view\index\mainView.html";i:1517811472;s:76:"D:\AppServ\www\hf1707_zc\public/../application/home\view\public\chatDiv.html";i:1517757175;s:72:"D:\AppServ\www\hf1707_zc\public/../application/home\view\public\nav.html";i:1517636030;s:75:"D:\AppServ\www\hf1707_zc\public/../application/home\view\public\footer.html";i:1517587242;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge"><!--设置ie内核浏览器下的渲染模式-->
    <meta name="renderer" content="webkit"><!--设置成网页以webkit(极速模式)来渲染页面-->
    <meta name="viewport" content="width=device-width,initial-scale=1"><!--设置网页宽度和访问设备宽度保持一致，且显示比例1:1，-->
    <title>首页</title>
    <!--<link rel="stylesheet" href="__CSS__/bootstrap.min.css">-->
    <link rel="stylesheet" href="__CSS__/home/mainView.css">
    <!--<link href="http://cdn.staticfile.org/twitter-bootstrap/3.0.1/css/bootstrap.min.css" rel="stylesheet">-->
    <!--<link href="__CSS__/bootstrap-combined.min.css" rel="stylesheet">-->
    <!--<script src="__JS__/jquery-2.1.4.js"></script>-->
    <!--<script src="__JS__/bootstrap.min.js"></script>-->

</head>
<body>
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
<div class="row clearfix">
    <div class="col-sm-12 column">
        <div class="banner">
            <div class="carousel slide" id="carousel-127411">
                <ol class="carousel-indicators">
                    <?php if(is_array($adList) || $adList instanceof \think\Collection || $adList instanceof \think\Paginator): $k = 0; $__LIST__ = $adList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?>
                    <li <?php echo !empty($k) && $k==1?"class='active'" : ''; ?>  data-slide-to="<?php echo $k; ?>" data-target="#carousel-127411">
                    </li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </ol>
                <div class="carousel-inner">
                    <?php if(is_array($adList) || $adList instanceof \think\Collection || $adList instanceof \think\Paginator): $k = 0; $__LIST__ = $adList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?>
                    <div class="item <?php echo !empty($k) && $k==1?'active' : ''; ?>">
                        <img alt="" width="100%" src="__STATIC__/<?php echo $vo['adimg']; ?>" />
                        <div class="carousel-caption">
                            <h4>
                                <?php echo $vo['addetails']; ?>
                            </h4>
                            <p>
                                Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.
                            </p>
                        </div>
                    </div>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </div> <a class="left carousel-control" href="#carousel-127411" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a> <a class="right carousel-control" href="#carousel-127411" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="content">
        <div class="sup_content">
            <h3>最新上线</h3>
            <!-- tab标签 -->
            <ul class="nav nav-tabs">
                <li class="active"><a href="#pro1" data-toggle="tab">音乐</a></li>
                <li><a href="#pro2" data-toggle="tab">游戏</a></li>
                <li><a href="#pro3" data-toggle="tab">设计</a></li>
                <li><a href="#pro4" data-toggle="tab">科技</a></li>
                <li><a href="#pro5" data-toggle="tab">影视</a></li>
                <li><a href="#pro6" data-toggle="tab">出版</a></li>
                <li><a href="#pro7" data-toggle="tab">活动</a></li>
            </ul>
            <!-- 每个tab页对应的内容 -->
            <div  class="tab-content">
                <div id="pro1" class="row tab-pane fade in active">
                    <div class="col-sm-8">
                        <img src="__STATIC__/img/home/mainView/pro_1.jpg" class="img-responsive newProject" alt="">
                    </div>
                    <div class="col-sm-4" style="font-size: 16px">
                        <div>
                            <h3>
                                短片电影
                            </h3>
                            <button type="button" class="btn btn-info btn-lg" style="width: 100%;margin: 20px 0">立即支持</button>
                            <p>
                                Yolanda智能体质管理方案，您的家庭健康管理第一站。她由市场价599元的Yo…
                            </p>
                            <p>
                                目标：756天￥3000000
                                <span class="label label-default">筹资失败</span>
                            </p>
                            <div class="progress my_progerss">
                                <div class="progress-bar progress-success" style="width: 60%">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <p>9%</p>
                                    <p>已达</p>
                                </div>
                                <div class="col-xs-4">
                                    <p>299999元</p>
                                    <p>已筹资</p>
                                </div>
                                <div class="col-xs-4">
                                    <p>18/01/10</p>
                                    <p>日期</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pro2"><p>游戏</p></div>
                <div class="tab-pane fade" id="pro3"><p>设计</p></div>
                <div id="pro4" class="tab-pane fade"><p>科技</p></div>
                <div id="pro5" class="tab-pane fade"><p>影视</p></div>
                <div id="pro6" class="tab-pane fade"><p>出版</p></div>
                <div id="pro7" class="tab-pane fade"><p>活动</p></div>
            </div>
        </div>
        <div class="row clearfix my_content">
            <div class="col-sm-12 column">
                <h3>热门众筹</h3>
                <div class="row">
                    <?php if(is_array($hotList) || $hotList instanceof \think\Collection || $hotList instanceof \think\Paginator): $k = 0; $__LIST__ = $hotList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?>
                    <div class="col-sm-6">
                        <a href="<?php echo url('home/Project/prodetails'); ?>?proid=<?php echo $vo['projectid']; ?>">
                            <div class="thumbnail hotList">
                                <img alt="300x200" src="__STATIC__/<?php echo $vo['projectimg']; ?>" />
                                <div class="caption">
                                    <h3>
                                        <?php echo $vo['projectname']; ?>
                                    </h3>
                                    <p>
                                        目标：￥<?php echo $vo['tolamount']; ?> 剩余：<?php echo $vo['resttime']; ?>天
                                        <span class="label label-default <?php echo !empty($vo['statename']) && $vo['statename']=='众筹中'?'label-primary' : ''; ?>"><?php echo $vo['statename']; ?></span>
                                    </p>
                                    <div class="progress my_progerss">
                                        <div class="progress-bar progress-success" style="width: <?php echo $vo['curamount']/$vo['tolamount']*100; ?>%"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <p><?php echo $vo['curamount']/$vo['tolamount']*100; ?>%</p>
                                            <p>已达</p>
                                        </div>
                                        <div class="col-xs-4">
                                            <p><?php echo $vo['curamount']; ?>元</p>
                                            <p>已筹资</p>
                                        </div>
                                        <div class="col-xs-4">
                                            <p><?php echo substr($vo['endtime'],0,10); ?></p>
                                            <p>结束日期</p>
                                        </div>
                                    </div>

                                    <!--<p>-->
                                    <!--<a class="btn btn-primary" href="#">Action</a> <a class="btn" href="#">Action</a>-->
                                    <!--</p>-->
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
                <h3>最新众筹</h3>
                <div class="row">
                    <?php if(is_array($newList) || $newList instanceof \think\Collection || $newList instanceof \think\Paginator): $k = 0; $__LIST__ = $newList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?>
                    <div class="col-md-4 col-sm-6">
                        <a href="<?php echo url('home/Project/prodetails'); ?>?proid=<?php echo $vo['projectid']; ?>">
                            <div class="thumbnail newList">
                                <img alt="300x200" src="__STATIC__/<?php echo $vo['projectimg']; ?>" />
                                <div class="caption">
                                    <h3>
                                        <?php echo $vo['projectname']; ?>
                                    </h3>
                                    <p>
                                        目标：￥<?php echo $vo['tolamount']; ?> 剩余：<?php echo $vo['resttime']; ?>天
                                        <span class="label label-default <?php echo !empty($vo['statename']) && $vo['statename']=='众筹中'?'label-primary' : ''; ?>"><?php echo $vo['statename']; ?></span>
                                    </p>
                                    <div class="progress my_progerss">
                                        <div class="progress-bar progress-success" style="width: <?php echo $vo['curamount']/$vo['tolamount']*100; ?>%"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <p><?php echo $vo['curamount']/$vo['tolamount']*100; ?>%</p>
                                            <p>已达</p>
                                        </div>
                                        <div class="col-xs-4">
                                            <p><?php echo $vo['curamount']; ?>元</p>
                                            <p>已筹资</p>
                                        </div>
                                        <div class="col-xs-4">
                                            <p><?php echo substr($vo['endtime'],0,10); ?></p>
                                            <p>结束日期</p>
                                        </div>
                                    </div>

                                    <!--<p>-->
                                    <!--<a class="btn btn-primary" href="#">Action</a> <a class="btn" href="#">Action</a>-->
                                    <!--</p>-->
                                </div>
                            </div>
                        </a>

                    </div>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
                <h3>即将下架</h3>
                <div class="row">
                    <?php if(is_array($oldList) || $oldList instanceof \think\Collection || $oldList instanceof \think\Paginator): $k = 0; $__LIST__ = $oldList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?>
                    <div class="col-md-4 col-sm-6">
                        <a href="<?php echo url('home/Project/prodetails'); ?>?proid=<?php echo $vo['projectid']; ?>">
                            <div class="thumbnail oldList">
                                <img alt="300x200" src="__STATIC__/<?php echo $vo['projectimg']; ?>" />
                                <div class="caption">
                                    <h3>
                                        <?php echo $vo['projectname']; ?>
                                    </h3>
                                    <p>
                                        目标：￥<?php echo $vo['tolamount']; ?> 剩余：<?php echo $vo['resttime']; ?>天
                                        <span class="label label-default <?php echo !empty($vo['statename']) && $vo['statename']=='众筹中'?'label-primary' : ''; ?>"><?php echo $vo['statename']; ?></span>
                                    </p>
                                    <div class="progress my_progerss">
                                        <div class="progress-bar progress-success" style="width: <?php echo $vo['curamount']/$vo['tolamount']*100; ?>%"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <p><?php echo $vo['curamount']/$vo['tolamount']*100; ?>%</p>
                                            <p>已达</p>
                                        </div>
                                        <div class="col-xs-4">
                                            <p><?php echo $vo['curamount']; ?>元</p>
                                            <p>已筹资</p>
                                        </div>
                                        <div class="col-xs-4">
                                            <p><?php echo substr($vo['endtime'],0,10); ?></p>
                                            <p>结束日期</p>
                                        </div>
                                    </div>

                                    <!--<p>-->
                                    <!--<a class="btn btn-primary" href="#">Action</a> <a class="btn" href="#">Action</a>-->
                                    <!--</p>-->
                                </div>
                            </div>
                        </a>

                    </div>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
                <h3>猜你喜欢</h3>
                <div class="row">
                    <?php if(is_array($hotList) || $hotList instanceof \think\Collection || $hotList instanceof \think\Paginator): $k = 0; $__LIST__ = $hotList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?>
                    <div class="col-md-4 col-sm-6">
                        <a href="<?php echo url('home/Project/prodetails'); ?>?proid=<?php echo $vo['projectid']; ?>">
                            <div class="thumbnail likeList">
                                <img alt="300x200" src="__STATIC__/<?php echo $vo['projectimg']; ?>" />
                                <div class="caption">
                                    <h3>
                                        <?php echo $vo['projectname']; ?>
                                    </h3>
                                    <p>
                                        目标：￥<?php echo $vo['tolamount']; ?> 剩余：<?php echo $vo['resttime']; ?>天
                                        <span class="label label-default <?php echo !empty($vo['statename']) && $vo['statename']=='众筹中'?'label-primary' : ''; ?>"><?php echo $vo['statename']; ?></span>
                                    </p>
                                    <div class="progress my_progerss">
                                        <div class="progress-bar progress-success" style="width: <?php echo $vo['curamount']/$vo['tolamount']*100; ?>%"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <p><?php echo $vo['curamount']/$vo['tolamount']*100; ?>%</p>
                                            <p>已达</p>
                                        </div>
                                        <div class="col-xs-4">
                                            <p><?php echo $vo['curamount']; ?>元</p>
                                            <p>已筹资</p>
                                        </div>
                                        <div class="col-xs-4">
                                            <p><?php echo substr($vo['endtime'],0,10); ?></p>
                                            <p>结束日期</p>
                                        </div>
                                    </div>

                                    <!--<p>-->
                                    <!--<a class="btn btn-primary" href="#">Action</a> <a class="btn" href="#">Action</a>-->
                                    <!--</p>-->
                                </div>
                            </div>
                        </a>

                    </div>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
            </div>
        </div>
        <div class="content_sup">
            <div class="support">
                <div style="text-align: center">
                    <button type="button" class="btn btn-primary btn-lg" onclick='window.location.href="<?php echo url('home/Project/proindex'); ?>"'>查看更多项目</button>
                    <h1>梦想开始的地方</h1>
                    <p>手里有闲钱不知道怎么花，支持这些有趣的项目</p>
                </div>
                <div class="row">
                    <div class="col-sm-9 col-xs-12">
                        <div class="col-xs-3">
                            <div class="mx_1"></div>
                            <h3>我有项目</h3>
                            <p>点击立即发布项目&nbsp;&nbsp;</p>
                        </div>
                        <div class="col-xs-3">
                            <div class="mx_2"></div>
                            <h3>我有项目</h3>
                            <p>点击立即发布项目&nbsp;&nbsp;</p>
                        </div>
                        <div class="col-xs-3">
                            <div class="mx_3"></div>
                            <h3>我有项目</h3>
                            <p>点击立即发布项目&nbsp;&nbsp;</p>
                        </div>
                        <div class="col-xs-3">
                            <div class="mx_4"></div>
                            <h3>我有项目</h3>
                            <p>点击立即发布项目&nbsp;&nbsp;</p>
                        </div>
                    </div>
                    <div class="col-sm-3 col-xs-12">
                        <div class="col-sm-12 col-xs-3 media">
                            <a href="#" class="pull-left"><span class="mxr_1"></span></a>
                            <div class="media-body">
                                <h4 class="media-heading">
                                    项目总数
                                </h4> 32个
                            </div>
                        </div>
                        <div class="col-sm-12 col-xs-3 media">
                            <a href="#" class="pull-left"><span class="mxr_2"></span></a>
                            <div class="media-body">
                                <h4 class="media-heading">
                                    项目总数
                                </h4> 32个
                            </div>
                        </div>
                        <div class="col-sm-12 col-xs-3 media">
                            <a href="#" class="pull-left"><span class="mxr_3"></span></a>
                            <div class="media-body">
                                <h4 class="media-heading">
                                    项目总数
                                </h4> 32个
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--<div id="gotop" style="display: block; z-index: 99;">-->
    <!--<a href="#top"></a>-->
    <!--</div>-->
</div>
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
<script>
    $(function(){

        $(".hotList>img").load(function(){
            console.log(333,$(this).width());
//            $(this).css("height",$(this).width()*0.78);
            $(this).css({"width":$(this).width(),"height":$(this).width()*0.78});
        });
        $(".oldList>img").load(function(){
            console.log(444,$(this).width());
//            $(this).css({"width":'300px',"height":'234px'});
            $(this).css({"width":$(this).width(),"height":$(this).width()*0.78});
        });
        $(".newList>img").load(function(){
            console.log(333,$(this).width());
//            $(this).css("height",$(this).width()*0.78);
            $(this).css({"width":$(this).width(),"height":$(this).width()*0.78});
        });
        $(".likeList>img").load(function(){
            console.log(333,$(this).width());
//            $(this).css("height",$(this).width()*0.78);
            $(this).css({"width":$(this).width(),"height":$(this).width()*0.78});
        });

    })
</script>
</html>
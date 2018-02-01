<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:76:"D:\AppServ\www\hf1707_zc\public/../application/home\view\index\mainView.html";i:1517467003;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge"><!--设置ie内核浏览器下的渲染模式-->
    <meta name="renderer" content="webkit"><!--设置成网页以webkit(极速模式)来渲染页面-->
    <meta name="viewport" content="width=device-width,initial-scale=1"><!--设置网页宽度和访问设备宽度保持一致，且显示比例1:1，-->
    <title>首页</title>
    <link rel="stylesheet" href="__CSS__/bootstrap.min.css">
    <link rel="stylesheet" href="__CSS__/home/goTop.css">
    <link rel="stylesheet" href="__CSS__/home/mainView.css">
    <!--<link href="http://cdn.staticfile.org/twitter-bootstrap/3.0.1/css/bootstrap.min.css" rel="stylesheet">-->
    <!--<link href="__CSS__/bootstrap-combined.min.css" rel="stylesheet">-->
    <script src="__JS__/jquery-2.1.4.js"></script>
    <script src="__JS__/bootstrap.min.js"></script>
    <script src="__JS__/home/gotop.js"></script>
    <!--<link rel="stylesheet" href="__CSS__/bootstrap.min.css">-->
    <!--<link rel="stylesheet" href="http://www.bootcss.com/p/layoutit/css/bootstrap-combined.min.css">-->
    <link href="http://cdn.staticfile.org/twitter-bootstrap/3.0.1/css/bootstrap.min.css" rel="stylesheet">
    <!--<link href="__CSS__/bootstrap-combined.min.css" rel="stylesheet">-->
    <script src="__JS__/jquery-2.1.4.js"></script>
    <script src="__JS__/bootstrap.min.js"></script>
    <style>
        @media (min-width: 980px){
            .my_nav>li {
                line-height: 40px;
                font-size: 16px;
            }
            .my_logo{

                /*height: 40px;*/
                /*line-height: 40px;*/
            }
            .my_content{
                margin: 0 120px;

            }
            .my_progerss{
                height: 12px;
                margin: 10px 0;
            }
        }
        @media (max-width: 979px){
            .my_content{
                margin: 0 80px;

            }
        }

    </style>
</head>
<body>
<!--后台跳转-------------------------------->
<div>
    <a href="<?php echo url('home/ToManager/ToManager'); ?>">
        <input type="button" value="后台登录">
    </a>
</div>
<!--=---------------------------------------------->
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-md-12 column">
            <nav class="navbar navbar-default" role="navigation">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand my_logo" href="#">众筹网</a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav my_nav">
                        <li class="active">
                            <a href="#">首页</a>
                        </li>
                        <li>
                            <a href="<?php echo url('/home/Project/proindex'); ?>">更多众筹</a>
                        </li>
                        <li>
                            <a href="<?php echo url('/home/Publishpro/jumpToProBaseMsg'); ?>">发起项目</a>
                            <!--<a href="#">联系我们</a>-->
                        </li>
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
                    <form class="navbar-form navbar-left" role="search">

                        <div class="form-group">
                            <input type="text" class="form-control" name="search" />
                        </div> <button type="submit" class="btn btn-default">搜索</button>
                    </form>
                    <ul class="nav navbar-nav navbar-right">
                        <!--<li>-->
                            <!--<a href="<?php echo url('/home/Index/index'); ?>"><span class="glyphicon glyphicon-log-in"></span> 登录</a>-->
                        <!--</li>-->
                        <!--<li>-->
                            <!--<a href="<?php echo url('/home/Index/index'); ?>"><span class="glyphicon glyphicon-user"></span> 注册</a>-->
                        <!--</li>-->
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">admin<strong class="caret"></strong></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="<?php echo url('/home/User/user'); ?>">个人设置</a>
                                </li>
                                <li>
                                    <a href="<?php echo url('/home/User/user'); ?>">项目管理(用户)</a>
                                </li>
                                <li>
                                    <a href="<?php echo url('/home/User/test'); ?>">查看通知(测试)</a>
                                </li>
                                <li class="divider">
                                </li>
                                <li>
                                    <a href="#">Separated link</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?php echo url('/home/Index/index'); ?>"><span class="glyphicon glyphicon-log-in"></span> 退出</a>
                        <li>
                            <a href="#">Link</a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown<strong class="caret"></strong></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="#">Action</a>
                                </li>
                                <li>
                                    <a href="#">Another action</a>
                                </li>
                                <li>
                                    <a href="#">Something else here</a>
                                </li>
                                <li class="divider">
                                </li>
                                <li>
                                    <a href="#">Separated link</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>

            </nav>
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
                            <img alt="" width="100%" src="<?php echo $vo['adimg']; ?>" />
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

            <div class="carousel slide" id="carousel-127411">
                <ol class="carousel-indicators">
                    <li class="active" data-slide-to="0" data-target="#carousel-127411">
                    </li>
                    <li data-slide-to="1" data-target="#carousel-127411">
                    </li>
                    <li data-slide-to="2" data-target="#carousel-127411">
                    </li>
                </ol>
                <div class="carousel-inner">
                    <div class="item active">
                        <img alt="" src="http://www.runoob.com/try/bootstrap/layoutit/v3/default2.jpg" />
                        <div class="carousel-caption">
                            <h4>
                                First Thumbnail label
                            </h4>
                            <p>
                                Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.
                            </p>
                        </div>
                    </div>
                    <div class="item">
                        <img alt="" src="http://www.runoob.com/try/bootstrap/layoutit/v3/default1.jpg" />
                        <div class="carousel-caption">
                            <h4>
                                Second Thumbnail label
                            </h4>
                            <p>
                                Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.
                            </p>
                        </div>
                    </div>
                    <div class="item">
                        <img alt="" src="http://www.runoob.com/try/bootstrap/layoutit/v3/default2.jpg" />
                        <div class="carousel-caption">
                            <h4>
                                Third Thumbnail label
                            </h4>
                            <p>
                                Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.
                            </p>
                        </div>
                    </div>
                </div> <a class="left carousel-control" href="#carousel-127411" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a> <a class="right carousel-control" href="#carousel-127411" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
            </div>
        </div>
    </div>
    <div class="row clearfix my_content">
        <div class="col-md-12 column">
            <h3>热门众筹</h3>
            <div class="row">
                <div class="col-md-6">
                    <div class="thumbnail">
                        <img alt="300x200" src="__STATIC__/img/home/mainView/goods1.jpg" />
                        <div class="caption">
                            <h3>
                                短片电影
                            </h3>
                            <p>
                                目标：756天￥3000000
                                <span class="label label-default">筹资失败</span>
                            </p>
                            <div class="progress my_progerss">
                                <div class="progress-bar progress-success">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <p>9%</p>
                                    <p>已达</p>
                                </div>
                                <div class="col-md-4">
                                    <p>299999元</p>
                                    <p>已筹资</p>
                                </div>
                                <div class="col-md-4">
                                    <p>18/01/10</p>
                                    <p>日期</p>
                                </div>
                            </div>

                            <!--<p>-->
                            <!--<a class="btn btn-primary" href="#">Action</a> <a class="btn" href="#">Action</a>-->
                            <!--</p>-->
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="thumbnail">
                        <img alt="300x200" src="__STATIC__/img/home/mainView/goods1.jpg" />
                        <div class="caption">
                            <h3>
                                短片电影
                            </h3>

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
                        <div class="thumbnail">
                            <img alt="300x200" src="<?php echo $vo['projectimg']; ?>" />
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
=======
                                <div class="progress-bar progress-success">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <p>9%</p>
                                    <p>已达</p>
                                </div>
                                <div class="col-md-4">
                                    <p>299999元</p>
                                    <p>已筹资</p>
                                </div>
                                <div class="col-md-4">
                                    <p>18/01/10</p>
                                    <p>日期</p>
                                </div>
                            </div>

                            <!--<p>-->
                            <!--<a class="btn btn-primary" href="#">Action</a> <a class="btn" href="#">Action</a>-->
                            <!--</p>-->
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="thumbnail">
                        <img alt="300x200" src="__STATIC__/img/home/mainView/goods1.jpg" />
                        <div class="caption">
                            <h3>
                                短片电影
                            </h3>
                            <p>
                                目标：756天￥3000000
                                <span class="label label-default">筹资失败</span>
                            </p>
                            <div class="progress my_progerss">
                                <div class="progress-bar progress-success">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <p>9%</p>
                                    <p>已达</p>
                                </div>
                                <div class="col-md-4">
                                    <p>299999元</p>
                                    <p>已筹资</p>
                                </div>
                                <div class="col-md-4">
                                    <p>18/01/10</p>
                                    <p>日期</p>

                                </div>
                            </div>

                            <!--<p>-->
                            <!--<a class="btn btn-primary" href="#">Action</a> <a class="btn" href="#">Action</a>-->
                            <!--</p>-->
                        </div>
                    </div>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </div>

                <h3>最新众筹</h3>
                <div class="row">
                    <?php if(is_array($newList) || $newList instanceof \think\Collection || $newList instanceof \think\Paginator): $k = 0; $__LIST__ = $newList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?>
                    <div class="col-md-4 col-sm-6">
                        <div class="thumbnail">
                            <img alt="300x200" src="<?php echo $vo['projectimg']; ?>" />
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

                <div class="col-md-6">
                    <div class="thumbnail">
                        <img alt="300x200" src="__STATIC__/img/home/mainView/goods1.jpg" />
                        <div class="caption">
                            <h3>
                                短片电影
                            </h3>
                            <p>
                                目标：756天￥3000000
                                <span class="label label-default">筹资失败</span>
                            </p>
                            <div class="progress my_progerss">
                                <div class="progress-bar progress-success">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <p>9%</p>
                                    <p>已达</p>
                                </div>
                                <div class="col-md-4">
                                    <p>299999元</p>
                                    <p>已筹资</p>
                                </div>
                                <div class="col-md-4">
                                    <p>18/01/10</p>
                                    <p>日期</p>

                                </div>
                            </div>

                            <!--<p>-->
                            <!--<a class="btn btn-primary" href="#">Action</a> <a class="btn" href="#">Action</a>-->
                            <!--</p>-->
                        </div>
                    </div>

                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
                <h3>即将下架</h3>
                <div class="row">
                    <?php if(is_array($oldList) || $oldList instanceof \think\Collection || $oldList instanceof \think\Paginator): $k = 0; $__LIST__ = $oldList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?>
                    <div class="col-md-4 col-sm-6">
                        <div class="thumbnail">
                            <img alt="300x200" src="<?php echo $vo['projectimg']; ?>" />
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
            </div>
            <h3>最新众筹</h3>
            <div class="row">
                <div class="col-md-4">
                    <div class="thumbnail">
                        <img alt="300x200" src="__STATIC__/img/home/mainView/goods1.jpg" />
                        <div class="caption">
                            <h3>
                                短片电影
                            </h3>
                            <p>
                                目标：756天￥3000000
                                <span class="label label-default">筹资失败</span>
                            </p>
                            <div class="progress my_progerss">
                                <div class="progress-bar progress-success">

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <p>9%</p>
                                    <p>已达</p>
                                </div>
                                <div class="col-md-4">
                                    <p>299999元</p>
                                    <p>已筹资</p>
                                </div>
                                <div class="col-md-4">
                                    <p>18/01/10</p>
                                    <p>日期</p>
                                </div>
                            </div>

                            <!--<p>-->
                            <!--<a class="btn btn-primary" href="#">Action</a> <a class="btn" href="#">Action</a>-->
                            <!--</p>-->
                        </div>
                    </div>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </div>

                <h3>猜你喜欢</h3>
                <div class="row">
                    <?php if(is_array($hotList) || $hotList instanceof \think\Collection || $hotList instanceof \think\Paginator): $k = 0; $__LIST__ = $hotList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?>
                    <div class="col-md-4 col-sm-6">
                        <div class="thumbnail">
                            <img alt="300x200" src="<?php echo $vo['projectimg']; ?>" />
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

                <div class="col-md-4">
                    <div class="thumbnail">
                        <img alt="300x200" src="__STATIC__/img/home/mainView/goods1.jpg" />
                        <div class="caption">
                            <h3>
                                短片电影
                            </h3>
                            <p>
                                目标：756天￥3000000
                                <span class="label label-default">筹资失败</span>
                            </p>
                            <div class="progress my_progerss">
                                <div class="progress-bar progress-success">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <p>9%</p>
                                    <p>已达</p>
                                </div>
                                <div class="col-md-4">
                                    <p>299999元</p>
                                    <p>已筹资</p>
                                </div>
                                <div class="col-md-4">
                                    <p>18/01/10</p>
                                    <p>日期</p>
                                </div>
                            </div>

                            <!--<p>-->
                            <!--<a class="btn btn-primary" href="#">Action</a> <a class="btn" href="#">Action</a>-->
                            <!--</p>-->
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="thumbnail">
                        <img alt="300x200" src="__STATIC__/img/home/mainView/goods1.jpg" />
                        <div class="caption">
                            <h3>
                                短片电影
                            </h3>
                            <p>
                                目标：756天￥3000000
                                <span class="label label-default">筹资失败</span>
                            </p>
                            <div class="progress my_progerss">
                                <div class="progress-bar progress-success">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <p>9%</p>
                                    <p>已达</p>
                                </div>
                                <div class="col-md-4">
                                    <p>299999元</p>
                                    <p>已筹资</p>
                                </div>
                                <div class="col-md-4">
                                    <p>18/01/10</p>
                                    <p>日期</p>

                                </div>
                            </div>

                            <!--<p>-->
                            <!--<a class="btn btn-primary" href="#">Action</a> <a class="btn" href="#">Action</a>-->
                            <!--</p>-->
                        </div>
                    </div>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
            </div>

        </div>
        <div class="content_sup">
            <div class="support">
                <div style="text-align: center">
                    <button type="button" class="btn btn-primary btn-lg">查看更多项目</button>
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

            <h3>猜你喜欢</h3>
            <div class="row">
                <div class="col-md-4">
                    <div class="thumbnail">
                        <img alt="300x200" src="__STATIC__/img/home/mainView/goods1.jpg" />
                        <div class="caption">
                            <h3>
                                短片电影
                            </h3>
                            <p>
                                目标：756天￥3000000
                                <span class="label label-default">筹资失败</span>
                            </p>
                            <div class="progress my_progerss">
                                <div class="progress-bar progress-success">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <p>9%</p>
                                    <p>已达</p>
                                </div>
                                <div class="col-md-4">
                                    <p>299999元</p>
                                    <p>已筹资</p>
                                </div>
                                <div class="col-md-4">
                                    <p>18/01/10</p>
                                    <p>日期</p>
                                </div>
                            </div>

                            <!--<p>-->
                            <!--<a class="btn btn-primary" href="#">Action</a> <a class="btn" href="#">Action</a>-->
                            <!--</p>-->
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="thumbnail">
                        <img alt="300x200" src="__STATIC__/img/home/mainView/goods1.jpg" />
                        <div class="caption">
                            <h3>
                                短片电影
                            </h3>
                            <p>
                                目标：756天￥3000000
                                <span class="label label-default">筹资失败</span>
                            </p>
                            <div class="progress my_progerss">
                                <div class="progress-bar progress-success">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <p>9%</p>
                                    <p>已达</p>
                                </div>
                                <div class="col-md-4">
                                    <p>299999元</p>
                                    <p>已筹资</p>
                                </div>
                                <div class="col-md-4">
                                    <p>18/01/10</p>
                                    <p>日期</p>
                                </div>

                            </div>

                            <!--<p>-->
                            <!--<a class="btn btn-primary" href="#">Action</a> <a class="btn" href="#">Action</a>-->
                            <!--</p>-->
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
                <div class="col-md-4">
                    <div class="thumbnail">
                        <img alt="300x200" src="__STATIC__/img/home/mainView/goods1.jpg" />
                        <div class="caption">
                            <h3>
                                短片电影
                            </h3>
                            <p>
                                目标：756天￥3000000
                                <span class="label label-default">筹资失败</span>
                            </p>
                            <div class="progress my_progerss">
                                <div class="progress-bar progress-success">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <p>9%</p>
                                    <p>已达</p>
                                </div>
                                <div class="col-md-4">
                                    <p>299999元</p>
                                    <p>已筹资</p>
                                </div>
                                <div class="col-md-4">
                                    <p>18/01/10</p>
                                    <p>日期</p>
                                </div>
                            </div>

                            <!--<p>-->
                            <!--<a class="btn btn-primary" href="#">Action</a> <a class="btn" href="#">Action</a>-->
                            <!--</p>-->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- GOTOP -->
    <div>
        <div id="code"></div>
        <div id="code_img"></div>
        <a id="gotop" href="javascript:void(0)"></a>
    </div>
    <!-- GOTOP -->
    <!--<div id="gotop" style="display: block; z-index: 99;">-->
        <!--<a href="#top"></a>-->
    <!--</div>-->
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

</div>

</body>

<script>

</script>

</html>
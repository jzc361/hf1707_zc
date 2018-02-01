<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:78:"D:\AppServ\www\hf1707_zc\public/../application/home\view\project\prolimit.html";i:1517447918;s:72:"D:\AppServ\www\hf1707_zc\public/../application/home\view\public\nav.html";i:1517447918;s:75:"D:\AppServ\www\hf1707_zc\public/../application/home\view\public\footer.html";i:1517371150;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>限时众筹</title>
    <link rel="stylesheet" href="__CSS__/bootstrap.min.css">
    <link rel="stylesheet" href="__CSS__/project.css">
    <!--<style>
        .center{
            margin-top: 30px;
            /*height: 1420px;*/
        }
        .sortList{
            width: 100%;
            overflow: hidden;
            padding: 5px;
            background-color: #fff;
        }
        .sortList a{
            cursor: pointer;
        }
        .stateList{
            width: 100%;
            margin: 20px 5px 40px;
            height: 37px;
        }
        .proList{
            /*width: 21%;*/
            background-color: #fff;
            margin: 0 5px 20px;
        }
        .proList>div{
            margin: 15px 0;
        }
        .proimg img{
            transition: all 0.5s;
        }
        .proimg img:hover{
            transform: scale(1.03);
        }
        .intro{
            margin: 0;
            font-size: 12px;
        }
        .container-fluid{
            padding: 0;
        }
        @media (min-width: 992px) {
            .proList{
                width: 21%;
            }
            .space{
                width: 1%;
            }
            .intro{
                font-size: 12px;
            }
        }
        @media (min-width: 768px) {
            .proList{
                width: 46%;
            }
            .space{
                width: 1%;
            }
            .intro{
                font-size: 12px;
            }
        }
    </style>-->
</head>
<body style="background: #f9f9f9;">
<!--公共nav-->
<!--<link rel="stylesheet" href="__CSS__/bootstrap.min.css">-->
<link rel="stylesheet" href="__CSS__/home/goTop.css">
<link rel="stylesheet" href="__CSS__/home/mainView.css">
<!--<script src="__JS__/jquery-2.1.4.js"></script>-->
<!--<script src="__JS__/bootstrap.min.js"></script>-->

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
            <li <?php if(!session('?current')): ?> class="active"<?php endif; ?>><!--||session('current')=='index'-->
                <a href="<?php echo url('/home/Index/index'); ?>">首页</a>
            </li>
            <li <?php if(session('current')=='proindex'): ?> class="active"<?php endif; ?>>
                <a href="<?php echo url('/home/Project/proindex'); ?>">更多众筹</a>
            </li>
            <li>
                <a href="<?php echo url('/home/Project/prolimit'); ?>">限时众筹</a>
            </li>
            <li <?php if(session('current')=='proBaseMsg'): ?> class="active"<?php endif; ?>>
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
            </li>
        </ul>
    </div>

</nav>
<div class="center container">
    <div style="background-color: #fff;margin-bottom: 30px">
        <div class="list sortList">
            <!--分类列表-->
            <ul class="nav nav-pills">
                <li role="presentation" class="active"><a href="proindex">全部</a></li>
                <?php if(is_array($sortList) || $sortList instanceof \think\Collection || $sortList instanceof \think\Paginator): $i = 0; $__LIST__ = $sortList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sort): $mod = ($i % 2 );++$i;?>
                <li role="presentation" class="<?php if(cookie('pro_sortid')==$sort['sortid']): ?>active<?php endif; ?>"><a href="proindex?sortid=<?php echo $sort['sortid']; if(cookie('pro_search')): ?>&search=<?php echo $search; endif; ?>" class="<?php echo $sort['sortid']; ?>"><?php echo $sort['sortname']; ?></a></li>
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
                    <img src="<?php echo $value['projectimg']; ?>" alt="" class="img-responsive" style="margin: auto">
                </a>
            </div>
            <!--项目名-->
            <div class="proname">
                <h4><a href="prodetails?proid=<?php echo $value['projectid']; ?>"><?php echo $value['projectname']; ?></a></h4>
            </div>
            <!--脚-->
            <div class="intro">

                <div class="col-sm-3">
                    <p><?php echo $value['curamount']; ?></p>
                    <p>已筹集</p>
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

<div class="">
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
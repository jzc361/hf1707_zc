<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:90:"D:\AppServ\www\hf170724_zc\hf1707_zc\public/../application/home\view\project\proindex.html";i:1517707187;s:84:"D:\AppServ\www\hf170724_zc\hf1707_zc\public/../application/home\view\public\nav.html";i:1517885691;s:87:"D:\AppServ\www\hf170724_zc\hf1707_zc\public/../application/home\view\public\footer.html";i:1517462875;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>产品项目</title>
    <!--<link rel="stylesheet" href="__CSS__/bootstrap.min.css">-->
    <!--<link rel="stylesheet" href="__CSS__/project.css">-->
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
            location.href="<?php echo url('home/User/exitLogin'); ?>";
        }
    }
</script>
<link rel="stylesheet" href="__CSS__/project.css">
<div class="center container">
    <div class="list" style="background-color: #fff">
        <div style="background-color: #fff">
            <div class="list sortList">
                <!--分类列表-->
                <ul class="nav nav-pills">
                    <?php if(is_array($sortList) || $sortList instanceof \think\Collection || $sortList instanceof \think\Paginator): $i = 0; $__LIST__ = $sortList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sort): $mod = ($i % 2 );++$i;?>
                    <li role="presentation" class="<?php if(cookie('pro_sortid')==$sort['sortid']): ?>active<?php endif; ?>"><a href="proindex?sortid=<?php echo $sort['sortid']; if(cookie('pro_search')): ?>&search=<?php echo $search; endif; ?>" class="<?php echo $sort['sortid']; ?>"><?php echo $sort['sortname']; ?></a></li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
            <div class="list stateList">
                <!--<div class="col-sm-7"></div>-->
                <!--状态列表-->
                <ul class="nav nav-pills col-xs-4" style="font-size: 12px">
                    <li role="presentation" class="<?php if(!cookie('pro_stateid')): ?>active<?php endif; ?>"><a href="proindex">所有项目(<?php echo $pronum; ?>)</a></li>
                    <?php if(is_array($stateList) || $stateList instanceof \think\Collection || $stateList instanceof \think\Paginator): $i = 0; $__LIST__ = $stateList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$state): $mod = ($i % 2 );++$i;?>
                    <li role="presentation" class="<?php if(cookie('pro_stateid')==$state['stateid']): ?>active<?php endif; ?>"><a href="proindex?stateid=<?php echo $state['stateid']; if(cookie('pro_sortid')): ?>&sortid=<?php echo $sortid; endif; if(cookie('pro_search')): ?>&search=<?php echo $search; endif; ?>"><?php echo $state['statename']; ?></a></li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
                <div class="col-xs-6"></div>
                <div class="col-xs-2">
                    <span>排序</span>
                    <select name="order" onchange="window.location=this.value">
                        <option value="proindex?sortid=<?php echo $sortid; ?>&stateid=<?php echo $stateid; ?>" <?php if(!cookie('order')): ?>echo selected<?php endif; ?>>请选择</option>
                        <option value="proindex?order=1&sortid=<?php echo $sortid; ?>&stateid=<?php echo $stateid; ?>" <?php if(cookie('order')==1): ?>echo selected<?php endif; ?>>热度</option>
                        <option value="proindex?order=2&sortid=<?php echo $sortid; ?>&stateid=<?php echo $stateid; ?>" <?php if(cookie('order')==2): ?>echo selected<?php endif; ?>>最新上线</option>
                        <option value="proindex?order=3&sortid=<?php echo $sortid; ?>&stateid=<?php echo $stateid; ?>" <?php if(cookie('order')==3): ?>echo selected<?php endif; ?>>金额最多</option>
                        <!--<option value="proindex?order=4&sortid=<?php echo $sortid; ?>" <?php if(cookie('order')==4): ?>echo selected<?php endif; ?>>支持最多</option>-->
                    </select>
                </div>
            </div>
        </div>

        <div class="showPro">
            <!--项目不存在-->
            <?php if(!$pro): ?>
            <div class="searchNull">无查询结果</div>
            <?php else: if(is_array($pro) || $pro instanceof \think\Collection || $pro instanceof \think\Paginator): $i = 0; $__LIST__ = $pro;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>
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
                </div>
                <!--目标-->
                <div>
                    <span>目标：<?php echo $value['daysnumber']; ?>天</span>
                    <span>￥<?php echo $value['tolamount']; ?></span>
                    <!--显示众筹状态-->
                    <div style="float: right">
                        <?php if($value['stateid']==5): ?><span class="common-sprite">众筹中</span><?php endif; if($value['stateid']==6): ?><span class="common-success">众筹成功</span><?php endif; if($value['stateid']==7): ?><span class="common-fail">众筹失败</span> <?php endif; ?>
                    </div>
                </div>
                <div class="progress progress-striped active" style="width: 85%">
                    <div class="progress-bar progress-bar-success" role="progressbar"aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $value['curamount']/$value['tolamount']*100; ?>%;">
                        <span class="sr-only"><?php echo $value['curamount']/$value['tolamount']*100; ?>%完成</span>
                    </div>
                </div>
                <!--脚-->
                <div class="intro">
                    <div class="col-xs-3">
                        <p><?php echo $value['curamount']/$value['tolamount']*100; ?>%</p>
                        <p>已达</p>
                    </div>
                    <div class="col-sm-3">
                        <p><?php echo $value['curamount']; ?></p>
                        <p>已筹集</p>
                    </div>
                    <div class="col-sm-6">
                        <p><?php echo substr($value['endtime'],0,10); ?></p>
                        <p>结束时间</p>
                    </div>
                </div>
            </div>
            <div class="space col-sm-1"></div>
            <?php endforeach; endif; else: echo "" ;endif; ?>

        </div>
    </div>
</div>
<div align="center"><?php echo $pro->render(); ?></div>
<?php endif; ?>
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
<!--<script src="__JS__/jquery-2.1.4.js"></script>-->
<!--<script src="__JS__/bootstrap.min.js"></script>-->
<script>
    //console.log($(".footer").height);
    $(window).on("load resize",function(){
        //var w=window.innerWidth||document.body.clientWidth||document.documentElement.clientWidth;
        var h=window.innerHeight||document.body.clientHeight||document.documentElement.clientHeight;

        //$(".footer").css("width",w);
        $(".searchNull").css("height",h-$(".nav").height()-$(".footer").height()-$(".list").height());
    });
    //分类
    /*    $('.sortList').find('li').click(function(){
     $('.sortList').find('li').attr('class','');
     $(this).attr('class','active');
     });

     //状态
     $('.stateList').find('li').click(function(){
     $('.stateList').find('li').attr('class','');
     $(this).attr('class','active');
     });*/

    /*    function order(){
     var order=$('#order option:selected').val();
     console.log(order);
     $('#order').href=order;
     /!*$.ajax({
     url:'proindex',
     data:{order:order},
     success:function(res){
     //location.href="proindex?order="+order;
     }
     });*!/
     }*/
</script>
</html>
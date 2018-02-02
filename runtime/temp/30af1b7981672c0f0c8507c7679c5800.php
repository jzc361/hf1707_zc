<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:92:"D:\AppServ\www\hf170724_zc\hf1707_zc\public/../application/home\view\project\prodetails.html";i:1517467836;s:84:"D:\AppServ\www\hf170724_zc\hf1707_zc\public/../application/home\view\public\nav.html";i:1517471035;s:87:"D:\AppServ\www\hf170724_zc\hf1707_zc\public/../application/home\view\public\footer.html";i:1517462875;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $pro['projectname']; ?></title>
    <link rel="stylesheet" href="__CSS__/layui.css">
    <link rel="stylesheet" href="__CSS__/layer.css">
    <!--<link rel="stylesheet" href="__STATIC__/layui/css/layui.css">-->
    <!--<link rel="stylesheet" href="__CSS__/bootstrap.min.css">-->
    <link rel="stylesheet" href="__CSS__/project.css">
    <style>
        .center{
            margin: 50px auto;
            /*width: 1200px;*/
        }
        .showpro{
            /*width: 1200px;*/
            padding: 20px 0 20px 20px;
            margin-bottom: 30px;
            background-color: #fff;
        }
        .showpro>img{
            width: 70%;
        }
        .pro_introduce{
            float: right;
            width: 25%;
            /*height: 398px;*/
        }
        .pro-title{
            font-size: 24px;
            height: 42px;
            line-height: 42px;
            overflow: hidden;
        }
        .details-left{
            float: left;
            width: 70%;
            /*height: 500px;*/
            padding-bottom: 20px;
            background-color: #fff;
        }
        .details-ls{
            margin: 20px 20px;
            /*height: 60px;
            border-bottom: 1px solid #e6e6e6;*/
        }
        .details-con{
            width: 100%;
            margin: 0 20px;
        }
        /*.d-ls{
            font-size: 18px;
        }*/
        .d-ls>a{
            text-align: center;
        }
        .details-right{
            float: right;
            width: 25%;
        }
        .initiator{
            padding: 0 20px 20px;
            background: #fff;
            border: 1px solid #f2f2f2;
            box-shadow: 0 0 40px rgba(216,216,216,.5);
        }
        .title{
            height: 57px;
            color: #323232;
            font-size: 18px;
            line-height: 56px;
            border-bottom: 1px solid #e6e6e6;
        }
        .initiator-con{
            margin-top: 18px;
        }
        .initiator-con>div{
            display: inline-block;
        }
        .initiator-peo{
            width: 65%;
            float: right;
        }
        #intro img{
            width: 80%;;
        }
        .grade{
            padding: 0 20px;
            background: #fff;
            margin-top: 20px;
            border: 1px solid #f2f2f2;
            box-shadow: 0 0 40px rgba(216,216,216,.5);
        }
        .grade-con{
            border-top: 1px solid #e6e6e6;
            width: 100%;
            display: block;
        }
        .grade-price{
            float: left;
            font-size: 16px;
            color: #323232;
        }
        .grade-people{
            float: right;
            font-size: 14px;
            cursor: pointer;
            color: #5e5e5e;
        }
        .grade-limit{
            height: 50px;
            font-size: 14px;
            font-weight: 700;
            color: #323232;
            margin-top: 20px;
        }
        .grade-intro{
            font-size: 14px;
            line-height: 22px;
        }
        .grade-img{
            overflow: hidden;
            padding-bottom: 10px;
        }
        .grade-btn{
            padding: 15px 0 30px;
        }
        .grade-btn>button{
            /*background: #2fd6a2;*/
            color: #fff;
            padding: 0 30px;
            font-size: 18px;
            height: 40px;
            border-radius: 4px;
        }
        @media (min-width: 768px) {
            .pro-title{
                font-size: 24px;
                height: 42px;
                line-height: 42px;
                overflow: hidden;
            }
            .pro-have{
                font-size: 16px;
                height: 24px;
                line-height: 24px;
                overflow: hidden;
            }
            .pro-amount{
                font-size: 48px;
                height: 60px;
                line-height: 60px;
                overflow: hidden;
            }
            .d-ls{
                font-size: 18px;
            }
        }
        @media (max-width: 767px) {
            .pro_introduce>p{
                margin: 0;
            }
            .pro-title{
                font-size: 18px;
                height: 28px;
                line-height: 28px;
                overflow: hidden;
            }
            .pro-have{
                font-size: 12px;
                height: 16px;
                line-height: 16px;
                overflow: hidden;
            }
            .pro-amount{
                font-size: 30px;
                height: 30px;
                line-height: 30px;
                overflow: hidden;
            }
            .d-ls{
                font-size: 14px;
            }
        }

    </style>
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
    <div class="center container">
        <div class="showpro">
            <img src="<?php echo $pro['projectimg']; ?>" alt="" style="display: inline-block" class="img-responsive">
            <div class="pro_introduce">
                <p class="pro-title"><?php echo $pro['projectname']; ?></p>
                <p class="pro-have">已筹到</p>
                <p class="pro-amount"><span style="font-size: 24px">￥</span><?php echo $pro['curamount']; ?></p>
                <?php if($pro['projecttype']=="普通众筹"): ?>
                <div class="progress progress-striped active" style="width: 85%">
                    <div class="progress-bar progress-bar-success" role="progressbar"aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $pro['curamount']/$pro['tolamount']*100; ?>%;">
                        <span class="sr-only"><?php echo $pro['curamount']/$pro['tolamount']*100; ?>% 完成</span>
                    </div>
                </div>
                <p>当前进度：<?php echo $pro['curamount']/$pro['tolamount']*100; ?>%</p>
                <p>目标：￥<?php echo $pro['tolamount']; ?></p>
                <?php endif; ?>
                <p>截止时间：<?php echo $pro['endtime']; ?></p>
                <p class="state">
                    <?php if($pro['stateid']==5): ?><span class="common-sprite">众筹中</span><?php endif; if($pro['stateid']==6): ?><span class="common-success">众筹成功</span><?php endif; if($pro['stateid']==7): ?><span class="common-fail">众筹失败</span> <?php endif; ?>
                </p>
                <button type="button" style="width: 85%" class="btn btn-info" onclick="profocus(<?php echo $pro['projectid']; ?>)">关注(<?php echo $pro['focuscount']; ?>)</button>
                <?php if($pro['projecttype']=="限时众筹"): ?>
                <button type="button" style="width: 85%;margin-top: 5%" class="btn btn-info" onclick="">立即支持</button>
                <?php endif; ?>
            </div>
        </div>
        <div class="showdetails">
            <div class="details-left">
                <ul class="nav nav-tabs details-ls" role="tablist">
                    <li role="presentation" class="active d-ls col-sm-3"><a href="#intro" aria-controls="intro" role="tab" data-toggle="tab">项目简介</a></li>
                    <li role="presentation" class="d-ls col-sm-3"><a href="#progress" aria-controls="progress" role="tab" data-toggle="tab">进展</a></li>
                    <li role="presentation" class="d-ls col-sm-3"><a href="#comment" aria-controls="comment" role="tab" data-toggle="tab">评论(<?php echo $commentnum; ?>)</a></li>
                    <li role="presentation" class="d-ls col-sm-3"></li>
                </ul>

                <div class="tab-content details-con">
                    <!--项目简介-->
                    <div role="tabpanel" class="tab-pane active" id="intro">
                        <?php echo $pro['intro']; ?>
                    </div>
                    <!--进展-->
                    <div role="tabpanel" class="tab-pane" id="progress">
                        <ul class="layui-timeline">
                            <li class="layui-timeline-item">
                                <i class="layui-icon layui-timeline-axis"><div class="glyphicon glyphicon-record"></div></i>
                                <div class="layui-timeline-content layui-text">
                                    <h3 class="layui-timeline-title">time</h3>
                                    <p>
                                        layui 2.0 的一切准备工作似乎都已到位。发布之弦，一触即发。
                                        <br>不枉近百个日日夜夜与之为伴。因小而大，因弱而强。
                                        <br>无论它能走多远，抑或如何支撑？至少我曾倾注全心，无怨无悔
                                    </p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!--评论-->
                    <div role="tabpanel" class="tab-pane" id="comment">
                        <iframe src="showComment?proid=<?php echo $pro['projectid']; ?>" frameborder="0" style="width: 90%;" height="1000px"></iframe>
                    </div>
                </div>
            </div>

            <?php if($pro['projecttype']=="普通众筹"): ?>
            <div class="details-right">
                <!--发起人信息-->
                <div class="initiator">
                    <div class="title">项目发起人</div>
                    <div class="initiator-con">
                        <div style="width: 35%"><img src="<?php echo $headimg; ?>" alt="" style="width: 65%"></div>
                        <div class="initiator-peo"><p><?php echo $username; ?></p></div>
                    </div>
                    <div>
                        <button type="button">消息</button>
                    </div>
                </div>
                <!--分额度众筹-->
                <?php if(is_array($proList) || $proList instanceof \think\Collection || $proList instanceof \think\Paginator): $i = 0; $__LIST__ = $proList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>
                <div class="grade">
                    <div class="title">
                        <div class="grade-price">￥<?php echo $value['price']; ?></div>
                        <div class="grade-people"><?php echo $value['curcount']; ?>位支持者</div>
                    </div>
                    <div class="grade-con">
                        <div class="grade-limit">限额 <?php echo $value['limitcount']; ?>份 | 剩余 <?php echo $value['limitcount']-$value['curcount']; ?>份</div>
                        <p class="grade-intro"><?php echo $value['introduce']; ?></p>
                        <div class="grade-img"><img src="<?php echo $value['imgs']; ?>" alt="" width="50px" height="50px"></div>
                        <p>配送费用： 免运费</p>
                        <p>预计回报发送时间：项目众筹成功后30天内</p>
                        <div class="grade-btn"><button <?php if($pro['stateid']==7): ?>disabled<?php endif; ?> type="button" class="btn btn-info" style="width: 100%" onclick="suppro(<?php echo $value['prodetailsid']; ?>,<?php echo $pro['projectid']; ?>)">支持￥<?php echo $value['price']; ?></button></div>
                    </div>
                </div>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
            <?php endif; ?>
        </div>
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
<!--<script src="__JS__/jquery-2.1.4.js"></script>-->
<!--<script src="__JS__/bootstrap.min.js"></script>-->
<script src="__JS__/lay/modules/layer.js"></script>
<!--<script>
    !function(){
        //无需再执行layui.use()方法加载模块，直接使用即可
        var form = layui.form
                ,layer = layui.layer;

        //…
    }();
</script>-->
<script>
    //关注
    function profocus(projectid){
        //console.log(projectid);
        $.ajax({
            url:'<?php echo url("home/Project/proFocus"); ?>',
            type:'post',
            data:{proid:projectid},
            dataType:'json',
            success:function(res){
                //alert(res.msg);
                showPrompt(res.msg);
            }
        });
    }

    //提示
    function showPrompt(content){
        layer.open({
            title: '提示'
            ,content: content
        });
    }

    //支持
    function suppro(prodetailsid,proid){
        //$res=confirm();
        console.log(prodetailsid,proid);
    }
</script>
</html>
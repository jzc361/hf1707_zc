<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:73:"D:\AppServ\www\tp505\public/../application/index\view\index\mainView.html";i:1516083325;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge"><!--设置ie内核浏览器下的渲染模式-->
    <meta name="renderer" content="webkit"><!--设置成网页以webkit(极速模式)来渲染页面-->
    <meta name="viewport" content="width=device-width,initial-scale=1"><!--设置网页宽度和访问设备宽度保持一致，且显示比例1:1，-->
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="__CSS__/bootstrap.min.css">
    <link rel="stylesheet" href="__CSS__/mainView.css">
</head>
<body data-spy="scroll" data-target=".nav">

<nav class="navbar navbar-fixed-top navbar-default" style="margin-bottom: 0"  role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNav">
                <span class="sr-only">切换导航</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#" style="padding: 5px 5px 0"><img width="100" height="40" src="__STATIC__/img/mainView/logonew.png" alt=""></a>
        </div>
        <div class="collapse navbar-collapse" id="myNav">
            <ul class="nav navbar-nav" style="float: right">
                <li class="active"><a href="#sco1">首页</a></li>
                <li><a href="#sco2">应用展示</a></li>
                <li><a href="#sco3">企业版服务</a></li>
                <li><a href="#sco4">样本服务</a></li>
                <li><a href="#sco5">问卷调查模板</a></li>
                <!--<li class="divider"></li>-->
                <li>
                    <ul class="nav_ul2">
                        <li><button class="btn btn-default" type="button" id="toLogin">登录</button></li>
                        <li><button class="btn btn-default" type="button" data-toggle="modal" data-target="#myModal">注册</button></li>
                        <li><button class="btn btn-warning" type="button">QQ登录</button></li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</nav>
<div id="sco1" class="container-fluid">
    <div class="banner">
        <div id="myCarousel" class="carousel slide">
            <!-- 轮播（Carousel）指标 -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active" style="width: 16px;height: 16px"></li>
                <li data-target="#myCarousel" data-slide-to="1" style="width: 16px;height: 16px"></li>
                <li data-target="#myCarousel" data-slide-to="2" style="width: 16px;height: 16px"></li>
            </ol>
            <!-- 轮播（Carousel）项目 -->
            <div class="carousel-inner">
                <div class="item active">
                    <img src="__STATIC__/img/mainView/banner.jpg" class="img-responsive" style="width: 100%" alt="First slide">
                    <div class="banner_div">
                        <h1>不止问卷调查 / 在线考试</h1>
                        <h3><span >1,970 </span>万用户已在问卷星上回收 <span>12.42</span> 亿份答卷</h3>
                        <button class="btn btn-warning btn-lg" type="button">免费使用</button>
                    </div>
                </div>
                <div class="item">
                    <img src="__STATIC__/img/mainView/banner2.jpg" class="img-responsive" style="width: 100%"  alt="Second slide">
                </div>
                <div class="item">
                    <img src="__STATIC__/img/mainView/banner3.jpg" class="img-responsive" style="width: 100%"  alt="Third slide">
                </div>
            </div>
            <!-- 轮播（Carousel）导航 -->
            <a class="carousel-control left" href="#myCarousel"
               data-slide="prev" style="font-size: 4.5rem;line-height: 20rem">&lsaquo;
            </a>
            <a class="carousel-control right" href="#myCarousel"
               data-slide="next" style="font-size:4.5rem;line-height: 20rem">&rsaquo;
            </a>
        </div>
    </div>

</div>
<div class="container content">
    <div id="sco2" class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-5 center-block">
            <img class="xs_img" src="__STATIC__/img/mainView/survey.png" alt="图片加载失败">
        </div>
        <div class="col-sm-5 content_div">
            <p class="content_font">在线问卷调查既复杂又简单，我们将诸多强大的功能集成到系统中，把最好的用户体验交给您。</p>
            <div style="overflow: hidden">
                <ul>
                    <li><i></i>轻松导入问卷</li>
                    <li><i></i>多渠道分发问卷</li>
                    <li><i></i>完美适配移动端</li>
                </ul>
                <ul>
                    <li><i></i>原始数据下载</li>
                    <li><i></i>自动生成图表</li>
                    <li><i style="background-image: url('__STATIC__/img/mainView/money_gray.png')"></i>付费收集答卷</li>
                </ul>
            </div>
            <button style="margin-left: 40px;" type="button" class="btn btn-info btn-lg">问卷调查介绍</button>
        </div>
        <div class="col-sm-1"></div>
    </div>
    <div id="sco3"  class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-5 content_div">
            <p class="content_font">整合线下考试的场景和线上系统的优势，问卷星在线考试定会对您大有助益。</p>
            <div style="overflow: hidden">
                <ul>
                    <li><i></i>批量录入试题</li>
                    <li><i></i>考试时间控制</li>
                    <li><i></i>自定义成绩单</li>
                </ul>
                <ul>
                    <li><i></i>题库随机抽题</li>
                    <li><i></i>系统自动阅卷</li>
                    <li><i></i>成绩查询系统</li>
                </ul>
            </div>
            <button style="margin-left: 40px;" type="button" class="btn btn-warning btn-lg">在线考试系统介绍</button>
        </div>
        <div class="col-sm-5 center-block">
            <img  class="xs_img" src="__STATIC__/img/mainView/test.png" alt="图片加载失败">
        </div>

        <div class="col-sm-1"></div>
    </div>
    <div id="sco4" class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-5 center-block">
            <img  class="xs_img" src="__STATIC__/img/mainView/360.png" alt="图片加载失败">
        </div>
        <div class="col-sm-5 content_div">
            <p class="content_font">360度评估操作简单、功能强大，能全方位、多维度评估员工，挖掘员工发展潜力，帮助企业挑选和培养优秀人才。</p>
            <div style="overflow: hidden">
                <ul>
                    <li><i></i>人员名单批量导入</li>
                    <li><i></i>维度/权重/部门设置</li>
                    <li><i></i>多终端直接作答</li>
                </ul>
                <ul>
                    <li><i></i>一对多批量评估</li>
                    <li><i></i>邮件/短信/密码邀请</li>
                    <li><i></i>个人/部门详细报告</li>
                </ul>
            </div>
            <button style="margin-left: 40px;" type="button" class="btn btn-info btn-lg">360度评估介绍</button>
        </div>
        <div class="col-sm-1"></div>
    </div>
    <div id="sco5"  class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-5 content_div">
            <p class="content_font">整合线下考试的场景和线上系统的优势，问卷星在线考试定会对您大有助益。</p>
            <div style="overflow: hidden">
                <ul>
                    <li><i></i>活动报名</li>
                    <li><i></i>微信签到</li>
                    <li><i></i>用户信息表</li>
                </ul>
                <ul>
                    <li><i></i>信息收集</li>
                    <li><i></i>意见反馈表</li>
                    <li><i></i>数据标记查询</li>
                </ul>
            </div>
            <button style="margin-left: 40px;" type="button" class="btn btn-warning btn-lg">报名表单介绍</button>
        </div>
        <div class="col-sm-5 center-block">
            <img  class="xs_img" src="__STATIC__/img/mainView/form.png" alt="图片加载失败">
        </div>

        <div class="col-sm-1"></div>
    </div>
    <div id="sco6"  class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-5 center-block">
            <img  class="xs_img" src="__STATIC__/img/mainView/evaluation.png" alt="图片加载失败"/>
        </div>
        <div class="col-sm-5 content_div">
            <p class="content_font">360度评估操作简单、功能强大，能全方位、多维度评估员工，挖掘员工发展潜力，帮助企业挑选和培养优秀人才。</p>
            <div style="overflow: hidden">
                <ul>
                    <li><i></i>多级维度设置</li>
                    <li><i></i>自定义测评结果</li>
                </ul>
                <ul>
                    <li><i></i>标准分差值对比</li>
                    <li><i></i>可视化测评数据</li>
                </ul>
            </div>
            <button style="margin-left: 40px;" type="button" class="btn btn-info btn-lg">在线评测介绍</button>
        </div>
        <div class="col-sm-1"></div>
    </div>
    <div id="sco7"  class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-5 content_div">
            <p class="content_font">准备好素材，分分钟就可以拥有一个强大的在线投票平台。</p>
            <div style="overflow: hidden">
                <ul>
                    <li><i></i>文字投票</li>
                    <li><i></i>视频竞选</li>
                </ul>
                <ul>
                    <li><i></i>图片评选</li>
                    <li><i></i>防刷票设置</li>
                </ul>
            </div>
            <button style="margin-left: 40px;" type="button" class="btn btn-warning btn-lg">在线投票介绍</button>
        </div>
        <div class="col-sm-5 center-block">
            <img  class="xs_img" src="__STATIC__/img/mainView/test.png" alt="图片加载失败"/>
        </div>
        <div class="col-sm-1"></div>
    </div>
    <div id="sco8"  class="text-center">
        <h3>他们正在使用</h3>
        <p>问卷星付费客户覆盖超过2万家企业和国内90%的高校，是各行业领导品牌最为信赖的企业数据平台。客户展示</p>
        <div>
            <img style="margin: 0 auto;" src="__STATIC__/img/mainView/college.png" class="img-responsive" alt="图片加载失败">
        </div>
        <div class="row">
            <ul class="content_ul text-center">
                <li>
                    <i class="college_gray"></i>
                    <span>高效</span>
                </li>
                <li>
                    <i class="internet_gray"></i>
                    <span>互联网</span>
                </li>
                <li>
                    <i class="car_blue"></i>
                    <span>汽车</span>
                </li>
                <li>
                    <i class="retail_gray"></i>
                    <span>零售</span>
                </li>
                <li>
                    <i class="consult_gray"></i>
                    <span>咨询</span>
                </li>
                <li>
                    <i class="science_gray"></i>
                    <span>科技</span>
                </li>
                <li>
                    <i class="financial_gray"></i>
                    <span>金融</span>
                </li>
            </ul>
        </div>

        <div class="text-center">
            <button class="btn btn-warning btn-lg" type="button">了解企业版</button>
        </div>
    </div>
</div>
<div class="container-fluid footer">
    <div class="container" style="margin-top: 40px">
        <div class="row">
            <div class="col-sm-2">
                <img src="__STATIC__/img/mainView/logo.png" alt="">
                <p> 400-993-5858</p>
                <p>cs#wjx.cn</p>
            </div>
            <div class="col-sm-2"></div>
            <div class="col-sm-2">
                <h4>产品</h4>
                <p>企业版</p>
                <p>云考试</p>
                <p>定制版</p>
                <p>样本服务</p>
            </div>
            <div class="col-sm-2">
                <h4>客户</h4>
                <p>客户展示</p>
                <p>最新问卷</p>
            </div>
            <div class="col-sm-2">
                <h4>支持</h4>
                <p>客服中心</p>
                <p>帮助中心</p>
                <p>开放平台</p>
            </div>
            <div class="col-sm-2">
                <h4>团队</h4>
                <p>关于我们</p>
                <p>加入我们 </p>
                <p>产品动态</p>
            </div>

        </div>
    </div>


</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">注册</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label for="inputAccount" class="col-sm-2 control-label">账号：</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputAccount" placeholder="请输入注册账号" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="col-sm-2 control-label">密码：</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="inputPassword" placeholder="请输入注册密码" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputConfirm" class="col-sm-2 control-label">密码：</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="inputConfirm" placeholder="请输入注册密码" />
                        </div>
                    </div>
                </form>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary">注册</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>
</body>
<script src="__JS__/jquery-2.1.4.js"></script>
<script src="__JS__/bootstrap.min.js"></script>
<script>
    $(function(){
        $("#toLogin").click(function(){

            window.location.href="<?php echo url('/index/Index/showLogin'); ?>";
        });
    });
</script>
</html>
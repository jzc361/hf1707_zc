<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:79:"D:\AppServ\www\hf170724_zc\public/../application/index\view\index\mainView.html";i:1516812000;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge"><!--设置ie内核浏览器下的渲染模式-->
    <meta name="renderer" content="webkit"><!--设置成网页以webkit(极速模式)来渲染页面-->
    <meta name="viewport" content="width=device-width,initial-scale=1"><!--设置网页宽度和访问设备宽度保持一致，且显示比例1:1，-->
    <title>首页</title>
    <!--<link rel="stylesheet" href="__CSS__/bootstrap.min.css">-->
    <link rel="stylesheet" href="http://www.bootcss.com/p/layoutit/css/bootstrap-combined.min.css">
    <!--<link href="__CSS__/bootstrap-combined.min.css" rel="stylesheet">-->
    <!--<link href="http://www.bootcss.com/p/layoutit/css/layoutit.css" rel="stylesheet">-->
    <script src="__JS__/jquery-2.1.4.js"></script>
    <script src="__JS__/bootstrap.min.js"></script>
    <style>
        @media (min-width: 980px){
            .my_nav>li {
                line-height: 40px;
                font-size: 16px;
            }
            .my_logo{
                height: 40px;
                line-height: 40px;
            }
            #my_search{
                padding: 7px 0;
            }
        }
        @media (max-width: 979px){
            /*.my_nav>li {*/
                /*line-height: 20px;*/
                /*font-size: 14px;*/
            /*}*/
            /*.my_logo{*/
                /*height: 20px;*/
                /*line-height: 20px;*/
            /*}*/
            /*.navbar-responsive-collapse{*/
                /*height: auto;*/
            /*}*/

        }

    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="navbar">
                <div class="navbar-inner">
                    <div class="container-fluid">
                        <a data-target=".navbar-responsive-collapse" data-toggle="collapse" class="btn btn-navbar">
                            <span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
                        </a>
                        <a href="#" class="brand my_logo">未名众筹</a><!-- my_logo-->
                        <div class="nav-collapse navbar-responsive-collapse in collapse">
                            <ul class="nav my_nav"><!--  my_nav-->
                                <li class="active">
                                    <a href="#">首页</a>
                                </li>
                                <li>
                                    <a href="#">更多众筹</a>
                                </li>
                                <li>
                                    <a href="#">联系我们</a>
                                </li>
                                <!--<li class="dropdown">-->
                                    <!--<a data-toggle="dropdown" class="dropdown-toggle" href="#">下拉菜单<strong class="caret"></strong></a>-->
                                    <!--<ul class="dropdown-menu">-->
                                        <!--<li>-->
                                            <!--<a href="#">下拉导航1</a>-->
                                        <!--</li>-->
                                        <!--<li>-->
                                            <!--<a href="#">下拉导航2</a>-->
                                        <!--</li>-->
                                        <!--<li>-->
                                            <!--<a href="#">其他</a>-->
                                        <!--</li>-->
                                        <!--<li class="divider">-->
                                        <!--</li>-->
                                        <!--<li class="nav-header">-->
                                            <!--标签-->
                                        <!--</li>-->
                                        <!--<li>-->
                                            <!--<a href="#">链接1</a>-->
                                        <!--</li>-->
                                        <!--<li>-->
                                            <!--<a href="#">链接2</a>-->
                                        <!--</li>-->
                                    <!--</ul>-->
                                <!--</li>-->
                                <li>
                                    <a href="#" id="my_search">
                                        <form class="form-search form-inline"  style="margin-bottom: 0">
                                            <input class="input-medium search-query" type="text" /> <button type="submit" class="btn">查找</button>
                                        </form>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav pull-right">
                                <li>
                                    <a href="#">右边链接</a>
                                </li>
                                <li class="divider-vertical" style="height: 60px">
                                </li>
                                <li class="dropdown">
                                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">下拉菜单<strong class="caret"></strong></a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="#">下拉导航1</a>
                                        </li>
                                        <li>
                                            <a href="#">下拉导航2</a>
                                        </li>
                                        <li>
                                            <a href="#">其他</a>
                                        </li>
                                        <li class="divider">
                                        </li>
                                        <li>
                                            <a href="#">链接3</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel slide" id="carousel-374136">
                <ol class="carousel-indicators">
                    <li class="active" data-slide-to="0" data-target="#carousel-374136">
                    </li>
                    <li data-slide-to="1" data-target="#carousel-374136">
                    </li>
                    <li data-slide-to="2" data-target="#carousel-374136">
                    </li>
                </ol>
                <div class="carousel-inner">
                    <div class="item active">
                        <img alt="" src="http://www.bootcss.com/p/layoutit/img/1.jpg" />
                        <div class="carousel-caption">
                            <h4>
                                棒球
                            </h4>
                            <p>
                                棒球运动是一种以棒打球为主要特点，集体性、对抗性很强的球类运动项目，在美国、日本尤为盛行。
                            </p>
                        </div>
                    </div>
                    <div class="item">
                        <img alt="" src="http://www.bootcss.com/p/layoutit/img/2.jpg" />
                        <div class="carousel-caption">
                            <h4>
                                冲浪
                            </h4>
                            <p>
                                冲浪是以海浪为动力，利用自身的高超技巧和平衡能力，搏击海浪的一项运动。运动员站立在冲浪板上，或利用腹板、跪板、充气的橡皮垫、划艇、皮艇等驾驭海浪的一项水上运动。
                            </p>
                        </div>
                    </div>
                    <div class="item">
                        <img alt="" src="http://www.bootcss.com/p/layoutit/img/3.jpg" />
                        <div class="carousel-caption">
                            <h4>
                                自行车
                            </h4>
                            <p>
                                以自行车为工具比赛骑行速度的体育运动。1896年第一届奥林匹克运动会上被列为正式比赛项目。环法赛为最著名的世界自行车锦标赛。
                            </p>
                        </div>
                    </div>
                </div> <a data-slide="prev" href="#carousel-374136" class="left carousel-control">‹</a> <a data-slide="next" href="#carousel-374136" class="right carousel-control">›</a>
            </div>
            <h3>热门众筹</h3>
            <ul class="thumbnails">
                <li class="span4">
                    <div class="thumbnail">
                        <img alt="300x200" src="http://www.bootcss.com/p/layoutit/img/people.jpg" />
                        <div class="caption">
                            <h3>
                                短片电影
                            </h3>
                            <p>
                                目标：756天￥3000000
                            <span class="label">筹资失败</span>
                            </p>
                            <div class="progress progress-warning active">
                                <div class="bar">
                                </div>
                            </div>
                            <div class="row-fluid">
                                <div class="span4">
                                    <p>9%</p>
                                    <p>已达</p>
                                </div>
                                <div class="span4">
                                    <p>299999元</p>
                                    <p>已筹资</p>
                                </div>
                                <div class="span4">
                                    <p>18/01/10</p>
                                    <p>日期</p>
                                </div>
                            </div>
                            <!--<p>-->
                                <!--<a class="btn btn-primary" href="#">浏览</a> <a class="btn" href="#">分享</a>-->
                            <!--</p>-->
                        </div>
                    </div>
                </li>
                <li class="span4">
                    <div class="thumbnail">
                        <img alt="300x200" src="http://www.bootcss.com/p/layoutit/img/city.jpg" />
                        <div class="caption">
                            <h3>
                                哈佛结构
                            </h3>
                            <p>
                                哈佛结构是一种将程序指令存储和数据存储分开的存储器结构，它的主要特点是将程序和数据存储在不同的存储空间中，进行独立编址。
                            </p>
                            <p>
                                <a class="btn btn-primary" href="#">浏览</a> <a class="btn" href="#">分享</a>
                            </p>
                        </div>
                    </div>
                </li>
                <li class="span4">
                    <div class="thumbnail">
                        <img alt="300x200" src="http://www.bootcss.com/p/layoutit/img/sports.jpg" />
                        <div class="caption">
                            <h3>
                                改进型哈佛结构
                            </h3>
                            <p>
                                改进型的哈佛结构具有一条独立的地址总线和一条独立的数据总线，两条总线由程序存储器和数据存储器分时复用，使结构更紧凑。
                            </p>
                            <p>
                                <a class="btn btn-primary" href="#">浏览</a> <a class="btn" href="#">分享</a>
                            </p>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>

</body>

<script>

</script>
</html>
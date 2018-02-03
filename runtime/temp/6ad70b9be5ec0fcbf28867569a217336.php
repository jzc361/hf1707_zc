<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:83:"D:\AppServ\www\hf1707_zc\public/../application/home\view\publishpro\proBaseMsg.html";i:1517560887;s:76:"D:\AppServ\www\hf1707_zc\public/../application/home\view\public\chatDiv.html";i:1517581140;s:72:"D:\AppServ\www\hf1707_zc\public/../application/home\view\public\nav.html";i:1517447918;s:75:"D:\AppServ\www\hf1707_zc\public/../application/home\view\public\footer.html";i:1517371150;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>众筹发布页</title>
    <link rel="stylesheet" href="__CSS__/bootstrap.min.css">
    <link rel="stylesheet" href="__CSS__/proBaseMsg.css">
    <link rel="stylesheet" href="__CSS__/default.css">

    <style>
        /*--通用-*/
        #moreImg{
            opacity: 0;
        }
        #moreImgBtn{
            padding: 4px 10px;
            height: 20px;
            line-height: 20px;
            border: 1px solid #999;
            text-decoration: none;
            color: #666;
        }
        #moreImgView{
            height: 200px;
            width: 200px;
            float: left;
            overflow: auto;
            border: 1px solid grey;
        }
        #moreImgView img{
            width: 100%;
        }
        body{ background:#f3f3f3; }
        .pro_lf{ padding:10px; width:50%; }
        .hide { height:0;float:none }
        .setlist{position:relative;}
        .holder_tip{left:125px}
        .faq_item1{position:relative;overflow:hidden;padding:4px;}
        .faq_item1 .holder_tip{left:4px;top:4px;}
        .next{
            padding: 6px 12px;
            float: right;
            margin-right: 30px;
        }
        #contentRight{
            height:600px;
            margin: 0;
            padding: 0;
        }
        /*--通用end-*/

        /*--xs-*/
        @media (max-width:768px) {
            #contentRight{
                float: left;
                margin-top: 30px;
            }
        }
        /*--sm-*/
        @media (max-width:768px) {
            #contentRight{
                float: left;
                margin-top: 30px;
            }
        }
            /*--md--*/
        @media (max-width:992px) {
            #contentRight{
                float: left;
                margin-top: 30px;
            }
        }

    </style>
</head>
<body>
<!--聊天客服-->
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
                            </div>
                        </div>
                        <div  v-if="x.loginstate=='离线'" style="color: black">
                            <div @click="showchat(x.empid,x.empname,x.headimg)">
                                <span>{{x.empname}}</span>
                                ({{x.loginstate}})
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
</script>
<script src="__JS__/qqface.js"></script>
<script src="__JS__/myChat.js"></script>
<script src="__JS__/zzsc.js" ></script>
<!--</html>-->
<!--nav-->
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
<div class="container" id="vueDiv" style="margin-top: 25px;margin-bottom: 25px;">
    <!--<div class="row-fluid">-->
<!--左边-->
<div class="col-md-7 col-sm-12 col-xs-12 agreementlf f_l">
    <form id="project_form" action="" method="post" enctype="multipart/form-data">
        <div class="pro_msg">项目信息</div>
        <!--项目标题-->
        <div class="setlist">
            <label class="setmid">项目标题</label>
            <input type="text" class="pro_lf textbox" id="proTitle" name="projectname" v-model="proTitle">
        </div>
        <!--众筹天数-->
        <div class="blank0"></div>
        <div class="setlist">
            <label class="setmid">众筹天数</label>
            <input name="daysnumber" id="daysNumber" v-model='daysNumber' @keyup="limitInt()" class="pro_lf textbox">
            <span class="setmid">天</span>
        </div>
        <!--众筹金额-->
        <div class="setlist">
            <label class="setmid">众筹金额</label>
            <input name="tolamount" id="tolamount" v-model='tolamount'  @keyup="limitInt()" class="pro_lf textbox">
            <span class="setmid">元</span>
        </div>
        <!--项目分类-->
        <div class="setlist">
            <label class="setmid" style="margin-right:25px;">项目分类</label>
                <select id="proSort" name="proSort" class="btn_select f_l">
                    <?php if(is_array($proSortList) || $proSortList instanceof \think\Collection || $proSortList instanceof \think\Paginator): $i = 0; $__LIST__ = $proSortList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
                        <option :value="<?php echo $val['sortid']; ?>"><?php echo $val['sortname']; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
        </div>
        <!--项目封面-->
        <div class="blank0"></div>
        <div class="setlist">
            <label class="setmid">项目封面</label>
            <label class="fileupload" style="width:97px;">
                <input type="file" @change="addImg($event)" class="filebox" id="imgFile" name="imgFile" accept="image/gif,image/jpeg,image/jpg,image/png"  style="cursor:pointer;padding: 0;height: 39px;width: 97px;filter: alpha(opacity=0);-moz-opacity: 0;-khtml-opacity: 0;opacity: 0; "/>
                <!--<input type="file" class="" name="img_file" accept="image/gif,image/jpeg,image/jpg,image/png"/>-->
            </label>
            <span class="prompt" style="margin-top:11px;" v-if="!isAddImg">支持jpg、jpeg、png、gif格式</span>
            <span class="prompt" style="margin-top:11px;" v-if="isAddImg">已添加图片，可在右侧预览</span>
        </div>
        <div class="blank0"></div>
        <!--项目详情-->
        <div class="blank0"></div>
        <div class="setlist">
            <label class="setmid">项目详情</label>
            <!--<textarea name="probrief" id="probrief" class="textareabox textbox w350"></textarea>-->
        </div>
        <div class="blank0"></div>
        <!--<div>-->
            <div id="editor"  name="proDetails"></div>
        <!--</div>-->
        <!---->
        <!--保存-->
        <div class="blank5"></div>
        <button type="button" id="next"  class="btn-success next">下一步</button>
        <!--<div class="saveone f_l" rel="gray" id="savenow"></div>-->
    </form>
</div>
<!--左边end-->
<div class="col-md-2"></div>
<!--右边-->
<div id="contentRight" class="col-md-4 col-sm-6 col-xs-9 agreementrt f_r">
    <div class="deal_item_box agreementlist">
        <!--图片 名称-->
        <div class="deal_content_box">
            <a href="#" title="">
                <img id="imagePreview"  :src="projectimg" />
                <!--<img id="imagePreview"  src="__STATIC__/img/home/publishPro/empty_thumb.gif" />-->
            </a>
            <div class="blank"></div>
            <span class="deal_title" id="deal_title" v-if="proTitle==''">项目标题</span>
            <span class="deal_title" id="" v-if="proTitle!=''">{{proTitle}}</span>
            <!--<a href="#" class="deal_title" id="deal_title"></a>-->
            <div class="blank"></div>
        </div>
        <!--基本信息-->
        <div class="paiduan" style="height:30px;padding:10px 12px 0 12px ;line-height: 20px;color: #A4A4A4;">
            <span class="caption-title">目标：
                <em>
                    <span class="num">
                        <font  v-if="daysNumber==''" id="dNumber">0</font>
                        <font  v-if="daysNumber!=''" >{{daysNumber}}</font>
                        天
                    </span>
                </em>
                <em>
                    <i class="font-yen">¥</i>
                    <span class="num" >
                        <font v-if="tolamount==''"  id='tolamount2'>0</font>
                        <font v-if="tolamount!=''">{{tolamount}}</font>
                        元
                    </span>
                </em>
            </span>
            <span class="f_r ">
                <span class="common-sprite">筹资中</span>
            </span>
        </div>
        <div class="deal_content_box" style="padding:15px 12px 0 12px; ">
            <div class="ui-progress">
                <span class="theme_bgcolor" style="width:100%;"></span>
            </div>
            <div class="blank"></div>
            <div class="div3" style="text-align:left;">
                <span class="num">100%</span>
                <div class="blank10"></div>
                <span class="til">已达</span>
            </div>
            <div class="div3">
                <span class="num">
                    <font id="price">0</font>
                    元
                </span>
                <div class="blank10"></div>
                <span class="til">已筹资</span>
            </div>
            <div class="div3" style="text-align:right;">
                <span class="num"><font id="deal_days">0</font>天</span>
                <div class="blank10"></div>
                <span class="til">剩余时间</span>
            </div>
            <div class="blank"></div>
        </div>
        <div class="blank"></div>
    </div>
</div>
        <!--右边end-->
    <!--</div>-->
</div>
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
<script src="__JS__/vue.js"></script>

<!-- 配置文件 -->
<script type="text/javascript" src="__STATIC__/ueditor/dist/utf8-php/ueditor.config.js"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript"  src="__STATIC__/ueditor/dist/utf8-php/ueditor.all.js"></script>
<script>

    var ue = UE.getEditor('editor');//富文本
    var proList = <?php echo $proList; ?>;

    console.log(proList);
    new Vue({
        el : '#vueDiv',
        //数据
        data:{
            proTitle:proList.projectname?proList.projectname : '',
            daysNumber:proList.daysnumber?proList.daysnumber : '',
            tolamount:proList.tolamount?proList.tolamount:'',
//            proDetails:proList?proList.intro : '',
            projectimg:proList.projectimg? proList.projectimg: '__STATIC__/img/home/publishPro/empty_thumb.gif',
            isAddImg:false//是否添加图片
        },
        //方法
        methods:{
            //限制众筹天数和金额只能输入正整数
            limitInt:function(){
                this.daysNumber=this.daysNumber.replace(/[^0-9]/g,'');
                this.tolamount=this.tolamount.replace(/[^0-9]/g,'');
            },
            //添加图片
            addImg:function(){
                this.isAddImg=true;
            }

        },

        mounted:function(){
//fd
        }
    });

    /*---图片预览-*/
    $("#imgFile").change(function(){
        var file = document.getElementById("imgFile").files;
        var result=document.getElementById("imagePreview");
        $(result).empty();
            var reader    = new FileReader();
            reader.readAsDataURL(file[0]);
            reader.onload=function(e){
                $(result).attr("src",this.result);
            };
    });

    //点击下一步
    $("#next").click(function(){
        var formData = new FormData($("#project_form")[0]);
        console.log(formData);
        $.ajax({
            url: "<?php echo url('home/Publishpro/saveProMsg'); ?>",
            type: "POST",
            data: formData,
            dataType: "json",
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            success: function(responseData) {
                location.href="<?php echo url('home/Publishpro/jumpToAddReturn'); ?>";
            },
            error: function(responseData) {
            }
        });
    });
    //保留数据
    $(function(){
        $("#editor").find("div:eq(0)").css({width:"90%"});
//       var proMsgList=$("#saveProMsgList").text();
//        console.log(proMsgList);
//        var proMsgArr=JSON.parse(proMsgList);
//        console.log(proMsgArr);
//        $("#proTitle").val(proMsgArr['proTitle']);
//        $("#deal_title").text(proMsgArr['proTitle']);
//        $("#daysNumber").val(proMsgArr['daysNumber']);
//        $("#dNumber").text(proMsgArr['daysNumber']);
//        $("#tolamount").val(proMsgArr['tolamount']);
//        $("#tolamount2").text(proMsgArr['tolamount']);
//        $("#proSort").val(proMsgArr['proSort']);
//        $("#probrief").text(proMsgArr['probrief']);
    });

</script>
</html>
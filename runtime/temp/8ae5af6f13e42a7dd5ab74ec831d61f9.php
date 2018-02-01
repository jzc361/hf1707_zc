<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:82:"D:\AppServ\www\hf1707_zc\public/../application/home\view\publishpro\addReturn.html";i:1517447918;s:72:"D:\AppServ\www\hf1707_zc\public/../application/home\view\public\nav.html";i:1517447918;s:75:"D:\AppServ\www\hf1707_zc\public/../application/home\view\public\footer.html";i:1517371150;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Title</title>
    <link rel="stylesheet" href="__CSS__/bootstrap.min.css">
    <link rel="stylesheet" href="__CSS__/proBaseMsg.css">
    <link rel="stylesheet" href="__CSS__/addReturn.css">
    <style>
        .setmid_new {
            margin-top: 12px;
        }
        .control-group{position:relative;}
        .holder_tip{left:105px}
        /*--通用-*/
        /*--通用end-*/

        /*--lg*/
        @media (min-width:1200px) {

        }
        /*--md-*/
        @media (min-width:992px) {

        }
        /*--sm-*/
        @media (min-width:768px) {
            #previewdiv{
                float: left;
            }
        }
        /*--xs-*/
        @media (max-width:768px) {
            #previewdiv{
                float: left;
            }
            .textbox{
                width: 55%;
            }
        }

    </style>
</head>
<body>
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
<div class="container" id="vueDiv" style="height: 605px;">
    <div class="col-md-1"></div>
    <div class="xqmain xqmain1000 col-md-10 col-sm-12 col-xs-12" style="margin-top:10px;">
        <div class="xqmain_main">
            <div class="page_title">回报设置 - <?php echo $proTitle; ?></div>
            <div class="switch_nav">
                <ul>
                    <li><a href="<?php echo url('home/Publishpro/jumpToProBaseMsg'); ?>?isReturn">项目介绍</a></li>
                    <li class="current"><a href="#">回报设置</a></li>
                </ul>
            </div>
            <div class="blank"></div>
            <div class="add_item_tip">
                <h1>小提示：</h1>
                <ul>
                    <li>【建议设置3个以上的回报】，回报多样化更能提高关注度。</li>
                    <li>【建议设置几十、几百、上千元的支持档位】，回报差异化更能满足不同人的需求。</li>
                    <li>【建议设置有创意的回报】，与众不同的回报更能打动支持者。</li>
                </ul>
            </div>
            <div class="link_dash"></div>
        </div>
        <div class="blank20"></div>
        <!--回报表格显示-->
        <div class="full" v-if="showtable">
            <table class="data-table">
                <tr>
                    <th width="">价格</th>
                    <th width="">限额</th>
                    <th width="">描述</th>
                    <th width="">操作</th>

                </tr>
                <tr v-for="x in returnArr">
                   <td>{{x.price}}</td>
                   <td>{{x.limitpart}}</td>
                   <td>{{x.returnDetails}}</td>
                   <td>编辑/删除</td>
                </tr>
            </table>
        </div>
        <!--回报表单填写-->
        <div v-if="showDetails" id="add_item_form" >
            <form class="ajax_form" id="item_form" action="" method="post">
                <!--left-->
                <div class="col-md-8 col-sm-12 col-xs-12 public_left">
                    <!--支持金额-->
                    <div class="form_row control-group">
                        <label class="form_lable">支持金额:</label>
                        <input type="text" value="" class="textbox" v-model="price" name="price" @keyup="limitInt()" />
                        <label>元</label>
                    </div>
                    <div class="blank0"></div>
                    <!--限额-->
                    <div class="form_row control-group">
                        <!--<label class="form_lable">限购份数:</label>-->
                        <label class="form_lable">限额:</label>
                        <input type="text" value="" class="textbox" v-model="limitpart" name="limitpart" @keyup="limitInt()" />
                        <label>份</label>
                    </div>
                    <div class="blank0"></div>
                    <!--回报内容-->
                    <div class="form_row control-group">
                        <label class="form_lable">回报内容:</label>
                        <textarea v-model="returnDetails" name="returnDetails" class="textareabox textbox"></textarea>
                    </div>
                    <div class="blank0"></div>
                    <!--图片-->
                    <div class="form_row control-group">
                        <label class="form_lable">图片:</label>
                        <label class="fileupload" style="width:97px;">
                            <input type="file" class="filebox" onchange="imgView()" id="imgFile" @change="getImgMsg($event)" name="imgFile" accept="image/gif,image/jpeg,image/jpg,image/png"  style="cursor:pointer;padding: 0;height: 39px;width: 97px;filter: alpha(opacity=0);-moz-opacity: 0;-khtml-opacity: 0;opacity: 0; "/>
                        </label>
                    </div>
                    <div class="blank0"></div>
                </div>
                <!--end left-->
                <!--right-->
                <div id="previewdiv" class="col-md-4 col-sm-8 col-xs-8 public_right" style="">
                    <div class="deal_preview_title">编辑预览</div>
                    <div class="blank10"></div>
                    <div class="item_preview">
                        <div id="support_price_box">
                            支持￥
                            <span id="support_price" v-if="price==''">0</span>
                            <span  v-if="price!=''">{{price}}</span>
                            元
                            <div class="blank"></div>
                        </div>
                        <div class="f14">
                            0位支持者&nbsp;&nbsp;
                            <span id="limit_user_box">限额
                                <span id="limit_user" v-if="limitpart==''">0</span>
                                <span v-if="limitpart!=''">{{limitpart}}</span>
                                份</span>
                            <div class="blank"></div>
                        </div>
                        <div id="repaid_content" class="f14" v-if="returnDetails==''">回报内容</div>
                        <div id="" class="f14" v-if="returnDetails!=''">{{returnDetails}}</div>
                        <img src="" id="imagePreview" style="width: 100%" /><!--图片预览-->
                        <div class="blank10"></div>
                        <div class="ui-button_green">
                            <div>
                                <span>支持￥
                                    <font id="support_price_btn"  v-if="price==''">0</font>
                                    <font id=""  v-if="price!=''">{{price}}</font>
                                    元</span>
                            </div>
                        </div>
                        <div class="blank1"></div>
                    </div>
                </div>
                <!--<div class="col-md-1"></div>-->
                <!--end right-->
                <div class="blank10"></div>
                <div class="add_item_btn">
                    <div class="ui-button theme_bgcolor" rel="green">
                        <div>
                            <span @click="saveReturnMsg">保存新的回报项目</span>
                        </div>
                    </div>
                    <!--<a href="javascript:void(0);" id="cancel_add">取消添加</a>-->
                </div>
                <div class="blank"></div>
            </form>
        </div>
        <!--添加回报 提交审核-->
        <div v-if="showBtn" id="add_item_row">
            <div class="add_item_btn f_l" id="add_item_btn">
                <div class="ui-button theme_bgcolor" rel="gray"  @click="showDetailsFun">
                    添加新的回报项目
                </div>
            </div>
            <div class="add_item_btn f_l" id="submit_deal_btn" style="margin-left:10px;">
                <div class="ui-button theme_bgcolor" rel="green">
                    <div>
                        <span  @click="sumbitPro">提交审核</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="blank40"></div>
    </div>
    <div class="col-md-1"></div>
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
<script>
    new Vue({
        el : '#vueDiv',
        //数据
        data:{
            showDetails:false,
            showBtn:true,
            showtable:false,
            price:'', //支持金额
            limitpart:'', //限制份数
            returnDetails:'', //回报内容,
            imgFile:'', //图片信息
            returnArr:[],//回报数组
            allformdata:localStorage.allformdata?localStorage.allformdata:[]
        },
        //方法
        methods:{
            //点击添加新的回报   显示与隐藏，清空数据
            showDetailsFun:function(){
                this.showDetails=true;
                this.showBtn=false;
            },
            //限制只能输入正整数
            limitInt:function(){
                this.price=this.price.replace(/[^0-9]/g,'');
                this.limitpart=this.limitpart.replace(/[^0-9]/g,'');
            },
            //获取图片信息
            getImgMsg:function($event){
                //var file = $event.target.files;
                //console.log(file);
            },
            //保存回报
            saveReturnMsg:function(){
                //保存回报
                var formData = new FormData($("#item_form")[0]);
                var _this=this;
                $.ajax({
                    url: "<?php echo url('home/Publishpro/saveReturnMsg'); ?>",
                    type: "POST",
                    data: formData,
                    dataType: "json",
                    async: false,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(responseData) {
                        //保存好后的显示
                        var $arr={price:_this.price,limitpart:_this.limitpart,returnDetails:_this.returnDetails};
                        _this.returnArr.push($arr);
                        //显示隐藏
                        _this.showtable=true;
                        _this.showDetails=false;
                        _this.showBtn=true;
                        _this.price='';
                        _this.limitpart='';
                        _this.returnDetails='';
                    },
                    error: function(responseData) {
                    }
                });




//                $.ajax({
//                    url: "<?php echo url('home/Publishpro/aa'); ?>",
//                    type: "POST",
//                    data: formData,
//                    dataType: "json",
//                    async: false,
//                    cache: false,
//                    contentType: false,
//                    processData: false,
//                    success: function(responseData) {
//                        //保存好后的显示
//                    },
//                    error: function(responseData) {
//                    }
//                });
//                console.log(formData);
//                console.log(this.allformdata.length);
//                this.formdata.push(['id']);
//                if( localStorage.allformdata!=undefined ){
//                    var allformdata=JSON.parse(localStorage.allformdata);
//                    console.log(allformdata);
//                    var data1={"index":localStorage.allformdata.length,"dataDetails":formData};
                    //allformdata.push(data1);
                   // localStorage.allformdata=JSON.stringify(allformdata);
//               }
//               else {
//                    this.allformdata.push([this.allformdata.length,formData]);
//                    localStorage.allformdata=this.allformdata;
//                    console.log( localStorage.allformdata);
                    //console.log(this.allformdata);

//                this.allformdata.push([this.allformdata.length,formData]);
//                localStorage.allformdata=[this.allformdata];
//                console.log(this.allformdata);


            },
            //提交审核
            sumbitPro:function(){
                $.ajax({
                     type: "post",
                     url: "<?php echo url('home/Publishpro/sumbitPro'); ?>",
                     dataType: "json",
                     success: function (responseData){
                         alert(responseData['msg']);
                         location.href="<?php echo url('home/Index/index'); ?>";
//                         location.reload(true);
                     },
                     error:function(){
                         alert("error");
                     }
                });
            }
        },
        mounted:function(){
            //发送ajax

        }
    });

    /*---图片预览-*/
    function imgView(){
        var file = document.getElementById("imgFile").files;
        var result=document.getElementById("imagePreview");
        $(result).empty();
        var reader    = new FileReader();
        reader.readAsDataURL(file[0]);
        reader.onload=function(e){
            $(result).attr("src",this.result);
        };
    }
</script>
</html>
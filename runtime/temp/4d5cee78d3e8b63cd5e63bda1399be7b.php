<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:77:"D:\AppServ\www\tp505\public/../application/index\view\index\personalView.html";i:1516199518;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge"><!--设置ie内核浏览器下的渲染模式-->
    <meta name="renderer" content="webkit"><!--设置成网页以webkit(极速模式)来渲染页面-->
    <meta name="viewport" content="width=device-width,initial-scale=1"><!--设置网页宽度和访问设备宽度保持一致，且显示比例1:1，-->
    <title>个人中心</title>
    <link rel="stylesheet" href="__CSS__/bootstrap.min.css">
    <link rel="stylesheet" href="__CSS__/personalView.css">
    <script src="__JS__/vue.js"></script>
</head>
<body>
<div style="background-color: #0078c8">
    <div class="container nav">
        <div class="row">
            <div class="col-sm-2 col-md-2 col-lg-2 col-xs-12" style="padding-top: 5px"><img width="130" height="48" src="__STATIC__/img/mainView/logonew.png" alt=""></div>
            <div class="col-sm-10 col-md-10 col-lg-10 col-xs-12">
                <div class="nav_float">
                    <ul class="nav_ul1">
                        <li class="active"><a href=""><span class="glyphicon glyphicon-home"></span>我的问卷</a></li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" style="background: none" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span>HF170724<em class="caret"></em></a>
                            <ul class="dropdown-menu ul_menu">
                                <li>用户信息</li>
                                <li>升级</li>
                                <li>客服中心</li>
                            </ul>
                        </li>
                        <li><a href=""><span class="glyphicon glyphicon-bell"></span>消息</a></li>
                        <li><a href=""><span class="glyphicon glyphicon-off"></span>退出</a></li>
                    </ul>
                </div>

            </div>
        </div>

    </div>
</div>
<div id="app" class="container content">
    <div class="row" style="padding: 10px 0">
        <div class="col-sm-11">
            <button class="btn btn-warning" id="creat">+创建问卷</button>
            <div class="form-group" style="display: inline-block" id="searchBlock">
                <input type="text" placeholder="请输入问卷名进行搜索..." value="<?php echo $keyWord; ?>">
                <span class="glyphicon glyphicon-search text-right" style="margin-left: -25px;cursor: pointer"></span>
            </div>
        </div>
        <div class="col-sm-1">
            <button class="btn btn-default"><span class="glyphicon glyphicon-trash"></span>回收站</button>
        </div>
    </div>

    <!--<wj-list my-src="index.php?type=Question&do=getQuestionnaire"></wj-list>-->
    <!--<pages></pages>-->


    <div id="wj_content">
        <?php if(is_array($questionnaire) || $questionnaire instanceof \think\Collection || $questionnaire instanceof \think\Paginator): $i = 0; $__LIST__ = $questionnaire;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$x): $mod = ($i % 2 );++$i;?>
        <div class="panel panel-info my_panel">
            <div class="panel-heading">
                <span><?php echo $x['q_title']; ?></span>
            <span style="float: right">
                <span>草稿</span>
                <span>答卷：0</span>
                <span><?php echo $x['q_time']; ?></span>
            </span>
            </div>
            <div class="panel-body">
                <ul class="panel_ul1">
                    <li>
                        <span class="glyphicon glyphicon-edit"></span>
                        设计问卷
                    </li>
                    <li>
                        <span class="glyphicon glyphicon-open-file"></span>
                        发送问卷
                    </li>
                    <li>
                        <span class="glyphicon glyphicon-save-file"></span>
                        分析&下载
                    </li>
                </ul>

                <ul class="panel_ul2">
                    <li>
                        <span class="glyphicon glyphicon-play-circle"></span>
                        发布
                    </li>
                    <li>
                        <span class="glyphicon glyphicon-duplicate"></span>
                        复制
                    </li>
                    <li onclick="deleteWj(<?php echo $x['q_id']; ?>)">
                        <span class="glyphicon glyphicon-trash"></span>
                        删除
                    </li>
                    <li>
                        <span class="glyphicon glyphicon-folder-open"></span>
                        文件夹
                    </li>
                    <li>
                        <span class="glyphicon glyphicon-bell"></span>
                        提醒
                    </li>
                </ul>

            </div>
        </div>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        <?php echo $page; ?>
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
<!--<?php if(is_array($questionnaire) || $questionnaire instanceof \think\Collection || $questionnaire instanceof \think\Paginator): $i = 0; $__LIST__ = $questionnaire;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>-->
    <!--<?php echo $vo['q_id']; ?>:<?php echo $vo['q_title']; ?><br/>-->
<!--<?php endforeach; endif; else: echo "" ;endif; ?>-->

</body>
<!--<h2>-->
    <!--你好,2018-->
<!--</h2>-->
<script src="__JS__/jquery-2.1.4.js"></script>
<script src="__JS__/bootstrap.min.js"></script>



<script>
    var content='<div>\
    <?php if(is_array($questionnaire) || $questionnaire instanceof \think\Collection || $questionnaire instanceof \think\Paginator): $i = 0; $__LIST__ = $questionnaire;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$x): $mod = ($i % 2 );++$i;?>\
    <div class="panel panel-info my_panel">\
            <div class="panel-heading">\
            <span><?php echo $x['q_title']; ?></span>\
    <span style="float: right">\
            <span>草稿</span>\
            <span>答卷：0</span>\
    <span><?php echo $x['q_time']; ?></span>\
    </span>\
    </div>\
    <div class="panel-body">\
            <ul class="panel_ul1">\
            <li>\
            <span class="glyphicon glyphicon-edit"></span>\
            设计问卷\
            </li>\
            <li>\
            <span class="glyphicon glyphicon-open-file"></span>\
            发送问卷\
            </li>\
            <li>\
            <span class="glyphicon glyphicon-save-file"></span>\
            分析&下载\
            </li>\
            </ul>\
            <ul class="panel_ul2">\
            <li>\
            <span class="glyphicon glyphicon-play-circle"></span>\
            发布\
            </li>\
            <li>\
            <span class="glyphicon glyphicon-duplicate"></span>\
            复制\
            </li>\
            <li onclick="deleteWj(<?php echo $x['q_id']; ?>)">\
            <span class="glyphicon glyphicon-trash"></span>\
            删除\
            </li>\
            <li>\
            <span class="glyphicon glyphicon-folder-open"></span>\
            文件夹\
            </li>\
            <li>\
            <span class="glyphicon glyphicon-bell"></span>\
            提醒\
            </li>\
            </ul>\
            </div>\
            </div>\
            <?php endforeach; endif; else: echo "" ;endif; ?>\
    <?php echo $questionnaire->render(); ?>\
    </div>';
    function deleteWj(id){
        if(confirm('确认删除？')){
            $.ajax({
                url:"<?php echo url('/index/Index/deleteWj'); ?>?id="+id,
                data:'id='+id,
                type:'post',
                dataType:'json',
                success:function(res){
                    if(res.code==20003){
                        alert(res.msg);
                        window.location.reload(true);
                    }else{
                        alert(res.msg);
                    }
                    console.log(res);
                }
            })
        }

    }
    $(function(){
        $("#creat").click(function(){ //index.php?type=Login&do=showChooseTypeView
            window.location.href="<?php echo url('index/Index/showChooseType'); ?>";
        });
        $("#searchBlock>span").click(function(){
           var keyWord=$("#searchBlock>input").val();
            console.log(keyWord);
            window.location.href="<?php echo url('/index/Index/searchWj'); ?>?keyWord="+keyWord;
//            $.ajax({
//                url:"<?php echo url('/index/Index/searchWj'); ?>",
//                data:'keyWord='+keyWord,
//                type:'post',
//                dataType:'json',
//                success:function(res){
//                    questionnaire=res;
//                    $("#wj_content").html(content);
//
////                    if(res.code==20007){
////                        alert(res.msg);
////
////                    }else{
////                        alert(res.msg);
////                    }
//                    console.log(res);
//                }
//            })

        });
    });



//var data="<?php echo $questionnaire[0]['q_title']; ?>";

//    var bus=new Vue();
//    Vue.component('wj-list',{
//        props: ['my-src'],
//        template:'<div>\
//        <div v-for="x in questionnaire" class="panel panel-info my_panel">\
//            <div class="panel-heading">\
//            <span>{{x.q_title}}</span>\
//    <span style="float: right">\
//            <span>草稿</span>\
//            <span>答卷：0</span>\
//    <span>{{x.q_time}}</span>\
//    </span>\
//    </div>\
//    <div class="panel-body">\
//            <ul class="panel_ul1">\
//            <li>\
//            <span class="glyphicon glyphicon-edit"></span>\
//            设计问卷\
//            </li>\
//            <li>\
//            <span class="glyphicon glyphicon-open-file"></span>\
//            发送问卷\
//            </li>\
//            <li>\
//            <span class="glyphicon glyphicon-save-file"></span>\
//            分析&下载\
//            </li>\
//            </ul>\
//            <ul class="panel_ul2">\
//            <li>\
//            <span class="glyphicon glyphicon-play-circle"></span>\
//            发布\
//            </li>\
//            <li>\
//            <span class="glyphicon glyphicon-duplicate"></span>\
//            复制\
//            </li>\
//            <li>\
//            <span class="glyphicon glyphicon-trash"></span>\
//            删除\
//            </li>\
//            <li>\
//            <span class="glyphicon glyphicon-folder-open"></span>\
//            文件夹\
//            </li>\
//            <span class="glyphicon glyphicon-bell"></span>\
//            提醒\
//            </li>\
//            </ul>\
//            </div>\
//            </div>\
//            </div>',
//        data:function(){
//            return {
//                questionnaire:[],
//                page:undefined,
//                pageNum:[],
//                PreviousClass:{'disabled':true},
//                NextClass:{'disabled':false},
//                pageNumClass:[]
//            }
//        },
//        methods:{
//            //var _this=this;
//            init:function(pageNow){
//                $.ajax({
//                    type:'get',
////                    url:this.mySrc,
//                    url:"index.php?type=Question&do=getQuestionnaire&pageNow="+pageNow,
////                    date:{'pageNow':pageNow},
//                    dataType:'json',
//                    success:function(data){
//                        this.questionnaire=data[0];
//                        this.page=data[1];
//                        bus.$emit('change',this.page);
//
////                        this.pageNum=[];
////                        for(var i=0;i<this.page.pageCount;i++){
////                            this.pageNum[i]=i+1;
////                        }
////                        //上一页、下一页样式
////                        this.PreviousClass['disabled']=false;
////                        this.NextClass['disabled']=false;
////                        if(this.page.pageNow==1){
////                            this.PreviousClass['disabled']=true;
////                        }
////                        if(this.page.pageNow==this.page.pageCount){
////                            this.NextClass['disabled']=true;
////                        }
////                        //页码样式
////                        for(var j=0;j<this.page.pageCount;j++){
////                            this.pageNumClass[j]={'active':false};
////                        }
////                        if(this.page['pageNow']>0){
////                            this.pageNumClass[this.page['pageNow']-1]={'active':true};
////                        }
//                    }.bind(this)
//                })
//            },
//            change:function(pageNow){
//                this.init(pageNow);
//            }
//        },
//        mounted:function(){
////            this.init(1);
//            bus.$on('pre',function(){
////                console.log(275,this.page);
//                this.init(this.page.pageLast);
//            }.bind(this));
//            bus.$on('next',function(){
////                console.log(278,this.page);
//                this.init(this.page.pageNext);
//            }.bind(this));
//            bus.$on('go',function(pageNow){
//                this.init(pageNow);
//            }.bind(this))
//        }
//    });
//    Vue.component('pages',{
//        template:'<nav aria-label="Page navigation">\
//        <ul class="pagination">\
//            <li v-bind:class="PreviousClass" v-on:click="pre()" >\
//            <a  aria-label="Previous">\
//            <span aria-hidden="true">&laquo;</span>\
//        </a>\
//        </li>\
//        <li v-for="x in pageNum" v-bind:class="pageNumClass[x-1]" v-on:click="change(x)"><a>{{x}}</a></li>\
//        <li v-bind:class="NextClass" v-on:click="next()" >\
//                <a  aria-label="Next">\
//                <span aria-hidden="true">&raquo;</span>\
//        </a>\
//        </li>\
//        </ul>\
//        </nav>',
//        data:function(){
//            return {
//                questionnaire:[],
//                page:undefined,
//                pageNum:[],
//                PreviousClass:{'disabled':true},
//                NextClass:{'disabled':false},
//                pageNumClass:[]
//            }
//        },
//        methods:{
//            pre:function(){
//                bus.$emit('pre');
//            },
//            next:function(){
//                bus.$emit('next');
//            },
//            change:function(pageNow){
//                bus.$emit('go',pageNow);
//            }
//        },
//        mounted:function(){
//            bus.$on('change',function(pages){
//                this.page=pages;
////                console.log(308,this.page);
//                this.pageNum=[];
//                for(var i=0;i<this.page.pageCount;i++){
//                    this.pageNum[i]=i+1;
//                }
//                //上一页、下一页样式
//                this.PreviousClass['disabled']=false;
//                this.NextClass['disabled']=false;
//                if(this.page.pageNow==1){
//                    this.PreviousClass['disabled']=true;
//                }
//                if(this.page.pageNow==this.page.pageCount){
//                    this.NextClass['disabled']=true;
//                }
//                //页码样式
//                for(var j=0;j<this.page.pageCount;j++){
//                    this.pageNumClass[j]={'active':false};
//                }
//                if(this.page['pageNow']>0){
//                    this.pageNumClass[this.page['pageNow']-1]={'active':true};
//                }
//
//            }.bind(this));
//        }
//
//    });
//    var app=new Vue({
//        el:'#app'
//    });

//    var app=new Vue({
//        el:'#app',
//        data:{
//            questionnaire:[],
//            page:undefined,
//            pageNum:[],
//            PreviousClass:{'disabled':true},
//            NextClass:{'disabled':false},
//            pageNumClass:[]
//        },
//        methods:{
//            //var _this=this;
//            init:function(pageNow){
//                $.ajax({
//                    type:'get',
//                    url:'index.php?type=Question&do=getQuestionnaire&pageNow='+pageNow,
//                    dataType:'json',
//                    success:function(data){
//                        this.questionnaire=data[0];
//                        this.page=data[1];
//                        this.pageNum=[];
//                        for(var i=0;i<this.page.pageCount;i++){
//                            this.pageNum[i]=i+1;
//                        }
//                        //上一页、下一页样式
//                        this.PreviousClass['disabled']=false;
//                        this.NextClass['disabled']=false;
//                        if(this.page.pageNow==1){
//                            this.PreviousClass['disabled']=true;
//                        }
//                        if(this.page.pageNow==this.page.pageCount){
//                            this.NextClass['disabled']=true;
//                        }
//                        //页码样式
//                        for(var j=0;j<this.page.pageCount;j++){
//                            this.pageNumClass[j]={'active':false};
//                        }
//                        if(this.page['pageNow']>0){
//                            this.pageNumClass[this.page['pageNow']-1]={'active':true};
//                        }
//                    }.bind(this)
//                })
//            },
//            change:function(pageNow){
//                this.init(pageNow);
//            }
//        },
//        mounted:function(){
//            this.init(1)
//        }
//    });


</script>
</html>
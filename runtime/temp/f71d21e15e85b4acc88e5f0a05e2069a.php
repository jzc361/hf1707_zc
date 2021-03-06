<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:100:"D:\AppServ\www\hf170724_zc\hf1707_zc\public/../application/home\view\project\prodetails_comment.html";i:1517581102;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $proid; ?></title>
    <link rel="stylesheet" href="__CSS__/layui.css">
    <link rel="stylesheet" href="__CSS__/admin/font.css">
    <link rel="stylesheet" href="__CSS__/admin/xadmin.css">
    <link rel="stylesheet" href="__CSS__/layer.css">
    <link rel="stylesheet" href="__CSS__/bootstrap.min.css">
    <style>
        textarea{
            /*textarea固定宽高*/
            resize: none;
        }
        #comments{
            background-color: #fff;
        }
        .comment{
            border-bottom: 1px solid gainsboro;
            padding-bottom: 45px;
        }
        .comText{
            border-bottom: 1px solid gainsboro;
            padding: 10px 0 10px 0;
        }
        .comText img{
            width: 50%;
        }
        .comText span{
            margin: 5px;
        }
        .recomlist{
            margin-left: 125px;
            background-color: #f8f9fb;
            padding: 15px;
        }
        .recomment{
            cursor: pointer;
        }
        .recomment:hover{
            color: #5bc0de;
        }
    </style>
</head>
<body>
    <div id="comments" class="container">
        <!--评论区（项目）-->
        <div class="comment">
            <h4>有什么想和大家交流的?</h4>
            <textarea name="" id="comToPro" maxlength="150" cols="30" rows="8" placeholder="输入您想要跟大家交流的内容~" style="width: 100%;"></textarea>
            <div style="float: right;">
                <?php if(!session('?zc_user')): ?>
                <div>
                    <p>请登录后提问，立即 <a href="javascript:;" onclick=top.location="<?php echo url('home/Userop/showLogin'); ?>">登录</a>或<!-- onclick="parent.showLogin()"-->
                        <a href="" onclick=top.location="<?php echo url('home/Userop/showRegister'); ?>">注册</a>
                    </p>
                </div>
                <?php endif; if(session('?zc_user')): ?><div><button type="button" class="btn btn-info" onclick="comToPro()">发布评论</button></div><?php endif; ?>
            </div>
        </div>

        <!--评论列表-->
        <div id="comList">
            <!--<comlist></comlist>-->
            <?php if(is_array($comments) || $comments instanceof \think\Collection || $comments instanceof \think\Paginator): $i = 0; $__LIST__ = $comments;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;if($value['commentto']==0): ?>
            <div class="comText">
                <div style="float: left">
                    <img src="<?php echo $value['headimg']; ?>" alt="加载失败">
                </div>
                <div style="" class="recom">
                    <p><span><?php echo $value['username']; ?>：</span><span><?php echo $value['content']; ?></span></p>
                    <p><span><?php echo $value['ctime']; ?></span><span class="recomment" onclick="recomment(<?php echo $value['commentid']; ?>)">回复</span></p>
                    <!--<div class="col-xs-1"></div>-->
                    <div class="recomlist">
                        <?php if(is_array($comments) || $comments instanceof \think\Collection || $comments instanceof \think\Paginator): $i = 0; $__LIST__ = $comments;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;if($value['commentid']==$val['commentto']): ?>
                        <p><span><?php echo $val['username']; ?>：</span><span><?php echo $val['content']; ?></span></p>
                        <p><span><?php echo $val['ctime']; ?></span><span class="recomment" onclick="recomment(<?php echo $value['commentid']; ?>)">回复</span></p>
                        <?php endif; endforeach; endif; else: echo "" ;endif; ?>
                        <div id="re<?php echo $value['commentid']; ?>" style="display: none">
                            <textarea name="" id="comToUser<?php echo $value['commentid']; ?>" maxlength="100" cols="50" rows="5"></textarea>
                            <button type="button" class="btn btn-info" onclick="comToUser(<?php echo $value['commentid']; ?>)">回复</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <div></div>
        <comments></comments>

    </div>
</body>
<script src="__JS__/jquery-2.1.4.js"></script>
<!--<script src="__JS__/layui.js"></script>-->
<script src="__JS__/bootstrap.min.js"></script>
<script src="__JS__/vue.js"></script>
<script type="text/javascript" src="__STATIC__/lib/layui/layui.js" charset="utf-8"></script>
<script src="__JS__/lay/modules/layer.js"></script>
<script type="text/javascript" src="__JS__/admin/xadmin.js"></script>
<script>

    //对项目评论
    function comToPro(){
        var content=$('#comToPro').val();
        var proid=$(document).attr("title");
        $.ajax({
            url:'<?php echo url("home/Project/comToPro"); ?>',
            type:'post',
            data:{content:content,proid:proid},
            dataType:'json',
            success:function(res){
                if(res.code==30001){
                    //alert(res.msg);
                    parent.showPrompt(res.msg);//调用父页面showPrompt方法
                    //评论成功，刷新页面
                    location.reload(true);
                }else {
                    //alert(res.msg);
                    parent.showPrompt(res.msg);//调用父页面showPrompt方法
                }
            }
        });
    }

    //显示回复框
    function recomment(commentid){
        $('#re'+commentid).toggle();
    }

    //回复用户
    function comToUser(commentid){
        var content=$('#comToUser'+commentid).val();
        var proid=$(document).attr("title");
        $.ajax({
            url:'<?php echo url("home/Project/comToPro"); ?>',
            type:'post',
            data:{content:content,proid:proid,commentto:commentid},
            dataType:'json',
            success:function(res){
                //console.log(res);
                if(res.code==30001){
                    //alert(res.msg);
                    parent.showPrompt(res.msg);//调用父页面showPrompt方法
                    //评论成功，刷新页面
                    location.reload(true);
                }else {
                    //alert(res.msg);
                    parent.showPrompt(res.msg);//调用父页面showPrompt方法
                }
            }
        });
    }

    /*new Vue({
        e1:'.recom'
    });*/





/*    Vue.component('comlist',{
        template:'<?php if(is_array($comments) || $comments instanceof \think\Collection || $comments instanceof \think\Paginator): $i = 0; $__LIST__ = $comments;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>\
                    <?php if($value['commentto']==0): ?>\
                    <div class="comText">\
                        <div style="float: left">\
                            <img src="<?php echo $value['headimg']; ?>" alt="加载失败">\
                        </div>\
                        <div style="" class="recom">\
                            <p><span><?php echo $value['username']; ?>：</span><span><?php echo $value['content']; ?></span></p>\
                            <p><span><?php echo $value['ctime']; ?></span><span class="recomment" onclick="recomment()">回复</span></p>\
                            <div class="recomlist">\
                                <?php if(is_array($comments) || $comments instanceof \think\Collection || $comments instanceof \think\Paginator): $i = 0; $__LIST__ = $comments;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>\
                                <?php if($value['commentid']==$val['commentto']): ?>\
                                <p><span><?php echo $val['username']; ?>：</span><span><?php echo $val['content']; ?></span></p>\
                                <p><span><?php echo $val['ctime']; ?></span><span class="recomment" onclick="recomment()">回复</span></p>\
                                <?php endif; ?>\
                                <?php endforeach; endif; else: echo "" ;endif; ?>\
                                <recomment></recomment>\
                            </div>\
                         </div>\
                     </div>\
                     <?php endif; ?>\
                    <?php endforeach; endif; else: echo "" ;endif; ?>'
    });

    var toUser=new Vue();
    Vue.component('recomment',{
        props:['item'],
        template:'<div>\
                        <textarea name="" id="" cols="20" rows="3"></textarea>\
                        <button type="button" class="btn btn-info" onclick="comToUser()">回复</button>\
                   </div>'
    });

    Vue.component('comList',{
        template:''
    });
    var app=new Vue({
        el:'#comList'
    });*/

/*    var toUser=new Vue();

    //评论组件
    Vue.component('comments',{
        template:'<div class="comment">\
                        <h4>有什么想和大家交流的?</h4>\
                            <textarea name="" id="comToPro" maxlength="150" cols="30" rows="8" placeholder="输入您想要跟大家交流的内容~" style="width: 100%;"></textarea>\
                            <div style="float: right;">\
                            <div>\
                            <p>请登录后提问，立即 <a href="">登录</a>或\
                            <a href="">注册</a>\
                            </p>\
                            </div>\
                    <div><button type="button" class="btn btn-info">发布评论</button></div>\
                    </div>\
                    </div>',
        /!*data:function(){
            return{

            }
        },*!/
        methods:{}

        /!*beforeCreate:function() {
            $.ajax({
                url: 'Project/getComment',
                type: 'get',
                data: '',
                dataType: 'json',
                success: function (res) {
                    console.log(res);
                }
            });
        },*!/
        /!*mounted: function () {

        }*!/
    });
    var app=new Vue({
        e1:'#comments'
    });*/

</script>
</html>
<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:74:"D:\AppServ\www\tp505\public/../application/index\view\index\creatView.html";i:1516119540;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge"><!--设置ie内核浏览器下的渲染模式-->
    <meta name="renderer" content="webkit"><!--设置成网页以webkit(极速模式)来渲染页面-->
    <meta name="viewport" content="width=device-width,initial-scale=1"><!--设置网页宽度和访问设备宽度保持一致，且显示比例1:1，-->
    <title>创建问卷</title>
    <link rel="stylesheet" href="__CSS__/bootstrap.min.css">
    <link rel="stylesheet" href="__CSS__/createView.css">

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
                            <a class="dropdown-toggle" style="background: none" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span>HF70724<em class="caret"></em></a>
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
<div style="height: 80px;background-color: #F7F8F8;width: 100%;margin-bottom: 40px">
    <div class="container">
        <h2 style="font-size:24px;color: #30a6f5;line-height: 80px;margin: 0">创建调查问卷</h2>
    </div>
</div>
<div class="container">
    <form id="createForm" class="form-horizontal" action=""  method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="q_title" class="col-sm-3 col-md-2 control-label" style="font-size: 24px;color: #30a6f5;">调查名称：</label>
            <div class="col-sm-9 col-md-10">
                <input type="text" name="q_title" class="form-control input-lg" id="q_title">
            </div>
        </div>
        <button type="button" id="create" class="btn btn-primary btn-lg center-block">立即创建</button>
    </form>
    <div style="font-size: 18px;color: #cccccc;border-top: 1px solid #cccccc;margin-top: 30px;text-align: center">
        <span style="color:#888888;position: relative;top: -11px; font-style: normal;padding: 0 6px; background-color: #fff;">
            或选择以下方式创建
        </span>
    </div>
</div>
<div class="container-fluid">
    <div class="row center-block block_width">
        <div class="col-xs-12 col-sm-6 col-lg-4">
            <div class="create_block">
                <div class="details" style="margin: 28px 20px 28px 26px;">
                    <img src="__STATIC__/img/createView/template-blue.png" alt="图片加载失败">
                </div>
                <div class="details">
                    <div class="details_title">选择模板</div>
                    <div class="details_info">使用问卷星提供的专业模板</div>
                    <button class="btn btn-default btn-lg" style="">创建</button>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-lg-4">
            <div class="create_block" style="width: 400px">
                <div class="details" style="margin: 28px 20px 28px 26px;">
                    <img src="__STATIC__/img/createView/text-blue.png" alt="图片加载失败">
                </div>
                <div class="details">
                    <div class="details_title">导入文本</div>
                    <div class="details_info">自由编辑文本自动生成问卷</div>
                    <button class="btn btn-default btn-lg" style="">创建</button>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-lg-4">
            <div class="create_block">
                <div class="details" style="margin: 28px 20px 28px 26px;">
                    <img src="__STATIC__/img/createView/service-blue.png" alt="图片加载失败">
                </div>
                <div class="details">
                    <div class="details_title">录入服务</div>
                    <div class="details_info">人工协助录入问卷更便捷</div>
                    <button class="btn btn-default btn-lg" style="">创建</button>
                </div>
            </div>

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
</body>
<script src="__JS__/jquery-2.1.4.js"></script>
<script src="__JS__/bootstrap.min.js"></script>
<script>
    $(function(){
        $("#create").click(function(){
//            alert($("#q_title").val());
            if($("#q_title").val()!='' && $("#q_title").val()!=null){
                $.ajax({
                    type:'post',
//                    url:'index.php?type=Question&do=createQuestionnaire',
                    url:"<?php echo url('index/Index/createQuestionnaire'); ?>",
                    dataType:'json',
                    data:{'q_title':$("#q_title").val()},
                    success:function(res){
                        if(res.code==20001){
                            alert(res.msg);
                            window.location.href="<?php echo url('index/Index/showDesign'); ?>?q_id="+res.data;
                        }else{
                            alert(res.msg);
                        }
                    }
                });
            }else{
                alert("请输入问卷标题");
            }
        })
    })
</script>
</html>
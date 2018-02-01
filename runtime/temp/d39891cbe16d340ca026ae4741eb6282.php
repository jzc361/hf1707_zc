<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:75:"D:\AppServ\www\hf1707_zc\public/../application/home\view\user\settings.html";i:1517361243;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge"><!--设置ie内核浏览器下的渲染模式-->
    <meta name="renderer" content="webkit"><!--设置成网页以webkit(极速模式)来渲染页面-->
    <meta name="viewport" content="width=device-width,initial-scale=1"><!--设置网页宽度和访问设备宽度保持一致，且显示比例1:1，-->
    <title>个人设置</title>
    <link rel="stylesheet" href="__CSS__/bootstrap.min.css">
    <link rel="stylesheet" href="__CSS__/home/userView.css">
    <script src="__JS__/jquery-2.1.4.js"></script>
    <script src="__JS__/bootstrap.min.js"></script>
</head>
<style>
    .page_title {
        padding: 10px 20px;
        font-size: 25px;
        line-height: 45px;
    }
    .control-label{
        text-align: right;
        padding-top: 7px;
        margin-top: 0;
        margin-bottom: 0;
    }
    .fileupload {
        width: 97px;
        height: 39px;
        cursor: pointer;
        overflow: hidden;
        display: inline-block;
        background: url(__STATIC__/img/home/userView/savecover.png);
        text-align: center;
        line-height: 39px;
        color: #fff;
        margin-top: 4px;
    }
    .filebox{
        cursor:pointer;
        padding: 0;
        height: 39px;
        width: 97px;
        filter: alpha(opacity=0);
        -moz-opacity: 0;
        -khtml-opacity: 0;
        opacity: 0;
    }

</style>
<body>
<div>
    <div class="page_title">
        个人设置
    </div>
    <div class="col-xs-8">
        <form class="form-horizontal" role="form" id="info_form">
            <div class="form-group">
                <label for="account" class="col-xs-3 control-label">会员帐号:</label>
                <div class="col-xs-7">
                    <input type="text" class="form-control" id="account" name="account"  disabled="true" value="<?php echo $zc_user['username']; ?>"/>
                </div>
            </div>
            <div class="form-group">
                <label for="telephone" class="col-xs-3 control-label">手机号码:</label>
                <div class="col-xs-7">
                    <input type="number" class="form-control" id="telephone" name="telephone"  disabled="true" value="<?php echo $zc_user['telephone']; ?>"/>
                </div>
                <div  class="col-xs-2">
                    <a href="/zc4/index.php?ctl=settings&act=mail_change">修改</a>
                </div>
            </div>
            <div class="form-group">
                <label for="sex" class="col-xs-3 control-label">性别:</label>
                <div class="col-xs-4">
                    <select name="sex" id="sex" class="form-control">
                        <option value="0" <?php if($zc_user['sex']==0): ?>selected<?php endif; ?>>未知</option>
                        <option value="1" <?php if($zc_user['sex']==1): ?>selected<?php endif; ?>>男</option>
                        <option value="2" <?php if($zc_user['sex']==2): ?>selected<?php endif; ?>>女</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="province" class="col-xs-3 control-label">所在地:</label>
                <div class="col-xs-3">
                    <select name="province" id="province" class="form-control">
                        <option value="0">请选择省份</option>
                    </select>
                </div>
                <div class="col-xs-3">
                    <select name="city" id="city" class="form-control">
                        <option value="0" >请选择城市</option>
                    </select>
                </div>
                <div class="col-xs-3">
                    <select name="county" id="county" class="form-control">
                        <option value="0" >请选择地区</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="introduction" class="col-xs-3 control-label">自我介绍:</label>
                <div class="col-xs-7">
                    <textarea name="introduction" id="introduction" class="form-control" rows="3"></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-offset-3 col-xs-7">
                    <button type="button" id="infoBtn" class="btn btn-primary">保存最新的设置</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-xs-4">
        <p style="font-size:14px">个人头像</p>
        <img id="avatar" style="width: 120px;height: 120px" src="<?php echo $zc_user['headimg']; ?>" />
        <div style="margin-top: 10px">
            <form id="img_form" action="<?php echo url('home/User/headImg'); ?>" method="post" enctype="multipart/form-data">
                <label class="fileupload">
                    <input type="file" class="filebox" name="headImg" id="headImg" />
                </label>
            </form>
        </div>
    </div>
    <div class="blank"></div>
</div>

</body>
<script>
    var $avatar=$('#avatar');
    var $province=$("#province");
    var $county=$("#county");
    var $city=$("#city");
    var user_province=<?php echo $zc_user['province']; ?>;
    var user_city=<?php echo $zc_user['city']; ?>;
    var user_county=<?php echo $zc_user['county']; ?>;

    $(function(){
        //头像上传
        $("input[name='headImg']").change(function () {
            preview(this.files,$avatar);
            var formData = new FormData($("#img_form")[0]);
            console.log(formData);
            $.ajax({
                url: "<?php echo url('home/User/headImg'); ?>",
                type: "POST",
                data: formData,
                dataType: "json",
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                success: function(res) {
                    console.log(res);
//                    if(res.code==20005){
//                        alert(res.msg);
//                    }else{
//                        alert(res.msg);
//                    }
                },
                error: function(res) {
                }
            });
        });
        //获取省份
        $.ajax({
            type:'get',
//                    url:'index.php?type=Question&do=createQuestionnaire',
            url:"<?php echo url('home/User/getAddr'); ?>",
            dataType:'json',
//            data:{'q_title':$("#q_title").val()},
            success:function(res){
                console.log(res);
                if(res.code==20007){
                    $province.children('option :lt(0)').remove();
                    for(var i=0;i<res.data.length;i++){
                        //省
                        if(res.data[i].type==0){
                            if(user_province==res.data[i].id){
                                $province.append("<option value='"+res.data[i].id+"' selected>"+res.data[i].name+"</option>");
                            }else{
                                $province.append("<option value='"+res.data[i].id+"'>"+res.data[i].name+"</option>");
                            }
                        }
                        //市
                        if(res.data[i].type==1){
                            if(user_city==res.data[i].id){
                                $city.append("<option value='"+res.data[i].id+"' selected>"+res.data[i].name+"</option>");
                            }else{
                                $city.append("<option value='"+res.data[i].id+"'>"+res.data[i].name+"</option>");
                            }
                        }

                        //区
                        if(res.data[i].type==2){
                            if(user_county==res.data[i].id){
                                $county.append("<option value='"+res.data[i].id+"' selected>"+res.data[i].name+"</option>");
                            }else{
                                $county.append("<option value='"+res.data[i].id+"'>"+res.data[i].name+"</option>");
                            }
                        }
                    }
                }else{
                    alert(res.msg);
                }

            }
        });
        //获取城市
        $province.change(function(){
            if ($province.val()!=0){
                $.ajax({
                    type:'get',
//                    url:'index.php?type=Question&do=createQuestionnaire',
                    url:"<?php echo url('home/User/getCity'); ?>?province="+$province.val(),
                    dataType:'json',
//            data:{'q_title':$("#q_title").val()},
                    success:function(res){
                        console.log(res);
                        if(res.code==20007){
                            $city.children('option:gt(0)').remove();
                            $county.children("option:gt(0)").remove();
                            for(var i=0;i<res.data.length;i++){
                                $city.append("<option value='"+res.data[i].id+"'>"+res.data[i].name+"</option>");
                            }
                        }else{
                            alert(res.msg);
                        }
                    }
                });

            }

        });
        //获取地区
        $city.change(function(){
            if ($city.val()!=0){
                $.ajax({
                    type:'get',
                    url:"<?php echo url('home/User/getCounty'); ?>?city="+$city.val(),
                    dataType:'json',
//            data:{'q_title':$("#q_title").val()},
                    success:function(res){
                        console.log(res);
                        if(res.code==20007){
                            $county.children("option:gt(0)").remove();
                            for(var i=0;i<res.data.length;i++){
                                $county.append("<option value='"+res.data[i].id+"'>"+res.data[i].name+"</option>");
                            }
                        }else{
                            alert(res.msg);
                        }
                    }
                });

            }

        });
        //保存最新设置
        $("#infoBtn").click(function(){
            var formData =$("#info_form").serialize();
            $.ajax({
                url: "<?php echo url('home/User/updateInfo'); ?>",
                type: "POST",
                data: formData,
                dataType: "json",
                success: function(res) {
                    console.log(res);
                    if(res.code==20005){
                        alert(res.msg);
                    }else{
                        alert(res.msg);
                    }
                },
                error: function(res) {
                }
            });
        });
    });
    //预览图片
    function preview(files,$preview){
        console.log(files);
        var reader= new FileReader();
        reader.readAsDataURL(files[0]);
        reader.onload = function(){
            $preview.attr("src",reader.result);
        };

//        for(var i=0;i<files.length;i++){
//
////            $preview.attr('src',)=reader[this.i].result;
////            reader[i].i=i;
////            reader[i].onload = function(){
////                var $img=$("<img style='max-width: 120px;max-height: 120px' src='"+reader[this.i].result+"'/>");
////                $preview.append($img);
////            };
//        }
    }


</script>
</html>
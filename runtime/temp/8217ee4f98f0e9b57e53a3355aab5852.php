<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:83:"D:\AppServ\www\hf1707_zc\public/../application/admin\view\promanage\proDetails.html";i:1517447918;}*/ ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>欢迎页面-X-admin2.0</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="stylesheet" href="__CSS__/admin/font.css">
    <link rel="stylesheet" href="__CSS__/admin/xadmin.css">
    <link rel="stylesheet" href="__CSS__/bootstrap.min.css">
</head>

<body>

<div class="x-body" id="vueDiv">
    <!--填写理由模态框-->
    <div id="checkBtn" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">不合格原因：</h4>
                </div><!--标题-->
                <div class="modal-body">
                    <div id="failreason" contenteditable style="width: 100%;height: 100px;border: 1px solid gray;"></div>
                </div><!--内容-->
                <div class="modal-footer">
                    <button type="button" onclick="proDispass(<?php echo $promsg[0]['projectid']; ?>)" class="btn btn-primary" >确定</button>
                </div><!--脚注-->
            </div>
        </div>
    </div>
    <!--详情显示-->
    <div v-if="'<?php echo $promsg[0]['statename']; ?>'=='待审核'" style="margin-bottom: 15px;" >
        <button type="button" onclick="proPass()"  value="<?php echo $promsg[0]['projectid']; ?>" class="td-status layui-btn layui-btn-normal layui-btn-mini">通过审核</button>
        <button type="button"  data-toggle="modal" data-target="#checkBtn"  value="<?php echo $promsg[0]['projectid']; ?>" class="td-status layui-btn layui-btn-normal layui-btn-mini">不通过</button>
    </div>
    <div>基本信息：</div>
    <table class="layui-table" style="text-align: center">
        <tr>
            <td style="text-align: center">发起人</td>
            <td style="text-align: center"><?php echo $promsg[0]['username']; ?></td>
            <td style="text-align: center">项目名称</td>
            <td colspan="3" style="text-align: center"><?php echo $promsg[0]['projectname']; ?></td>
            <td rowspan="3" style="width: 260px;">
                <img src="<?php echo $promsg[0]['projectimg']; ?>" alt="" style="width: 100%;">
            </td>
        </tr>
        <tr>
            <td style="text-align: center">众筹天数</td>
            <td style="text-align: center"><?php echo $promsg[0]['daysnumber']; ?>天</td>
            <td style="text-align: center">众筹金额</td>
            <td style="text-align: center">￥<?php echo $promsg[0]['tolamount']; ?>元</td>
            <td style="text-align: center">状态</td>
            <td style="text-align: center"><?php echo $promsg[0]['statename']; ?></td>
        </tr>
        <tr v-if="'<?php echo $promsg[0]['statename']; ?>'=='待审核'">
            <td style="text-align: center">发起时间</td>
            <td colspan="5" style="text-align: center"><?php echo $promsg[0]['createtime']; ?></td>
        </tr>
        <tr v-if="'<?php echo $promsg[0]['statename']; ?>'!='待审核'">
            <td style="text-align: center">发起时间</td>
            <td style="text-align: center"><?php echo $promsg[0]['createtime']; ?></td>
            <td style="text-align: center">开始时间</td>
            <td style="text-align: center"><?php echo $promsg[0]['begintime']; ?></td>
            <td style="text-align: center">结束时间</td>
            <td style="text-align: center"><?php echo $promsg[0]['endtime']; ?></td>
        </tr>
    </table>
    <div>回报信息：</div>
    <table class="layui-table">
        <tr>
            <td></td>
            <td>物品展示</td>
            <td>支付金额</td>
            <td>限额</td>
            <td>回报描述</td>
        </tr>
        <?php if(is_array($returnmsg) || $returnmsg instanceof \think\Collection || $returnmsg instanceof \think\Paginator): $i = 0; $__LIST__ = $returnmsg;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
        <tr>
            <td>回报<?php echo $i; ?></td>
            <td><img src="<?php echo $val['imgs']; ?>" alt="" style="width: 150px;height: 150px;"></td>
            <td>￥<?php echo $val['price']; ?>元</td>
            <td><?php echo $val['limitcount']; ?>份</td>
            <td><?php echo $val['introduce']; ?></td>
        </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
</div>

</body>
<script src="__JS__/jquery-2.1.4.js"></script>
<script src="__JS__/vue.js"></script>
<script src="__JS__/bootstrap.min.js"></script>
<script>
    //通过审核
    function proPass(){
        var btn=event.target;
        var projectid=$(btn).attr('value');
        console.log(projectid);
        if(confirm("通过审核？")){
            $.ajax({
                type: "post",
                url: "<?php echo url('admin/promanage/proPass'); ?>",
                data: {projectid:projectid},
                dataType: "json",
                success: function (responseData){
                    alert(responseData.msg);
                    top.location.href="<?php echo url('admin/Promanage/index'); ?>";
                },
                error:function(){
                    alert("error");
                }
            });
        }

    }
    //不通过
    function proDispass(id){
       // var btn=event.target;
        var failreason=$("#failreason").text();
        console.log(id,failreason);

        if(confirm("审核不通过？")){
            $.ajax({
                type: "post",
                url: "<?php echo url('admin/promanage/proDispass'); ?>",
                data: {projectid:id,failreason:failreason},
                dataType: "json",
                success: function (responseData){
                    alert(responseData.msg);
                    top.location.href="<?php echo url('admin/Promanage/index'); ?>";
                },
                error:function(){
                    alert("error");
                }
            });
        }
    }

    new Vue({
        el : '#vueDiv',
        //数据
        data:{
         //   failreason:''

        },
        //方法
        methods:{
//            proDispass:function($projectid){
//                console.log($projectid,this.failreason);
//            }
        },

        mounted:function(){
            //发送ajax
        }
    });
//    layui.use(['form','layer'], function(){
//        $ = layui.jquery;
//        var form = layui.form
//                ,layer = layui.layer;
//    });
</script>
</html>
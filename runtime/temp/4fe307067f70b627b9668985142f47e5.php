<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:88:"D:\AppServ\www\hf1707_zc\public/../application/admin\view\promanage\limitProDetails.html";i:1517390183;}*/ ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>限时众筹详情</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="stylesheet" href="__CSS__/admin/font.css">
    <link rel="stylesheet" href="__CSS__/admin/xadmin.css">
</head>
<body>
<div class="x-body" id="vueDiv">
    <div>基本信息：</div>
    <table class="layui-table" style="text-align: center">
        <tr>
            <td style="text-align: center">发起人</td>
            <td style="text-align: center">官方发起</td>
            <td style="text-align: center">项目名称</td>
            <td colspan="3" style="text-align: center"><?php echo $promsg[0]['projectname']; ?></td>
            <td rowspan="3" style="width: 260px;">
                <img src="<?php echo $promsg[0]['projectimg']; ?>" alt="" style="width: 100%;">
            </td>
        </tr>
        <tr>
            <td style="text-align: center">支持金额</td>
            <td style="text-align: center">￥<?php echo $promsg[0]['price']; ?>元</td>
            <td>限额</td>
            <td><?php echo $promsg[0]['limitcount']; ?>份</td>
            <td style="text-align: center">状态</td>
            <td style="text-align: center"><?php echo $promsg[0]['limitstatename']; ?></td>
        </tr>
        <tr>
            <td style="text-align: center">发起时间</td>
            <td style="text-align: center"><?php echo $promsg[0]['createtime']; ?></td>
            <td style="text-align: center">开始时间</td>
            <td style="text-align: center"><?php echo $promsg[0]['begintime']; ?></td>
            <td style="text-align: center">结束时间</td>
            <td style="text-align: center"><?php echo $promsg[0]['endtime']; ?></td>
        </tr>
    </table>
    <div>项目进度：</div>
    <table class="layui-table">

    </table>

</div>

</body>
<script src="__JS__/jquery-2.1.4.js"></script>
<script src="__JS__/vue.js"></script>
<script>
    new Vue({
        el : '#vueDiv',
        //数据
        data:{

        },
        //方法
        methods:{
        },

        mounted:function(){
            //发送ajax
        }
    });

</script>
</html>
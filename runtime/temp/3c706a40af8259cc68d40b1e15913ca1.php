<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:89:"D:\AppServ\www\hf170724_zc\hf1707_zc\public/../application/home\view\user\proDetails.html";i:1517448844;}*/ ?>
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
        <tr>
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
    <div>进度：</div>
</div>

</body>
<script src="__JS__/jquery-2.1.4.js"></script>
<script src="__JS__/vue.js"></script>
<script src="__JS__/bootstrap.min.js"></script>
<script>
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
</script>
</html>
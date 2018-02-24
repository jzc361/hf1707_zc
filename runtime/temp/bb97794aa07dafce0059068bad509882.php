<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:84:"D:\AppServ\www\hf170724_zc\hf1707_zc\public/../application/home\view\user\focus.html";i:1517836116;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge"><!--设置ie内核浏览器下的渲染模式-->
    <meta name="renderer" content="webkit"><!--设置成网页以webkit(极速模式)来渲染页面-->
    <meta name="viewport" content="width=device-width,initial-scale=1"><!--设置网页宽度和访问设备宽度保持一致，且显示比例1:1，-->
    <title>关注的项目</title>
    <link rel="stylesheet" href="__CSS__/bootstrap.min.css">
    <link rel="stylesheet" href="__CSS__/bootstrapValidator.min.css">
    <link rel="stylesheet" href="__CSS__/home/userView.css">
    <script src="__JS__/jquery-2.1.4.js"></script>
    <script src="__JS__/bootstrap.min.js"></script>
    <script src="__JS__/bootstrapValidator.min.js"></script>
</head>
<style>
    @media (min-width: 768px) {

    }
    @media (max-width: 767px) {

    }
    #my_table{
        text-align: center
    }
    #my_table th{
        text-align: center
    }
</style>
<body>

<div class="container-fluid" style="min-height: 880px">
    <div class="page_title">关注的项目</div>
    <table class="table table-hover table-responsive" id="my_table" >
        <thead style="text-align: center" >
        <tr>
            <th>项目名称</th>
            <th width="100" style="text-align: center">获得支持</th>
            <th width="100">支持人数</th>
            <th width="100">达成目标</th>
            <th width="100">剩余时间</th>
            <th width="100">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($focusList) || $focusList instanceof \think\Collection || $focusList instanceof \think\Paginator): $i = 0; $__LIST__ = $focusList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <tr>
            <td>
                <div class="media">
                    <a href="#" class="pull-left">
                        <img class="media-object"  height="45px" width="70px" src="__STATIC__/<?php echo $vo['projectimg']; ?>" alt='' />
                    </a>
                    <div class="media-body">
                        <?php echo $vo['projectname']; ?>
                    </div>
                </div>
            </td>
            <td>￥<?php echo $vo['curamount']; ?></td>
            <td><?php echo $vo['surport_count']; ?></td>
            <td><?php echo round($vo['curamount']/$vo['tolamount']*100,2); ?>%</td>
            <td><?php echo $vo['resttime']; ?></td>
            <td><a href="#" onclick="cancelFocus(<?php echo $vo['focusid']; ?>)">取消关注</a></td>
        </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>
    <div style="text-align: center"><?php echo $focusList->render(); ?></div>

</div>
<div class="blank"></div>
</body>
<script>
//    if(){
//        location.href="<?php echo url('home/user/data/'); ?>?page="currenrPage -1;
//    }
    $(function(){

    });
    function cancelFocus(id){
        $.ajax({
            type:'get',
            url:"<?php echo url('home/User/cancelFocus'); ?>?id="+id,
            dataType:'json',
            success:function(res){
                console.log(res);
                if(res.code==20003){
                    alert(res.msg);
                    window.location.reload();
                }else{
                    alert(res.msg);
                }

            }
        });
    }
</script>

</html>
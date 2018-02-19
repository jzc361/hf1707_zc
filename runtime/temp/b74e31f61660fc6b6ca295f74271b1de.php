<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:86:"D:\AppServ\www\hf170724_zc\hf1707_zc\public/../application/home\view\user\support.html";i:1519050934;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge"><!--设置ie内核浏览器下的渲染模式-->
    <meta name="renderer" content="webkit"><!--设置成网页以webkit(极速模式)来渲染页面-->
    <meta name="viewport" content="width=device-width,initial-scale=1"><!--设置网页宽度和访问设备宽度保持一致，且显示比例1:1，-->
    <title>支持的项目</title>
    <link rel="stylesheet" href="__CSS__/bootstrap.min.css">
    <link rel="stylesheet" href="__CSS__/bootstrapValidator.min.css">
    <link rel="stylesheet" href="__CSS__/home/userView.css">
    <link rel="stylesheet" href="__CSS__/admin/font.css">
    <link rel="stylesheet" href="__CSS__/admin/xadmin.css">
    <script src="__JS__/jquery-2.1.4.js"></script>
    <script src="__JS__/bootstrap.min.js"></script>
    <script src="__JS__/bootstrapValidator.min.js"></script>
</head>
<style>
    @media (min-width: 768px) {

    }
    @media (max-width: 767px) {

    }
    .my_table{
        text-align: center
    }
    .my_table th{
        text-align: center
    }
</style>
<body>

<div class="container-fluid" style="min-height: 880px">
    <div class="page_title">支持的项目</div>
    <!-- tab标签 -->
    <ul class="nav nav-tabs money_tabs" id="my_tabs">
        <li class="active"><a href="#pro1" data-toggle="tab">全部</a></li>
        <li><a href="#pro2" data-toggle="tab" >已支付</a></li>
        <li><a href="#pro3" data-toggle="tab">未支付</a></li>
    </ul>
    <!-- 每个tab页对应的内容 -->
    <div  class="tab-content">
        <div id="pro1" class="tab-pane fade in active">
            <table class="table table-hover table-responsive my_table" id="my_table" >
                <thead style="text-align: center" >
                <tr>
                    <th>项目名称</th>
                    <th width="100" style="text-align: center">金额</th>
                    <th width="80">运费</th>
                    <th width="150">状态</th>
                    <th width="100">操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($allList) || $allList instanceof \think\Collection || $allList instanceof \think\Paginator): $i = 0; $__LIST__ = $allList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <tr id="<?php echo $vo['ordersid']; ?>">
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
                    <td>￥<?php echo $vo['ordersprice']; ?></td>
                    <td>-</td>
                    <td><?php echo $vo['orderstate']; ?></td>
                    <td>
                        <?php if($vo['orderstate']=='未支付'): ?>
                        <p><button class="btn btn-danger btn-xs" onclick='x_admin_show("项目详情","to?id=<?php echo $vo['ordersid']; ?>")'>立即支付</button></p>
                        <?php endif; ?>
                        <p><a href="javascript:;" onclick='x_admin_show("项目详情","supportDetail?id=<?php echo $vo['ordersid']; ?>")'>查看详情</a></p>
                        <p><a href="javascript:;" onclick='orderDelete(<?php echo $vo['ordersid']; ?>)'>删除</a></p>
                        <?php if($vo['orderstate']!='交易关闭'): ?>
                        <p><a href="javascript:;" onclick='orderCancel(<?php echo $vo['ordersid']; ?>)'>取消订单</a></p>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            </table>
            <div style="text-align: center"><?php echo $allList->render(); ?></div>
        </div>
        <div id="pro2" class="tab-pane fade">
            <table class="table table-hover table-responsive my_table" id="my_table2" >
                <thead style="text-align: center" >
                <tr>
                    <th>项目名称</th>
                    <th width="100" style="text-align: center">金额</th>
                    <th width="80">运费</th>
                    <th width="150">状态</th>
                    <th width="100">操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($paidList) || $paidList instanceof \think\Collection || $paidList instanceof \think\Paginator): $i = 0; $__LIST__ = $paidList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
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
                    <td>￥<?php echo $vo['ordersprice']; ?></td>
                    <td>-</td>
                    <td><?php echo $vo['orderstate']; ?></td>
                    <td>
                        <?php if($vo['orderstate']=='未支付'): ?>
                        <p><button class="btn btn-danger btn-xs" onclick='x_admin_show("项目详情","to?id=<?php echo $vo['ordersid']; ?>")'>立即支付</button></p>
                        <?php endif; ?>
                        <p><a href="javascript:;" onclick='x_admin_show("项目详情","supportDetail?id=<?php echo $vo['ordersid']; ?>")'>查看详情</a></p>
                        <p><a href="javascript:;" onclick='orderDelete(<?php echo $vo['ordersid']; ?>)'>删除</a></p>
                        <?php if($vo['orderstate']!='交易关闭'): ?>
                        <p><a href="javascript:;" onclick='orderCancel(<?php echo $vo['ordersid']; ?>)'>取消订单</a></p>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            </table>
            <div style="text-align: center"><?php echo $paidList->render(); ?></div>
        </div>
        <div id="pro3" class="tab-pane fade">
            <table class="table table-hover table-responsive my_table" id="my_table3" >
                <thead style="text-align: center" >
                <tr>
                    <th>项目名称</th>
                    <th width="100" style="text-align: center">金额</th>
                    <th width="80">运费</th>
                    <th width="150">状态</th>
                    <th width="100">操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($unpaidList) || $unpaidList instanceof \think\Collection || $unpaidList instanceof \think\Paginator): $i = 0; $__LIST__ = $unpaidList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
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
                    <td>￥<?php echo $vo['ordersprice']; ?></td>
                    <td>-</td>
                    <td><?php echo $vo['orderstate']; ?></td>
                    <td>
                        <?php if($vo['orderstate']=='未支付'): ?>
                        <p><button class="btn btn-danger btn-xs" onclick='x_admin_show("项目详情","to?id=<?php echo $vo['ordersid']; ?>")'>立即支付</button></p>
                        <?php endif; ?>
                        <p><a href="javascript:;" onclick='x_admin_show("项目详情","supportDetail?id=<?php echo $vo['ordersid']; ?>")'>查看详情</a></p>
                        <p><a href="javascript:;" onclick='orderDelete(<?php echo $vo['ordersid']; ?>)'>删除</a></p>
                        <?php if($vo['orderstate']!='交易关闭'): ?>
                        <p><a href="javascript:;" onclick='orderCancel(<?php echo $vo['ordersid']; ?>)'>取消订单</a></p>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            </table>
            <div style="text-align: center"><?php echo $unpaidList->render(); ?></div>
        </div>
    </div>


</div>
<!-- 模态框（Modal） -->
<div class="blank"></div>
</body>
<!--<script type="text/javascript" src="__JS__/layui.js" charset="utf-8"></script>-->

<script type="text/javascript" src="__STATIC__/lib/layui/layui.js" charset="utf-8"></script>
<script type="text/javascript" src="__JS__/admin/xadmin.js"></script>
<script>
    function orderDelete(id){
        if(confirm('确认删除该订单？')){
            $.ajax({
                url:'<?php echo url("home/Order/orderDelete"); ?>?orderId='+id,
                type:'get',
                dataType:'json',
                success:function(res){
                    if(res.code==20003){
//                        $('#'+id).remove();
                        window.location.reload(true);
                        alert(res.msg)
                    }else{
                        alert(res.msg)
                    }
                }
            });
        }
    }
    function orderCancel(id){
        if(confirm('确认取消该订单？')){
            $.ajax({
                url:'<?php echo url("home/Order/orderCancel"); ?>?orderId='+id,
                type:'get',
                dataType:'json',
                success:function(res){
                    if(res.code==20003){
                        window.location.reload(true);
                        alert(res.msg)
                    }else{
                        alert(res.msg)
                    }
                }
            });
        }
    }

</script>

</html>
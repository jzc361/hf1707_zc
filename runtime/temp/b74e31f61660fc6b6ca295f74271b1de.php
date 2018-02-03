<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:86:"D:\AppServ\www\hf170724_zc\hf1707_zc\public/../application/home\view\user\support.html";i:1517631693;}*/ ?>
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
    <div class="page_title">支持的项目</div>
    <table class="table table-hover table-responsive" id="my_table" >
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
        <?php if(is_array($supportList) || $supportList instanceof \think\Collection || $supportList instanceof \think\Paginator): $i = 0; $__LIST__ = $supportList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
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
            <td><a href="#" onclick="detail()">查看详情</a></td>
        </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>
    <div style="text-align: center"><?php echo $supportList->render(); ?></div>

</div>
<!-- 模态框（Modal） -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">添加配送地址</h4>
            </div>
            <div class="modal-body">
                <form id="defaultForm" method="post" class="form-horizontal" action="<?php echo url('/home/User/addAddr'); ?>">
                    <div class="form-group">
                        <label class="col-xs-3 control-label">收货人姓名：</label>
                        <div class="col-xs-4">
                            <input type="text" class="form-control" name="reverName" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3 control-label">地区：</label>
                        <div class="col-xs-4">
                            <select name="province" id="province" class="form-control">
                                <option value="" rel="0">请选择省份</option>
                                <option value="安徽" rel="3" >安徽</option>
                                <option value="澳门" rel="396" >澳门</option>
                                <option value="北京" rel="52" >北京</option>
                                <option value="福建" rel="4" >福建</option>
                                <option value="甘肃" rel="5" >甘肃</option>
                                <option value="广东" rel="6" >广东</option>
                                <option value="广西" rel="7" >广西</option>
                                <option value="贵州" rel="8" >贵州</option>
                                <option value="海南" rel="9" >海南</option>
                                <option value="河北" rel="10" >河北</option>
                                <option value="黑龙江" rel="12" >黑龙江</option>
                                <option value="河南" rel="11" >河南</option>
                                <option value="湖北" rel="13" >湖北</option>
                                <option value="湖南" rel="14" >湖南</option>
                                <option value="江苏" rel="16" >江苏</option>
                                <option value="江西" rel="17" >江西</option>
                                <option value="吉林" rel="15" >吉林</option>
                                <option value="辽宁" rel="18" >辽宁</option>
                                <option value="内蒙古" rel="19" >内蒙古</option>
                                <option value="宁夏" rel="20" >宁夏</option>
                                <option value="青海" rel="21" >青海</option>
                                <option value="山东" rel="22" >山东</option>
                                <option value="上海" rel="321" >上海</option>
                                <option value="山西" rel="23" >山西</option>
                                <option value="陕西" rel="24" >陕西</option>
                                <option value="四川" rel="26" >四川</option>
                                <option value="台湾" rel="397" >台湾</option>
                                <option value="天津" rel="343" >天津</option>
                                <option value="香港" rel="395" >香港</option>
                                <option value="西藏" rel="28" >西藏</option>
                                <option value="新疆" rel="29" >新疆</option>
                                <option value="云南" rel="30" >云南</option>
                                <option value="浙江" rel="31" >浙江</option>
                                <option value="重庆" rel="394" >重庆</option>
                            </select>
                        </div>
                        <div class="col-xs-4">
                            <select name="city" id="city" class="form-control">
                                <option value="" rel="0">请选择城市</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3 control-label">详细地址：</label>
                        <div class="col-xs-8">
                            <textarea name="detailAddr" id="detailAddr" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3 control-label">邮编：</label>
                        <div class="col-xs-4">
                            <input type="text" class="form-control" name="Postcode"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3 control-label">手机：</label>
                        <div class="col-xs-8">
                            <input type="text" class="form-control" name="telephone"/>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary"  id="submitBtn">保存</button>
                <button type="button" class="btn btn-default" id="resetBtn">重置</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<div class="blank"></div>
</body>
<script>
    function getDetail(){
        $('#myModel').modal('show')
    }
    $(function(){
        $("#addBtn").click(function(){
            $('#myModal').modal('show')
        });

        //正则校验
        $('#defaultForm').bootstrapValidator({
//        live: 'disabled',
            message: '该值不能为空',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                reverName: {
                    validators: {
                        notEmpty: {
                            message: '收货人不能为空'
                        }
                    }
                },
                province: {
                    validators: {
                        notEmpty: {
                            message: '省份不能为空'
                        }
                    }
                },
                city: {
                    validators: {
                        notEmpty: {
                            message: '城市不能为空'
                        }
                    }
                },
                detailAddr: {
                    validators: {
                        notEmpty: {
                            message: '详细地址不能为空'
                        }
                    }
                },
                Postcode: {
                    validators: {
                        notEmpty: {
                            message: '邮编地址不能为空'
                        }
                    }
                },
                telephone: {
                    validators: {
                        notEmpty: {
                            message: '电话号码不能为空'
                        }
                    }
                }
            }
        });
        $('#resetBtn').click(function() {
            $('#defaultForm').data('bootstrapValidator').resetForm(true);
        });
        $('#submitBtn').click(function() {
            $('#defaultForm').submit();
        });

    });

</script>

</html>
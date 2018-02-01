<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:83:"D:\AppServ\www\hf1707_zc\public/../application/admin\view\promanage\allProView.html";i:1517456693;}*/ ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>全部项目</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />

    <link rel="stylesheet" href="__CSS__/admin/font.css">
    <link rel="stylesheet" href="__CSS__/admin/xadmin.css">

</head>

<body>
<div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="">首页</a>
        <a href="">演示</a>
        <a>
            <cite>导航元素</cite></a>
      </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
</div>
<div class="x-body" id="vueDiv">
    <div class="layui-row">
        <form class="x-so">
            <span style="font-size: 17px;">项目类型：</span>
            <select name="1"  style="width: 160px;height: 38px;" id="selectProSort" >
                <option value="all">全部</option>
                <?php if(is_array($proSort) || $proSort instanceof \think\Collection || $proSort instanceof \think\Paginator): $i = 0; $__LIST__ = $proSort;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;if(session('selectsortid')): ?>
                <option  v-if="<?php echo $selectsortid; ?>==<?php echo $val['sortid']; ?>" selected  value="<?php echo $val['sortid']; ?>"><?php echo $val['sortname']; ?></option>
                <?php endif; if(session('selectsortid')): ?>
                <option  v-if="<?php echo $selectsortid; ?>!=<?php echo $val['sortid']; ?>"  value="<?php echo $val['sortid']; ?>"><?php echo $val['sortname']; ?></option>
                <?php endif; if(!session('selectsortid')): ?>
                <option  value="<?php echo $val['sortid']; ?>"><?php echo $val['sortname']; ?></option>
                <?php endif; endforeach; endif; else: echo "" ;endif; ?>
            </select>
            <span style="font-size: 17px;margin-left:10px;">项目状态：</span>
            <select name="" style="width: 160px;height: 38px;" id="searchState">
                <option value="all">全部</option>
                <?php if(is_array($stateList) || $stateList instanceof \think\Collection || $stateList instanceof \think\Paginator): $i = 0; $__LIST__ = $stateList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;if(session('stateid')): ?>
                <option  v-if="<?php echo $stateid; ?>==<?php echo $val['stateid']; ?>" selected  value="<?php echo $val['stateid']; ?>"><?php echo $val['statename']; ?></option>
                <?php endif; if(session('stateid')): ?>
                <option  v-if="<?php echo $stateid; ?>!=<?php echo $val['stateid']; ?>"  value="<?php echo $val['stateid']; ?>"><?php echo $val['statename']; ?></option>
                <?php endif; if(!session('stateid')): ?>
                <option  value="<?php echo $val['stateid']; ?>"><?php echo $val['statename']; ?></option>
                <?php endif; endforeach; endif; else: echo "" ;endif; ?>
            </select>

            <input type="text" name="" id="keyword"  value="<?php echo $keyword; ?>" placeholder="请输入项目名称" autocomplete="off" class="layui-input">
            <button class="layui-btn"  type="button" id="searchkeyword" lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
        </form>
    </div>
    <table class="layui-table" style="text-align: center">
        <thead>
        <tr>
            <!--<th>序号</th>-->
            <th style="text-align: center">发起人</th>
            <th style="text-align: center">项目名称</th>
            <th style="text-align: center">项目类型</th>
            <!--<th>项目图片</th>-->
            <th style="text-align: center">众筹天数</th>
            <th style="text-align: center">众筹金额</th>
            <th style="text-align: center">状态</th>
            <th style="text-align: center">发起时间</th>
            <th style="text-align: center">操作</th>
        </thead>
        <tbody>
        <?php if(is_array($allProList) || $allProList instanceof \think\Collection || $allProList instanceof \think\Paginator): $i = 0; $__LIST__ = $allProList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
        <tr>
            <!--<td><?php echo $i; ?></td>-->
            <td><?php echo $val['username']; ?></td>
            <td><?php echo $val['projectname']; ?></td>
            <td><?php echo $val['sortname']; ?></td>
            <td><?php echo $val['daysnumber']; ?></td>
            <td><?php echo $val['tolamount']; ?></td>
            <td class="td-status">
                <span class="layui-btn layui-btn-normal layui-btn-mini"><?php echo $val['statename']; ?></span>
            </td>
            <td><?php echo $val['createtime']; ?></td>
            <td class="td-manage">
                <a href="javascript:;"
                   onclick='x_admin_show("项目详情","showDetails?id="+<?php echo $val['projectid']; ?>)'>
                    查看详情
                </a>
            </td>
        </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>

        </tbody>
    </table>
    <div class="page">
        <?php echo $allProList->render(); ?>
    </div>
</div>
</body>
<script src="__JS__/jquery-2.1.4.js"></script>
<script src="__JS__/vue.js"></script>
<script type="text/javascript" src="__JS__/admin/jquery.min.js"></script>
<script type="text/javascript" src="__STATIC__/lib/layui/layui.js" charset="utf-8"></script>
<script type="text/javascript" src="__JS__/admin/xadmin.js"></script>
<script src="__JS__/admin/html5.min.js"></script>
<script src="__JS__/admin/respond.min.js"></script>
<script>
    function startnow(){
        alert("111");
    }
    new Vue({
        el : '#vueDiv',
        //数据
        data:{

        },
        //方法
        methods:{
            searchSort:function($this){
                console.log($this);
            }
        },

        mounted:function(){
            //发送ajax
        }
    });
    $(function(){

    });
    //查询的多种可能
    function search(selectstateid,selectsortid,key){
        //两个都不为全部时
        if(selectstateid!='all' && selectsortid!='all'){
            location.href="<?php echo url('admin/Promanage/index'); ?>?stateid="+selectstateid+"&sortid="+selectsortid+"&keyword="+key;
        }
        //选择项目状态时
        else if(selectstateid!='all' && selectsortid=='all'){
            location.href="<?php echo url('admin/Promanage/index'); ?>?stateid="+selectstateid+"&keyword="+key;
        }
        //选择项目分类时
        else if(selectstateid=='all' && selectsortid!='all'){
            location.href="<?php echo url('admin/Promanage/index'); ?>?sortid="+selectsortid+"&keyword="+key;

        }
        //都不选时
        else if(selectstateid=='all' && selectsortid=='all'){
            console.log("dbx");
            location.href="<?php echo url('admin/Promanage/index'); ?>?keyword="+key;
        }
    }
    //选择项目分类
    $("#selectProSort").change(function(){
        console.log($(this).val());
        var selectsortid=$(this).val();
        var selectstateid=$("#searchState").val();
        var keyword=$("#keyword").val();
        search(selectstateid,selectsortid,keyword);
    });
    //选择项目状态
    $("#searchState").change(function(){
        var selectstateid=$(this).val();
        var selectsortid=$("#selectProSort").val();
        var keyword=$("#keyword").val();
//        console.log(selectstateid);
        search(selectstateid,selectsortid,keyword);
    });
    //点击搜索
    $("#searchkeyword").click(function(){
        var keyword=$("#keyword").val();
        var selectsortid=$("#selectProSort").val();
        var selectstateid=$("#searchState").val();
//        console.log(selectstateid);
        search(selectstateid,selectsortid,keyword);
    });



</script>
</html>
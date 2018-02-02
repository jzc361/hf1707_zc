<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:84:"D:\AppServ\www\hf170724_zc\hf1707_zc\public/../application/home\view\user\money.html";i:1517574863;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge"><!--设置ie内核浏览器下的渲染模式-->
    <meta name="renderer" content="webkit"><!--设置成网页以webkit(极速模式)来渲染页面-->
    <meta name="viewport" content="width=device-width,initial-scale=1"><!--设置网页宽度和访问设备宽度保持一致，且显示比例1:1，-->
    <title>资金管理</title>
    <link rel="stylesheet" href="__CSS__/bootstrap.min.css">
    <link rel="stylesheet" href="__CSS__/bootstrapValidator.min.css">
    <link rel="stylesheet" href="__CSS__/home/userView.css">
    <script src="__JS__/vue.js"></script>
    <script src="__JS__/jquery-2.1.4.js"></script>
    <script src="__JS__/bootstrap.min.js"></script>
    <script src="__JS__/bootstrapValidator.min.js"></script>
</head>
<style>
    .money_box {
        border: #d8d8d8 solid 1px;
        margin: 10px;
        padding: 20px;
        background: #fafafa;
    }
    .credit_box {
        font-size: 20px;
        font-family: "微软雅黑";
    }
    @media (min-width: 768px) {
        .money_tabs>li>a {
            padding: 10px 15px;
        }
    }
    @media (max-width: 767px) {
        .money_tabs>li>a {
            padding: 10px 6px;
        }
    }
    .my_table th{
        text-align: center;
    }
    .my_table td{
        text-align: center;
    }
    .my_table tr{
        height: 47px;
    }

</style>
<body style="min-height: 800px">
<div class="container" id="app">
    <!-- tab标签 -->
    <ul class="nav nav-tabs money_tabs" id="my_tabs">
        <li class="active"><a href="#pro1" data-toggle="tab">账户主页</a></li>
        <li><a href="#pro2" data-toggle="tab" @click="resetForm">会员充值</a></li>
        <li><a href="#pro3" data-toggle="tab">充值日志</a></li>
        <li><a href="#pro4" data-toggle="tab">会员提现</a></li>
        <li><a href="#pro5" data-toggle="tab">提现日志</a></li>
        <li><a href="#pro6" data-toggle="tab">收支明细</a></li>
    </ul>
    <!-- 每个tab页对应的内容 -->
    <div  class="tab-content">
        <div id="pro1" class="tab-pane fade in active">
            <div class="money_box">
                <div class="credit_box">
                    <p><span>账户余额：</span><span id="money_span" style="color: #71b900;">￥{{money}}</span><span>元</span></p>
                    <p><span>诚意金：</span><span style="color: #71b900;">￥0.00</span><span>元</span></p>
                </div>
                <button class="btn btn-info" @click="toRecharge">立即充值</button>
                <button class="btn btn-warning" @click="toWithdrawals">我要提现</button>
            </div>
        </div>
        <div id="pro2" class="tab-pane fade">
            <!--<form id="rechargeForm" method="post" class="form-horizontal" action="<?php echo url('/home/User/addAddr'); ?>">-->
            <form id="rechargeForm"  method="post" class="form-horizontal" role="form"  action="<?php echo url('/home/User/recharge'); ?>" style="margin-top: 20px">
                <div class="form-group">
                    <label class="col-xs-2 control-label" style="font-size: 16px;margin-top: 10px">充值金额：</label>
                    <div class="col-xs-8 input-group-lg">
                        <input name="rechargeNum" type="text" v-model="rechargeNum" class="form-control"  placeholder="请输入充值金额">
                    </div>
                    <span style="font-size: 16px;margin-top: 13px;display: inline-block;">人民币（元）</span>
                </div>
                <button  type="button" @click="recharge"  id="my_btn" class="btn btn-primary btn-lg">确定，去付款</button>
            </form>
        </div>
        <div id="pro3" class="tab-pane fade">
            <table class="table table-hover table-responsive my_table">
                <caption>充值记录</caption>
                <thead>
                <tr>
                    <th>项目名称</th>
                    <th width="200">支付时间</th>
                    <th width="100">金额</th>
                    <th width="100">是否支付</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="x in rechargeList">
                    <td>{{x.r_method}}</td>
                    <td v-if="x.r_time==null">无</td>
                    <td v-else>{{x.r_time}}</td>
                    <td>{{x.r_amount}}</td>
                    <td v-if="x.r_state==1">已支付</td>
                    <td v-else><button  class="btn btn-warning btn-sm">继续支付</button></td>
                </tr>
                </tbody>
            </table>
            <page></page>
        </div>
        <div id="pro4" class="tab-pane fade"><p>会员提现</p></div>
        <div id="pro5" class="tab-pane fade">
            <table class="table table-hover table-responsive">
                <caption>提现记录</caption>
                <thead>
                <tr>
                    <th>项目名称</th>
                    <th>支付时间</th>
                    <th>金额</th>
                    <th>是否支付</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>在线支付</td>
                    <td>无</td>
                    <td>100.00</td>
                    <td><button class="btn btn-warning">继续支付</button></td>
                </tr>
                <tr>
                    <td>在线支付</td>
                    <td>无</td>
                    <td>100.00</td>
                    <td><button class="btn btn-warning">继续支付</button></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div id="pro6" class="tab-pane fade"><p>收支明细</p></div>
    </div>
</div>

</body>
<script type="text/x-template" id="page">
    <ul class="pagination" >
        <li v-show="current != 1" @click="current-- && goto(current--)" ><a href="#">上一页</a></li>
        <li v-for="index in pages" @click="goto(index)" :class="{'active':current == index}" :key="index">
            <a href="#" >{{index}}</a>
        </li>
        <li v-show="allPage != current && allPage != 0 " @click="current++ && goto(current++)"><a href="#" >下一页</a></li>
    </ul>
</script>
<script>

//    //去充值
//    function toRecharge(){
//        $('#my_tabs li:eq(1) a').tab('show')
//    }
//    //去提现
//    function toWithdrawals(){
//        $('#my_tabs li:eq(3) a').tab('show')
//    }
    var $myForm=$('#rechargeForm');
    var bus=new Vue();
    Vue.component("page",{
        template:"#page",
//        template:"<h2>分页</h2>",
        data:function(){
            return{
                current:1,//当前页
                showItem:1,//显示页码数
                allPage:1//总页数
            }
        },
        computed:{
            pages:function(){
                var pag = [];
                if( this.current < this.showItem ){ //如果当前激活的项 小于要显示的条数
                    //总页数和要显示的条数那个大就显示多少条
                    var i = Math.min(this.showItem,this.allPage);
                    while(i){
                        pag.unshift(i--);
                    }
                }else{ //当前页数大于显示页数了
                    var middle = this.current - Math.floor(this.showItem / 2 ),//从哪里开始
                            i = this.showItem;
                    if( middle >  (this.allPage - this.showItem)  ){
                        middle = (this.allPage - this.showItem) + 1
                    }
                    while(i--){
                        pag.push( middle++ );
                    }
                }
                return pag
            }
        },
        methods:{
            goto:function(index){
                if(index == this.current) return;
                this.current = index;
                //发送ajax请求
                bus.$emit('go',index);
            }
        },
        mounted:function(){
            //监听总页数
            bus.$on('all',function(pageData){
                this.current=pageData.current;//当前页
                this.showItem=pageData.showItem;//显示页码数
                this.allPage=pageData.allPage;//总页数
            }.bind(this))

        }
    });
    var app = new Vue({
        el: '#app',
        data: {
            rechargeList: [],
            current:1,
            rechargeNum:'',
            money:<?php echo $money; ?>,
            telephone:''
        },
        methods:{
            //获取充值列表
            getRechargeList:function(){
                var that=this;
                $.ajax({
                    url: "<?php echo url('home/User/getRechargeList'); ?>",
                    type: "get",
                    data:{'pageNow':that.current},
                    dataType: "json",
                    async: false,
                    success: function(res) {
                        console.log(219,res);
                        if(res.code==20007){
                            that.rechargeList=res.data[0];
                            console.log(333,that.rechargeList);
                            bus.$emit('all',res.data[1]);

                        }else{
                            alert(res.msg);
                        }
                    },
                    error: function(res) {
                    }
                });
            },
            //去充值
            toRecharge:function(){
                $('#rechargeForm').data('bootstrapValidator').resetForm(true);
                $('#my_tabs li:eq(1) a').tab('show');
            },
            //去提现
            toWithdrawals:function(){
                $('#my_tabs li:eq(3) a').tab('show');
            },
            //充值
            recharge:function(){
                var that=this;
//                $myForm.data("bootstrapValidator").validate();
//                $('#rechargeForm').bootstrapValidator('validate');
                $('#rechargeForm').data('bootstrapValidator').validate();
                console.log(253,this.rechargeNum);
                console.log(254,$('#rechargeForm').data('bootstrapValidator').isValid());
                if($('#rechargeForm').data('bootstrapValidator').isValid()){
                    if(confirm("确认充值？")){
                        var formData1=$myForm.serialize();
                        var formData=$('#rechargeForm').serialize();
                        console.log(111,$myForm);
                        console.log(222,$('#rechargeForm'));
                        console.log(263,formData1);
                        console.log(264,formData);
                        $.ajax({
                            url: "<?php echo url('home/User/recharge'); ?>",
                            type: "post",
                            data:formData,
                            dataType: "json",
                            success: function(res) {
                                console.log(275,res);
                                if(res.code==20005){
//                                    that.rechargeNum='';
                                    that.money=res.data;
                                    that.getRechargeList();
                                    $('#my_tabs li:eq(0) a').tab('show');
                                    alert('充值成功');
                                }else{
                                    alert(res.msg);
                                }
                            },
                            error: function() {
                            }
                        });
                    }
                }else{
                    alert("请输入正确的金额");
                }

            },
            //清空充值表单
            resetForm:function(){
                $('#rechargeForm').data('bootstrapValidator').resetForm(true);
            }

        },
        mounted:function(){
            //获取充值记录表
            this.getRechargeList();
            bus.$on('go',function(index){
                this.current=index;
                this.getRechargeList();
            }.bind(this));
        },
        updated: function () {
            //正则校验
            $('#rechargeForm').bootstrapValidator({
//        live: 'disabled',
                message: '该值不能为空',
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    rechargeNum: {
                        validators: {
                            notEmpty: {
                                message: '充值金额不能为空'
                            },
                            regexp: {
//                            regexp: /^[a-zA-Z0-9_\.]+$/,
                                regexp:/^(([1-9]\d{0,9})|0)(\.\d{1,2})?$/,
//                            regexp:/(^[1-9](\d+)?(\.\d{1,2})?$)|(^(0){1}$)|(^\d\.\d{1,2}?$)/,
                                message: '充值金额格式不正确'
                            }
                        }
                    }
                }
            });
        }
    });



</script>
<script>
    $(function(){
        //正则校验
//        $('#rechargeForm').bootstrapValidator({
////        live: 'disabled',
//            message: '该值不能为空',
//            feedbackIcons: {
//                valid: 'glyphicon glyphicon-ok',
//                invalid: 'glyphicon glyphicon-remove',
//                validating: 'glyphicon glyphicon-refresh'
//            },
//            fields: {
//                rechargeNum: {
//                    validators: {
//                        notEmpty: {
//                            message: '充值金额不能为空'
//                        },
//                        regexp: {
////                            regexp: /^[a-zA-Z0-9_\.]+$/,
//                            regexp:/^(([1-9]\d{0,9})|0)(\.\d{1,2})?$/,
////                            regexp:/(^[1-9](\d+)?(\.\d{1,2})?$)|(^(0){1}$)|(^\d\.\d{1,2}?$)/,
//                            message: '充值金额格式不正确'
//                        }
//                    }
//                }
//            }
//        });
        //
//        $("#charge_btn").click(function(){
//            if(confirm("确认付款？")){
//                var formData=$('#rechargeForm').serialize();
//                $.ajax({
//                    url: "<?php echo url('home/User/recharge'); ?>",
//                    type: "post",
//                    data:formData,
//                    dataType: "json",
//                    success: function(res) {
//                        console.log(res);
//                        if(res.code==20007){
//                            alert('充值成功');
//                            $('#rechargeForm').data('bootstrapValidator').resetForm(true);
//                            $("#money_span").text('￥'+res.data);
//                            $('#my_tabs li:eq(0) a').tab('show')
//                        }else{
//                            alert(res.msg);
//                        }
//                    },
//                    error: function() {
//                    }
//                });
//            }
//        });
    });
</script>

</html>
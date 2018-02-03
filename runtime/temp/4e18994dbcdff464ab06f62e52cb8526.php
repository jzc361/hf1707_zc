<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:75:"D:\AppServ\www\tp505\public/../application/index\view\index\designView.html";i:1516125948;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge"><!--设置ie内核浏览器下的渲染模式-->
    <meta name="renderer" content="webkit"><!--设置成网页以webkit(极速模式)来渲染页面-->
    <meta name="viewport" content="width=device-width,initial-scale=1"><!--设置网页宽度和访问设备宽度保持一致，且显示比例1:1，-->
    <title>设计问卷</title>
    <link rel="stylesheet" href="__CSS__/bootstrap.min.css">
    <link rel="stylesheet" href="__CSS__/designView.css">
    <script src="__JS__/vue.js"></script>
</head>
<body style="background: #eeeeee; margin: 0; padding: 0;">
<div id="myApp">
    <question-type></question-type>
    <div class="content">
        <div class="container content_div">
            <h1 class="q_title"><?php echo $data['q_title']; ?></h1>
            <design></design>
        </div>
    </div>
</div>
</body>
<script src="__JS__/jquery-2.1.4.js"></script>
<script src="__JS__/bootstrap.min.js"></script>
<script>
//    console.log(222);
    var questionnaireId="<?php echo $data['q_id']; ?>";
    var bus=new Vue();
    Vue.component('design',{
        template:'<div>\
        <div v-for="(item, index) in questionArr" v-on:mouseover="showBtn(index)" v-on:mouseout="hideBtn(index)" class="question_block">\
    <h4>{{index+1}}.{{item.q_name}}</h4>\
<ul>\
<li v-for="(x, i) in item.q_options">\
    <label>\
    <input type="radio">\
    {{x.o_name}}\
</label>\
</li>\
</ul>\
<hr style="margin: 9px auto">\
    <div style="height: 36px">\
    <div style="float: right" v-show="isShow[index]">\
    <button type="button" class="btn btn-default" v-on:click="edit(index)">编辑</button>\
    <button type="button" class="btn btn-default" v-on:click="copy(index)">复制</button>\
    <button type="button" class="btn btn-default" v-on:click="del(index)">删除</button>\
    <button type="button" class="btn btn-default" v-on:click="up(index)">上移</button>\
    <button type="button" class="btn btn-default" v-on:click="down(index)">下移</button>\
    <button type="button" class="btn btn-default" v-on:click="top(index)">最前</button>\
    <button type="button" class="btn btn-default" v-on:click="bottom(index)">最后</button>\
    </div>\
    </div>\
    <div v-show="item.show">\
    <form action="" class="form-horizontal">\
    <h5>标题</h5>\
    <div class="form-group">\
    <div class="col-xs-5">\
    <textarea class="form-control" v-model="item.q_name"></textarea>\
    </div>\
    </div>\
    <h5>选项</h5>\
    <div class="form-group" v-for="(x, i) in item.q_options">\
    <div class="col-xs-5">\
    <input class="form-control" type="text" v-model="x.o_name">\
    </div>\
    <div class="col-xs-5">\
    <div style="margin-top: 5px">\
    <span class="glyphicon glyphicon-plus" v-on:click="optionAdd(index,i)"></span>\
    <span class="glyphicon glyphicon-minus" v-on:click="optionDel(index,i)"></span>\
    <span class="glyphicon glyphicon-upload" v-on:click="optionUp(index,i)"></span>\
    <span class="glyphicon glyphicon-download" v-on:click="optionDown(index,i)"></span>\
    </div>\
    </div>\
    </div>\
    <button type="button" class="btn btn-warning" v-on:click="edit(index)" style="width: 100%">完成编辑</button>\
    </form>\
    </div>\
    <div style="clear: both"></div>\
    </div>\
    </div>',
    data:function(){
        return {
            questionArr:[],
            isShow:[]
        }
    },
        methods:{
            newradio:function(){
                var question={q_name:'请在此输入问题标题',q_options:[{o_name:'选项1'},{o_name:'选项2'}],show:true};
                for(var i =0;i <this.questionArr.length;i++ ){
                    this.questionArr[i].show = false;
                }
                this.questionArr.push(question);
                this.isShow.push(true);
//                $.ajax({
//                    type:'post',
//                    url:'index.php?type=Question&do=insertQuestion&q_id='+questionnaireId,
//                    dataType:'json',
//                    data:question,
//                    success:function(data){
//                        this.questionArr=data;
//                    }.bind(this)
//                })
            },
            showBtn:function(index){
                var objArr=JSON.parse(JSON.stringify(this.isShow));
                objArr[index]=true;
                this.isShow=objArr;
//                event.stopPropagation();
            },
            hideBtn:function(index){
                var objArr=JSON.parse(JSON.stringify(this.isShow));
                objArr[index]=false;
                this.isShow=objArr;
//                event.stopPropagation();
            },
            edit:function (index) {
                for(var i=0;i<this.questionArr.length;i++){
                    if(i!=index){
                        this.questionArr[i].show=false;
                    }else{
                        this.questionArr[i].show= !this.questionArr[i].show;
                    }
                }
            },
            copy:function (index) {
                this.questionArr[index].show=false;
                var obj=JSON.parse(JSON.stringify(this.questionArr[index]));
                obj.show=true;
                this.questionArr.splice(index+1,0,obj);
            },
            del:function (index) {
                this.questionArr.splice(index,1);
            },
            up:function (index) {
//                alert(index);
                var objArr=JSON.parse(JSON.stringify(this.questionArr));
                if(index>0){
                    var tmp=objArr[index];
                    objArr[index]=objArr[index-1];
                    objArr[index-1]=tmp;
                    this.questionArr=objArr;
                }
//                if(index>0){
//                    alert(123);
//                    var tmp=this.questionArr[index];
//                    this.questionArr[index]=this.questionArr[index-1];
//                    this.questionArr[index-1]=tmp;
//                }
            },
            down:function (index) {
//                alert(index);
                var objArr=JSON.parse(JSON.stringify(this.questionArr));
                if(index<this.questionArr.length-1){
                    var tmp=objArr[index];
                    objArr[index]=objArr[index+1];
                    objArr[index+1]=tmp;
                    this.questionArr=objArr;
                }
//                if(index<this.questionArr.length-1){
//                    alert(123);
//                    var tmp=this.questionArr[index];
//                    this.questionArr[index]=this.questionArr[index+1];
//                    this.questionArr[index+1]=tmp;
//                }
            },
            top:function (index) {
                var tmp=this.questionArr[index];
                this.questionArr.splice(index,1);
                this.questionArr.splice(0,0,tmp);
            },
            bottom:function (index) {
                var tmp=this.questionArr[index];
                this.questionArr.splice(index,1);
                this.questionArr.splice(this.questionArr.length,0,tmp);
            },
            optionAdd:function (index,i) {
                var newId=this.questionArr[index]['q_options'].length+1;
//                this.questionArr[index]['q_options'].splice(i+1,0,{o_name:'新选项'});
                this.questionArr[index]['q_options'].splice(i+1,0,{o_name:'选项'+newId});
            },
            optionDel:function (index,i) {
                this.questionArr[index]['q_options'].splice(i,1);
            },
            optionUp:function (index,i) {
                var objArr=JSON.parse(JSON.stringify(this.questionArr[index]['q_options']));
                if(i>0){
                    var tmp=objArr[i];
                    objArr[i]=objArr[i-1];
                    objArr[i-1]=tmp;
                    this.questionArr[index]['q_options']=objArr;
                }
            },
            optionDown:function (index,i){
                var objArr=JSON.parse(JSON.stringify(this.questionArr[index]['q_options']));
                if(i<objArr.length-1){
                    var tmp=objArr[i];
                    objArr[i]=objArr[i+1];
                    objArr[i+1]=tmp;
                    this.questionArr[index]['q_options']=objArr;
                }
//                if(i<this.questionArr[index]['q_options'].length-1){
//                    var tmp=this.questionArr[index]['q_options'][i];
//                    this.questionArr[index]['q_options'][i]=this.questionArr[index]['q_options'][i+1];
//                    this.questionArr[index]['q_options'][i+1]=tmp;
//                }
            },
            complete:function(){
//                console.log(276,JSON.stringify(this.questionArr));
                $.ajax({
                    type:'post',
//                    url:'index.php?type=Question&do=insertQuestion&q_id='+questionnaireId,
                    url:"<?php echo url('index/Index/insertQuestion'); ?>?q_id="+questionnaireId,
                    dataType:'json',
                    data:'questionStr='+JSON.stringify(this.questionArr),
                    success:function(res){
                        console.log(res);
                        if(res.code==20001){
                            alert(res.msg);
//                            window.location.href="./index.php?type=Login&do=showPersonalView";
                            window.location.href="<?php echo url('index/Index/showPersonal'); ?>";
                        }else {
                            alert(res.msg);
                            console.log('error,问卷编辑失败！');
                        }
                    }.bind(this),
                    error:function(res){
                        console.log('error问卷编辑失败！',res);
                    }
                });
            }
        },
        mounted:function(){
            bus.$on('radio',function(){
//                console.log(275,this.page);
                this.newradio();
            }.bind(this));
            bus.$on('toComplete',function(){
                this.complete();
            }.bind(this))
        }
    });
    Vue.component('question-type',{
    template:'<div><div class="nav">\
    <div class="container">\
        <button class="btn btn-warning" v-on:click="toComplete()">完成编辑</button>\
    <span class="nav_font">\
    <i class="ico"></i>预览\
    </span>\
    <div style="float: right">\
    <span >题目随机设置</span>\
    <input type="checkbox">\
    <span>隐藏系统题号</span>\
    </div>\
    </div>\
    </div>\
    <div class="menu">\
    <ul style="margin: 0;padding: 0 2px">\
    <li v-on:click="radio()">\
    <i class="menu_ico"></i>单选\
    </li>\
    <li>\
    <i class="menu_ico p1"></i>多选\
    </li>\
    <li>\
    <i class="menu_ico p2"></i>填空\
    </li>\
    <li>\
    <i class="menu_ico p3"></i>矩阵\
    </li>\
    <li>\
    <i class="menu_ico p4"></i>文件\
    </li>\
    <li>\
    <i class="menu_ico p5"></i>评分\
    </li>\
    <li>\
    <i class="menu_ico p6"></i>分页\
    </li>\
    <li>\
    <i class="menu_ico p7"></i>段落说明\
    </li>\
    <li>\
    <i class="menu_ico p8"></i>排序\
    </li>\
    <li>\
    <i class="menu_ico p9"></i>下拉框\
    </li>\
    <li>\
    <i class="menu_ico p10"></i>多级下拉\
    </li>\
    <li>\
    <i class="menu_ico p11"></i>高级题型\
    </li>\
    <li style="border-right: 0">\
    <i class="menu_ico p12"></i>个人信息\
    </li>\
    <div style="clear: both"></div>\
    </ul>\
    </div></div>',
    methods:{
        radio:function(){
            bus.$emit('radio');
        },
        toComplete:function(index){
            bus.$emit('toComplete');
        }
    }
    });
    var app=new Vue({
        el:'#myApp'
    });
</script>
</html>
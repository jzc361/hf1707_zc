<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:88:"D:\AppServ\www\hf1707_zc\public/../application/admin\view\promanage\publishLimitPro.html";i:1519652161;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>发布限时众筹</title>
    <link rel="stylesheet" href="__CSS__/bootstrap.min.css">
    <link rel="stylesheet" href="__CSS__/proBaseMsg.css">
    <link rel="stylesheet" href="__CSS__/default.css">
    <style>
        /*--通用-*/
        #moreImg{
            opacity: 0;
        }
        #moreImgBtn{
            padding: 4px 10px;
            height: 20px;
            line-height: 20px;
            border: 1px solid #999;
            text-decoration: none;
            color: #666;
        }
        #moreImgView{
            height: 200px;
            width: 200px;
            float: left;
            overflow: auto;
            border: 1px solid grey;
        }
        #moreImgView img{
            width: 100%;
        }
        body{ background:#f3f3f3; }
        .pro_lf{ padding:10px; width:50%; }
        .hide { height:0;float:none }
        .setlist{position:relative;}
        .holder_tip{left:125px}
        .faq_item1{position:relative;overflow:hidden;padding:4px;}
        .faq_item1 .holder_tip{left:4px;top:4px;}
        .next{
            padding: 6px 12px;
            float: right;
            margin-right: 30px;
        }
        #contentRight{
            height:600px;
            margin: 0;
            padding: 0;
        }
        /*--通用end-*/

        /*--xs-*/
        @media (max-width:768px) {
            #contentRight{
                float: left;
                margin-top: 30px;
            }
        }
        /*--sm-*/
        @media (max-width:768px) {
            #contentRight{
                float: left;
                margin-top: 30px;
            }
        }
        /*--md--*/
        @media (max-width:992px) {
            #contentRight{
                float: left;
                margin-top: 30px;
            }
        }

    </style>
</head>

<body>

<div class="container" id="vueDiv">
    <!--<div class="row-fluid">-->
    <!--左边-->
    <div class="col-md-7 col-sm-12 col-xs-12 agreementlf f_l">
        <form id="project_form" action="" method="post" enctype="multipart/form-data">
            <div class="pro_msg">项目信息</div>
            <!--项目标题-->
            <div class="setlist">
                <label class="setmid">项目标题</label>
                <input type="text" class="pro_lf textbox" id="proTitle" name="proTitle" v-model="proTitle">
            </div>
            <div class="blank0"></div>
            <!--项目分类-->
            <div class="setlist">
                <label class="setmid" style="margin-right:25px;">项目分类</label>
                <select id="proSort" name="proSort" class="btn_select f_l">
                    <?php if(is_array($proSortList) || $proSortList instanceof \think\Collection || $proSortList instanceof \think\Paginator): $i = 0; $__LIST__ = $proSortList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
                    <option :value="<?php echo $val['sortid']; ?>"><?php echo $val['sortname']; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
            <div class="blank0"></div>
            <!--是否马上开始众筹-->
            <div class="setlist">
                <label class="setmid" style="margin-right:25px;">马上开始</label>
                <select  name="selectVal" id="selectVal" v-model="selectVal"  class="btn_select f_l" @change="isstartNow(selectVal)">
                    <option value="1">是</option>
                    <option value="0">否</option>
                </select>
            </div>
            <div class="blank0"></div>
            <!--开始时间-->
            <div class="setlist" v-show="startNow">
                <label class="setmid" style="margin-right:25px;">开始时间</label>
                <input name="starttime" id="starttime" type="datetime-local" class="pro_lf textbox">
            </div>
            <div class="blank0"></div>
            <!--结束时间-->
            <div class="setlist">
                <label class="setmid" style="margin-right:25px;">结束时间</label>
                <input name="endtime" id="endtime" type="datetime-local" class="pro_lf textbox">
            </div>
            <div class="blank0"></div>
            <!--支持金额-->
            <div class="setlist">
                <label class="setmid">支持金额</label>
                <input name="tolprice" id="tolprice" v-model='tolprice'  @keyup="limitInt()" class="pro_lf textbox">
                <span class="setmid">元</span>
            </div>
            <div class="blank0"></div>
          <!--限额-->
            <div class="setlist">
                <label class="setmid">限额</label>
                <input name="totalpart"  id="totalpart" v-model="totalpart"  @keyup="limitInt()" class="pro_lf textbox">
                <span class="setmid">份</span>
            </div>
            <div class="blank0"></div>
            <!--项目封面-->
            <div class="blank0"></div>
            <div class="setlist">
                <label class="setmid">项目封面</label>
                <label class="fileupload" style="width:97px;">
                    <input type="file" @change="addImg($event)" class="filebox" id="imgFile" name="imgFile" accept="image/gif,image/jpeg,image/jpg,image/png"  style="cursor:pointer;padding: 0;height: 39px;width: 97px;filter: alpha(opacity=0);-moz-opacity: 0;-khtml-opacity: 0;opacity: 0; "/>
                    <!--<input type="file" class="" name="img_file" accept="image/gif,image/jpeg,image/jpg,image/png"/>-->
                </label>
                <span class="prompt" style="margin-top:11px;" v-if="!isAddImg">支持jpg、jpeg、png、gif格式</span>
                <span class="prompt" style="margin-top:11px;" v-if="isAddImg">支持jpg、jpeg、png、gif格式</span>
            </div>
            <div class="blank0"></div>
            <!--项目详情-->
            <div class="blank0"></div>
            <div class="setlist">
                <label class="setmid">项目详情</label>
                <!--<textarea name="probrief" id="probrief" class="textareabox textbox w350"></textarea>-->
            </div>
            <div class="blank0"></div>
            <!--<div>-->
            <script id="editor" name="proDetails" type="text/plain"></script>
            <!--</div>-->
            <!---->
            <!--保存-->
            <div class="blank5"></div>
            <button type="button"  id="submitpro" class="btn-success next">提交</button>
            <!--<div class="saveone f_l" rel="gray" id="savenow"></div>-->
        </form>
    </div>
    <!--左边end-->
    <div class="col-md-2"></div>
    <!--右边-->
    <div id="contentRight" class="col-md-4 col-sm-6 col-xs-9 agreementrt f_r">
        <div class="deal_item_box agreementlist">
            <!--图片 名称-->
            <div class="deal_content_box">
                <a href="#" title="">
                    <img id="imagePreview"  src="__STATIC__/img/home/publishPro/empty_thumb.gif" />
                    <!--<img id="imagePreview"  src="__STATIC__/img/home/publishPro/empty_thumb.gif" />-->
                </a>
                <div class="blank"></div>
                <span class="deal_title" id="deal_title" v-if="proTitle==''">项目标题</span>
                <span class="deal_title" id="" v-if="proTitle!=''">{{proTitle}}</span>
                <!--<a href="#" class="deal_title" id="deal_title"></a>-->
                <div class="blank"></div>
            </div>
            <!--基本信息-->
            <div class="paiduan" style="height:30px;padding:10px 12px 0 12px ;line-height: 20px;color: #A4A4A4;">
                <span class="caption-title">目标：
                    <em>
                        <i class="font-yen">¥</i>
                        <span class="num" >
                            <font v-if="tolprice==''"  id='tolprice2'>0</font>
                            <font v-if="tolprice!=''">{{tolprice}}</font>
                            元
                        </span>
                    </em>
                </span>
                <span class="f_r ">
                    <span class="common-sprite">筹资中</span>
                </span>
                <div>
                    <span class="caption-title">限额：
                        <em>
                            <span class="num" >
                                <font v-if="totalpart==''"  id=''>0</font>
                                <font v-if="totalpart!=''">{{totalpart}}</font>
                                份
                            </span>
                        </em>
                    </span>
                </div>
            </div>

            <div class="deal_content_box" style="padding:30px 12px 0 12px; ">
                <div class="ui-progress">
                    <span class="theme_bgcolor" style="width:100%;"></span>
                </div>
                <div class="blank"></div>
                <div class="div3" style="text-align:left;margin-bottom: 20px;">
                    <span class="num">100%</span>
                    <div class="blank10"></div>
                    <span class="til">已达</span>
                </div>
                <div class="div3">
                    <span class="num">
                        <font id="price">0</font>
                        元
                    </span>
                    <div class="blank10"></div>
                    <span class="til">已筹资</span>
                </div>
                <div class="div3" style="text-align:right;">
                    <span class="num"><font id="deal_days">0</font>份</span>
                    <div class="blank10"></div>
                    <span class="til">已支持</span>
                </div>
                <div class="blank"></div>
            </div>
            <div class="blank"></div>
        </div>
    </div>
    <!--右边end-->
    <!--</div>-->
</div>
</body>
<script src="__JS__/jquery-2.1.4.js"></script>
<script src="__JS__/vue.js"></script>
<!-- 配置文件 -->
<script type="text/javascript" src="__STATIC__/ueditor/dist/utf8-php/ueditor.config.js"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript"  src="__STATIC__/ueditor/dist/utf8-php/ueditor.all.js"></script>
<script>
    var ue = UE.getEditor('editor');//富文本
    ue.ready(function() {
        //设置编辑器的内容
//        ue.setContent('hello');
        //获取html内容，返回: <p>hello</p>
        prohtml = ue.getContent();

    });
    new Vue({
        el : '#vueDiv',
        //数据
        data:{
            proTitle:'',
            tolprice:'',
            totalpart:'',
            isAddImg:false,//是否添加图片,
            startNow:false, //是否马上开始
            selectVal:1 //默认马上开始
        },
        //方法
        methods:{
            //限制众筹天数和金额只能输入正整数
            limitInt:function(){
                this.totalpart=this.totalpart.replace(/[^0-9]/g,'');
                this.tolprice=this.tolprice.replace(/[^0-9]/g,'');
            },
            //添加图片
            addImg:function(){
                this.isAddImg=true;
            },
            //是否马上开始
            isstartNow:function(selectVal){
                console.log(selectVal);
                if(selectVal==0){
                    this.startNow=true;
                }
                else if(selectVal==1){
                    this.startNow=false;
                }
            }

        },

        mounted:function(){

        }
    });

    /*---图片预览-*/
    var flag=0;
    isImg();
    function isImg(){
        $("#imgFile").change(function(){
            var fileList=document.getElementById("imgFile").files[0];  //获取选择的文件对象（数组）
            console.log(fileList);
            var allowTypes = ["image/jpeg","image/png","image/gif","image/jpg"]; //允许上传的文件类型
            if(fileList.type=='image/jpeg' || fileList.type=='image/png' || fileList.type=='image/gif' || fileList.type=='image/jpg'){
                flag=1;
                /*---图片预览-*/
//                $("#imgFile").change(function(){
                var file = document.getElementById("imgFile").files;
                var result=document.getElementById("imagePreview");
                $(result).empty();
                var reader    = new FileReader();
                reader.readAsDataURL(file[0]);
                reader.onload=function(e){
                    $(result).attr("src",this.result);
                };
//                });
            }
            else {
                flag=0;
                $("#imagePreview").attr("src",'__STATIC__/img/home/publishPro/empty_thumb.gif');
                alert("只能上传图片文件");
            }
        });
    }
//    $("#imgFile").change(function(){
//        var file = document.getElementById("imgFile").files;
//        var result=document.getElementById("imagePreview");
//        $(result).empty();
//        var reader    = new FileReader();
//        reader.readAsDataURL(file[0]);
//        reader.onload=function(e){
//            $(result).attr("src",this.result);
//        };
//    });
    //项目提交
    $("#submitpro").click(function(){
        console.log(prohtml);
        var formData = new FormData($("#project_form")[0]);
        console.log(formData);
        var proTitle=$("#proTitle").val();
        var starttime=$("#starttime").val();
        var endtime=$("#endtime").val();
        var imgFile=$("#imgFile").val();
        var tolprice=$("#tolprice").val();
        var totalpart=$("#totalpart").val();
        var selectVal=$("#selectVal").val();
        if(proTitle=='' || tolprice==''|| totalpart==''){
            alert("请将信息填写完整");
        }
        else if(selectVal==0 && starttime==''){    //不马上开始，要判断开始时间是否为空
            alert("请选择开始时间");
        }
        else if(endtime==''){
            alert("请选择结束时间");
        }
        else if(imgFile==''){
            alert("请选择图片封面");
        }
        else if(flag==0){
            alert("只能上传图片");
        }
        else {
            $.ajax({
                type: "POST",
                url: "<?php echo url('admin/promanage/submitLimitPro'); ?>",
                data: formData,
                dataType: "json",
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                success: function (responseData){
                    if(responseData.code=='90018'){
                        alert(responseData.msg);
                    }
                    else {
                        console.log(responseData);
                        alert(responseData.msg);
                        location.reload(true);
                    }

                },
                error:function(){
                    alert("error");
                }
            });
        }


    });



</script>
</html>
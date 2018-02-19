<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:86:"D:\AppServ\www\hf1707_zc\public/../application/admin\view\backmanager\rolemanager.html";i:1517820923;}*/ ?>
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
      <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <link rel="stylesheet" href="__CSS__/bootstrap.min.css">
      <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
      <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
      <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
      <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"
              integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
      <!--Ztree插件-->
      <link rel="stylesheet" href="__CSS__/admin/demo.css" type="text/css">
      <link rel="stylesheet" href="__CSS__/admin/zTreeStyle.css" type="text/css">

  </head>

  <style>
      .layui-form-label{
          float: left;
          display: block;
          padding: 9px 15px;
          width: 120px;
          font-weight: 400;
          text-align: right;
      }
  </style>
  <body>
  <div class="x-body" id="vueData">
      <fieldset class="layui-elem-field">
          <legend>角色管理</legend>
          <div class="layui-field-box" id="allrole">
              <table class="layui-table" lay-even>
                  <tbody>

                  <!--角色管理操作-->
                  <tr v-for="roleInfo in allrole" v-if="roleInfo.roleid==1">
                      <td>{{roleInfo.rolename}}</td><td>{{roleInfo.roledetails}}</td><td>--</td><td>--</td>
                  </tr>
                  <tr v-for="roleInfo in allrole" v-if="roleInfo.roleid!=1">
                      <td>{{roleInfo.rolename}}</td><td>{{roleInfo.roledetails}}</td>
                      <td>
                        <a :rid="roleInfo.roleid" data-toggle="modal" data-target="#modalEdit" onclick="roleEdit(this)" href="#">权限修改</a>
                      </td>
                     <td>
                         <a :rid="roleInfo.roleid" onclick="roleDel(this)" href="#">删除</a>
                     </td>
                  </tr>
                  </tbody>
              </table>
          </div>
      </fieldset>
      <!--<blockquote class="layui-elem-quote layui-quote-nm"></blockquote>-->
  </div>
  <div style="text-align: center" class="layui-form-item">
      <button class="btn layui-btn" data-toggle="modal" data-target="#modalAdd" style="width: 30%" id="roleAdd" lay-filter="add">
          添加角色
      </button>
  </div>
  <!--模态框显示增加菜单-->


  <!-- Modal -->
  <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modalAdd" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="modalLabelAdd">添加角色</h4>
                  <!--------------------------添加角色------------------------------>
              </div>
              <div class="modal-body">
                  <!--角色名-->
                  <div class="layui-form-item">
                      <label for="nameAdd" class="layui-form-label">
                          <span class="x-red">*</span>角色名称
                      </label>
                      <div class="layui-input-inline">
                          <input type="text" id="nameAdd" name="nameADd" required="" lay-verify="required"
                                 autocomplete="off" class="layui-input">
                      </div>
                      <div class="layui-form-mid layui-word-aux">
                          <span class="x-red">*</span>必填
                      </div>
                  </div>
                  <!--权限添加-->
                  <div class="layui-form-item">
                      <label for="gradeAdd" class="layui-form-label">
                          <span class="x-red">*</span>权限选择
                      </label>
                      <div class="layui-input-inline">
                          <input type="text" id="gradeAdd" name="gradeAdd" required="" lay-verify=""
                                 autocomplete="off" class="layui-input">
                      </div>
                      <div class="layui-form-mid layui-word-aux">
                          <span class="x-red">*</span>请合理分配权限
                      </div>
                  </div>
                  <div class="layui-form-item">
                      <label for="introAdd" class="layui-form-label">
                          <span class="x-red">*</span>角色详情/介绍
                      </label>
                      <div class="layui-input-inline">
                          <input type="text" id="introAdd" name="email" required="" lay-verify=""
                                 autocomplete="off" class="layui-input">
                      </div>
                      <div class="layui-form-mid layui-word-aux">
                          <span class="x-red">*</span>
                      </div>
                  </div>
                  <!---->
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                  <button type="button" class="btn layui-btn">确认添加</button>
              </div>
          </div>
      </div>
  </div>

  <!--模态框显示菜单-->

  <!-- Modal -->
  <!--权限修改-->
  <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalLabelEdit">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="modalLabelEdit">权限修改</h4>
                  <!--------------------------修改角色------------------------------>
              </div>
              <div class="modal-body">
                  <!--角色名-->
                  <div class="layui-form-item">
                      <label for="nameEdit" class="layui-form-label">
                          <span class="x-red">*</span>角色名称
                      </label>
                      <div class="layui-input-inline">
                          <input type="text" id="nameEdit" name="nameEdit" required="" lay-verify="required"
                                 autocomplete="off" class="layui-input">
                      </div>
                      <div class="layui-form-mid layui-word-aux">
                          <span class="x-red">*</span>
                      </div>
                  </div>
                  <!--权限修改-->
                  <div class="layui-form-item">
                      <label class="layui-form-label">
                          <span class="x-red">*</span>权限选择
                      </label>

                      <div class="content_wrap layui-input-inline">
                          <div class="zTreeDemoBackground left">
                              <ul id="roleEdit" class="ztree"  style="background-color: whitesmoke;width: 192px;height: 100%;border-color: #e6e6e6"></ul>
                          </div>
                      </div>

                      <div class="layui-form-mid layui-word-aux">
                          <span class="x-red">*</span>请合理分配权限
                      </div>
                  </div>
                  <div class="layui-form-item">
                      <label for="introEdit" class="layui-form-label">
                          <span class="x-red">*</span>角色详情/介绍
                      </label>
                      <div class="layui-input-inline">

                          <input type="text" style="overflow-y:visible" id="introEdit" lay-verify="" autocomplete="off" class="layui-input"/>

                      </div>
                      <div class="layui-form-mid layui-word-aux">
                          <span class="x-red">*</span>
                      </div>
                  </div>
                  <!---->
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                  <button type="button" id="saveEdit" class="btn layui-btn">确认修改</button>
              </div>
          </div>
      </div>
  </div>
  <!--权限修改-->


  <!---->
  </body>
  <script type="text/javascript" src="__JS__/admin/jquery.min.js"></script>
  <script type="text/javascript" src="__STATIC__/lib/layui/layui.js" charset="utf-8"></script>
  <script type="text/javascript" src="__JS__/admin/xadmin.js"></script>
  <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
  <!--[if lt IE 9]>
  <script src="__JS__/admin/html5.min.js"></script>
  <script src="__JS__/admin/respond.min.js"></script>
  <![endif]-->
  <script src="https://cdn.jsdelivr.net/npm/vue"></script>
  <!--引用vue-->
  <script src="__JS__/vue.js"></script>

  <!--引用jq文件-->
    <!--依赖JQ的文件在对应的放在依赖版本下引用-->
  <script src="__JS__/jquery-2.1.4.js"></script>
  <script src="__JS__/bootstrap.min.js"></script>

  <script type="text/javascript" src="__JS__/admin/jquery-1.4.4.min.js"></script>
  <script type="text/javascript" src="__JS__/admin/jquery.ztree.core-3.5.js"></script>
  <script type="text/javascript" src="__JS__/admin/jquery.ztree.excheck-3.5.js"></script>





  <script>
      $(
              //获取权限
          $.ajax({
              url:"<?php echo url('admin/backmanager/allRole'); ?>",
              data:'',
              type:'post',
              dataType:'json',
              success:function($res){
                  var roleVue = new Vue({
                      el:"#allrole",
                      data:{
                          'allrole':$res.data
                      },
                      created: function () {

                      }
                  })
              }
          })
      );

//Ztree插件方法
      function zTree($treeData){
          var setting = {
              check: {
                  enable: true
              },
              data: {
                  simpleData: {
                      enable: true
                  }
              },
          };
          //点击权限修改后绑定该角色所有权限数据

          var code;

          function setCheck() {
              showCode('setting.check.chkboxType = { "Y" : "ps ", "N" : "px" };');
          }
          function showCode(str) {
              if (!code) code = $("#code");
              code.empty();
              code.append("<li>"+str+"</li>");
          }
          //ztree数据绑定与标签绑定
          $(document).ready(function(){
              $.fn.zTree.init($("#roleEdit"), setting,$treeData);
              setCheck();
              $("#py").bind("change", setCheck);
              $("#sy").bind("change", setCheck);
              $("#pn").bind("change", setCheck);
              $("#sn").bind("change", setCheck);
          });

      }

      //添加角色
      $("#roleAdd").click(function (){

      });

      //删除角色
      function roleDel(obj){
        $rid = $(obj).attr('rid');
          $checkDel = confirm('您确定要删除该角色吗？');
          if($checkDel){
              $.ajax({
                  url:"<?php echo url('admin/backmanager/roleDel'); ?>",
                  data:'rid='+$rid,
                  type:'post',
                  dataType:'json',
                  success:function(res){
                      alert(res.msg);
                      window.location.reload();
                  }
              })
          }
      }
//角色权限修改
      function roleEdit(obj){
          $rid = $(obj).attr('rid');//获取角色ID
          $.ajax({
              url:"<?php echo url('admin/backmanager/roleEditData'); ?>" ,
              data:'rid='+$rid,
              type:'post',
              dataType:'json',
              success:function(res){

                    if(res!=''){
                        //
                        var zNodes = [];
                        //循环遍历菜单添加数据
                        for(var $i = 0;$i<res.data[0].length;$i++){
                            //显示主枝
                            if (res.data[0][$i]['menufid'] == 0) {
                                zNodes.push({
                                    id: res.data[0][$i]['menuid'],
                                    pId: res.data[0][$i]['menufid'],
                                    name: res.data[0][$i]['menuname'],
                                    open: true,
                                    checked: false
                                })
                            } else if (res.data[0][$i]['menuid'] == 8 || res.data[0][$i]['menuid'] == 10) {
                                zNodes.push({
                                    id: res.data[0][$i]['menuid'],
                                    pId: res.data[0][$i]['menufid'],
                                    name: res.data[0][$i]['menuname'],
                                    open: true,
                                    checked: false
                                })
                            } else {
                                zNodes.push({
                                    id: res.data[0][$i]['menuid'],
                                    pId: res.data[0][$i]['menufid'],
                                    name: res.data[0][$i]['menuname'],
                                    checked: false
                                })
                            }
                        }

                        //把有权限的选项给勾选
                        for(var $j=0;$j<res.data[1].length;$j++){

                            for(var $z =0;$z<zNodes.length;$z++){
                                if(zNodes[$z]['id']==res.data[1][$j]['menuid']){
                                    zNodes[$z]['checked']=true;
                                }
                            }
                        }

                        //给对应得文本框绑定内容
                        $("#nameEdit").val(res.data[1][0]['rolename']);
                        $("#introEdit").val(res.data[1][0]['roledetails']);

                        //给当前的元素增加属性'',属性值为''
                        $("#nameEdit").attr("roleid",res.data[1][0]['roleid']);

                        //调用ztree
                        zTree(zNodes);
                    }

                //zTree(res);
              }
          });
      }
      //保存修改
      $("#saveEdit").click(function(){
          //获取对应ztree(id)节点的选中数据
          var roleEdit = $.fn.zTree.getZTreeObj("roleEdit");
          //获取选中(true)的所有属性
          var newmenu = roleEdit.getCheckedNodes(true);
          var newmenuid = [];
          for(var $i = 0;$i<newmenu.length;$i++){
              newmenuid.push({
                  menuid:newmenu[$i]['id']
              })
          }
          //获取当前被修改角色得id
          var editId = $("#nameEdit").attr('roleId');

          var editName = $('#nameEdit').val();

          var editDetails = $('#introEdit').val();
          //删除数据+//插入数据
          $.ajax({
              url:"<?php echo url('admin/backmanager/roleEdit'); ?>",
              //data数据角色id,角色名,角色介绍
              //复数数据使用json
              data:{'roleid':editId,'rolename':editName,'roledetails':editDetails,'menuid':newmenuid},
              type:'post',
              dataType:'json',
              success:function(res) {
                    alert(res.msg);
                    window.location.reload();
              }
          })

      });

  </script>
  <script>

  </script>
</html>
<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:85:"D:\AppServ\www\hf1707_zc\public/../application/admin\view\backmanager\empmanager.html";i:1517473165;}*/ ?>
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
                      <td>{{roleInfo.empid}}</td><td>{{roleInfo.empname}}</td><td>{{roleInfo.rolename}}</td><td>--</td><td>--</td>
                  </tr>
                  <tr v-for="roleInfo in allrole" v-if="roleInfo.roleid!=1">
                      <td>{{roleInfo.empid}}</td><td>{{roleInfo.empname}}</td><td>{{roleInfo.rolename}}</td>
                      <td>
                        <a :rid="roleInfo.empid" data-toggle="modal" data-target="#modalEdit" onclick="empEdit(this)" href="#">权限修改</a>
                      </td>
                     <td>
                         <a :rid="roleInfo.empid" onclick="empDel(this)" href="#">删除</a>
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
  <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalLabelEdit">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="modalLabelEdit">修改角色</h4>
                  <!--------------------------添加角色------------------------------>
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
                          <span class="x-red">*</span>必填
                      </div>
                  </div>
                  <!--权限添加-->
                  <div class="layui-form-item">
                      <label for="gradeEdit" class="layui-form-label">
                          <span class="x-red">*</span>权限选择
                      </label>
                      <div class="layui-input-inline">
                          <input type="text" id="gradeEdit" name="gradeEdit" required="" lay-verify=""
                                 autocomplete="off" class="layui-input">
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
                          <input type="text" id="introEdit" name="introEdit" required="" lay-verify=""
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
                  <button type="button" class="btn layui-btn">确认修改</button>
              </div>
          </div>
      </div>
  </div>

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
  <script src="__JS__/jquery-2.1.4.js"></script>
  <script src="__JS__/bootstrap.min.js"></script>

  <script>
      $(
              $.ajax({
                  url:"<?php echo url('admin/backmanager/allEmp'); ?>",
                  type:'post',
                  dataType:'json',
                  data:'',
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

      //修改角色
      function roleEdit(){

      }
      //添加角色
      $("#roleAdd").click(function (){

      });

      //删除角色
      function empDel(obj){
        $rid = $(obj).attr('rid');
          $checkDel = confirm('您确定要删除该员工吗？');
          if($checkDel){
              $.ajax({
                  url:"<?php echo url('admin/backmanager/empDel'); ?>",
                  data:'rid='+$rid,
                  dataType:'json',
                  type:'post',
                  success:function(res){
                      alert(res.msg);
                      window.location.reload();
                  }
              })
          }
      }

      function empEdit(){

      }
  </script>
  <script>
  </script>
</html>
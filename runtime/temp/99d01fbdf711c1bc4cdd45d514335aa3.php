<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:72:"D:\AppServ\www\hf1707_zc\public/../application/admin\view\chat\chat.html";i:1517558113;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" href="__CSS__/chat.css">
    <link rel="stylesheet" type="text/css" href="__STATIC__/font_Icon/iconfont.css">
</head>
<body>
<div id="myChat" style="left: 400px;"></div>
<!--<div class="chatContainer">-->
    <div id="chatlist" ref="chatBox">
        <!--头部-->
        <div class="chatBox-head">
            <div class="chatBox-head-one">
                <div class="chat-people">
                    <div class="ChatInfoHead">
                        <img id="headimg" src="__STATIC__/img/admin/icon01.png" alt="头像"/>
                    </div>
                    <div id="empname" class="ChatInfoName"></div>
                </div>
            </div>
        </div>
        <!--用户列表-->
        <div class="chatBox-info" style="height: 100%">
            <div class="chatBox-list" ref="chatBoxlist" style="height: 100%">
            </div>
        </div>
    </div>
<!--</div>-->
</body>
<script src="__JS__/jquery-2.1.4.js"></script>
<script>
    var empInfo=<?php echo $empInfo; ?>;
    var empid=empInfo[0]['empid'];
    var empheadimg=empInfo[0]['headimg'];
    var empname=empInfo[0]['empname'];
    $("#headimg").attr("src",empheadimg);
    $("#empname").text(empname);
    var staticUrl='__STATIC__';
</script>
<script src="__JS__/qqface.js"></script>
<script src="__JS__/myChat.js"></script>
<script src="__JS__/admin/connectServer.js"></script>



</html>
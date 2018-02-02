<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:72:"D:\AppServ\www\hf1707_zc\public/../application/admin\view\chat\chat.html";i:1517553765;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" href="__CSS__/chat.css">
</head>
<body>
<!--<div class="chatContainer">-->
    <div id="chatlist" ref="chatBox">
        <!--头部-->
        <div class="chatBox-head">
            <div class="chatBox-head-one">
                <div class="chat-people">
                    <div class="ChatInfoHead">
                        <img id="headimg" src="__STATIC__/img/admin/icon01.png" alt="头像"/>
                    </div>
                    <div id="empname" class="ChatInfoName">这是用户的名字，看看名字到底能有多长</div>
                </div>
            </div>
        </div>
        <!--用户列表-->
        <div class="chatBox-info" style="height: 100%">
            <div class="chatBox-list" ref="chatBoxlist" style="height: 100%">
                <!--<div class="chat-list-people">-->
                    <!--<div><img  src="__STATIC__/img/admin/icon01.png" alt="头像"/></div>-->
                    <!--<div class="chat-name" style="width: auto;">-->
                        <!--<p>qqq</p>-->
                    <!--</div>-->
                    <!--<div class="message-num">10</div>-->
                <!--</div>-->
            </div>
        </div>
    </div>
<!--</div>-->
</body>
<script src="__JS__/jquery-2.1.4.js"></script>
<script>
    var empInfo=<?php echo $empInfo; ?>;
    var empid=empInfo[0]['empid']
    $("#headimg").attr("src",empInfo[0]['headimg']);
    $("#empname").text(empInfo[0]['empname']);
    var staticUrl='__STATIC__';

</script>
<script src="__JS__/admin/connectServer.js"></script>
</html>

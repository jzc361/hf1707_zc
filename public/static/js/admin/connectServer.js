/**
 * Created by Administrator on 2018/2/2.
 */
var ws=new WebSocket("ws://localhost:7777");
ws.onopen=function()
{
    console.log("连接上服务器了");
    console.log(empInfo);

    //获取用户列表
    var msg={
        sender:empid,
        rever:'server',
        type:'getUserList',
        content:empid,
        msgid:11111,
        msgtime:(new Date()).getTime()
    };
    var msgString=JSON.stringify(msg);
    ws.send(msgString);
};

ws.onmessage=function(msg)
{
    var msgObj=JSON.parse(msg.data);
    if(msgObj.type=='getUserListResp') {
        var empMsg=[];
        if(msgObj.content!=false)
        {
            empMsg=msgObj.content;
        }
        console.log(empMsg);
        showUserList(empMsg);
    }
    else  if(msgObj.type=='getHisWithThisResp'){
        var hisList=[];
        if(msgObj.content!=false)
        {
            hisList=msgObj.content;
        }
        console.log(hisList);
        //showUserList(empMsg);
    }
};

ws.onclose=function()
{
    console.log("服务器已关闭");
};

//用户列表显示
function showUserList(empMsg){
    var chatBoxList=$(".chatBox-list");
    if(empMsg.length>0){
        for (var i=0;i<empMsg.length;i++){
            var $user=$("<div class='chat-list-people' value='"+empMsg[i]['userid']+"'></div>");
            $user.append(' ' +
                '<div><img src='+staticUrl+'/'+empMsg[i]["headimg"]+' alt="头像"/></div>\
                 <div class="chat-name" style="width: auto;">\
                    <p>'+empMsg[i]['username']+'</p>\
                 </div>\
                 <div class="message-num">10</div>');
            chatBoxList.append($user);
            //点击某用户，获取聊天记录
            $user.click(function(){
                var $userid=$(this).attr("value");
                console.log($userid);
                var msg={
                    sender:empid,
                    rever:'server',
                    type:'getHisWithThis',
                    content:{userid:$userid,empid:empid},
                    msgid:11111,
                    msgtime:(new Date()).getTime()
                };
                var msgString=JSON.stringify(msg);
                ws.send(msgString);

            });
            //chatBoxList.append('<div class="chat-list-people">\
            //<div><img src='+staticUrl+'/'+empMsg[i]["headimg"]+' alt="头像"/></div>\
            //<div class="chat-name" style="width: auto;">\
            //<p>'+empMsg[i]['username']+'</p>\
            //</div>\
            //<div class="message-num">10</div>\
            //</div>');
        }
    }
    else if(empMsg.length==0){
        chatBoxList.append("<p style='text-align: center'>暂无</p>");

    }
}
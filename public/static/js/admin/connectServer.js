/**
 * Created by Administrator on 2018/2/2.
 */

var chatdiv=$("#myChat");
var $chat=new MyChat(chatdiv,function(message){
    console.log(message);
});
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
        var chatList=[];
        if(msgObj.content!=false)
        {
            chatList=msgObj.content;
        }
        console.log(chatList);
        showChatMsg(chatList);
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
                userSrc=$(this).find("img").attr("src");
                var name=$(this).find("p").text();
                $chat.setHead(userSrc,name); //设置头部 （选择的客服的头像与昵称）
                $chat.show();
                $chat.sendMsg(empheadimg); //调用发送消息，并传入当前客服的头像
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
        }
    }
    else if(empMsg.length==0){
        chatBoxList.append("<p style='text-align: center'>暂无</p>");
    }
}

//聊天页面显示
function showChatMsg(chatList){
    $("#chatBox-content-demo").empty();
    if(chatList.length>0){
        for (var i=0;i<chatList.length;i++){
            if(chatList[i]['sender']==empid){  //发送者为客服，放右边
                $chat.sendMsgView(empheadimg,chatList[i]['content']);
            }
            else if(chatList[i]['rever']==empid){
                $chat.getFriendMsg(userSrc,chatList[i]['content']);

            }
        }
    }
    else {
        //清空
    }

}
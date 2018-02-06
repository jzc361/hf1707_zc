/**
 * Created by Administrator on 2018/2/2.
 */
var choiceUser='';
var userSrc='';
var chatdiv=$("#myChat");
var hisShow=$("#hisShow");
var $chat=new MyChat(chatdiv,hisShow,function(message){
    var msg = {
        sender: empid,
        rever: choiceUser,
        type: 'personChat1',
        content: message,
        msgid: 11111,
        msgtime: (new Date()).getTime()
    };
    var msgString = JSON.stringify(msg);
    ws.send(msgString);
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
         userList=[];
        if(msgObj.content!=false)
        {
            userList=msgObj.content;
        }
        showUserList(userList);
    }
    else  if(msgObj.type=='getHisWithThisResp'){
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
        var chatList=[];
        if(msgObj.content!=false)
        {
            chatList=msgObj.content;
        }
        console.log(chatList);
        showChatMsg(chatList);
        //showUserList(userList);
    }
    else if(msgObj.type=='personChat'){
        console.log(choiceUser);
        console.log(msgObj.sender);
        //如果发消息的是当前聊天的用户才做实时显示   不获取新的用户列表，并且改为已读
        if(choiceUser!='' && msgObj.sender==choiceUser){
            $chat.getFriendMsg(userSrc,msgObj.content);
          //不获取新的用户列表，并且改为已读
            var msg={
                sender:empid,
                rever:'server',
                type:'updateUnread',
                content:{userid:choiceUser,empid:empid},
                msgid:11111,
                msgtime:(new Date()).getTime()
            };
            var msgString=JSON.stringify(msg);
            ws.send(msgString);
        }
        else
        {
            //获取新的用户列表
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
        }
        //showUserList(userList);

    }
};

ws.onclose=function()
{
    console.log("服务器已关闭");
};

//点击关闭
$(".chat-close").click(function(){
    //console.log(choiceUser);
    choiceUser=''
});
//用户列表显示
function showUserList(userList){
    var chatBoxList=$(".chatBox-list");
    chatBoxList.empty();
    if(userList.length>0){
        for (var i=0;i<userList.length;i++){
            var $user=$("<div class='chat-list-people' value='"+userList[i]['userid']+"'></div>");
            if(userList[i]['unreadcount']==0){
                $user.append(' ' +
                    '<div><img src='+staticUrl+'/'+userList[i]["headimg"]+' alt="头像"/></div>\
                 <div class="chat-name" style="width: auto;">\
                    <p>'+userList[i]['username']+'</p>\
                 </div>\
                 <div class=""></div>');
            }
            else {
                $user.append(' ' +
                    '<div><img src='+staticUrl+'/'+userList[i]["headimg"]+' alt="头像"/></div>\
                 <div class="chat-name" style="width: auto;">\
                    <p>'+userList[i]['username']+'</p>\
                 </div>\
                 <div class="message-num">'+userList[i]['unreadcount']+'</div>');
            }

            chatBoxList.append($user);
            //点击某用户，获取聊天记录
            $user.click(function(){
                userSrc=$(this).find("img").attr("src");
                var name=$(this).find("p").text();
                var $userid=$(this).attr("value");
                choiceUser=$userid;
                console.log($userid);
                //var $chat=new MyChat(chatdiv);
                $chat.setHead(userSrc,name); //设置头部 （选择的客服的头像与昵称）
                $chat.show();
                $chat.sendMsg(staticUrl+"/"+empheadimg); //调用发送消息，并传入当前客服的头像

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
    else if(userList.length==0){
        chatBoxList.append("<p style='text-align: center'>暂无</p>");
    }
}

//聊天页面显示
function showChatMsg(chatList){
    $("#chatBox-content-demo").empty();
    if(chatList.length>0){
        for (var i=0;i<chatList.length;i++){
            if(chatList[i]['sender']==empid){  //发送者为客服，放右边
                $chat.sendMsgView(staticUrl+"/"+empheadimg,chatList[i]['content']);
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

//点击消息记录获取消息记录
$(":button[value='消息记录']").click(function(){
    $.ajax({
         type: "get",
         url: getHisUrl,
         data: {empid:empid,userid:choiceUser},
         dataType: "json",
         success: function (responseData){
             //console.log(responseData);
             var res=JSON.parse(responseData);
             var hisList=res['hisList'];
             var username=res['username'];
             var empname=res['empname'];
             console.log(res);
             var $btnPage=$("#page");
             $btnPage.empty();
             var chatHisPage=new MyPage($btnPage,hisList.length,6,function(start,end){
                var hisContent=$("#hisContent");
                 hisContent.empty();
                 for(var i=start;i<=end;i++)
                 {
                     if(hisList[i]['sender']==choiceUser){
                         hisContent.append("<div>\
                         <p class='hisP' style='color: blue'>\
                             <span style='margin-right: 10px;'>"+username+"</span>\
                             <span>"+hisList[i]['msgTime']+"</span>\
                        </p>\
                        <p class='hisP'>"+hisList[i]['content']+"</p>\
                     </div>");
                     }
                     else {
                         hisContent.append("<div>\
                         <p class='hisP' style='color: orange'>\
                             <span style='margin-right: 10px;'>"+empname+"</span>\
                             <span>"+hisList[i]['msgTime']+"</span>\
                         </p>\
                         <p class='hisP'>"+hisList[i]['content']+"</p>\
                     </div>");
                     }
                 }
             });
             //console.log(responseData);
            // console.log(hisList);
         },
         error:function(){
             alert("error");
         }
    });
   // location.href=""+getHisUrl+"?empid="+empid+"&userid="+choiceUser;
});

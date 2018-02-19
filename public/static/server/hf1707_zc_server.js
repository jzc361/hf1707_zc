var EmpDAO=require("./HF1707_zc_Modules/EmpDAO");
var loginUser=[];
var ws=require("ws");//引用ws模块
var Server=ws.Server;//获取ws模块的Server属性
var server=new Server({port:7777});//创建端口号为8888的服务器
console.log("服务器已开启...");
server.on('connection',function(socket){
    console.log("有人来了...");
    socket.on("message",function(data){
        var msg=JSON.parse(data);
        loginUser[msg.sender]=socket;
        if(msg.type=='getUserList')
        {
            var empid=msg.content;
            //获取客服信息
            EmpDAO.getUserList(empid,function(result,rows){
                if(result==true)
                {
                    //console.log(rows);
                    var msgResp={
                        sender:'server',
                        rever:msg.sender,
                        type:'getUserListResp',
                        content:rows,
                        msgid:11111,
                        msgtime:(new Date()).getTime()
                    };
                }
                else{
                    var msgResp={
                        sender:'server',
                        rever:msg.sender,
                        type:'getUserListResp',
                        content:false,
                        msgid:11111,
                        msgtime:(new Date()).getTime()
                    }
                }
                var msgRespString=JSON.stringify(msgResp);
                socket.send(msgRespString);
            });
            console.log(msg.content);
        }
        else if(msg.type=='getHisWithThis'){
            console.log(msg.content);
            var userid=msg.content.userid;
            var empid=msg.content.empid;
            //先把未读消息改为0，在获取聊天记录
            EmpDAO.updateUnread(userid,empid,function(result,rows){
                if(result==true){
                    //获取聊天记录
                    EmpDAO.getHisMsg(userid,empid,function(result,rows){
                        if(result==true)
                        {
                            //console.log(rows);
                            var msgResp={
                                sender:'server',
                                rever:msg.sender,
                                type:'getHisWithThisResp',
                                content:rows,
                                msgid:11111,
                                msgtime:(new Date()).getTime()
                            };
                        }
                        else{
                            var msgResp={
                                sender:'server',
                                rever:msg.sender,
                                type:'getHisWithThisResp',
                                content:false,
                                msgid:11111,
                                msgtime:(new Date()).getTime()
                            }
                        }
                        var msgRespString=JSON.stringify(msgResp);
                        socket.send(msgRespString);
                    });
                }
            });

        }
        else if(msg.type=='personChat'){
            console.log(msg);
            var userid=msg.sender;
            var empid=msg.rever;
            var message=msg.content;
            //默认保存未读记录
            EmpDAO.insertHisToUnread(userid,empid,message,function(result){
                if(result==true){
                    //console.log("插入记录成功");
                }
            });
            var revSocket=loginUser[empid];
            //console.log(revSocket);
            if(revSocket!=undefined && revSocket.readyState==ws.OPEN)
            {
                revSocket.send(data);
            }
        }
        //改为已读
        else if(msg.type=='updateUnread'){
            var userid=msg.content.userid;
            var empid=msg.content.empid;
            EmpDAO.updateUnread(userid,empid,function(result,rows){

            });
        }
        else if(msg.type=='personChat1'){

            //获取一下用户的信息（头像）
            console.log(msg);
            var empid=msg.sender;
            var userid=msg.rever;
            var message=msg.content;

            EmpDAO.insertHisToUnread(empid,userid,message,function(result){
                if(result==true){
                    //console.log("插入记录成功");
                }
            });
            var revSocket=loginUser[userid];
            //console.log(revSocket);
            if(revSocket!=undefined && revSocket.readyState==ws.OPEN)
            {
                revSocket.send(data);
            }
        }
        else if(msg.type=='getHisWithThis1'){
            var userid=msg.content.userid;
            var empid=msg.content.empid;
            //先把未读消息改为0，在获取聊天记录
            EmpDAO.updateUnread(userid,empid,function(result,rows){
                if(result==true){
                    //获取聊天记录
                    EmpDAO.getHisMsg(userid,empid,function(result,rows){
                        if(result==true)
                        {
                            //console.log(rows);
                            var msgResp={
                                sender:'server',
                                rever:msg.sender,
                                type:'getHisWithThis1Resp',
                                content:rows,
                                msgid:11111,
                                msgtime:(new Date()).getTime()
                            };
                        }
                        else{
                            var msgResp={
                                sender:'server',
                                rever:msg.sender,
                                type:'getHisWithThis1Resp',
                                content:false,
                                msgid:11111,
                                msgtime:(new Date()).getTime()
                            }
                        }
                        var msgRespString=JSON.stringify(msgResp);
                        socket.send(msgRespString);
                    });
                }
            });
        }
        else if(msg.type=='insertHisToRead'){
            console.log(msg);
            var empid=msg.content.empid;
            var userid=msg.content.userid;
            EmpDAO.insertHisToUnread(empid,userid,function(result){
                if(result==true){
                    var msgResp={
                        sender:'server',
                        rever:msg.sender,
                        type:'insertHisToUnreadResp',
                        content:'',
                        msgid:11111,
                        msgtime:(new Date()).getTime()
                    };
                    var msgRespString=JSON.stringify(msgResp);
                    socket.send(msgRespString);
                }
            });
        }
        socket.on("close",function()
        {
            console.log("客户端已关闭") ;
        });
    });
});
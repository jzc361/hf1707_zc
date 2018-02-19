function EmpDAO()
{
    this.adapter=require("./MyAdapter");
}

//所有server离线
EmpDAO.prototype.allServerExit=function(callback){
    var sql="update t_emp set loginstate='离线'";
    this.adapter.run(sql,
        [],
        function(result){
            if(result==true) //判断sql语句是否执行成功
            {
                callback(true);
            }
            else{
                callback(false);
            }
        });
};

//修改客服的未读消息字段为0（已读）
EmpDAO.prototype.updateUnread=function(userid,empid,callback){
    var sql="UPDATE zc_chats SET unreadcount = 0 WHERE rever = ? AND sender=?";
    this.adapter.run(sql,
        [empid,userid],
        function(result){
            if(result==true) //判断sql语句是否执行成功
            {
                callback(true);
            }
            else{
                callback(false);
            }
        });
};
//修改用户的未读消息字段为0（已读）
EmpDAO.prototype.updateUnread1=function(userid,empid,callback){
    var sql="UPDATE zc_chats SET unreadcount = 0 WHERE rever = ? AND sender=?";
    this.adapter.run(sql,
        [userid,empid],
        function(result){
            if(result==true) //判断sql语句是否执行成功
            {
                callback(true);
            }
            else{
                callback(false);
            }
        });
};
//获取当前客服接受信息的用户列表  与 未读消息数
EmpDAO.prototype.getUserList=function(empid,callback){
    var sql="SELECT a.userid,a.username,a.headimg,b.unreadcount FROM zc_user a," +
        "(select b.sender,sum(b.unreadcount) unreadcount from zc_emp a,zc_chats b " +
        "where a.empid=b.rever and a.empid=? group by b.sender ORDER BY b.msgTime DESC)b" +
        " WHERE a.userid in (b.sender)";
    this.adapter.all(sql,[empid],function(result,rows){
        //此时为查询所以有两个参数，rows即执行sql得出的结果，若是增删改，一个参数result即可
        if(result==true) //判断sql语句是否执行成功
        {
            callback(true,rows);

        }
        else{
            callback(false);
        }
    });
};
//获取与某个用户的聊天记录
EmpDAO.prototype.getHisMsg=function(userid,empid,callback){
    var sql="select * from zc_chats where (sender=? and rever=?) or (rever=? and sender=?)";
    this.adapter.all(sql,[userid,empid,userid,empid],function(result,message){
        if(result==true) //判断sql语句是否执行成功
        {
            callback(true,message);
        }
        else{
            callback(false);
        }
    });
};
//插入已读聊天记录
EmpDAO.prototype.insertHisToRead=function(userid,empid,message,callback){
    var sql="insert into zc_chats(sender,rever,content,msgTime,unreadcount) " +
        "values(?,?,?,now(),0)";
    this.adapter.run(sql,
        [userid,empid,message],
        function(result){
            if(result==true) //判断sql语句是否执行成功
            {
                //console.log("成功");
                callback(true);
            }
            else{
                callback(false);
            }
        });
};
//插入未读聊天记录
EmpDAO.prototype.insertHisToUnread=function(userid,empid,message,callback){
    var sql="insert into zc_chats(sender,rever,content,msgTime,unreadcount) " +
        "values(?,?,?,now(),1)";
    this.adapter.run(sql,
        [userid,empid,message],
        function(result){
            if(result==true) //判断sql语句是否执行成功
            {
                //console.log("成功");
                callback(true);
            }
            else{
                callback(false);
            }
        });
};
module.exports=new EmpDAO();
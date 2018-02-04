if(localStorage.userMsg!=undefined){
	var userMsg=JSON.parse(localStorage.userMsg);
	var userid=userMsg[0]['userid'];
	var userimg=userMsg[0]['headimg'];
}
var choiceServerId='';
var choiceServerImg='';
var ws=new WebSocket("ws://localhost:7777");
ws.onopen=function()
{
    console.log("连接上服务器了");
};

ws.onmessage=function(msg)
{
    var msgObj=JSON.parse(msg.data);
	if(msgObj.type=='personChat1'){
		console.log(msgObj.content);
		if(choiceServerId!='' && msgObj.sender==choiceServerId){
			$chat.getFriendMsg(choiceServerImg,msgObj.content);
		}
		//showChatNow();

	}
	else if(msgObj.type=='getHisWithThis1Resp'){
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


//聊天页面显示
function showChatMsg(chatList){
	console.log(choiceServerImg);
	$("#chatBox-content-demo").empty();
	if(chatList.length>0){
		for (var i=0;i<chatList.length;i++){
			if(chatList[i]['sender']==choiceServerId){  //发送者为客服，放左边
				$chat.getFriendMsg(choiceServerImg,chatList[i]['content']);
			}
			else if(chatList[i]['rever']==choiceServerId){
				$chat.sendMsgView(userimg,chatList[i]['content']);

			}
		}
	}
	else {
		//清空
	}

}
var chatdiv=$("#myChat");

var hisShow=$("#hisShow");
var $chat=new MyChat(chatdiv,hisShow,function(message){
	//发送消息给客服
	var msg = {
		sender: userid,
		rever: choiceServerId,
		type: 'personChat',
		content: message,
		msgid: 11111,
		msgtime: (new Date()).getTime()
	};
	var msgString = JSON.stringify(msg);
	ws.send(msgString);
	console.log(message);
});
new Vue({
	el : '#service',
	//数据
	data:{
		serviceList:''
	},
	//方法
	methods:{
		getService:function(){
			var _this=this;
			$.ajax({
				type: "post",
				url: getServiceMsgUrl,
				dataType: "json",
				success: function (responseData){
					_this.serviceList=responseData;
					localStorage.serviceMsg=JSON.stringify(responseData);
				},
				error:function(){
					alert("error");
				}
			});
		},
		showchat:function(empid,empname,src){
			choiceServerId=empid;
			choiceServerImg=staticUrl+"/"+src;
			$chat.setHead(staticUrl+"/"+src,empname); //设置头部 （选择的客服的头像与昵称）
			$chat.show();
			$chat.sendMsg(staticUrl+"/"+userMsg[0]['headimg']); //调用发送消息，并传入当前用户的头像
			$chat.show();
			console.log(empname);
			//获取历史记录
			var msg={
				sender:userid,
				rever:'server',
				type:'getHisWithThis1',
				content:{userid:userid,empid:empid},
				msgid:11111,
				msgtime:(new Date()).getTime()
			};
			var msgString=JSON.stringify(msg);
			ws.send(msgString);

		}

	},

	mounted:function(){
//fd
	}
});

$(":button[value='消息记录']").click(function(){

	console.log(choiceServerId,userid);
	$.ajax({
		type: "get",
		url: getHisUrl,
		data: {empid:choiceServerId,userid:userid},
		dataType: "json",
		success: function (responseData){
			//console.log(responseData);
			var res=JSON.parse(responseData);
			var hisList=res['hisList'];
			var username=res['username'];
			var empname=res['empname'];
			//console.log(res);
			var $btnPage=$("#page");
			$btnPage.empty();
			var chatHisPage=new MyPage($btnPage,hisList.length,6,function(start,end){
				var hisContent=$("#hisContent");
				hisContent.empty();
				for(var i=start;i<=end;i++)
				{
					if(hisList[i]['sender']==userid){
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

});

//点击某客服
$(function(){
	var $qqServer = $('.qqserver');
	var $qqserverFold = $('.qqserver_fold');
	var $qqserverUnfold = $('.qqserver_arrow');
	$qqserverFold.click(function(){
		$qqserverFold.hide();
		$qqServer.addClass('unfold');
	});
	$qqserverUnfold.click(function(){
		$qqServer.removeClass('unfold');
		$qqserverFold.show();
	});
	//窗体宽度小鱼1024像素时不显示客服QQ
	function resizeQQserver(){
		$qqServer[document.documentElement.clientWidth < 1024 ? 'hide':'show']();
	}
	$(window).bind("load resize",function(){
		resizeQQserver();
	});
});



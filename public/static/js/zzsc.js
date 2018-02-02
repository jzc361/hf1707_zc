if(localStorage.userMsg!=undefined){
	var userMsg=JSON.parse(localStorage.userMsg);
	var userid=userMsg[0]['userid'];
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
		//showChatNow();
		$chat.getFriendMsg(choiceServerImg,msgObj.content);

	}
};

ws.onclose=function()
{
    console.log("服务器已关闭");
};
var chatdiv=$("#myChat");


var $chat=new MyChat(chatdiv,function(message){
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

		}

	},

	mounted:function(){
//fd
	}
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

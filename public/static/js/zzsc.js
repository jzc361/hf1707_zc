//var serviceList = {$serviceList};

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
					//console.log(responseData);
					_this.serviceList=responseData;

					//console.log(_this.serviceList);
					//console.log(responseData);
					///alert(responseData.msg);
					//location.reload(true);
				},
				error:function(){
					alert("error");
				}
			});
		}

	},

	mounted:function(){
//fd
	}
});

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

$(function(){
	//var $qqServer = $('.qqserver');
	//var $qqserverFold = $('.qqserver_fold');
	//var $qqserverUnfold = $('.qqserver_arrow');
	//$qqserverFold.click(function(){
	//	$qqserverFold.hide();
	//	$qqServer.addClass('unfold');
	//});
	//$qqserverUnfold.click(function(){
	//
    //
	//});
	//窗体宽度小鱼1024像素时不显示客服QQ
	//function resizeQQserver(){
	//	$qqServer[document.documentElement.clientWidth < 1024 ? 'hide':'show']();
	//}
	//$(window).bind("load resize",function(){
	//	resizeQQserver();
	//});
});
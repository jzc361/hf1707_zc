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
					_this.serviceList=responseData;
				},
				error:function(){
					alert("error");
				}
			});
		},
		showchat:function(empname){
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

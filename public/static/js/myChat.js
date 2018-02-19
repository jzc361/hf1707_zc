/**
 * Created by Administrator on 2018/2/1.
 */
function MyChat($div,$hisdiv,callback){
    this.$div=$div;
    this.$contentR=$hisdiv;
    this.callback=callback;
    this.draw();
}

MyChat.prototype.draw=function(){
    this.$div.attr('class','chatBox');
    this.$contentR.attr('class','contentR');
    //聊天框头部
    this.$head=$("<div class='chatBox-head-one chatBox-head'></div>");
    //聊天用户信息显示
    this.$userMsg=$("<div class='chat-people'></div>");
    this.$head.append(this.$userMsg);
    //关闭
    this.$close=$("<div class='chat-close' style='margin: 10px 10px 0 0;font-size: 14px'>关闭</div>");
    //this.$close=$("<input class='chat-close' style='margin: 10px 10px 0 0;font-size: 14px' value='关闭'>");
    this.$head.append(this.$userMsg,this.$close);
    //点击关闭
    this.$close.click(function(){
        this.$userMsg.empty();
        this.$div.hide();
        this.myface.hide();
        //this.mydraw.hide();
        //this.$divR.hide();
    }.bind(this));
    //聊天框头部结束
    //左边
    this.$contentL=$("<div></div>");
    //聊天信息显示
    this.$chatBox=$("<div class='chatBox-info' style='top: 0;'></div>");
    this.$chatBoxContent=$("<div class='chatBox-content' style='height:100%'></div>");
    this.$chatBox.append(this.$chatBoxContent);
    //this.$div.append(this.$chatBox);
    //this.$chatBoxContent=$("<div></div>")
    this.msgDiv=$("<div class='chatBox-content-demo' id='chatBox-content-demo' style='height:100%;'></div>");
    this.$chatBoxContent.append(this.msgDiv);
    //聊天框底部
    this.$footer=$("<div class='chatBox-send'></div>");
    this.$btn=$("<div></div>");
    //选择表情
    this.$face=$("<button class='btn-default-styles'> <i class='iconfont icon-biaoqing'></i></button>");
    this.$faceDiv=$("<div></div>");//装表情的div,也要append到this.$div
    //直接调用表情插件
    this.myface=new QqFace(this.$faceDiv,''+staticUrl+'/expression/',function(img){
        this.$inputDiv.append(img);
    }.bind(this));
    //点击表情
    this.$face.click(function()
    {
        this.myface.display(event);
    }.bind(this));
    //选择图片
    this.$pic=$('' +
        '<label id="chat-tuxiang" title="发送图片" for="inputImage" class="btn-default-styles">\
            <input type="file" onchange="selectImg(this)" accept="image/jpg,image/jpeg,image/png" name="file" id="inputImage" class="hidden">\
            <i class="iconfont icon-tuxiang"></i>\
        </label>');
    //消息记录
    this.$hisBtn=$("<input type='button' class='hisBtn' value='消息记录'>");
    //点击消息记录
    this.$hisBtn.click(function(){
        this.$contentR.toggle();
        if(this.$contentR.css("display")=="none"){
            this.$contentL.css({width:"100%"});
        }
        else {
            this.$contentL.css({width:"65%"});
        }
    }.bind(this));
    //输入框
    this.$inputDiv=$("<div class='div-textarea' contenteditable='true'></div>");
    //发送按钮
    this.$sendBtn=$("<div><button class='sendBtn' type='button'>发送</button></div>");
    //点击发送

    this.$btn.append(this.$face, this.$pic,this.$hisBtn);
    this.$footer.append(this.$btn,this.$inputDiv,this.$sendBtn);
    this.$contentL.append(this.$chatBox,this.$footer,this.$faceDiv);
    this.$contentL.css({width: '100%', height: '88%', marginTop: '77px', float: 'left',position:"relative" });
    //右边 消息记录
    //this.$contentR=$("<div></div>");
    //this.$contentR.css({width: '35%', height: '90%', marginTop: '74px', float: 'right',display:"none",backgroundColor:' #eee',
    //border: '1px #D0D0D0 solid'});
    this.$div.append(this.$head,this.$contentL,this.$contentR);
};
//设置头部信息
MyChat.prototype.setHead=function(img,nickname){
    this.$userMsg.empty();
    this.$userMsg.append('\
    <div class="ChatInfoHead">\
        <img src='+img+' alt="头像"/>\
    </div>\
    <div class="ChatInfoName">'+nickname+'</div>'); //方法接入
};
//发送消息
MyChat.prototype.sendMsg=function(img)
{
    this.$sendBtn.click(function(){
        var message=this.$inputDiv.html();
        if(message!=''){
            this.myface.hide();//隐藏表情框
            //this.mydraw.hide();
            this.msgDiv.append('\
        <div class="clearfloat">\
            <div class="right">\
                <div class="chat-message">'+message+'</div>\
                <div class="chat-avatars">\
                    <img src='+img+' alt="头像"/>\
                </div>\
            </div>\
        </div>');
            if(this.callback instanceof Function){
                this.callback(message);
            }
            this.$inputDiv.empty();
            // $(document).ready(function () {
            $("#chatBox-content-demo").scrollTop($("#chatBox-content-demo")[0].scrollHeight);
            // });
        }
        else {
            //this.$inputDiv.html('请输入发送的消息');
        }

    }.bind(this));
};
//接收消息显示
MyChat.prototype.getFriendMsg=function(img,message){
    this.msgDiv.append('\
    <div class="clearfloat" style="font-size: 17px;">\
        <div class="left">\
            <div class="chat-avatars">\
                <img src='+img+' alt="头像"/>\
            </div>\
            <div class="chat-message">\
            '+message+'\
            </div>\
        </div>\
    </div>');
    $("#chatBox-content-demo").scrollTop($("#chatBox-content-demo")[0].scrollHeight);

};
//发送消息显示
MyChat.prototype.sendMsgView=function(img,message){
    this.msgDiv.append('\
    <div class="clearfloat" style="font-size: 17px;">\
        <div class="right">\
            <div class="chat-message">\
            '+message+'\
            </div>\
            <div class="chat-avatars">\
                <img src='+img+' alt="头像"/>\
            </div>\
        </div>\
    </div>');
    $("#chatBox-content-demo").scrollTop($("#chatBox-content-demo")[0].scrollHeight);

};
//显示
MyChat.prototype.show=function()
{
    //this.$userMsg.empty();
    this.$div.show();
};

//显示历史记录
MyChat.prototype.showHis=function(HisList)
{
    //循环显示发送者什么时间发送了什么
    this.$contentR.append("<div>" +
            "<p class='hisP'>" +
                "<span style='margin-right: 10px;'>小一</span>" +
                "<span>2018/2/4/10:10</span>" +
            "</p>" +
            "<p class='hisP'>你在干嘛</p>" +
        "</div>");
};





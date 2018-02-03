/**
 * Created by Administrator on 2017/10/11.
 */

function QqFace($div,$pash,callback,css)
{
    this.$div=$div;
    this.$pash=$pash;//图片路径，每个人都不一定一样
    this.callback=callback;
    if(css==undefined)
    {
        this.css={
            backgroundColor:'rgb(238, 238, 238)',
            width:'267px',
            height:'200px',
            display: 'none',
            position: 'absolute'
        };
    }
    else{
        this.css=css;
        //在html var一个css
    }
    this.draw();
}
//绘制控件
QqFace.prototype.draw=function()
{
  /*  this.$div.css({
        backgroundColor: 'gainsboro',
        width:'267px',
        height:'200px',
        display: 'none',
        position: 'absolute',
        zIndex: '500'
    });*/
    this.$div.css(this.css);
    this.$div.empty();
    for(var i=1;i<=75;i++)
    {
          var $img=$("<img src='"+this.$pash+i+".gif'/>");
        /*法二:在这var self=this;此时this即为QqFace，所以可以把 this.callback改成 self.callback
          就不用加bind(this)，$(this).clone()就也不用改了，因为click里的this即为被点击的img*/
        $img.click(function(event) { //所有的img
            if(this.callback instanceof Function)
            {
                this.callback($(event.target).clone());
            }
            //用回调把$(event.target).clone()作为参数传出去，再在外面append到对应的地方
            //$(this).clone() 要改成 $(event.target).clone() //因为此时的this为QqFace不为$img
        }.bind(this));//要调用QqFace的callback，而此时的this为img，所以要bind（this）
        this.$div.append($img);
    }
};
//显示，隐藏+设置位置方法
QqFace.prototype.display=function(event){
    this.$div.css({
        top:event.offsetY+160,
        left:event.offsetX
    });
    this.$div.toggle(1000);
};
//隐藏
QqFace.prototype.hide=function()
{
    this.$div.hide();
};



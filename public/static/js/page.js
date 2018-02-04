/**
 * Created by Administrator on 2017/10/12.
 */
//* 传入的参数：1.标签 2.总的条数 3.每页的条数
// 4.回调函数（开始行，结束行）：点击上一页，下一页或某页数时显示界面
// （显示都不能写在封装里，一般都用回调显示）
// */
function MyPage($div,total,pagesize,callback,css)
{
    this.$div=$div;
    this.total=total;   //总条数
    this.pagesize=pagesize; //每页的条数
    this.currpage=1;//当前页
    this.totalpage=0;//总页数
    this.callback=callback;
    if(css==undefined)
    {
        this.css={
            //width:'100%',
            textAlign: 'center',
            fontSize:"12px",
            height: '30px',
            marginTop: '15px',
            position:"absolute",
            bottom:"5px"
        };
    }
    else{
        this.css=css;
    }
    //this.css=css;
    this.draw();
    this.compute();
}
//首页 上一页  下一页 尾页
MyPage.prototype.draw=function()
{
    this.$div.css(this.css);
    this.totalpage=Math.ceil(this.total/this.pagesize);//计算总页数
    // var $pageDiv=$("<div></div>");
    //$pageDiv.css({top:"430px",left:"880px",position:"absolute"});
    var $first=$("<input type='button' value='首页'/>");
    $first.css({marginLeft:"5px",backgroundColor:"#01aee0",color:"white",border:'gray', width:'40px',height:'22px',outline:"none"});
    var $prev=$("<input type='button' value='上一页'/>");
    $prev.css({marginLeft:"5px",backgroundColor:"#01aee0",color:"white",border:'gray', width:'52px',height:'22px',outline:"none"});
    var $next=$("<input type='button' value='下一页'/>");
    $next.css({marginLeft:"5px",backgroundColor:"#01aee0",color:"white",border:'gray', width:'52px',height:'22px',outline:"none"});
    var $last=$("<input type='button' value='尾页'/>");
    $last.css({marginLeft:"5px",backgroundColor:"#01aee0",color:"white",border:'gray', width:'40px',height:'22px',outline:"none"});
    this.$show=$("<span></span>");
    this.$show.css({margin:"5px"});
    // 用this，不用var，因为后面computer要用，
    // 此时this指向MyPage，因为有bind，所以后面computer也能用
    var index=this;
    $first.click(function() {
        $(this).css({backgroundColor:"red",color:"white"});
        $(this).siblings("input").css({backgroundColor:"#01aee0",color:"white"});

        index.currpage=1;
        index.compute();//计算
    });
    var index1=this;
    $prev.click(function(){
        $(this).css({backgroundColor:"red",color:"white"});
        $(this).siblings("input").css({backgroundColor:"#01aee0",color:"white"});
        if(index1.currpage-1<1)
        {
            alert("已经是第一页");
        }
        else{
            // this.$div.empty();
            index1.currpage--;
            index1.compute();//计算
        }
    });
    var index2=this;
    $next.click(function(){
        $(this).css({backgroundColor:"red",color:"white"});
        $(this).siblings("input").css({backgroundColor:"#01aee0",color:"white"});
        if(index2.currpage+1>index.totalpage)
        {
            alert("已经是最后一页")
        }
        else{
            //this.$div.empty();
            index2.currpage++;
            index2.compute();//计算
        }
    });
    var index3=this;
    $last.click(function(){
        $(this).css({backgroundColor:"red",color:"white"});
        $(this).siblings("input").css({backgroundColor:"#01aee0",color:"white"});
        index3.currpage=index3.totalpage;
        index3.compute();//计算
        // alert("已经是最后一页");
    });
    this.$div.append($first,$prev,this.$show,$next,$last);
};

MyPage.prototype.compute=function(){
    //this.$div.text='';
    this.totalpage=Math.ceil(this.total/this.pagesize);//计算总页数
    if(this.currpage>0 && this.currpage<=this.totalpage)
    //当前页大于0且小于总页数(为正常的页码)，范围外是异常的不用计算start,end
    {
        //计算当前页的开始行数和结束行数
        var start=(this.currpage-1)*this.pagesize;
        var end=this.currpage*this.pagesize-1;
        if(end>this.total-1)
        {
            end=this.total-1;
        }
        this.$show.text(this.currpage+"/"+this.totalpage);// (n/5)//第n页显示
        //调用回调把开始行数和结束行数传出去
        this.callback(start,end);
    }
};
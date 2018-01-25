/**
 * Created by lenovo on 2018/1/16.
 */
$(function(){
    $("#login").click(function(){
        var formData=$("#loginForm").serialize();
        $.ajax({
            url:loginUrl,
            data:formData,
            type:'post',
            dataType:'json',
            success:function(res){
                if(res.code==10001){
                    alert(res.msg);
                    location.href=personalUrl;
                }else{
                    alert(res.msg);
                }

            }
        })
    });

    $("#toMain").click(function(){
        window.location.href=mainUrl;
    });
//        $("#login").click(function(){
//            window.location.href="index.php?type=Login&do=showPersonalView";
//        })
});
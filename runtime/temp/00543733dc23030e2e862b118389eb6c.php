<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:84:"D:\AppServ\www\hf170724_zc\hf1707_zc\public/../application/home\view\user\test3.html";i:1517108516;}*/ ?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">

    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link href="css/lightbox.css" rel="stylesheet" />
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-sm-4"><a href="img/1.jpg" class="lightbox-2" rel="flowers" title="1">
            <img src="img/1.jpg"
                 class="img-responsive img-circle"></a></div>
        <div class="col-sm-4"><a href="img/2.jpg" class="lightbox-2" rel="flowers" title="2">
            <img src="img/2.jpg"
                 class="img-responsive img-circle"></a></div>
        <div class="col-sm-4"><a href="img/3.jpg" class="lightbox-2" rel="flowers" title="3">
            <img src="img/3.jpg"
                 class="img-responsive img-cirecle"></a></div>

        <div class="col-sm-4"><a href="img/4.jpg" class="lightbox-2" rel="flowers" title="4">
            <img src="img/4.jpg"
                 class="img-responsive img-cirecle"></a></div>
    </div>
</div>
<script type="text/javascript" src="js/jquery-1.9.0.js"></script>
<script type="text/javascript" src="js/jquery.lightbox.js"></script>
<script>
    $(function(){
        $(".lightbox-2").lightbox({
            fitToScreen: true,
            imageClickClose: false
        });

    });

</script>

</body>
</html>
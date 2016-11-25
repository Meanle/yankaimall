<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo ($meta_title); ?></title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" href="favicon.ico"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm.min.css">
    <link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm-extend.min.css">
    <link rel="stylesheet" href="/Apps/Home/View/default/css/iconfont.css"/>
    <link rel="stylesheet" href="/Apps/Home/View/default/css/app.css"/>
    <link rel="stylesheet" href="/Apps/Home/View/default/css/oders.css"/>
    <script type='text/javascript' src="/Apps/Home/View/default/js/zepto.min.js" charset='utf-8'></script>
</head>
<body>


<div class="page">
    <div class="content page-home infinite-scroll" id='coupon-page'>
        <!-- 这里是页面内容区 -->
        <div class="buttons-row">
            <a href="#tab1" class="tab-link active button tab1">有效</a>
            <a href="#tab2" class="tab-link button tab2">无效</a>
        </div>

        <div class="tabs">
            <div id="tab1" class="tab active">
                <div class="content-block" style="text-align: center">
                   有效
                </div>
            </div>
            <div id="tab2" class="tab">
                <div class="content-block" style="text-align: center">
                    无效
                </div>
            </div>
        </div>

        <!--这里是当没有收藏商品显示的内容-->
        <div class="content-padded" style="height: 100%;margin: 0;">
            <div class="develop" style="width: 100%; height: 100%; padding: 40% 0;">
                <p class="icon iconfont" style="width: 100%;text-align: center; font-size: 6rem;    color: #929292;">&#xe622;</p>
                <p style="width: 100%;text-align: center;color: #929292;font-size: .65rem;">口袋里空空的</p>
            </div>
        </div>

    </div>
</div>

<script>
    $.config = {router: false}          //关闭sui路由功能
</script>
<script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm.min.js' charset='utf-8'></script>
<script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm-extend.min.js' charset='utf-8'></script>
<!--<script type='text/javascript' src="/Apps/Home/View/default/js/back.js" charset='utf-8'></script>-->
<!-- 默认必须要执行$.init(),实际业务里一般不会在HTML文档里执行，通常是在业务页面代码的最后执行 -->
<script type="text/javascript">
    $.init();
//    给当前页面div.page加上page-current以显示
    $(function (){
        var page1st = $(".page").eq(0);
        page1st.addClass("page-current");
    });
    var a = '<?php echo U();?>';

 //        设置nav宽度，使得左右滑动
    var w =0;
    $(".scroll-fix li").each(function(){
        w+=parseInt($(this).width());
    });
    $(".scroll-fix").width(w+10);
</script>
</body>
</html>
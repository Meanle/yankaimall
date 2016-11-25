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
    <div class="content" id="oders-index">
        <div class="list-block" style="margin: .75rem 0;">
            <ul>
                <li>
                    <a href="<?php echo U('Home/Users/gocouponEntityByPages');?>" class="item-link item-content">
                        <div class="item-inner">
                            <div class="item-title">优惠券</div>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
        <div class="list-block" style="margin: .75rem 0;">
            <ul>
                <li>
                    <!--<a href="<?php echo U('Home/Users/gowalletdetail');?>" class="item-content">-->
                    <a class="item-content">
                        <div class="item-inner">
                            <div class="item-title" style="color: #464545;">账户余额</div>
                            <div class="item-subtitle ">￥<?php echo ($data['money']); ?></div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="<?php echo U('Home/Users/gorechargedetail');?>" class="item-link item-content">
                        <div class="item-inner">
                            <div class="item-title">账户充值</div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="" class="item-content">
                        <div class="item-inner">
                            <div class="item-title" style="color: #464545;">我的积分</div>
                            <div class="item-subtitle">0</div>
                        </div>
                    </a>
                </li>
            </ul>
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
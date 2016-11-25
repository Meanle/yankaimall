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
    <div class="content page-home" id='vip-page'>
        <div class="list">
            <div class="list-group-title" style="margin: 0;">
                <p class="title-img">
                    <img src="/Apps/Home/View/default/img/vip.png" >
                </p>
            </div>
            <div class="card-content">
                <div class="card-content-inner">
                    <p class="color-gray"><span class="iconfont" style="font-size: 1.4rem;vertical-align: middle;margin-right: 0.4rem">&#xe6b8;</span>黑金卡特权</p>
                    <p>1.咖啡吧饮品半价</p>
                    <p>2.会员生日当天大礼包</p>
                    <p>3.每周会员特价产品</p>
                    <p>4.线上线下均享会员价</p>
                    <p>5.购物积分兑换</p>
                    <p>6.免费体验彩妆、护肤沙龙活动</p>
                </div>
                <div class="card-content-inner">
                    <p class="color-gray"><span class="iconfont" style="font-size: 1.4rem;vertical-align: middle;margin-right: 0.4rem">&#xe62d;</span>黑金卡收费</p>
                    <p>1.雁凯跨境馆VIP黑金卡,从办卡之日计，有效期一年。</p>
                    <p>费用:<em style="color:#d37b89">200元/年</em></p>

                    <p>2.雁凯跨境馆VIP黑金卡,从办卡之日计，有效期二年。</p>
                    <p>费用:<em style="color:#d37b89">400元/二年</em></p>

                    <p>3.雁凯跨境馆VIP黑金卡,从办卡之日计，有效期三年。</p>
                    <p>费用:<em style="color:#d37b89">600元/三年</em></p>
                </div>
            </div>
        </div>
    </div>
    <nav class="bar bar-tab bottom-bar vip-tabbar">
        <div class="row no-gutter">
            <div class="col-50 activevip"><a href="<?php echo U('Home/Users/govipActivePages');?>">激活黑金卡</a></div>
            <div class="col-50 handlevip"><a href="<?php echo U('Home/Users/govipApplyPages');?>">我要办理</a></div>
        </div>
    </nav>
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
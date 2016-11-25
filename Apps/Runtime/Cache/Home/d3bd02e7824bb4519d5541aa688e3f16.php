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
        <form method="post" action="<?php echo U('Home/Welfare/recharge');?>">
            <div class="card-content" style="background: #fff">
                <div class="card-content-inner" style="padding-bottom: 0;">
                    <div class="chooseway">
                        <p>充值金额:
                            <input class="chargemoney" type="number" name="money" value="50"/>
                            <span>元</span>
                        </p>
                        <div class="row charge">
                            <div class="col-20 on">
                                <a href="#" class="button button-dark">
                                    <span class="chargemoney">50</span><span>元</span>
                                </a>
                            </div>
                            <div class="col-20">
                                <a href="#" class="button button-dark">
                                    <span class="chargemoney">100</span><span>元</span>
                                </a>
                            </div>
                            <div class="col-20">
                                <a href="#" class="button button-dark">
                                    <span class="chargemoney">200</span><span>元</span>
                                </a>
                            </div>
                            <div class="col-20">
                                <a href="#" class="button button-dark">
                                    <span class="chargemoney">300</span><span>元</span>
                                </a>
                            </div>
                            <div class="col-20">
                                <a href="#" class="button button-dark">
                                    <span class="chargemoney">500</span><span>元</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-content-inner" style="padding-top: 0;">
                    <div class="coffee-check">
                        <div class="list-block media-list list-charge">
                            <ul>
                                <li class="item-content">
                                    <div class="item-inner">
                                        <div class="item-title">
                                            <span>支付方式</span>
                                        </div>
                                    </div>
                                </li>

                                <li>
                                    <label class="label-checkbox item-content">
                                        <input type="radio" name="my-radio" data-index="1" checked="checked">
                                        <div class="item-media"><i class="icon icon-form-checkbox"></i></div>
                                        <div class="item-inner">
                                            <div class="item-title-row">
                                                <div class="item-title">微信支付</div>
                                                <!--<div class="item-after">logo</div>-->
                                            </div>
                                            <div class="item-subtitle">精选促销安装5.0以上的版本</div>
                                        </div>
                                        <div class="pay wechatpay">
                                        </div>
                                    </label>
                                </li>

                                <!--<li>
                                    <label class="label-checkbox item-content">
                                        <input type="radio" name="my-radio" data-index="2">
                                        <div class="item-media"><i class="icon icon-form-checkbox"></i></div>
                                        <div class="item-inner">
                                            <div class="item-title-row">
                                                <div class="item-title">支付宝</div>
                                            </div>
                                            <div class="item-subtitle">精选促销安装支付宝app使用</div>
                                        </div>
                                        <div class="pay alipay">
                                        </div>
                                    </label>
                                </li>-->

                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <p class="check_btn content-padded">
                <input class="button button-big button-fill" value="确定充值" type="submit" data-transition='fade'/>
            </p>
        </form>
    </div>
</div>

<script>
    $(".charge .col-20").click(function () {
        var t = $(this).index() + 1;
        year = t;
        $(this).addClass("on").siblings().removeClass("on");
        var cmoney = $(this).find('.chargemoney').text();
        $('.chargemoney').val(cmoney);
        $('#money').val(cmoney);
    });
</script>
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
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
    <form method="post" action="<?php echo U('Home/Welfare/registerCard');?>">
        <div class="content page-home" id='vip-page' style="margin-bottom: 0;">
            <div class="list-block inset vip-active-input">
                <div class="item-title content-padded">
                    <p class="item-subtitle">黑金卡卡号</p>
                </div>
                <ul style="background: #2e2e2e">
                    <li>
                        <div class="item-content">
                            <div class="item-inner">
                                <div class="item-input">
                                    <input id='oldPass' name='cardId' type="number" placeholder="请输入黑金卡卡号">
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                <div class="item-title content-padded">
                    <p class="item-subtitle">黑金卡密码</p>
                </div>
                <ul style="background: #2e2e2e">
                    <li>
                        <div class="item-content">
                            <div class="item-inner">
                                <div class="item-input">
                                    <input id='newPass' name='cardPassword' type="password" placeholder="请输入黑金卡密码">
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="content-block login-register row">
                <p class="col-40" style="margin: 0 auto;float: none">
                    <input id="" class="button button-fill" style="background: #ffbe00;color: #000;" type="submit"
                       data-transition='fade' value="激活" />
                </p>
            </div>
        </div>
    </form>
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
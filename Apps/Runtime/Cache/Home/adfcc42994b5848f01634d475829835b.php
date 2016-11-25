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
    
<nav class="bar bar-tab">
    <a class="tab-item [index]" href="<?php echo U('Index/index');?>">
        <span class="icon iconfont">&#xe602;</span>
        <span class="tab-label">首页</span>
    </a>
    <a class="tab-item [classify]" href="<?php echo U('Index/classify');?>" data-transition='slide-in'>
        <span class="icon iconfont">&#xe639;</span>
        <span class="tab-label">分类</span>
    </a>
    <a id="cart" class="tab-item [cart]" href="<?php echo U('Cart/getCartInfo');?>" data-transition='slide-in'>
        <span class="icon iconfont">&#xe601;</span>
        <span class="tab-label" >购物车</span>
    </a>
    <a class="tab-item active" href="<?php echo U('Orders/queryByPage');?>" data-transition='slide-in'>
        <span class="icon iconfont">&#xe600;</span>
        <span class="tab-label">我的</span>
    </a>
</nav>

    <div class="content">
        <!-- 这里是页面内	容区 -->
        <div class="page-settings">
            <div class="list-block media-list person-card">
                <ul>
                    <li>
                        <div href="#" class="item-content">
                            <div class="item-media" style="position: relative">
                                <img src="<?php echo WSTImgPath($WST_USER['userPhoto']);?>" width="80">
                                <?php if($vipcard == 1): ?><span class="iconfont" style="font-size: 1.4rem;vertical-align: middle;position: absolute;right: 0;top: 0;color: #1d1c1c;">
                                        &#xe637;
                                    </span><?php endif; ?>
                            </div>
                            <div class="item-inner">
                                <div class="item-title-row">
                                    <div class="item-title"><?php echo ($WST_USER["loginName"]); ?></div>
                                </div>
<!--                                <div class="item-subtitle">
                                    积分:<em><?php $aa=$WST_USER["userScore"]; $bb=$WST_USER["userTotalScore"] ;echo $aa+$bb?></em>
                                </div>-->
                                <div class="item-subtitle">
                                    <p>上次登陆时间: </p>
                                    <?php echo ($WST_USER["lastTime"]); ?>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="row text-center row-nomargin">
                <div class="col-20" onclick="getAllOrderDetails(1)" style="cursor: pointer;">
                    <h4><?php echo ($statusList[-2]); ?></h4>
                    <div class="color-gray">待付款</div>
                </div>
                <div class="col-20" onclick="getAllOrderDetails(2)" style="cursor: pointer;">
                    <h4><?php echo ($statusList[2]); ?></h4>
                    <div class="color-gray">待发货</div>
                </div>
                <div class="col-20" onclick="getAllOrderDetails(3)" style="cursor: pointer;">
                    <h4><?php echo ($statusList[3]); ?></h4>
                    <div class="color-gray">待收货</div>
                </div>
                <div class="col-20" onclick="getAllOrderDetails(4)" style="cursor: pointer;">
                    <h4><?php echo ($statusList[4]); ?></h4>
                    <div class="color-gray">待评价</div>
                </div>
                <div class="col-20" onclick="gooders()" style="cursor: pointer;">
                    <h4 class="iconfont" style="font-size: .85rem">&#xe6b9;</h4>
                    <div class="color-gray">订单</div>
                </div>
            </div>
            <div class="list-block list">
                <div class="row noline text-center">
                    <div class="col-25" onclick="getCollects()">
                        <h4 class="collect iconfont"></h4>
                        <div class="color-gray">商品收藏</div>
                    </div>
                    <div class="col-25" onclick="gomywalletEntityByPages()">
                        <h4 class="coupon iconfont"></h4>
                        <div class="color-gray">我的钱包</div>
                    </div>
                    <div class="col-25" onclick="getvipcards()">
                        <h4 class="vip"></h4>
                        <div class="color-gray">黑金卡</div>
                    </div>
                    <div class="col-25" onclick="getintegral()">
                        <h4 class="integral"></h4>
                        <div class="color-gray">积分商城</div>
                    </div>

                    <?php if($isVipDay): ?><div class="col-25" onclick="goVipDay()">
                            <h4 class="black-vip"></h4>
                            <div class="color-gray">黑金尊享</div>
                        </div><?php endif; ?>
                </div>
            </div>
            <div class="list-block list">
                <ul>
                    <li class="item-content item-link" onclick="goEditPhone()">
                        <div class="item-media"><i class="icon icon-card"></i></div>
                        <div class="item-inner">
                            <div class="item-title">绑定/修改手机</div>
                            <?php if($user['userPhone']): ?><div class="item-after item-after-color">已绑定</div><?php else: ?><div class="item-after item-after-color">未绑定</div><?php endif; ?>
                        </div>
                    </li>
                    <li class="item-content item-link" onclick="goEditPass()">
                        <div class="item-media"><i class="icon icon-settings"></i></div>
                        <div class="item-inner">
                            <div class="item-title">修改密码</div>
                        </div>
                    </li>
                    <li class="item-content item-link" onclick="goEditInfo()">
                        <div class="item-media"><i class="icon icon-me"></i></div>
                        <div class="item-inner">
                            <div class="item-title">个人资料</div>
                        </div>
                    </li>
                    <!--							<li class="item-content item-link">
                                                    <div class="item-media"><i class="icon icon-message"></i></div>
                                                    <div class="item-inner">
                                                        <div class="item-title">消息通知</div>
                                                    </div>
                                                </li>
                                                <li class="item-content item-link">
                                                    <div class="item-media"><i class="icon icon-friends"></i></div>
                                                    <div class="item-inner">
                                                        <div class="item-title">帮助中心</div>
                                                    </div>
                                                </li>-->
                </ul>
            </div>
<!--            <div class="content-block">
                <a href="<?php echo U('Home/Users/logout');?>" data-transition='slide-out' class="button button-big button-fill">退出登录</a>
            </div>-->
        </div>
    </div>
</div>
<script>
    function gooders() {
        location.href = "<?php echo U('Home/Orders/queryPayByPage');?>";
    }
    function goodercoffee() {
        location.href = "<?php echo U('Home/Orders/queryReceiveByPage');?>";

    }
    function goodercoffee1() {
        location.href = "<?php echo U('Home/Orders/queryAppraiseByPage');?>";

    }
    function odersclass() {
        location.href = "<?php echo U('Home/Orders/odersclass');?>";

    }
    function getAllOrderDetails(type) {
        var type = type;
        location.href = "<?php echo U('Home/Orders/goqueryEntityByPage');?>" + "&type=" + type;

    }
    function getCollects() {
        location.href = "<?php echo U('Home/Favorites/queryByPage');?>";
    }

    function gomywalletEntityByPages() {
        location.href = "<?php echo U('Home/Users/gomywalletEntityByPages');?>";
    }

    function getvipcards() {
        location.href = "<?php echo U('Home/Users/govipEntityByPages');?>";
    }
    function getintegral() {
        alert('暂未开放');
    }
    function getfeedbackDetails() {
        location.href = "<?php echo U('Home/Users/getfeedbackDetails');?>";
    }
    function goEditPass() {
        location.href = "<?php echo U('Home/Users/toEditPass');?>";
    }
    function goEditInfo() {
        location.href = "<?php echo U('Home/Users/toEdit');?>";
    }

    function goEditPhone() {
        location.href = "<?php echo U('Home/Users/phonelogins');?>";
    }

    function goVipDay() {
        location.href = "<?php echo U('Home/Welfare/goVipDay');?>";
    }
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
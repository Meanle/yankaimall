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
    <div class="content" id='detail-page'>
        <!-- 这里是页面内容区 -->
        <div class="page-check" id="pagecheck">
            <div class="list-block list-num">
                <ul>
                    <li class="item-content">
                        <div class="item-media"><i class="icon icon-f7"></i></div>
                        <div class="item-inner">
                            <div class="item-title">
                                <span>订单编号:</span><?php echo ($orderInfo["order"]["orderNo"]); ?>
                            </div>
                            <div class="item-after coffee-price">
                                    <?php if(($orderInfo["orderStatus"] == -3) OR ($orderInfo["orderStatus"] == -4)): ?>拒收<?php if($orderInfo["isRefund"] == 1): ?>(已退款)<?php else: ?>(未退款)<?php endif; ?>
                                    <?php elseif($orderInfo["order"]["orderStatus"] == -2): ?>未付款
                                    <?php elseif($orderInfo["order"]["orderStatus"] == -1): ?>已取消
                                    <?php elseif($orderInfo["order"]["orderStatus"] == 0): ?>未受理
                                    <?php elseif($orderInfo["order"]["orderStatus"] == 1): ?>已受理
                                    <?php elseif($orderInfo["order"]["orderStatus"] == 2): ?>打包中
                                    <?php elseif($orderInfo["order"]["orderStatus"] == 3): ?>配送中
                                    <?php elseif($orderInfo["order"]["orderStatus"] == 4): ?>已到货
                                    <?php elseif($orderInfo["order"]["orderStatus"] == 5): ?>确认已收货<?php endif; ?>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="list-block media-list">
                <ul>
                    <?php if(is_array($orderInfo['goodsList'])): $key1 = 0; $__LIST__ = $orderInfo['goodsList'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$goods): $mod = ($key1 % 2 );++$key1;?><li>
                            <a class="item-content" href="<?php echo U('Home/Goods/getGoodsDetails/',array('goodsId'=>$goods['goodsId']));?>">
                                <div class="item-media"><img src="/<?php echo ($goods['goodsThums']); ?>" width="80"></div>
                                <div class="item-inner">
                                    <div class="item-title-row">
                                        <div class="item-title"><?php echo ($goods["goodsName"]); if($goods['goodsAttrName'] != ''): ?>【<?php echo ($goods['goodsAttrName']); ?>】<?php endif; ?></div>
                                        <div class="item-after">
                                            <span class="coffee-price">￥<?php echo ($goods["shopPrice"]); ?></span>
                                            <span>x<?php echo ($goods["goodsNums"]); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
            <div class="card facebook-card">
                <div class="card-content">
                    <div class="coffee-message">
                        <div class="item-input">
                            <div class="list-block media-list">
                                <ul>
                                    <li style="font-size: .7rem;color: #5f646e;">
                                        <div class="item-inner">
                                            <div class="item-title">
                                                <span>收货人信息</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="item-content" href="javascript:;">
                                            <div class="item-inner">
                                                <div class="item-title-row">
                                                    <div class="item-title">收货人姓名:</div>
                                                    <div class="item-after">
                                                        <?php echo ($orderInfo["order"]["userName"]); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="item-content" href="javascript:;">
                                            <div class="item-inner">
                                                <div class="item-title-row">
                                                    <div class="item-title">收货地址:</div>
                                                    <div class="item-after">
                                                        <?php if($orderInfo['catName'][0]['catName'] == '咖啡馆'): echo ($orderInfo["order"]["orderRemarks"]); ?>
                                                            <?php else: ?>
                                                            <span id="user-address"><?php echo ($orderInfo["order"]["userAddress"]); ?></span>
                                                            <script>
                                                                var span = document.getElementById('user-address');
                                                                var address = span.innerHTML;
                                                                var newAddr = address.split('蒸湘区 默认 ');
                                                                span.innerHTML = newAddr[0]+newAddr[1];
                                                            </script><?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="item-content" href="javascript:;">
                                            <div class="item-inner">
                                                <div class="item-title-row">
                                                    <div class="item-title">联系电话:</div>
                                                    <div class="item-after">
                                                        <?php echo ($orderInfo["order"]["userPhone"]); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="item-content" href="javascript:;">
                                            <div class="item-inner">
                                                <div class="item-title-row">
                                                    <div class="item-title">期望送达时间:</div>
                                                    <div class="item-after">
                                                        <?php echo ($orderInfo["order"]["requireTime"]); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <div class="line-bg"></div>
                                    <li style="font-size: .7rem;color: #5f646e;">
                                        <div class="item-inner">
                                            <div class="item-title">
                                                <span>日志信息</span>
                                            </div>
                                        </div>
                                    </li>
                                    <?php if(is_array($orderInfo['logs'])): $key1 = 0; $__LIST__ = $orderInfo['logs'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$log): $mod = ($key1 % 2 );++$key1;?><li>
                                            <a class="item-content" href="javascript:;">
                                                <div class="item-inner">
                                                    <div class="item-title-row">
                                                        <div class="item-title"><?php echo ($log["logTime"]); ?></div>
                                                        <div class="item-after">
                                                            <?php echo ($log["logContent"]); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="line-bg"></div>
                    <div class="coffee-money">
                        <div class="list-block list-num">
                            <ul>
                                <li class="item-content">
                                    <div class="item-inner">
                                        <div class="item-title">
                                            <span>订单总额</span>
                                        </div>
                                        <div class="item-after coffee-price">￥<?php echo ($orderInfo["order"]["totalMoney"]+$orderInfo["order"]["deliverMoney"]); ?></div>
                                    </div>
                                </li>
                                <li class="item-content">
                                    <div class="item-inner">
                                        <div class="item-title">
                                        </div>
                                        <div class="item-after coffee-price">
                                            <span class="jine">支付金额</span>
                                            <span>￥<?php echo ($orderInfo["order"]["realTotalMoney"]); ?></span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
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
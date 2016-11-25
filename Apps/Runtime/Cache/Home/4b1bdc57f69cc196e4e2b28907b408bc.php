<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo ($goodsDetails["goodsName"]); ?> | 雁凯跨境馆</title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" href="/favicon.ico">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" href="/Apps/Home/View/default/css/sm.min.css">
    <link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm-extend.min.css">
    <link rel="stylesheet" href="/Apps/Home/View/default/css/iconfont.css"/>
    <link rel="stylesheet" href="/Apps/Home/View/default/css/app.css"/>
</head>

<body>

<div class="page">
    <div class="content" id='detail-page'>
        <!-- 这里是页面内容区 -->
        <style>
            .list-block,
            .content-block {
                margin: 0.75rem 0;
            }
        </style>
        <div class="page-detail" id="pagedetail">
            <div class="swiper-container swiper-container-horizontal" data-space-between="10">
                <div class="swiper-wrapper">
                    <div class="swiper-slide" style="max-height: 18rem">
                        <img class='card-cover' src="/<?php echo ($goodsDetails['goodsImg']); ?>" alt="">
                    </div>
                    <?php if(is_array($goodsImgs)): $k = 0; $__LIST__ = $goodsImgs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><div class="swiper-slide" style="max-height: 18rem">
                            <img class='card-cover' src="/<?php echo ($vo['goodsImg']); ?>" alt="">
                        </div><?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
                <div class="swiper-pagination">
                    <span class="swiper-pagination-bullet swiper-pagination-bullet-active"></span>
                    <span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span>
                </div>
            </div>
            <div class='content-block goods-card'>
                <h3><?php echo ($goodsDetails["goodsName"]); ?></h3>
                <?php if($isvip == 1): ?><p><strong>￥<?php echo ($goodsDetails["vipPrice"]); ?></strong>
                        <del>￥<?php echo ($goodsDetails["marketPrice"]); ?></del>
                    </p>
                    <?php else: ?>
                    <p><strong>￥<?php echo ($goodsDetails["shopPrice"]); ?></strong>
                        <del>￥<?php echo ($goodsDetails["marketPrice"]); ?></del>
                    </p><?php endif; ?>



                <div class="row text-center color-gray" style="margin-top: -1.4rem;">
                    <div style="float: right;margin-right:.5rem ;">
                        <a class="operate-num button" onclick="favoriteGoods(<?php echo ($goodsDetails['goodsId']); ?>)">
                            <span id='f0_txt' f='<?php echo ($favoriteGoodsId); ?>'>
                            <?php if($favoriteGoodsId > 0): ?>已收藏<?php else: ?>收藏商品<?php endif; ?>
                            </span>
                        </a>
                    </div>
                </div>
                <div class="row text-center color-gray" style="margin-top: .5rem;">
                    <div class="col-33">
                        <p class="text-left">运费：<?php echo ($goodsDetails["deliveryStartMoney"]); ?>元</p>
                        <!--<p>配送费<?php echo ($goodsDetails["deliveryMoney"]); ?>元</p>-->
                        <p class="text-left"><?php echo ($goodsDetails["deliveryFreeMoney"]); ?>元起免运费</p>
                    </div>
                    <div class="col-33">月销<?php echo ($goodsDetails["saleCount"]); ?>笔</div>
                    <div class="col-33">湖南衡阳</div>
                </div>
            </div>
<!--            <div class="list-block media-list">
                <ul>
                    <li>
                        <a href="#" class="item-link item-content">
                            <div class="item-inner">
                                <div class="item-title-row">
                                    <div class="item-title">选择颜色和尺码</div>
                                </div>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>-->
            <div class='content-block'>
                <div class="buttons-row">
                    <a href="#tab-detail" class="tab-link active button">商品介绍</a>
                    <a href="#tab-comments" class="tab-link button">评论(<?php echo count($goodsAppraises['root'])?>)</a>
                </div>
                <div class="tabs">
                    <div class="tab active content-padded" id='tab-detail'>
                        <div class="list-block media-list">
                            <div class="coffeedetail goods-detail-img">
                                <p><?php echo ($goodsDetails["goodsDesc"]); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="tab" id='tab-comments'>
                        <div class="list-block media-list">
                            <ul>
                                <?php if( count($goodsAppraises['root']) > 0): if(is_array($goodsAppraises['root'])): $i = 0; $__LIST__ = $goodsAppraises['root'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i;?><li>
                                            <div class="item-content">
                                                <div class="item-media"><img src="<?php echo ($vo1['userPhoto']); ?>" width="44"></div>
                                                <div class="item-inner">
                                                    <div class="item-title-row">
                                                        <div class="item-title"><?php echo ($vo1['loginName']); ?></div>
                                                        <div class="item-after"><?php echo ($vo1['createTime']); ?></div>
                                                    </div>
                                                    <div class="item-text"><?php echo ($vo1['content']); ?></div>
                                                </div>
                                            </div>
                                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                                    <?php else: ?>
                                    <div class="tab active content-padded" id='tab-details' style="text-align: center">
                                        <p>还没有评价信息</p>
                                    </div><?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <p class="h111"></p>
        <a href="#" id="toTop" style="display: block;" class="gotop iconfont">&#xe606;</a>
    </div>
    <nav class="bar bar-tab bottom-bar detail-tabbar">
        <div class="gwbtnbox">
            <div class="gwbtn">
                <ul>
                    <li class="shop">
                            <span class="cart js_cartcont">
                                <a href="<?php echo U('Home/Cart/getCartInfo');?>">
                                    <s class="icon iconfont">&#xe605;</s>
                                    <i class="tip_number cart_gnum_chk"><?php echo ($chkgoodsnum); ?></i><em>购物车</em>
                                </a>
                            </span>
                    </li>
                    <li class="add_shop ">
                            <span class="js_cartbtn">
                                <a class="btna btn-addtocart" href="#" onclick="addCart(<?php echo ($goodsDetails['goodsId']); ?>,1,'<?php echo ($goodsDetails['goodsThums']); ?>','<?php echo ($rs['userPhone']); ?>');">加入购物车</a>
                            </span>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
<!-- 默认必须要执行$.init(),实际业务里一般不会在HTML文档里执行，通常是在业务页面代码的最后执行 -->

<script src="/Public/js/jquery.min.js"></script>
<script src="/Public/plugins/layer/layer.min.js"></script>
<script src="/Apps/Home/View/default/js/goods.js"></script>
<script src="/Apps/Home/View/default/js/usercom.js"></script>
<script>
    var ThinkPHP = window.Think = {
        "ROOT": "",
        "APP": "/index.php",
        "PUBLIC": "/Public",
        "DEEP": "<?php echo C('URL_PATHINFO_DEPR');?>",
        "MODEL": ["<?php echo C('URL_MODEL');?>", "<?php echo C('URL_CASE_INSENSITIVE');?>", "<?php echo C('URL_HTML_SUFFIX');?>"],
        "VAR": ["<?php echo C('VAR_MODULE');?>", "<?php echo C('VAR_CONTROLLER');?>", "<?php echo C('VAR_ACTION');?>"],
        "DOMAIN": "<?php echo WSTDomain();?>",
        "CITY_ID": "<?php echo ($currArea['areaId']); ?>",
        "CITY_NAME": "<?php echo ($currArea['areaName']); ?>",
        "DEFAULT_IMG": "<?php echo WSTDomain();?>/<?php echo ($CONF['goodsImg']); ?>",
        "MALL_NAME": "<?php echo ($CONF['mallName']); ?>",
        "SMS_VERFY": "<?php echo ($CONF['smsVerfy']); ?>",
        "PHONE_VERFY": "<?php echo ($CONF['phoneVerfy']); ?>",
        "IS_LOGIN": "<?php echo ($WST_IS_LOGIN); ?>"
    };
</script>
<script src="/Public/js/think.js"></script>
<script src="/Public/js/common.js"></script>
<script>
    jQuery.noConflict();
</script>
<script type='text/javascript' src='//g.alicdn.com/sj/lib/zepto/zepto.min.js' charset='utf-8'></script>
<script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm.min.js' charset='utf-8'></script>
<script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm-extend.min.js' charset='utf-8'></script>
<script type="text/javascript" src="/Apps/Home/View/default/js/gotop.js"></script>
<script type="text/javascript" src="/Apps/Home/View/default/js/app.js"></script>
<script type="text/javascript">
    $.init();
    toTop(false);
    gerGnum();
    function gerGnum(){
        $.ajax({
            url:'<?php echo U("Home/Cart/getCartInfo");?>',
            type:'post',
            data:{"axm":1},
            timeout: 2000,
            success:function(data){
                var cart = WST.toJson(data);
                var chkgoodsnum = 0;
                for(var shopId in cart.cartgoods){
                    var shop = cart.cartgoods[shopId];
                    for(var goodsId in shop.shopgoods){
                        var goods = shop.shopgoods[goodsId];
                        if(goods.ischk==1){
                            chkgoodsnum++;
                        }
                    }
                };
                if(chkgoodsnum != 0){
                    $(".cart_gnum_chk").css('display','block').html(chkgoodsnum);
                }
            },
            error: function(xhr, type, errorThrown) {
                $.toast('网络故障请刷新重载!');
            }
        });
    };
</script>
</body>
</html>
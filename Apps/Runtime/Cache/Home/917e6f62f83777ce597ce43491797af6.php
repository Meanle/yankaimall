<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>购物车</title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" href="/favicon.ico">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm.min.css">
    <link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm-extend.min.css">
    <link rel="stylesheet" href="/Apps/Home/View/default/css/iconfont.css"/>
    <link rel="stylesheet" href="/Apps/Home/View/default/css/app.css"/>
</head>

<body>
<script src="/Public/js/jquery.min.js"></script>
<script src="/Public/plugins/lazyload/jquery.lazyload.min.js?v=1.9.1"></script>
<script src="/Public/plugins/layer/layer.min.js"></script>
<script type="text/javascript">
var WST = ThinkPHP = window.Think = {
        "ROOT"   : "",
        "APP"    : "/index.php",
        "PUBLIC" : "/Public",
        "DEEP"   : "<?php echo C('URL_PATHINFO_DEPR');?>",
        "MODEL"  : ["<?php echo C('URL_MODEL');?>", "<?php echo C('URL_CASE_INSENSITIVE');?>", "<?php echo C('URL_HTML_SUFFIX');?>"],
        "VAR"    : ["<?php echo C('VAR_MODULE');?>", "<?php echo C('VAR_CONTROLLER');?>", "<?php echo C('VAR_ACTION');?>"],
        "DOMAIN" : "<?php echo WSTDomain();?>",
        "CITY_ID" : "<?php echo ($currArea['areaId']); ?>",
        "CITY_NAME" : "<?php echo ($currArea['areaName']); ?>",
        "DEFAULT_IMG": "<?php echo WSTDomain();?>/<?php echo ($CONF['goodsImg']); ?>",
        "MALL_NAME" : "<?php echo ($CONF['mallName']); ?>",
        "SMS_VERFY"  : "<?php echo ($CONF['smsVerfy']); ?>",
        "PHONE_VERFY"  : "<?php echo ($CONF['phoneVerfy']); ?>",
        "IS_LOGIN" :"<?php echo ($WST_IS_LOGIN); ?>"
}
    $(function() {
    	$('.lazyImg').lazyload({ effect: "fadeIn",failurelimit : 10,threshold: 200,placeholder:WST.DEFAULT_IMG});
    });
</script>
<script src="/Public/js/think.js"></script>
<div class="page page-current">
    <a style="display: none;" href="http://www.wstmall.net">Powered&nbsp;By&nbsp;<strong><span style="color: #3366FF">WSTMall</span></strong></a>
    
<nav class="bar bar-tab">
    <a class="tab-item [index]" href="<?php echo U('Index/index');?>">
        <span class="icon iconfont">&#xe602;</span>
        <span class="tab-label">首页</span>
    </a>
    <a class="tab-item [classify]" href="<?php echo U('Index/classify');?>" data-transition='slide-in'>
        <span class="icon iconfont">&#xe639;</span>
        <span class="tab-label">分类</span>
    </a>
    <a id="cart" class="tab-item active" href="<?php echo U('Cart/getCartInfo');?>" data-transition='slide-in'>
        <span class="icon iconfont">&#xe601;</span>
        <span class="tab-label" >购物车</span>
    </a>
    <a class="tab-item [set]" href="<?php echo U('Orders/queryByPage');?>" data-transition='slide-in'>
        <span class="icon iconfont">&#xe600;</span>
        <span class="tab-label">我的</span>
    </a>
</nav>

    <div class="content" id="cart-page">
        <?php if(empty($cartInfo['cartgoods'])): ?><div id="cart-nil">
                <!-- 这里是页面内容区 -->
                <div class="page-cart">
                    <i class="gwc_ic"></i>
                    <p class="p1">购物车空空如也~</p>
                    <a class="gwc_btn1" href="<?php echo U('Index/index');?>">去逛逛</a>
                </div>
            </div>
            <br/>
            <?php else: ?>
            <?php if(empty($sessions)): ?><div id="cart-nils">
                    <!-- 这里是页面内容区 -->
                    <div class="page-cart">
                        <i class="gwc_ic"></i>
                        <p class="p1">购物车为空哦~</p>
                        <a class="gwc_btn1" href="<?php echo U('Index/index');?>">去逛逛</a>
                    </div>
                </div>
                <br/>
                <?php else: ?>
                <form id="have-cart-nils" action="" method="post">
                    <div class="page-cart-list">
                        <ul>
                            <li class="cartgoods-list" id="">
                                <dl>
                                    <!--产品循环开始-->
                                    <?php if(is_array($cartInfo['cartgoods'])): $i = 0; $__LIST__ = $cartInfo['cartgoods'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$shopgoods): $mod = ($i % 2 );++$i;?><div id="wst_cart_shop_<?php echo ($key); ?>" data="<?php echo ($key); ?>" disabled="true"></div>
                                        <dt class="clx">
                                            <!--<div style="height: 600px;"><?php dump($cartInfo['cartgoods'][34]['shopgoods'][0]['shopId']); ?></div>-->
                                            <input type="checkbox" onclick="cartChkShop(this)" id='chk_shop_<?php echo ($shopgoods["shopgoods"][0][shopId]); ?>' value="<?php echo ($shopgoods["shopgoods"][0][shopId]); ?>" class="cus_chk" name="chk_shop" />
                                            <em>选择该店铺:<?php echo ($shopgoods["shopgoods"][0][shopName]); ?></em>
                                        </dt>
                                        <?php if(is_array($shopgoods['shopgoods'])): $key2 = 0; $__LIST__ = $shopgoods['shopgoods'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$goods): $mod = ($key2 % 2 );++$key2;?><dd class="clx" id="qty-51879-124614" jqstock="468" jqtmprcredit="130"
                                                jqtmprcash=""
                                                jqtmpprice="130.00" jqshopprice="130.00" jqtmpid="51879"
                                                jqtmpspec="124614"
                                                jqimportprice="15.47" jqtype="1" activeid="0">
                                                <?php if($isvip == 1): ?><input type='hidden' id='price_<?php echo ($goods["goodsId"]); ?>_<?php echo ($goods["goodsAttrId"]); ?>' value='<?php echo ($goods["vipPrice"]); ?>'/>
                                                    <?php else: ?>
                                                    <input type='hidden' id='price_<?php echo ($goods["goodsId"]); ?>_<?php echo ($goods["goodsAttrId"]); ?>' value='<?php echo ($goods["shopPrice"]); ?>'/><?php endif; ?>
                                                <!-- isBook='"+goods.isBook+"' "+(goods.ischk==1?"checked":"")+"-->
                                                <input onclick='cartChkGoods(this)' isBook="<?php echo ($goods['isBook']); ?>" parent="<?php echo ($goods['shopId']); ?>" dataId="<?php echo ($goods['goodsAttrId']); ?>" type='checkbox' class='cus_chk cart-goods-check cgoodsId' id='chk_goods_<?php echo ($goods["goodsId"]); ?>_<?php echo ($goods["goodsAttrId"]); ?>' name='chk_goods_<?php echo ($goods["shopId"]); ?>' <?php if($goods["ischk"] == 1): ?>checked<?php endif; ?> value='<?php echo ($goods["goodsId"]); ?>' />
                                                <input class="chb-slave" name="selected[124614]" type="checkbox"
                                                       checked="checked"
                                                       style="display:none;">
                                                <a href="<?php echo U('Home/Goods/getGoodsDetails/',array('goodsId'=>$goods['goodsId']));?>">
                                                    <img src="/<?php echo ($goods['goodsThums']); ?>" name="lazyImg" alt=""
                                                         style="display: block;">
                                                </a>
                                                <p class="txt">
                                                    <a href="<?php echo U('Home/Goods/getGoodsDetails/',array('goodsId'=>$goods['goodsId']));?>"><?php echo ($goods["goodsName"]); ?></a>
                                                    <a onclick="removeCartGoods(this,'<?php echo ($goods["goodsId"]); ?>','<?php echo ($goods["goodsAttrId"]); ?>')" spId="<?php echo ($goods['shopId']); ?>" style="float: right;margin-right:5px; font-size: 1rem" class="iconfont">&#xe610;</a>
                                                    <?php if($goods['attrVal'] != ''): ?>【<?php echo ($goods['attrName']); ?>:<?php echo ($goods['attrVal']); ?>】<?php endif; ?>
                                                </p>

                                                <p class="price clx">
                                                    <?php if($isvip == 1): ?><em>¥<?php echo ($goods["vipPrice"]); ?>元</em><i>x<b class="item-count"><?php echo ($goods["cnt"]); ?></b><input type='hidden' id='buy-num_<?php echo ($goods["goodsId"]); ?>_<?php echo ($goods["goodsAttrId"]); ?>' value='<?php echo ($goods["cnt"]); ?>' style='width:40px;'/></i>
                                                        <?php else: ?>
                                                        <em>¥<?php echo ($goods["shopPrice"]); ?>元</em><i>x<b class="item-count"><?php echo ($goods["cnt"]); ?></b><input type='hidden' id='buy-num_<?php echo ($goods["goodsId"]); ?>_<?php echo ($goods["goodsAttrId"]); ?>' value='<?php echo ($goods["cnt"]); ?>' style='width:40px;'/></i><?php endif; ?>
                                                </p>
                                                <p class="give">
                                                </p>
                                            </dd><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
                                </dl>
                                <dl>
                                    <!--产品循环结束-->
                                    <dd class="show_tips" style="display:none">
                                        <p class="thetips n1000" style="display:none"><i class="icon-warning"></i>根据海关规定购买多件的总价不能超过2000元，请您分多次购买。
                                        </p>
                                    </dd>
                                    <dd class="jsmbox">
                                        <div class="clx">
                                            <span class="s1 left">结算<!--<em class="em-item-count">1件</em>--></span>
                                            <div class="js right">
                                                <!--<?php  dump($cartInfo); ?>-->
                                                <p>商品总额：<em>￥<span class="em-item-amount"><?php echo ($cartInfo["gtotalMoney"]); ?></span></em></p>
                                                <p>优惠：<em class="em-item-promotion-minus">-￥<?php echo ($shopgoods["deliveryFreeMoney"]); ?></em>
                                                </p>
                                                <p>税费：<em class="em-item-import">￥<?php echo ($shopgoods["deliveryMoney"]); ?></em></p>
                                                <p class="p1">总计（不含运费）：<em>￥<span class="em-item-amount"><?php echo ($cartInfo['totalMoney']); ?></span></em></p>
                                                <a class="cus_btn1 submitBtn"
                                                   href="<?php echo U('Home/Orders/checkOrderInfo');?>">去结算</a>
                                            </div>
                                        </div>
                                    </dd>
                                </dl>
                            </li>
                        </ul>
                    </div>
                </form><?php endif; endif; ?>
    </div>
</div>
<script src="/Public/js/common.js"></script>
<script src="/Public/plugins/layer/layer.min.js"></script>
<script src="/Apps/Home/View/default/js/common.js"></script>
<script src="/Apps/Home/View/default/js/goods.js"></script>
<script type="text/javascript">
    function removeCartGoods(obj,goodsId,goodsAttrId){
        jQuery.post(Think.U('Home/Cart/delCartGoods') ,{goodsId:goodsId,goodsAttrId:goodsAttrId},function(data) {
            var cart = WST.toJson(data);
            var spId = $(obj).attr("spId");
            $(obj).parent().parent().remove();
            if($("input[name='chk_goods_"+spId+"']").length==0){
                $("#chk_shop_"+spId).parent().remove();
            }
            if($("input[name='chk_shop']").length==0){
                $("#have-cart-nils").fadeOut();
                var html = '<div id="cart-nil"><div class="page-cart"><i class="gwc_ic"></i><p class="p1">购物车为空哦~</p>'+
                '<a class="gwc_btn1" href="<?php echo U('Index/index');?>">去逛逛</a></div></div>';
                $("#cart-page").html(html);
            }
            var totalmoney = 0, goodsnum = 0;
            for(var shopId in cart.cartgoods){
                var shop = cart.cartgoods[shopId];
                for(var goodsId in shop.shopgoods){
                    var goods = shop.shopgoods[goodsId];
                    goodsnum++;
                    totalmoney = totalmoney + parseFloat(goods.shopPrice * goods.cnt);
                    totalmoney = totalmoney.toFixed(2);
                }
            }
            $(".em-item-amount").html(totalmoney);
            $('.cart_num, .cart_gnum_chk').html(goodsnum);
            $(".cart_gnum").html(goodsnum);
        });
    }
</script>

</body>
</html>
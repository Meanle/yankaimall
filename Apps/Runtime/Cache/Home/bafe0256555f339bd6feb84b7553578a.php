<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>咖啡馆</title>
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
<!--    <header class="bar bar-nav">
        <p onclick="goback()" class="button button-link button-nav pull-left back">
            <span class="icon icon-left"></span>
        </p>
        <h1 class='title'>衡阳</h1>
    </header>-->
    <a style="display: none;" href="http://www.wstmall.net">Powered&nbsp;By&nbsp;<strong><span style="color: #3366FF">WSTMall</span></strong></a>
    <div class="content" id="coffee-page">
        <!-- 这里是页面内容区 -->
        <?php $_result=WSTGoodsCats();if(is_array($_result)): $k1 = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($k1 % 2 );++$k1; if(is_array($vo1['catChildren'])): $k2 = 0; $__LIST__ = $vo1['catChildren'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($k2 % 2 );++$k2; if($vo2['catName'] == 咖啡馆): if(is_array($vo2['catChildren'])): $k3 = 0; $__LIST__ = $vo2['catChildren'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo3): $mod = ($k3 % 2 );++$k3;?><div class="card">
                            <!--列表头部-->
                            <div class="card-header">
                                <div class="click-open-close">
                                    点击展开
                                </div>
                                <div class="coffee-bg">
                                    <img src="/Apps/Home/View/default/img/coffee<?php echo ($k3); ?>.png"/>
                                </div>
                            </div>
                            <!--列表内容详情-->
                            <div id="click_hidden" class="card-content">
                                <div class="card-content-inner">
                                    <div class="square"></div>
                                    <div class="list">
                                        <ul class="list_sort_list">
                                            <?php if(is_array($catList)): foreach($catList as $k4=>$vo4): if(is_array($vo4['catChildren'])): foreach($vo4['catChildren'] as $k5=>$vo5): if(is_array($vo5['goods'])): foreach($vo5['goods'] as $k6=>$vo6): if($vo6['goodsCatId3'] == $vo3['catId']): ?><li>
                                                                <div class="sell-goods" onclick="goCoffeeDetail(<?php echo ($vo6['goodsId']); ?>)">
                                                                    <a class="">
                                                                        <img alt="" src="/<?php echo ($vo6['goodsThums']); ?>">
                                                                    </a>
                                                                    <p class="txt">
                                                                        <a href="#"><?php echo ($vo6['goodsName']); ?></a>
                                                                    </p>
                                                                    <div class="price">
                                                                        <span class="pri">
                                                                            <em>￥<?php echo ($vo6['shopPrice']); ?></em>
                                                                        </span>
                                                                    </div>
                                                                    <div class="vip-price">
                                                                        <p><?php echo ($vo6['vipPrice']); ?></p>
                                                                    </div>
                                                                </div>
                                                                <div class="bg-addcart added"></div>
                                                                <div class="button-add btnCart" onclick="addCart(<?php echo ($vo6['goodsId']); ?>,0,'<?php echo ($vo6['goodsName']); ?>','<?php echo ($rs['userPhone']); ?>')">+</div>
                                                            </li><?php endif; endforeach; endif; endforeach; endif; endforeach; endif; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div><?php endforeach; endif; else: echo "" ;endif; endif; endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
    </div>
    <nav class="bar bar-tab bottom-bar">
        <div class="coffee-cart">
        </div>
        <div class="gwbtnbox coffee-gocheck" >
        </div>
    </nav>
</div>
<script src="/Public/js/common.js"></script>
<script src="/Public/plugins/layer/layer.min.js"></script>
<script src="/Apps/Home/View/default/js/common.js"></script>
<script src="/Apps/Home/View/default/js/goods.js"></script>
<script>

//    点击打开咖啡列表内容
    var ishide = false;
    $(".card-header").click(function (event) {
        $(this).next().toggle("quick");
        $(this).parent().siblings().find('.card-content').hide(500,'swing');
        $(this).parent().siblings().find('.click-open-close').text("点击展开");
        if(!ishide){
            ishide = true;
            $(this).find(".click-open-close").text("点击关闭");
        }else{
            ishide = false;
            $(this).find(".click-open-close").text("点击展开");
        };
        $(".content").animate({scrollTop:$(this).offset().top + 100},500);
        $(".coffee-cart").fadeOut(500,'swing');
    });
//加载页面判断购物车是否有物品，并显示
        jQuery.post(Think.U('Home/Cart/getCoffeeCartInfo') ,{"axm":1},function(data) {
            var cart = WST.toJson(data);
            console.log(cart);
            var html = new Array();
            var totalmoney = 0, chkgoodsnum = 0, goodsnum = 0;
            html.push('<div class="list-block media-list person-card"><ul><li>');
            //for(var i=0;i<cart.cartgoods.length;i++){
            for(var shopId in cart.cartgoods){
                var shop = cart.cartgoods[shopId];
                html.push(  "<div class='item-check' id='cart_shop_li_"+shopId+"'><input type='checkbox' onclick='cartChkShop(this)' id='chk_shop_"+shopId+"' value='"+shopId+"' name='chk_shop'/><span>选择该店铺:"+shop.shopgoods[0].shopName+"</span></div>" );
                for(var goodsId in shop.shopgoods){
                    var goods = shop.shopgoods[goodsId];
                    goodsnum++;
                    if(goods.ischk==1){
                        chkgoodsnum++;
                        if('<?php echo isValidVip();?>' == '1'){
                            totalmoney = totalmoney + parseFloat(goods.vipPrice * goods.cnt);
                        }else{
                            totalmoney = totalmoney + parseFloat(goods.shopPrice * goods.cnt);
                        }
                        totalmoney = totalmoney.toFixed(2);
                    }
                    var url = Think.U("Home/Goods/getGoodsDetails","goodsId="+goods.goodsId);
                    html.push("<div class='item-content'><div class='item-media'>" +
                            "<a href='"+url+"'>" +
                            "<?php if(isValidVip() == 1): ?><input type='hidden' id='price_"+goods.goodsId+"_"+goods.goodsAttrId+"' value='"+goods.vipPrice+"'/><?php else: ?><input type='hidden' id='price_"+goods.goodsId+"_"+goods.goodsAttrId+"' value='"+goods.shopPrice+"'/><?php endif; ?>" +
                            "<input type='checkbox' onclick='cartChkGoods(this)' class='cart-goods-check cgoodsId' id='chk_goods_"+goods.goodsId+"_"+goods.goodsAttrId+"' name='chk_goods_"+goods.shopId+"' value='"+goods.goodsId+"' parent='"+goods.shopId+"' dataId='"+goods.goodsAttrId+"' isBook='"+goods.isBook+"' "+(goods.ischk==1?"checked":"")+">" +
                            "<img src='"+WST.DOMAIN +"/"+goods.goodsThums+"' /></a>" +
                            "</div>" +
                            "<div class='item-inner'><div class='item-title-row'>" +
                            "<div class='cart-close-box' style=''>" +
                            "<span class='cart-colse' price="+goods.shopPrice+" cnt="+goods.cnt+" spId="+goods.shopId+" onclick=removeCartGoods(this,'"+goods.goodsId+"','"+goods.goodsAttrId+"');></span></div>" +
                            "<a href='"+url+"' class='item-title'><span class='goodsname'>"+goods.goodsName+"</span><span>￥"+goods.shopPrice+"</span></a></div>" +
                            "<div class='item-subtitle'><div class='operate'>" +
                            "<span id='numl_"+goods.goodsId+"_"+goods.goodsAttrId+"' onclick='changeCatGoodsnum(1,"+goods.shopId+","+goods.goodsId+","+goods.goodsAttrId+","+goods.isBook+")' class='icon iconfont add'>&#xe60c;</span>" +
                            "<span id='buy-span_"+goods.goodsId+"_"+goods.goodsAttrId+"' class='operate-num'>x "+goods.cnt+"</span><input type='hidden' id='buy-num_"+goods.goodsId+"_"+goods.goodsAttrId+"' value='"+goods.cnt+"' style='width:40px;'/>" +
                            "<span id='numl_"+goods.goodsId+"_"+goods.goodsAttrId+"' onclick='changeCatGoodsnum(2,"+goods.shopId+","+goods.goodsId+","+goods.goodsAttrId+","+goods.isBook+")' class='icon iconfont minus'>&#xe611;</span></div></div></div></div>");
                }
            };
            html.push('</li></ul></div>');
            html = html.join("");
            if(goodsnum==0){
                var html = '<div class="gwbtnbox coffee-gwbtnbox"><div class="gwbtn"><ul><li class="shop"><span class="cart js_cartcont icon iconfont"><a href="#"><s class="icon iconfont" style="font-size: 2rem">&#xe607;</s></a></span></li><li><span class="cart js_cartcont icon iconfont">来一杯香浓的咖啡么？</span></li></ul></div></div>';
                $(".bottom-bar").append(html);
            }else{
                var html = '<div class="gwbtn"><ul onclick="openOpreat()"><li class="shop"><span class="cart js_cartcont"><span class="cart_gnum_chk">'+ chkgoodsnum +'</span><a href="#"><s class="icon iconfont" style="font-size: 2rem">&#xe607;</s></a></span></li>' +
                        '<li class="coffee-price"><div>总价￥<span id="cart_handler_right_totalmoney">'+ totalmoney +'</span></div><div><span>已选<span class="cart_gnum_chk cart_price">'+ chkgoodsnum +'</span>个商品</span>' +
                        '</div> </li></ul><div class="add_shop "><span class="js_cartbtn"><a class="button button-fill" href="<?php echo U('Home/Orders/checkCoffeeOrderInfo');?>">选好了</a></span></div></div>';
                $(".coffee-gocheck").append(html);
            };
//            $(".cart_gnum_chk").html(chkgoodsnum);
//            $('#cart_handler_right_totalmoney').html(totalmoney);
            $(".coffee-cart").append(html);
        });
        eleShopCart = document.querySelector(".coffee-gocheck");
        // 绑定点击事件
        if (eleShopCart) {[].slice.call(document.getElementsByClassName("btnCart"))
                .forEach(function(button) {button.addEventListener("click",function(event) {
//                    $(this).parent().find('.bg-addcart').addClass('added');
                    WST.msg("正在操作...",{offset: '200px'});
//                    var msg= layer.load('数据加载中');
                            setTimeout(function(){
                                $(".coffee-gocheck").fadeIn();
                                jQuery.post(Think.U('Home/Cart/getCoffeeCartInfo') ,{"axm":1},function(data) {
                                    var cart = WST.toJson(data);
                                    var totalmoney = 0, chkgoodsnum = 0, goodsnum = 0;
                                    for(var shopId in cart.cartgoods){
                                        var shop = cart.cartgoods[shopId];
                                        for(var goodsId in shop.shopgoods){
                                            var goods = shop.shopgoods[goodsId];
                                            goodsnum++;
                                            if(goods.ischk==1){
                                                chkgoodsnum++;
                                                if('<?php echo isValidVip();?>' == '1'){
                                                    totalmoney = totalmoney + parseFloat(goods.vipPrice * goods.cnt);
                                                }else{
                                                    totalmoney = totalmoney + parseFloat(goods.shopPrice * goods.cnt);
                                                }
                                                totalmoney = totalmoney.toFixed(2);
                                            }
                                        }
                                    }
                                    if(goodsnum != 0){
                                        $(".coffee-gwbtnbox").fadeOut();
                                        var html = '<div class="gwbtn"><ul onclick="openOpreat()"><li class="shop"><span class="cart js_cartcont"><span class="cart_gnum_chk">'+ chkgoodsnum +'</span><a href="#"><s class="icon iconfont" style="font-size: 2rem">&#xe607;</s></a></span></li>' +
                                                '<li class="coffee-price"><div>总价￥<span id="cart_handler_right_totalmoney">'+ totalmoney +'</span></div><div><span>已选<span class="cart_gnum_chk cart_price">'+ chkgoodsnum +'</span>个商品</span>' +
                                                '</div> </li></ul><div class="add_shop "><span class="js_cartbtn"><a class="button button-fill" href="<?php echo U('Home/Orders/checkCoffeeOrderInfo');?>">选好了</a></span></div></div>';
                                        $(".coffee-gocheck").append(html);
                                    }else{
                                        $(".coffee-gocheck").fadeOut();
                                    }
                                    $(".cart_gnum_chk").html(chkgoodsnum);
                                    $('#cart_handler_right_totalmoney').html(totalmoney);
                                });
                            },2500)
                         });
                        });
        }
        function openOpreat() {
            jQuery.post(Think.U('Home/Cart/getCoffeeCartInfo') ,{"axm":1},function(data) {
                var cart = WST.toJson(data);
                var html = new Array();
                var totalmoney = 0, chkgoodsnum = 0, goodsnum = 0;
                html.push('<div class="list-block media-list person-card"><ul><li>');
                //for(var i=0;i<cart.cartgoods.length;i++){
                for(var shopId in cart.cartgoods){
                    var shop = cart.cartgoods[shopId];
                    html.push(  "<div class='item-check' id='cart_shop_li_"+shopId+"'><input type='checkbox' onclick='cartChkShop(this)' id='chk_shop_"+shopId+"' value='"+shopId+"' name='chk_shop'/><span>选择该店铺:"+shop.shopgoods[0].shopName+"</span></div>" );
                    for(var goodsId in shop.shopgoods){
                        var goods = shop.shopgoods[goodsId];
                        goodsnum++;
                        if(goods.ischk==1){
                            chkgoodsnum++;
                            if('<?php echo isValidVip();?>' == '1'){
                                totalmoney = totalmoney + parseFloat(goods.vipPrice * goods.cnt);
                            }else{
                                totalmoney = totalmoney + parseFloat(goods.shopPrice * goods.cnt);
                            }
                            totalmoney = totalmoney.toFixed(2);
                        }
                        var url = Think.U("Home/Goods/getGoodsDetails","goodsId="+goods.goodsId);
                        html.push(  "<div class='item-content'><div class='item-media'>" +
                                "<a href='"+url+"'>" +
                                "<?php if(isValidVip() == 1): ?><input type='hidden' id='price_"+goods.goodsId+"_"+goods.goodsAttrId+"' value='"+goods.vipPrice+"'/><?php else: ?><input type='hidden' id='price_"+goods.goodsId+"_"+goods.goodsAttrId+"' value='"+goods.shopPrice+"'/><?php endif; ?>" +
                                "<input type='checkbox' onclick='cartChkGoods(this)' class='cart-goods-check cgoodsId' id='chk_goods_"+goods.goodsId+"_"+goods.goodsAttrId+"' name='chk_goods_"+goods.shopId+"' value='"+goods.goodsId+"' parent='"+goods.shopId+"' dataId='"+goods.goodsAttrId+"' isBook='"+goods.isBook+"' "+(goods.ischk==1?"checked":"")+">" +
                                "<img src='"+WST.DOMAIN +"/"+goods.goodsThums+"' /></a>" +
                                "</div>" +
                                "<div class='item-inner'><div class='item-title-row'>" +
                                "<a href='"+url+"' class='item-title'><span class='goodsname'>"+goods.goodsName+"</span>" +
                                "<?php if(isValidVip() == 1): ?><span>￥"+goods.vipPrice+"</span><?php else: ?><span>￥"+goods.shopPrice+"</span><?php endif; ?>" +
                                "</a><div class='cart-close-box item-title' style=''>" +
                                "<span class='cart-colse iconfont' price="+goods.shopPrice+" cnt="+goods.cnt+" spId="+goods.shopId+" onclick=removeCartGoods(this,'"+goods.goodsId+"','"+goods.goodsAttrId+"');>&#xe610;</span></div></div>" +
                                "<div class='item-subtitle'><div class='operate'>" +
                                "<span id='numl_"+goods.goodsId+"_"+goods.goodsAttrId+"' onclick='changeCatGoodsnum(1,"+goods.shopId+","+goods.goodsId+","+goods.goodsAttrId+","+goods.isBook+")' class='icon iconfont add'>&#xe60c;</span>" +
                                "<span id='buy-span_"+goods.goodsId+"_"+goods.goodsAttrId+"' class='operate-num'>x "+goods.cnt+"</span><input type='hidden' id='buy-num_"+goods.goodsId+"_"+goods.goodsAttrId+"' value='"+goods.cnt+"' style='width:40px;'/>" +
                                "<span id='numl_"+goods.goodsId+"_"+goods.goodsAttrId+"' onclick='changeCatGoodsnum(2,"+goods.shopId+","+goods.goodsId+","+goods.goodsAttrId+","+goods.isBook+")' class='icon iconfont minus'>&#xe60d;</span></div></div></div></div>");

                    }
                };
                html.push('</li></ul></div>');
                html = html.join("");
                $(".cart_gnum_chk").html(chkgoodsnum);
                $('#cart_handler_right_totalmoney').html(totalmoney);
                $(".coffee-cart").html(html);
            });
            $(".coffee-cart").toggle('quick');
        }
        function removeCartGoods(obj,goodsId,goodsAttrId){
            jQuery.post(Think.U('Home/Cart/delCartGoods') ,{goodsId:goodsId,goodsAttrId:goodsAttrId,"axm":1},function(data) {
                var cart = WST.toJson(data);
                var spId = $(obj).attr("spId");
                $(obj).parent().parent().parent().parent().remove();
                if($("input[name='chk_goods_"+spId+"']").length==0){
                    $("#cart_shop_li_"+spId).remove();
                    $(".coffee-cart").fadeOut();
                    $(".coffee-gocheck").fadeOut();
                    var html = '<div class="gwbtnbox coffee-gwbtnbox"><div class="gwbtn"><ul><li class="shop"><span class="cart js_cartcont icon iconfont"><a href="#"><s class="icon iconfont" style="font-size: 2rem">&#xe607;</s></a></span></li><li><span class="cart js_cartcont icon iconfont">来一杯香浓的咖啡么？</span></li></ul></div></div>';
                    $(".bottom-bar").append(html);
                }
                var totalmoney = 0, goodsnum = 0;
                for(var shopId in cart.cartgoods){
                    var shop = cart.cartgoods[shopId];
                    for(var goodsId in shop.shopgoods){
                        var goods = shop.shopgoods[goodsId];
                        goodsnum++;
                        if('<?php echo isValidVip();?>' == '1'){
                            totalmoney = totalmoney + parseFloat(goods.vipPrice * goods.cnt);
                        }else{
                            totalmoney = totalmoney + parseFloat(goods.shopPrice * goods.cnt);
                        }
                        totalmoney = totalmoney.toFixed(2);
                    }
                }
                $("#cart_handler_right_totalmoney, .wst-nvg-cart-price").html(totalmoney);
                $('.cart_num, .cart_gnum_chk').html(goodsnum);
                $(".cart_gnum").html(goodsnum);
            });
        }
        $(".add_shop ").click(function (){
            $(".coffee-cart").css('display','none');
//            return false;
        });
    function goCoffeeDetail(id) {
       location.href =  "<?php echo U('Home/Goods/getCoffeeGoodsDetails');?>&goodsId=" + id;
    }

</script>
</body>

</html>
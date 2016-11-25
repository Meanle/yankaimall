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
    <a class="tab-item active" href="<?php echo U('Index/index');?>">
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
    <a class="tab-item [set]" href="<?php echo U('Orders/queryByPage');?>" data-transition='slide-in'>
        <span class="icon iconfont">&#xe600;</span>
        <span class="tab-label">我的</span>
    </a>
</nav>

    <!--<div class="content-padded" style="height: 100%;">-->
    <!--<div class="develop" style="width: 100%; height: 100%; padding: 40% 0;">-->
    <!--<p class="icon iconfont" style="width: 100%;text-align: center; font-size: 6rem;    color: #929292;">&#xe6bd;</p>-->
    <!--<p style="width: 100%;text-align: center;color: #929292;">咦，页面坐着神州11号飞去外太空了！</p>-->
    <!--</div>-->
    <!--</div>-->
    <div class="header-nav">
        <script src="/Public/js/jquery.min.js"></script>
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
<script src="/Public/plugins/layer/layer.min.js"></script>
<script>
    jQuery.noConflict();
</script>
<div class="bar bar-header-secondary">
    <form action="<?php echo U('Home/goods/searchGoodsList','searchType=1');?>" method="post" enctype="multipart/form-data">
        <div class="searchbar">
            <a class="searchbar-cancel">取消</a>
            <div class="search-input">
                <label class="icon icon-search" for="search"></label>
                <input type="search" name="keyWords" id='search' placeholder='输入您想要的商品...'/>
            </div>
        </div>
    </form>
</div>

        <div class="header-class" id="navHeight">
            <nav class="nav-wrap" id="nav-wrap">
                <ul class="clearfix scroll-fix sort-tab">
                    <?php $_result=WSTGoodsCats();if(is_array($_result)): $k1 = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($k1 % 2 );++$k1; if(is_array($vo1['catChildren'])): $k2 = 0; $__LIST__ = $vo1['catChildren'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($k2 % 2 );++$k2; if($vo2['catName'] == 默认): if(is_array($vo2['catChildren'])): $k3 = 0; $__LIST__ = $vo2['catChildren'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo3): $mod = ($k3 % 2 );++$k3; if($k3 == 1): ?><li>
                                            <a class="active"><?php echo ($vo3["catName"]); ?></a>
                                        </li>
                                        <?php else: ?>
                                        <li>
                                            <a><?php echo ($vo3["catName"]); ?></a>
                                        </li><?php endif; endforeach; endif; else: echo "" ;endif; endif; endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </nav>
        </div>
    </div>
    <!--生日日-->
    <?php if($isBirthday == 1): ?><div class="birthday">
            <a href="<?php echo U('Home/Welfare/goBirthDay');?>"></a>
        </div><?php endif; ?>
    <!--会员日-->
    <?php if($isVipday == 1): ?><div class="birthday">
            <a href="<?php echo U('Home/Welfare/goVipDay');?>"></a>
        </div><?php endif; ?>

    <div class="content page-home" id='home-page'>
        <!--下拉刷新-->
        <!--        <div class="pull-to-refresh-layer">
                    <div class="preloader"></div>
                    <div class="pull-to-refresh-arrow"></div>
                </div>-->
        <!-- 这里是页面内容区 -->
        <!--slider-->
        <div class="swiper-container swiper-container-horizontal" data-space-between="10" data-autoplay="3000" data-speed="300">
            <div class="swiper-wrapper">
                <?php $_result=WSTAds(-1);if(is_array($_result)): $k = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><div class="swiper-slide">
                        <img class='card-cover'
                             src="/<?php echo ($vo['adFile']); ?>"
                             alt="">
                    </div><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
            <div class="swiper-pagination">
                <span class="swiper-pagination-bullet swiper-pagination-bullet-active"></span>
                <span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span>
            </div>
        </div>
        <div class="index-coffee">
            <div class="row">
                <div class="col-33">
                    <a href="<?php echo U('Home/Users/govipEntityByPages');?>">
                        <p class="index-coffee-icon iconfont">&#xe71a;</p>
                        <p class="index-coffee-title">黑金特权</p>
                    </a>
                </div>
                <div class="col-33">
                    <a href="<?php echo U('Index/coffee');?>">
                        <p class="index-coffee-icon iconfont">&#xe633;</p>
                        <p class="index-coffee-title">咖啡馆</p>
                    </a>
                </div>
                <div class="col-33">
                    <?php $_result=WSTGoodsCats();if(is_array($_result)): $k1 = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($k1 % 2 );++$k1; if(is_array($vo1['catChildren'])): $k2 = 0; $__LIST__ = $vo1['catChildren'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($k2 % 2 );++$k2; if($vo2['catName'] == 默认): if(is_array($vo2['catChildren'])): $k3 = 0; $__LIST__ = $vo2['catChildren'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo3): $mod = ($k3 % 2 );++$k3; if($vo3['catName'] == 超值热卖): ?><a href="<?php echo U('Home/Goods/getGoodsList/',array('c1Id'=>$vo1['catId'],'c2Id'=>$vo2['catId'],'c3Id'=>$vo3['catId'],'catName'=>$vo3['catName'],'class'=>$k3));?>">
                                            <p class="index-coffee-icon iconfont">&#xe635;</p>
                                            <p class="index-coffee-title">热卖榜</p>
                                        </a><?php endif; endforeach; endif; else: echo "" ;endif; endif; endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
                </div>
            </div>
        </div>

        <div class="list">
            <ul class="clearfix">
                <?php $_result=WSTGoodsCats();if(is_array($_result)): $k1 = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($k1 % 2 );++$k1; if(is_array($vo1['catChildren'])): $k2 = 0; $__LIST__ = $vo1['catChildren'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($k2 % 2 );++$k2; if($vo2['catName'] == 默认): if(is_array($vo2['catChildren'])): $k3 = 0; $__LIST__ = $vo2['catChildren'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo3): $mod = ($k3 % 2 );++$k3;?><div id="section<?php echo ($k3); ?>" class="list-group">
                                    <div class="list-group-title">
                                        <span><?php echo ($vo3['catName']); ?></span>
                                        <p>不可错过</p>
                                    </div>
                                    <a href="<?php echo U('Home/Goods/getClassGoodslist/',array('sum'=>$k3,'c1Id'=>$vo1['catId'],'catName'=>$vo3['catName']));?>"
                                       data-transition='slide-in'>
                                        <div class="card color-default" style="margin: 0 0 .5rem 0;">
                                            <div style="" valign="bottom"
                                                 class="card-header color-white no-border no-padding">
                                                <img class='card-cover'
                                                     src="/<?php echo WSTAds($vo1['catId'])[$k3-1]['adFile'];?>" alt="">
                                            </div>
                                        </div>
                                    </a>
                                    <?php $num = 0;?>
                                    <ul class="list_sort_list">
                                        <?php if($k3 == 1): if(is_array($catList1)): foreach($catList1 as $k4=>$vo4): if($vo4['catName'] == 分类): if(is_array($vo4['catChildren'])): foreach($vo4['catChildren'] as $k5=>$vo5): if(is_array($vo5['goods'])): foreach($vo5['goods'] as $k6=>$vo6): if($num < 4): $num ++;?>
                                                                <li>
                                                                    <div class="sell-goods"
                                                                         onclick="goGoodsDetail('<?php echo ($vo6[goodsId]); ?>')">
                                                                        <a>
                                                                            <img alt="" src="/<?php echo ($vo6['goodsThums']); ?>">
                                                                        </a>
                                                                        <p class="txt">
                                                                            <a><?php echo ($vo6['goodsName']); ?></a>
                                                                        </p>
                                                                        <div class="price">
                                                                            <span class="pri"><em>￥ <?php echo ($vo6['shopPrice']); ?></em></span>
                                                                            <del>￥<?php echo ($vo6["marketPrice"]); ?></del>
                                                                        </div>
                                                                        <!--<div class="vip-price">
                                                                            <p><?php echo ($vo6['vipPrice']); ?></p>
                                                                        </div>-->
                                                                        <!--<p class="pl"><em>5人评价</em>，<em>好评率100%</em></p>-->
                                                                    </div>
                                                                </li><?php endif; endforeach; endif; endforeach; endif; endif; endforeach; endif; endif; ?>
                                        <?php if($k3 == 2): if(is_array($catList2)): foreach($catList2 as $k4=>$vo4): if($vo4['catName'] == 分类): if(is_array($vo4['catChildren'])): foreach($vo4['catChildren'] as $k5=>$vo5): if(is_array($vo5['goods'])): foreach($vo5['goods'] as $k6=>$vo6): if($num < 4): $num ++;?>
                                                                <li>
                                                                    <div class="sell-goods"
                                                                         onclick="goGoodsDetail('<?php echo ($vo6[goodsId]); ?>')">
                                                                        <a>
                                                                            <img alt="" src="/<?php echo ($vo6['goodsThums']); ?>">
                                                                        </a>
                                                                        <p class="txt">
                                                                            <a><?php echo ($vo6['goodsName']); ?></a>
                                                                        </p>
                                                                        <div class="price">
                                                                            <span class="pri"><em>￥ <?php echo ($vo6['shopPrice']); ?></em></span>
                                                                            <del>￥<?php echo ($vo6["marketPrice"]); ?></del>
                                                                        </div>
                                                                       <!-- <div class="vip-price">
                                                                            <p><?php echo ($vo6['vipPrice']); ?></p>
                                                                        </div>-->
                                                                        <!--<p class="pl"><em>5人评价</em>，<em>好评率100%</em></p>-->
                                                                    </div>
                                                                </li><?php endif; endforeach; endif; endforeach; endif; endif; endforeach; endif; endif; ?>
                                        <?php if($k3 == 3): if(is_array($catList3)): foreach($catList3 as $k4=>$vo4): if($vo4['catName'] == 分类): if(is_array($vo4['catChildren'])): foreach($vo4['catChildren'] as $k5=>$vo5): if(is_array($vo5['goods'])): foreach($vo5['goods'] as $k6=>$vo6): if($num < 4): $num ++;?>
                                                                <li>
                                                                    <div class="sell-goods"
                                                                         onclick="goGoodsDetail('<?php echo ($vo6[goodsId]); ?>')">
                                                                        <a>
                                                                            <img alt="" src="/<?php echo ($vo6['goodsThums']); ?>">
                                                                        </a>
                                                                        <p class="txt">
                                                                            <a><?php echo ($vo6['goodsName']); ?></a>
                                                                        </p>
                                                                        <div class="price">
                                                                            <span class="pri"><em>￥ <?php echo ($vo6['shopPrice']); ?></em></span>
                                                                            <del>￥<?php echo ($vo6["marketPrice"]); ?></del>
                                                                        </div>
                                                                        <!--<div class="vip-price">
                                                                            <p><?php echo ($vo6['vipPrice']); ?></p>
                                                                        </div>-->
                                                                        <!--<p class="pl"><em>5人评价</em>，<em>好评率100%</em></p>-->
                                                                    </div>
                                                                </li><?php endif; endforeach; endif; endforeach; endif; endif; endforeach; endif; endif; ?>
                                        <?php if($k3 == 4): if(is_array($catList4)): foreach($catList4 as $k4=>$vo4): if($vo4['catName'] == 分类): if(is_array($vo4['catChildren'])): foreach($vo4['catChildren'] as $k5=>$vo5): if(is_array($vo5['goods'])): foreach($vo5['goods'] as $k6=>$vo6): if($num < 4): $num ++;?>
                                                                <li>
                                                                    <div class="sell-goods"
                                                                         onclick="goGoodsDetail('<?php echo ($vo6[goodsId]); ?>')">
                                                                        <a>
                                                                            <img alt="" src="/<?php echo ($vo6['goodsThums']); ?>">
                                                                        </a>
                                                                        <p class="txt">
                                                                            <a><?php echo ($vo6['goodsName']); ?></a>
                                                                        </p>
                                                                        <div class="price">
                                                                            <span class="pri"><em>￥ <?php echo ($vo6['shopPrice']); ?></em></span>
                                                                            <del>￥<?php echo ($vo6["marketPrice"]); ?></del>
                                                                        </div>
                                                                        <!--<div class="vip-price">
                                                                            <p><?php echo ($vo6['vipPrice']); ?></p>
                                                                        </div>-->
                                                                        <!--<p class="pl"><em>5人评价</em>，<em>好评率100%</em></p>-->
                                                                    </div>
                                                                </li><?php endif; endforeach; endif; endforeach; endif; endif; endforeach; endif; endif; ?>
                                    </ul>
                                    <div class="list-more">
                                        <p><a style="color: #000;"
                                              href="<?php echo U('Home/Goods/getClassGoodslist/',array('sum'=>$k3,'c1Id'=>$vo1['catId'],'catName'=>$vo3['catName']));?>"
                                              data-transition='slide-in'>更多</a></p>
                                    </div>
                                </div><?php endforeach; endif; else: echo "" ;endif; endif; endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
                <div id="" style="font-size: .55rem;text-align: center;padding: .2rem 0 0 0;">客服电话:4000-665-133</div>
                <div id="shop-info" style="font-size: .55rem;text-align: center;padding: .2rem;">门店地址:衡阳市蒸湘区解放大道21号华新步步高一楼</div>
            </ul>
        </div>
    </div>
    <div id="alerter" style="position:fixed;height:100%;width:100%;top: 0;left: 0;background:rgba(103, 103, 103, 0.23);z-index: 999999">
        <div style="margin: 50% auto; position: relative;">
            <p class="closealerter" style="position: absolute; top: 0; right: 0;width: 1.5rem;height: 1.5rem;"></p>
            <img style="width: 100%" src="/Apps/Home/View/default/img/alert.png">
            <p class="closealerter" style="position: absolute;bottom: 2.5rem;height: 2rem;width: 100%;"></p>
        </div>
    </div>
</div>
<script type='text/javascript' src="/Apps/Home/View/default/js/cookie.js" charset='utf-8'></script>
<script src="/Public/js/jquery.min.js"></script>
<script>

    var isfirst = sessionStorage.getItem("first");
    if(isfirst){
        jQuery("#alerter").css('display','none');
    }else{
        jQuery(".closealerter").click(function (){
            jQuery("#alerter").hide(100);
        });
        sessionStorage.setItem("first", "1");
    }


    //    进入商品详情
    function goGoodsDetail(id) {
        location.href = "<?php echo U('Home/Goods/getGoodsDetails/');?>&goodsId=" + id;
    }
    jQuery(function (){
        //    首页生日日和会员日显示
        var interval=setInterval(tiao,5000);
        var intervals=setInterval(tiao,5500);
        jQuery('.birthday').click(function () {
            clearInterval(interval,intervals);
        });
        //    定位锚点
        var stop2 = $("#section2").offset().top;
        var stop3 = $("#section3").offset().top;
        var stop4 = $("#section4").offset().top;
        jQuery(".sort-tab li").click(function() {
            var t = $(this).index();
            if(t == 0) {
                jQuery("#home-page").stop().animate({scrollTop: '0px'}, 700);
                $(".sort-tab li a").removeClass("active");
                $(".sort-tab li a").eq(t).addClass("active");
            } else {
                $(".sort-tab li a").removeClass("active");
                $(".sort-tab li a").eq(t).addClass("active");
                var tnum = t+1;
                var section = "section" + tnum;
                console.log(section);
                if(section == "section2"){
                    jQuery(".content").stop().animate({scrollTop: stop2-90}, 500);
                }else if(section == "section3"){
                    jQuery(".content").stop().animate({scrollTop: stop3-90}, 500);
                }else if(section == "section4"){
                    jQuery(".content").stop().animate({scrollTop: stop4-90}, 500);
                }
            }
        });
    });
//    首页生日日和会员日动画
    function tiao(){
        jQuery(".birthday").animate({left:"-1rem"},250,function(){jQuery(".birthday").animate({left:"-0.5rem"},250);});
        jQuery(".vipday").animate({right:"-5.5rem"},250,function(){jQuery(".vipday").animate({right:"-5rem"},250);});
    };
//    记住浏览位置，返回时回到当前位置
    var c=0;
    jQuery(function (){
        sessionStorage.removeItem("top");
        var a=b=null;
        if(window.sessionStorage){
            a=parseInt(sessionStorage.getItem("top1"));
            b=parseInt(sessionStorage.getItem("size1"));
            if(a){
                jQuery('.content').scrollTop(a);
            }
        }
    });

    // 记住当前浏览位置并存储为session
    jQuery('.content').on('scroll',  function () {
        var tops1=jQuery('.content').scrollTop(),
                height1=jQuery('.content').scrollTop(),
                scrollbottom=height1-tops1;
        if(window.sessionStorage){
            sessionStorage.setItem("top1",tops1);
            sessionStorage.setItem("size1",c);
        }
    })
    jQuery.noConflict();
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
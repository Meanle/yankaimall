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
    <a class="tab-item active" href="<?php echo U('Index/classify');?>" data-transition='slide-in'>
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

    </div>
    <div class="content page-home" id='home-page' style="top: 2.2rem;">
        <!-- 这里是页面内容区 -->
        <!--slider-->
        <div class="list">
            <?php if(is_array($catList)): $k1 = 0; $__LIST__ = $catList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($k1 % 2 );++$k1; if($vo1['catName'] == 分类): if(is_array($vo1['catChildren'])): $k2 = 0; $__LIST__ = $vo1['catChildren'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($k2 % 2 );++$k2;?><div id="section$k1" class="list-group">
                            <a data-transition='slide-in' style="display: block">
                                <div class="card color-default" style="margin: 0;">
                                    <div valign="bottom" class="card-header color-white no-border no-padding"
                                         style="height:auto;">
                                        <img class='card-cover' src="/<?php echo WSTAds($vo1['catId'])[$k2-1]['adFile'];?>" alt="">
                                    </div>
                                </div>
                            </a>
                            <div class="row classify-goods">
                                <?php if(is_array($vo2['catChildren'])): $k3 = 0; $__LIST__ = $vo2['catChildren'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo3): $mod = ($k3 % 2 );++$k3;?><div class="col-25">
                                        <a href="<?php echo U('Home/Goods/getGoodsList/',array('c1Id'=>$vo1['catId'],'c2Id'=>$vo2['catId'],'c3Id'=>$vo3['catId'],'catName'=>$vo3['catName'],'class'=>$k2));?>"><?php echo ($vo3['catName']); ?></a>
                                    </div><?php endforeach; endif; else: echo "" ;endif; ?>
                            </div>
                        </div><?php endforeach; endif; else: echo "" ;endif; endif; endforeach; endif; else: echo "" ;endif; ?>
        </div>
    </div>
</div>
<script>
    //    记住当前浏览位置，返回时回到当前浏览位置
    var c=0;
    $(function (){
        sessionStorage.removeItem("top");
        var a=b=null;
        if(window.sessionStorage){
            a=parseInt(sessionStorage.getItem("top2"));
            b=parseInt(sessionStorage.getItem("size2"));
            if(a){
                $('.content').scrollTop(a);
            }
        }
    });
    // 记住当前浏览位置并存储为session
    $('.content').on('scroll',  function () {
        var tops2=$('.content').scrollTop(),
                height2=$('.content').scrollTop(),
                scrollbottom=height2-tops2;
        if(window.sessionStorage){
            sessionStorage.setItem("top2",tops2);
            sessionStorage.setItem("size2",c);
        }
    })
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
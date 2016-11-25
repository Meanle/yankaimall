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


<script src="/Public/js/jquery.min.js"></script>
<script src="/Apps/Home/View/default/js/goods.js"></script>
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
<link rel="stylesheet" href="/Apps/Home/View/default/css/favorites.css">
<div class="page">

    <div class="content page-home infinite-scroll" id='list-page'>
        <!-- 这里是页面内容区 -->
        <?php if(empty($rs['data'][root])): ?><!--这里是当没有收藏商品显示的内容-->
            <div class="content-padded" style="height: 100%;margin: 0;">
                <div class="develop" style="width: 100%; height: 100%; padding: 40% 0;">
                    <p class="icon iconfont"
                       style="width: 100%;text-align: center; font-size: 6rem;    color: #929292;">&#xe622;</p>
                    <p style="width: 100%;text-align: center;color: #929292;">您还没有收藏商品哦</p>
                    <a class="col-50 button button-fill" style="margin: 1rem auto; width: 50%;"
                       href="/index.php?m=Home&c=Index&a=index">去逛逛</a>
                </div>
            </div>
            <?php else: ?>
            <!--这里是有商品时候显示的内容-->
            <div class="list">
                <ul class="list_sort_list collect_list">
                    <?php if(is_array($rs['data']['root'])): $i = 0; $__LIST__ = $rs['data']['root'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i;?><li>
                            <div>
                                <a class="" href="<?php echo U('Home/Goods/getGoodsDetails/',array('goodsId'=>$vo1[goodsId]));?>">
                                    <img alt="" src="/<?php echo ($vo1['goodsThums']); ?>">
                                </a>
                                <p class="txt">
                                    <a href="#"><?php echo ($vo1['goodsName']); ?></a>
                                </p>
                                <div class="price">
									<span class="pri">
			                        <em>￥<?php echo ($vo1['shopPrice']); ?></em>
			                    </span>

                                </div>
                                <p class="pl"><em>销量:</em><em><?php echo ($vo1['saleCount']); ?></em></p>
                                <a onclick="javascript:removeFavorite(<?php echo ($vo1['favoriteId']); ?>,0,this)">取消收藏</a>
                            </div>
                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div><?php endif; ?>
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
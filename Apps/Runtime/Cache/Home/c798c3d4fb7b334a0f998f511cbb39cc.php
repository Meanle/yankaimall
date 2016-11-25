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
    <div class="content page-home infinite-scroll" id='vip-page' style="margin-bottom: 0;">
        <div class="list">
            <div class="list-group-title" style="margin: 0;">
                <div class="vip-title-img text-center">
                    <div class="item-content text-center">
                        <div class="item-media"><img src="<?php echo WSTImgPath($WST_USER['userPhoto']);?>" width="80">
                        </div>
                        <div class="item-inner">
                            <div class="item-title-row">
                                <div class="item-title">
                                    <span class="iconfont" style="font-size: 1.4rem;vertical-align: middle;margin-right: 0.4rem">&#xe6b8;</span>
                                    <?php echo ($WST_USER["loginName"]); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-content">
                <div class="card-content">
                    <!--以下是会员不是会员特价商品日显示-->

                    <?php if(is_array($articleList)): $k1 = 0; $__LIST__ = $articleList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($k1 % 2 );++$k1; if(is_array($vo1[articlecats])): $k2 = 0; $__LIST__ = $vo1[articlecats];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($k2 % 2 );++$k2; endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
                    <!--end-->

                    <!--以下是会员卡日特价商品，只有在制定日期显示-->
                    <div class="vip-date iamvip">
                        <p class="color-gray" style="padding-bottom: 0; ">
                            <span class="iconfont" style="font-size: 1.4rem;vertical-align: middle;">&#xe62c;</span>
                            <span><?php echo ($WST_USER["loginName"]); ?></span>
                            <span style="color: #ccc;font-size: .5rem">黑金会员</span>
                        </p>
                        <p class="twocode"><img src="/Apps/Home/View/default/img/twocode.png"></p>
                        <div class="list coffee-content-block">
                            <ul class="list_sort_list collect_list">
                                    <div class="content-padded" style="height: 100%; margin-top: 0;">
                                        <div class="develop" style="width: 100%; height: 100%; padding:0;">
                                            <p style="width: 100%;text-align: center;color: #929292;"><span class="bvipcard">卡号：</span><span><?php echo ($vipcard[cardId]); ?></span></p>
                                            <p style="width: 100%;text-align: center;color: #929292;"><span class="bvipcard">密码：</span><span><?php echo ($vipcard[cardPassword]); ?></span></p>
                                            <p style="width: 100%;text-align: center;color: #929292;"><span class="bvipcard">办理日期：</span><span><?php echo ($vipcard[startTime]); ?></span></p>
                                            <p style="width: 100%;text-align: center;color: #929292;"><span class="bvipcard">有效期至：</span><span><?php echo ($vipcard[endTime]); ?></span></p>
                                        </div>
                                    </div>
                            </ul>
                        </div>
                    </div>
                    <div class="content-block row">
                        <p class="col-40" style="margin: 0 auto;float: none">
                            <input id="goIndex" class="button button-fill" style="background: #ffbe00;color: #fff;" type="submit"
                                   data-transition='fade' value="前去购物" />
                        </p>
                    </div>
                    <div class="card-content-inner" style="padding: 0 1.5rem .5rem 1.5rem;">
                        <p class="color-gray">
                        </p>
                        <p style="color: #ccc;font-size: 0.85rem;">您的特权</p>
                        <p>1.咖啡吧饮品半价</p>
                        <p>2.会员生日当天大礼包</p>
                        <p>3.每周会员特价产品</p>
                        <p>4.线上线下均享会员价</p>
                        <p>5.购物积分兑换</p>
                        <p>6.免费体验彩妆、护肤沙龙活动</p>
                    </div>
                    <!--end-->
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#goIndex').click(function () {
        location.href = "<?php echo U('Index/index');?>";
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
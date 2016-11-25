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
    <!--    <header class="bar bar-nav">
            <a href="#" class="button button-link button-nav pull-left back">
                <span class="icon icon-left"></span>
            </a>
            <h1 class="title"><?php echo ($catName); ?>专题</h1>
            <p class="pull-right">
                <span class="icon icon-share"></span>
            </p>
        </header>-->
    <div class="content page-home infinite-scroll page-special" id='list-page'>
        <!-- 这里是页面内容区 -->
        <div class="special-img">
            <div style="height: auto" valign="bottom" class="card-header color-white no-border no-padding">
                <img class="card-cover" src="/<?php echo WSTAds($c1Id)[$class-1]['adFile'];?>" alt="">
            </div>
        </div>
        <!--这里是专题商品-->
        <div class="list">
            <ul id="special-list" class="list_sort_list collect_list">
                <?php if(is_array($pages['root'])): foreach($pages['root'] as $k1=>$goods): ?><li>
                        <div class="sell-goods">
                            <a class="" href="<?php echo U('Home/Goods/getGoodsDetails/',array('goodsId'=>$goods['goodsId']));?>">
                                <img alt="" src="/<?php echo ($goods['goodsThums']); ?>">
                            </a>
                            <p class="txt">
                                <a href="#"><?php echo ($goods['goodsName']); ?></a>
                            </p>
                            <div class="price">
									<span class="pri">
			                        <em>￥ <?php echo ($goods['shopPrice']); ?></em>
			                    </span>
                            </div>
                            <div class="vip-price">
                                <p><em>￥</em><?php echo ($goods['vipPrice']); ?></p>
                            </div>
                            <a class="hei_si"
                               href="<?php echo U('Home/Goods/getGoodsDetails/',array('goodsId'=>$goods['goodsId']));?>"
                               style="display: block;">查看详情</a>
                            <!--<p class="pl"><em>5人评价</em>，<em>好评率100%</em></p>-->
                        </div>
                    </li><?php endforeach; endif; ?>
            </ul>
        </div>
        <!--当没有商品时显示-->
        <div id="bottom-nogoods">
        </div>
        <!-- 加载提示符 -->
        <div class="infinite-scroll-preloader">
            <div class="preloader"></div>
        </div>
    </div>
</div>


<script>
    //列表上啦加载
    $(function () {
        var c1Id = JSON.parse("<?php echo $c1Id; ?>");
        var c2Id = JSON.parse("<?php echo $c2Id; ?>");
        var c3Id = JSON.parse("<?php echo $c3Id; ?>");
        var _class = JSON.parse("<?php echo $class; ?>");
        var loading = false;
        var pagecurr = 1;
        var lastPage = 1;
        $.ajax({
            url: '<?php echo U("Home/Goods/getGoodsListlimit");?>',
            type: 'get',
            data: {
                c1Id: c1Id,
                c2Id: c2Id,
                c3Id: c3Id,
                c1Id: c1Id,
                class: _class,
                pcurr: pagecurr+1
            },
            success: function (json) {
                var goodslist = json.pages.root;
                if (!goodslist.length) {
                    $.detachInfiniteScroll($('.infinite-scroll'));
                    // 删除加载提示符
                    $('.infinite-scroll-preloader').remove();
                    $('#bottom-nogoods').html('<div class="nogoods"> 别拉了，到底啦~</div>');
                    return;
                } else{
                    $(document).on('infinite', '.page-special', function () {
                        // 如果正在加载，则退出
                        if (loading) return;
                        // 设置flag
                        loading = true;
                        // 模拟1s的加载过程
                        setTimeout(function () {
                            // 重置加载flag
                            loading = false;
                            // 添加新条目
                            addItems(pagecurr++);
                            //容器发生改变,如果是js滚动，需要刷新滚动
                            $.refreshScroller();
                        }, 1000);
                    });
                }
            }
        });
        function addItems(type, pcurr) {
            $.ajax({
                url: '<?php echo U("Home/Goods/getGoodsListlimit");?>',
                type: 'get',
                data: {
                    c1Id: c1Id,
                    c2Id: c2Id,
                    c3Id: c3Id,
                    c1Id: c1Id,
                    class: _class,
                    pcurr: pagecurr
                },
                success: function (json) {
                    console.log(json);
                    var goodslist = json.pages.root;
                    if (!goodslist.length) {
                        setTimeout($.toast("已经没有啦"), 1500);
                        $.detachInfiniteScroll($('.infinite-scroll'));
                        // 删除加载提示符
                        $('.infinite-scroll-preloader').remove();
                        $('#bottom-nogoods').html('<div class="nogoods"> 别拉了，到底啦~</div>');
                        return;
                    } else {
                        var html = new Array();
                        for (var i = 0; i < goodslist.length; i++) {
                            var url = "<?php echo U('Home/Goods/getGoodsDetails');?>" + "&goodsId=" + goodslist[i].goodsId;
                            html.push('<li><div class="sell-goods"><a href="' + url + '"><img alt="" src="/' + goodslist[i].goodsThums + '"></a>' +
                                    '<p class="txt"><a href="#">' + goodslist[i].goodsName + '</a></p><div class="price">' +
                                    '<span class="pri"><em>' + goodslist[i].shopPrice + '</em></span></div><div class="vip-price"><p>' +
                                    '<em>￥</em>' + goodslist[i].vipPrice + '</p></div><a class="hei_si" href="' + url + '" style="display: block;">查看详情</a></div></li>');
                        }
                        html = html.join("");
                        $('#special-list').append(html);
                        if (json.length < 4) {
                            $.toast("已经没有啦");
                            // 加载完毕，则注销无限加载事件，以防不必要的加载
                            $.detachInfiniteScroll($('.infinite-scroll'));
                            // 删除加载提示符
                            $('.infinite-scroll-preloader').remove();
                            $('#bottom-nogoods').html('<div class="nogoods"> 别拉了，到底啦~</div>');
                            return;
                        }
                    }
                }
            });
        };
    });

    //    记住当前浏览位置，返回时回到当前浏览位置
    var c = 0;
    $(function () {
        var a = b = null;
        if (window.sessionStorage) {
            a = parseInt(sessionStorage.getItem("top"));
            b = parseInt(sessionStorage.getItem("size"));
            if (a) {
                $('.content').scrollTop(a);
            }
        }
    });
    $('.content').on('scroll', function () {
        var tops = $('.content').scrollTop(),
                height = $('.content').scrollTop(),
                scrollbottom = height - tops;
        if (window.sessionStorage) {
            sessionStorage.setItem("top", tops);
            sessionStorage.setItem("size", c);
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
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
	<?php if(empty($pages['root'])): ?><div class="content-padded" style="height: 100%;">
			<div class="develop" style="width: 100%; height: 100%; padding: 20% 0;">
				<p class="icon iconfont" style="width: 100%;text-align: center; font-size: 6rem;    color: #929292;">&#xe621;</p>
				<p style="width: 100%;text-align: center;color: #929292;">找不到您搜索的商品！</p>
			</div>
		</div>
	<?php else: ?>
	<div class="content page-home infinite-scroll page-searchlist" id='list-page' style="top: 2.2rem;">
		<!-- 这里是页面内容区 -->
		<div class="list">
			<ul id="search-list" class="list_sort_list collect_list">
					<?php if(is_array($pages['root'])): $key = 0; $__LIST__ = $pages['root'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$goods): $mod = ($key % 2 );++$key;?><li>
							<div>
								<a class="" href="<?php echo U('Home/Goods/getGoodsDetails/',array('goodsId'=>$goods['goodsId']));?>">
									<img alt="" src="/<?php echo ($goods['goodsThums']); ?>">
								</a>
								<p class="txt">
									<a href="#"><?php echo ($goods['goodsName']); ?></a>
								</p>
								<div class="price">
									<span class="pri">
			                        <em>￥<?php echo ($goods['shopPrice']); ?></em>
			                    </span>

								</div>
								<p class="hei_si" onclick='location.href="<?php echo U('Home/Goods/getGoodsDetails/',array('goodsId'=>$goods['goodsId']));?>"'>查看详情</p>
								<!--<p class="pl"><em>5人评价</em>，<em>好评率100%</em></p>-->
							</div>
						</li><?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
		</div>
		<!-- 加载提示符 -->
		<div class="infinite-scroll-preloader">
			<div class="preloader"></div>
		</div>
	</div><?php endif; ?>
</div>
<script>
	//goods上啦加载
	$(function() {
		var  searchType = JSON.parse("<?php echo $searchType; ?>");
		var  keyWords = "<?php echo $keyWords; ?>";
		var loading = false;
		var pagecurr = 1;
		var lastPage = 1;
		function addItems(type,pcurr) {
			$.ajax({
				url:'<?php echo U("Home/Goods/searchGoodsListlimit");?>',
				type:'get',
				data:{
					searchType:searchType,
					keyWords:keyWords,
					pcurr:pagecurr
				},
				success:function(json){
					console.log(json);
					var goodslist = json.pages.root;
					if(!goodslist.length){
						$.toast("已经没有啦");
						$.detachInfiniteScroll($('.infinite-scroll'));
						// 删除加载提示符
						$('.infinite-scroll-preloader').remove();
						return;
					}else{
						var html = new Array();
						for(var i =0;i<goodslist.length;i++){
							var url= "<?php echo U('Home/Goods/getGoodsDetails');?>" + "&goodsId=" + goodslist[i].goodsId;
							html.push('<li><div class="sell-goods"><a href="'+url+'"><img alt="" src="/'+goodslist[i].goodsThums+'"></a>' +
									'<p class="txt"><a href="#">' +goodslist[i].goodsName +'</a></p><div class="price">' +
									'<span class="pri"><em>'+goodslist[i].shopPrice+'</em></span></div><div class="vip-price"><p>' +
									'<em>￥</em>'+goodslist[i].vipPrice+'</p></div><a class="hei_si" href="'+url+'" style="display: block;">查看详情</a></div></li>');
						}
						html = html.join("");
						$('#search-list').append(html);
						if(json.length<4){
							$.toast("已经没有啦");
							$.detachInfiniteScroll($('.infinite-scroll'));
						}
					}
				}
			});
		}

		// 预先加载1页
//        addItems(pagecurr++);
		$(function(){
			$(document).on('infinite', '.page-searchlist',function() {
				// 如果正在加载，则退出
				if (loading) return;
				// 设置flag
				loading = true;
				// 模拟1s的加载过程
				setTimeout(function() {
					// 重置加载flag
					loading = false;
					// 添加新条目
					addItems(pagecurr++);
					//容器发生改变,如果是js滚动，需要刷新滚动
					$.refreshScroller();
				}, 200);
			});
		});
	});
	//    记住当前浏览位置，返回时回到当前浏览位置
	var c=0;
	$(function (){
		var a=b=null;
		if(window.sessionStorage){
			a=parseInt(sessionStorage.getItem("top4"));
			b=parseInt(sessionStorage.getItem("size4"));
			if(a){
				$('.content').scrollTop(a);
			}
		}
	});
	// 记住当前浏览位置并存储为session
	$('.content').on('scroll',  function () {
		var tops4=$('.content').scrollTop(),
				height4=$('.content').scrollTop(),
				scrollbottom=height4-tops4;
		if(window.sessionStorage){
			sessionStorage.setItem("top4",tops4);
			sessionStorage.setItem("size4",c);
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
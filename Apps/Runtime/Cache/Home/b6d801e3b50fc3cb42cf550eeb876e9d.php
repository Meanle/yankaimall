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


<style>
    .sender-box {
        padding: .2rem .7rem;
        font-size: .7rem;
    }
</style>
<div class="page">
    <div class="content" id="oders-entity">
        <div class="buttons-row">
            <a href="#tab1" class="tab-link button tab1 active">待付款</a>
            <a href="#tab2" class="tab-link button tab2">待发货</a>
            <a href="#tab3" class="tab-link button tab3">待收货</a>
            <a href="#tab4" class="tab-link button tab4 ">待评价</a>
            <a href="#tab5" class="tab-link button tab5">已完成</a>
        </div>
        <div class="tabs">
            <div id="tab1" class="tab active">
                <div class="content-block">
                </div>
            </div>
            <div id="tab2" class="tab">
                <div class="content-block">
                </div>
            </div>
            <div id="tab3" class="tab">
                <div class="content-block">
                </div>
            </div>
            <div id="tab4" class="tab">
                <div class="content-block">
                </div>
            </div>
            <div id="tab5" class="tab">
                <div class="content-block">
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    //    ajax获取对应数据并生成html
    function tabgetAjax(url,tnum){
        $.ajax({
            url: url,
            type: 'get',
            success: function (json) {
                var total = json.root;
                var num = 0;
                var html = new Array();
                var htmls = '';
                for (var i = 0; i < total.length; i++) {
                    if(total[i]['goodslist'][0]['catName'] != '咖啡馆'){
                        num++;
                        html.push('<div class="content-block" style="margin-bottom: .5rem"><div class="list-block list-num"><div class="list-block list-num"><ul><li class="item-content"><div class="item-media">' +
                                '<i class="icon icon-f7"></i></div><div class="item-inner"><div class="item-title"><span class="ctitlenum"><span>订单编号:</span>' + total[i].orderNo + '</span><span class="ctitlenum"><span>下单时间:</span>' + total[i].createTime + '</span>' +
                                '</div></div>' +
                                '</div></li></ul></div>');
                        for(var j=0;j<total[i].goodslist.length;j++){
                            html.push('<div class="list-block media-list"><ul><li>');
                            if(total[i].goodslist[j].catName == "咖啡馆"){
                                html.push('<a href="<?php echo U('Home/Goods/getCoffeeGoodsDetails/');?>&goodsId='+ total[i].goodslist[j].goodsId+'" class="item-content">');
                            }else {
                                html.push('<a href="<?php echo U('Home/Goods/getGoodsDetails/');?>&goodsId='+ total[i].goodslist[j].goodsId+'" class="item-content">');
                            }
                            html.push('<div class="item-media">' +
                                    '<img src="' + total[i].goodslist[j].goodsThums + '" width="80"></div><div class="item-inner"><div class="item-title-row"><div class="item-title">' +
                                    '</div><div class="item-after"><span class="coffee-price order-goods-name">' + total[i].goodslist[j].goodsName + '</span>' +
                                    '</div></div></div></a></li></ul></div>');
                        }
                        html.push('<div class="list-block list-num"><ul><li class="item-content"><div class="item-media"><i class="icon icon-f7"></i></div>' +
                                '<div class="item-inner"><div class="item-title">');
                        switch (parseInt(total[i].orderStatus)){
                            case -3:
                                html.push('<span>订单状态：</span><span>已拒收</span></div><div class="item-after go-check"><a onclick="showOrder('+ total[i].orderId +')">查看</a>');
                                break;
                            case -2:
                                html.push('<span>订单金额：</span><span style="color: #e4393c;">￥'+ total[i].totalMoney +'</span></div><div class="item-after go-check"><a onclick="orderCancel('+ total[i].orderId +',3)">取消</a></div>' +
                                        '<div class="item-after go-check"><a onclick="toPay('+ total[i].orderId +')">去付款</a>');
                                break;
                            case -1:
                                html.push('<span>订单状态：</span><span>已取消</span></div><div class="item-after go-check"><a onclick="showOrder('+ total[i].orderId +')">查看</a>');
                                break;
                            case 0:
                                html.push('<span>订单状态：</span><span>未受理</span></div><div class="item-after go-check"><a onclick="showOrder('+ total[i].orderId +')">查看</a>');
                                break;
                            case 1:
                                html.push('<span>订单状态：</span><span>已受理</span></div><div class="item-after go-check"><a onclick="showOrder('+ total[i].orderId +')">查看</a>');
                                break;
                            case 2:
                                html.push('<span>订单状态：</span><span>打包中</span></div><div class="item-after go-check"><a onclick="showOrder('+ total[i].orderId +')">查看</a>');
                                break;
                            case 3:
                                html.push('<span>订单状态：</span><span>配送中</span></div><div class="item-after go-check"><a onclick="orderConfirm('+ total[i].orderId +',1)">确认收货</a>');
                                if(total[i].senderName != 'undefined' && total[i].senderPhone != 'undefined') {
                                    htmls = '<li>'
                                            +'<div class="sender-box">'
                                            +'<span>配送员:</span><span style="float: right;">'+total[i].senderName+'</span><br>'
                                            +'</div>'
                                            +'<div class="sender-box">'
                                            +'<span>联系电话:</span><span style="float: right;">'+total[i].senderPhone+'</span>'
                                            +'</div>'
                                            +'</li>';
                                }
                                break;
                            case 4:
                                if(total[i].isAppraises == 1){
                                    html.push('<span>订单状态：</span><span>已完成</span></div><div class="item-after go-check"><a onclick="showOrder('+ total[i].orderId +')">查看</a>');
                                }else{
                                    html.push('<span>订单状态：</span><span>已到货</span></div><div class="item-after go-check"><a onclick="appraiseOrder('+ total[i].orderId +')">去评价</a>');
                                }
                                break;
                            case 5:
                                html.push('<span>订单状态：</span><span>确认收货</span></div><div class="item-after go-check"><a onclick="showOrder('+ total[i].orderId +')">查看</a>');
                                break;

                        }
                        html.push('</div></div></li><li>'+htmls+'</li></ul></div></div>');
                    }
                }
                if (num == 0) {
                    html.push('<div class="page-cart"><i class="gwc_ic"></i><p class="p1">还没有相关订单~</p>' +
                            '<a class="gwc_btn1" href="/index.php?m=Home&c=Index&a=index">去逛逛</a></div>');
                }
                html = html.join("");
                var id ='#tab'+ tnum;
                $(id).html(html);
            }
        });
    };
    var urlone = '<?php echo U("Home/Orders/queryEntityByPage");?>';
    var urltwo = '<?php echo U("Home/Orders/queryDeliveryByPage");?>';
    var urlthree = '<?php echo U("Home/Orders/queryReceiveByPage");?>';
    var urlfour = '<?php echo U("Home/Orders/queryAppraiseByPage");?>';
    var urlfive = '<?php echo U("Home/Orders/queryCompleteOrders");?>';
    //    进入订单页面判断执行ajax获取相应的数据
    $(function(){
        $(".tab-link").each(function(index, value) {
            if($(this).hasClass("active")){
                var tnum = index+1;
                switch (tnum){
                    case 1:
                        tabgetAjax(urlone,tnum);
                        break;
                    case 2:
                        tabgetAjax(urltwo,tnum);
                        break;
                    case 3:
                        tabgetAjax(urlthree,tnum);
                        break;
                    case 4:
                        tabgetAjax(urlfour,tnum);
                        break;
                }
            }
        })
    });
    //    点击tab按钮获取相对应数据
    $(".tab1").click(function tabOne() {
        tabgetAjax(urlone,1);
    })
    $(".tab2").click(function tabTwo() {
        tabgetAjax(urltwo,2);
    });
    $(".tab3").click(function tabThree() {
        tabgetAjax(urlthree,3);
    });
    $(".tab4").click(function tabFour() {
        tabgetAjax(urlfour,4);
    });
    $(".tab5").click(function tabFive() {
        tabgetAjax(urlfive,5);
    });
    //去支付ajax请求
    function toPay(id){
        var params = {};
        params.orderId = id;
        $.ajax({
            url: '<?php echo U("Home/Orders/checkOrderPay");?>',
            type: 'post',
            data: params,
            success: function (json) {
                if(json.status==1){
                    location.href= "<?php echo U('Home/Payments/toPay');?>"+'&orderId='+params.orderId;
                }else if(json.status==-2){
                    var rlist = json.rlist;
                    var garr = new Array();
                    for(var i=0;i<rlist.length;i++){
                        garr.push(rlist[i].goodsName+rlist[i].goodsAttrName);
                    }
                    $.toast('订单中商品【'+garr.join("，")+'】库存不足，不能进行支付。', {icon: 5});
                }else{
                    $.toast('您的订单已支付!', {icon: 5});
                    setTimeout(function(){
                        location.href = '<?php echo U("Home/Orders/queryDeliveryByPage");?>';
                    },1500);
                }
            }
        });
    }
    //  确认收货
    function orderConfirm(id,type){
        if(type==1){
            $.confirm('您确定收货吗?',
                    function () {
                        $.toast('数据处理中，请稍候...');
                        $.ajax({
                            url: '<?php echo U("Home/Orders/orderConfirm");?>',
                            type: 'post',
                            data: {orderId:id,type:type},
                            success: function (data) {
                                if(data.status>0){
                                    $.toast('确认收货成功');
                                    location.reload();
                                }else if(data.status==-1){
                                    $.toast('操作失败，订单状态已发生改变，请刷新后再重试 !');
                                }else{
                                    $.toast('操作失败，请与商城管理员联系 !');
                                }
                            }
                        });
                    }
            );
        }
    }
    //去评价页面跳转
    function appraiseOrder(id){
        var id = id;
        location.href = '<?php echo U("Home/GoodsAppraises/toAppraises");?>'+'&orderId='+id;
    }
    //查看订单详情
    function showOrder(id){
        var id = id;
        location.href = '<?php echo U("Home/Orders/getOrderDetails");?>'+'&orderId='+id;
    }
    //取消订单
    function orderCancel(id,type){
        if(type==3){
            $.confirm('您确定取消该订单吗?',
                    function () {
                        $.toast('数据处理中，请稍候...');
                        $.ajax({
                            url: '<?php echo U("Home/Orders/orderCancel");?>',
                            type: 'post',
                            data: {orderId:id},
                            success: function (data) {
                                if(data.status>0){
                                    $.toast('取消订单成功');
                                    location.reload();
                                }else if(data.status==-1){
                                    $.toast('操作失败，请刷新后再重试 !');
                                }else{
                                    $.toast('操作失败，请与商城管理员联系 !');
                                }
                            }
                        });
                    }
            );
        }else {
            $.toast('该订单无法取消...');
        }
    }

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
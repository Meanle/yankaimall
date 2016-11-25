<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE>
<html lang="zh-cn">
<head>
	<meta name="viewport" content="initial-scale=1, maximum-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>前去支付</title>
	<meta name="keywords" content="<?php echo ($CONF['mallKeywords']); ?>,在线支付" />
	<meta name="description" content="<?php echo ($CONF['mallDesc']); ?>,在线支付" />
	<link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm.min.css">
	<link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm-extend.min.css">
	<link rel="stylesheet" href="/Apps/Home/View/default/css/iconfont.css"/>
	<link rel="stylesheet" href="/Apps/Home/View/default/css/common.css" />
	<link rel="stylesheet" href="/Apps/Home/View/default/css/ordersuccess.css" />
	<link rel="stylesheet" href="/Apps/Home/View/default/css/base.css" />
	<link rel="stylesheet" href="/Apps/Home/View/default/css/head.css" />
	<link rel="stylesheet" href="/Apps/Home/View/default/css/pslocation.css" />
	<link rel="stylesheet" href="/Apps/Home/View/default/css/magnifier.css" />
	<style type="text/css">

	</style>
</head>
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
<body class="root61">
	<div class="w" style="width: 100%;">
		<div>
			<div class="wst-ods-success-tb">
				<form autocomplete="off" method="get">
					<div class="wst-ods-success-tc"  style="background-color: #F8F8F8;">
						<div class="wst-ods-success-td">
							<?php if(count($orderInfos) > 0): ?><img src="/Apps/Home/View/default/images/icon-succ.png" alt="" /><?php endif; ?>
						</div>
						<div class="wst-ods-success-tf" style="width: inherit;">
							<div class="wst-ods-success-l25">
								<input type="hidden" id="orderId" name="orderId" value="<?php echo ($orderId); ?>"/>
								<input type="hidden" id="payCode" name="payCode" value="<?php echo ($payCode); ?>"/>
								<input type="hidden" id="needPay" name="needPay" value="<?php echo ($needPay); ?>"/>
								<?php if(count($orders) > 0): ?><div class="wst-ods-success-tg">您的订单已提交成功，请尽快支付！</div>
								<div >共<?php echo ($orderCnt); ?>张订单 <!--<span id="wst-order-details" style="color:#1D94D7;cursor:pointer;">订单详情</span>。--> </div>
								<div id="wst-orders-box" style="margin-left: 75px;display:none;">
									<?php if(is_array($orders)): $i = 0; $__LIST__ = $orders;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$order): $mod = ($i % 2 );++$i;?><div>订单：<?php echo ($key); ?></div>
									    <?php if(is_array($order)): $i = 0; $__LIST__ = $order;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$goods): $mod = ($i % 2 );++$i;?><div><?php echo ($goods["goodsName"]); ?>&nbsp;&nbsp;<?php echo ($goods["goodsAttrName"]); ?></div><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
								</div>
								 待付金额：<span class="wst-ods-success-ti">￥<?php echo ($needPay); ?></span> 元
								 <div style="display: none;">
								 	<div style="float:left;">支付方式：</div>
								 	<div style="float:left;">
								 	<?php if(is_array($payments)): $i = 0; $__LIST__ = $payments;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$payment): $mod = ($i % 2 );++$i; if($payment['isOnline'] == 1): ?><div class="wst-payCode" data="<?php echo ($payment['payCode']); ?>"><img src="/<?php echo ($payment['payIcon']); ?>" width="100" height="28"/></div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                                	<div class="wst-clear"></div>
								 	</div>
								 	<div class="wst-clear"></div>
								 </div>
								 <div style="height:50px;line-height:50px;margin-top: 15px;">
									<input type="button" onclick="getPayUrl();" style="border-radius: .2rem;background: #0894ec;border: 1px solid #0894ec;color: #fff; width:100%;height:35px;font-size:16px;" value="前往支付"/>
								 </div>
	   							<?php else: ?>
	   								<div class="wst-ods-success-tj">
	   								您的订单已支付!
									</div><?php endif; ?>
	   						</div>							
						</div>
						<div class="wst-clear"></div>
					</div>					
					</form>
					<!--<div class="wst-clear"></div>
					<div class="wst-ods-success-tk">
						<div id="checkout" class="wst-checkout" >
							<a class="btn-submit" href="/index.php">
								<span id="saveConsigneeTitleDiv" class="wst_btn-continue"></span>
							</a>
							<div class="wst-clear"></div>
						</div>
					</div>-->
				</div>							
			</div>			
		</div>
	
	<div class="wst-clear"></div>
    <div style="height: 20px;"></div>
	<script src="/Public/js/common.js"></script>
	<script src="/Public/plugins/layer/layer.min.js"></script>
  	<script src="/Apps/Home/View/default/js/index.js"></script>      	
 	<script src="/Apps/Home/View/default/js/common.js"></script>
	<script src="/Apps/Home/View/default/js/orders.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		if($(".wst-payCode")[0])$(".wst-payCode")[0].click();
	});

	</script>
</body>
</html>
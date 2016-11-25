<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE>
<html lang="zh-cn">
<head>
	<meta name="viewport" content="initial-scale=1, maximum-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>支付成功</title>
	<meta name="keywords" content="<?php echo ($CONF['mallKeywords']); ?>,支付成功" />
	<meta name="description" content="<?php echo ($CONF['mallDesc']); ?>,支付成功" />
	<link rel="stylesheet" href="/Apps/Home/View/default/css/common.css" />
	<link rel="stylesheet" href="/Apps/Home/View/default/css/ordersuccess.css" />
	<link rel="stylesheet" href="/Apps/Home/View/default/css/base.css" />
	<link rel="stylesheet" href="/Apps/Home/View/default/css/head.css" />
	<link rel="stylesheet" href="/Apps/Home/View/default/css/pslocation.css" />
	<link rel="stylesheet" href="/Apps/Home/View/default/css/magnifier.css" />
</head>

<body class="root61">
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

	<div class="w"  style="width: 100%; margin: 0;">
			<div class="wst-ods-success-tb">
				<div class="wst-ods-success-tc" style="height: 40%;">
					<div class="wst-ods-success-td">
						<img src="/Apps/Home/View/default/images/icon-succ.png" alt="" />
					</div>
					<div class="wst-ods-success-tf"  style="width: inherit;">
						<div class="wst-ods-success-l25">
							<span class="wst-ods-success-tg">您的订单已支付成功！</span>
						</div>
					</div>
					<div class="wst-clear"></div>
				</div>

				<div class="wst-clear"></div>
				<br/>
				<div class="cart-button clearfix">
				<li style="width: 65%;height: 4rem;line-height: 4rem;background: #0894ec;color: #fff;border-radius: .2rem; text-align: center; margin: 0 auto;" onclick="javascript:toContinue();">继续购物</li>
				<div class="wst-clear"></div>
			</div>

				<!--<div class="wst-ods-success-tk">
					<div id="checkout" class="wst-checkout" >
						<a class="btn-submit" href="/index.php">
							<span id="saveConsigneeTitleDiv" class="wst_btn-continue"></span>
						</a>
						<div class="wst-clear"></div>
					</div>
				</div>-->
			</div>
		</div>
	
	<div class="wst-clear"></div>
    <div style="height: 20px;"></div>
    

	<script src="/Public/js/common.js"></script>
  	<script src="/Apps/Home/View/default/js/index.js"></script>      	
 	<script src="/Apps/Home/View/default/js/common.js"></script>
 	<script src="/Apps/Home/View/default/js/orders.js"></script>
 	<script>
 		function toContinue(){
			location.href= WST.DOMAIN;
		}	
 	</script>
</body>
</html>
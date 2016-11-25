<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>卖家登录 - <?php echo ($CONF['mallTitle']); ?></title>
		<meta name="keywords" content="<?php echo ($CONF['mallKeywords']); ?>" />
		<meta name="description" content="<?php echo ($CONF['mallDesc']); ?>,卖家登录" />
		<link rel="stylesheet" href="/Apps/Home/View/default/css/app.css" />
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
		<div class="lg-container">
			<section class="st-panel st-bg" id="st-panel-6">
				<div class="login-form">
					<h2 style="margin-bottom: 1rem;">雁凯跨境生活馆</h2>
					<div id="login-form">
						<input id="username" name="txtuser" type="text" class="text" placeholder="用户名">
						<input id="password" name="txtpwd" type="password" placeholder="密码">
						<div class="item-input input-define sell-login">
							<input id="verify" type="text" placeholder="请输入验证码">
							<label class="img">
								<img style='vertical-align:middle;cursor:pointer;width: 100%;border-radius: 3rem;'
									 class='verifyImg'
									 src='/Apps/Home/View/default/images/clickForVerify.png'
									 title='刷新验证码' alt="点击刷新验证码" onclick='getVerify()'/>
							</label>
						</div>
						<button id="loginbtn" type="submit" onclick="login();">登录</button>
						<p><a href="##">忘记密码?</a></p>
						<div id="wrong">
						</div>
					</div>
				</div>
			</section>
		</div>
		<script src="/Public/js/common.js"></script>
		<script src="/Apps/Home/View/default/sell/js/common.js"></script>
		<script src="/Apps/Home/View/default/sell/js/shoplogin.js"></script>
	</body>
</html>
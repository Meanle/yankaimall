<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="shortcut icon" href="favicon.ico"/>
  		<title>卖家中心 - <?php echo ($meta_title); ?></title>
  		<meta name="keywords" content="<?php echo ($CONF['mallKeywords']); ?>" />
      	<meta name="description" content="<?php echo ($CONF['mallDesc']); ?>,卖家中心" />
  		<meta http-equiv="Expires" content="0">
		<meta http-equiv="Pragma" content="no-cache">
		<meta http-equiv="Cache-control" content="no-cache">
		<meta http-equiv="Cache" content="no-cache">
  		<link rel="stylesheet" href="/Apps/Home/View/default/css/common.css" />
    	<link rel="stylesheet" href="/Apps/Home/View/default/css/shop.css">
    	<link rel="stylesheet" type="text/css" href="/Public/plugins/webuploader/webuploader.css" />

		<style>
			.laypage_curr{background-color:#0894ec !important; color:#fff;}
		</style>
		<?php echo WSTLoginTarget(1);?>
    </head>
    <body>
        <div class="wst-wrap">
          <div class='wst-header'>
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
			<div class="wst-clear;"></div>
		</div>
			<a style="display: none" class="" href="http://www.wstmall.net">Powered&nbsp;By&nbsp;<strong><span style="color: #3366FF;">WSTMall</span></strong></a>
          <div class='wst-nav'></div>
          <div class='wst-main'>
            <div class='wst-menu'>
				<div class="wst-nav-box">
					<li class="liselect"  style="float:left;">
						<p onclick="goSindex()" style='color:#FFFFFF; margin-top: 5px;'>我是卖家</p>
						<div class="user-name">
							<img onclick="goSindex()" class='lazyImg' src="/<?php echo session('shopInfo')['shop']['shopImg'];?>" data-original="/<?php echo session('shopInfo')['shop']['shopImg'];?>" height="120" width="120" />
							<p class="greet">您好,&nbsp;&nbsp;<span><?php echo ($WST_USER['userName']?$WST_USER['userName']:$WST_USER['loginName']); ?></span><br>
								<!--<?php if($shopInfo['shop']['shopName'] ==''): ?>-->
										<!--<span>您还不是卖家</span><br>-->
									<!--<?php else: ?>-->
									<!--<span><?php echo ($WST_USER['userName']?$WST_USER['userName']:$WST_USER['loginName']); ?></span><br>-->
								<!--<?php endif; ?>-->
								<span>欢迎来到雁凯生活馆</span><br>
								<span class="outname" onclick="logout()">退出</span>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span onclick="cleanCache()">清除缓存</span>
							</p>
						</div>
					</li>
					<div class="wst-clear"></div>
				</div>
            	<span class='wst-menu-title'><span></span>交易管理</span>
            	<ul>
              	<li onclick="goBack(this)" data='<?php echo U("Home/Orders/toShopOrdersList");?>' <?php if($umark == "toShopOrdersList"): ?>class='liselect'<?php endif; ?>>订单管理<span id="wst_orders_cnt" style="display:none;" class="wst-msg-tips-box"></span></li>
            	<li onclick="goBack(this)" data="<?php echo U('Home/OrderComplains/queryShopComplainByPage');?>" <?php if($umark == "queryShopComplainByPage"): ?>class='liselect'<?php endif; ?>>投诉订单</li>
            	<li onclick="goBack(this)" data="<?php echo U('Home/OrderSettlements/toSettlementIndex');?>" <?php if($umark == "toSettlementIndex"): ?>class='liselect'<?php endif; ?>>订单结算</li>
				<li onclick="goBack(this)" data="<?php echo U('Home/Users/checkingVip');?>" <?php if($umark == "toSettlementIndex"): ?>class='liselect'<?php endif; ?>>会员验证</li>
            	</ul>
            	<span class='wst-menu-title'><span></span>商品管理</span>
            	<ul>
               	<li onclick="goBack(this)" data="<?php echo U('Home/ShopsCats/index');?>" <?php if($umark == "index"): ?>class='liselect'<?php endif; ?>>店铺分类</li>
              	<li onclick="goBack(this)" data="<?php echo U('Home/Goods/queryOnSaleByPage');?>" <?php if($umark == "queryOnSaleByPage"): ?>class='liselect'<?php endif; ?>>出售中的商品</li>
               	<li onclick="goBack(this)" data="<?php echo U('Home/Goods/queryUnSaleByPage');?>" <?php if($umark == "queryUnSaleByPage"): ?>class='liselect'<?php endif; ?>>仓库中的商品</li>
					<li onclick="goBack(this)" data="<?php echo U('Home/Goods/queryPenddingByPage');?>" <?php if($umark == "queryPenddingByPage"): ?>class='liselect'<?php endif; ?>>待审核商品</li>
               	<li onclick="goBack(this)" data="<?php echo U('Home/Goods/toEdit/',array('umark'=>'toEditGoods'));?>" <?php if($umark == "toEditGoods"): ?>class='liselect'<?php endif; ?>>新增商品</li>
               	<li onclick="goBack(this)" data="<?php echo U('Home/GoodsAppraises/index');?>" <?php if($umark == "GoodsAppraises"): ?>class='liselect'<?php endif; ?>>查看评价</li>

               	<li onclick="goBack(this)" data="<?php echo U('Home/AttributeCats/index');?>" <?php if($umark == "AttributeCats"): ?>class='liselect'<?php endif; ?>>商品类型</li>
               	<li onclick="goBack(this)" data="<?php echo U('Home/Imports/index');?>" <?php if($umark == "Imports"): ?>class='liselect'<?php endif; ?>>数据导入</li>
				</ul>
              	<span class='wst-menu-title'><span></span>网店设置</span>
              	<ul>
            	<li onclick="goBack(this)" data="<?php echo U('Home/Shops/toEdit/');?>" <?php if($umark == "toEdit"): ?>class='liselect'<?php endif; ?>>店铺资料</li>
              	<li onclick="goBack(this)" data="<?php echo U('Home/Shops/toShopCfg/');?>" <?php if($umark == "setShop"): ?>class='liselect'<?php endif; ?>>店铺设置</li>
              	<li onclick="goBack(this)" data="<?php echo U('Home/Messages/queryByPage/');?>" id='li_queryMessageByPage' <?php if($umark == "queryMessageByPage"): ?>class='liselect'<?php endif; ?>>商城消息<span style="display:none;" class="wst-msg-tips-box"></span></li>
              	<li onclick="goBack(this)" data="<?php echo U('Home/Shops/toEditPass');?>" <?php if($umark == "toEditPass"): ?>class='liselect'<?php endif; ?>>修改密码</li>
           		</ul>
            </div>
            <div class='wst-content'>
            
<div>
	<div class='wst-page-header'>
		卖家中心&nbsp;>&nbsp;帐户概览
	</div>
	<div style="height:158px;">
		<table style="width:800px;margin-top:25px;">
			<tbody>
				<tr>
					<td width="140">
						<div class='wst-shophome-img'>
							<a target="_blank" href="<?php echo U('Home/Shops/toShopHome/',array('shopId'=>$shopInfo['shop']['shopId']));?>">
								<img class='lazyImg' data-original="/<?php echo ($shopInfo['shop']['shopImg']); ?>" height="120" width="120" />
							</a>
						</div>
					</td>
					<td style="vertical-align:top;line-height:25px;">
						<div style="font-weight:bolder;"><?php echo ($shopInfo['shop']['shopName']); ?></div>
						<div style="">店铺名称：<a target="_blank" href="<?php echo U('Home/Shops/toShopHome/',array('shopId'=>$shopInfo['shop']['shopId']));?>"><span style="color:#55AAFF"><?php echo ($shopInfo['shop']['shopName']); ?></a></span></div>
						<div style="">店铺状态：
						<?php if($shopInfo['shop']['shopStatus'] == 1): if(($shopInfo['shop']['shopAtive'] == 1) and ($shopInfo['shop']['shopStatus'] == 1)): ?>营业中，
							<?php else: ?>
								休息中，<?php endif; endif; ?>
						<?php if($shopInfo['shop']['shopStatus'] == 1): ?>已审核
						<?php elseif($shopInfo['shop']['shopStatus'] == -2): ?>
							已停止
						<?php elseif($shopInfo['shop']['shopStatus'] == -1): ?>
							已拒绝
						<?php elseif($shopInfo['shop']['shopStatus'] == 0): ?>
							待审核<?php endif; ?>
						</div>
					</td>
					<td width="280" style="vertical-align:top;line-height:25px;">
						<div style="font-weight:bolder;">店铺动态评分</div>
						<div style="">商品描述:
							<?php $__FOR_START_460452225__=0;$__FOR_END_460452225__=$shopInfo['details']['goodsScore'];for($i=$__FOR_START_460452225__;$i < $__FOR_END_460452225__;$i+=1){ ?><img src="/Apps/Home/View/default/images/icon_score_yes.png"/><?php } ?>
							<?php echo ($shopInfo['details']['goodsScore']); ?>分
						</div>
						<div style="">时效评分:
							<?php $__FOR_START_1575118011__=0;$__FOR_END_1575118011__=$shopInfo['details']['timeScore'];for($i=$__FOR_START_1575118011__;$i < $__FOR_END_1575118011__;$i+=1){ ?><img src="/Apps/Home/View/default/images/icon_score_yes.png"/><?php } ?>
							<?php echo ($shopInfo['details']['timeScore']); ?>分
						</div>
						<div style="">服务评分:
							<?php $__FOR_START_493919695__=0;$__FOR_END_493919695__=$shopInfo['details']['serviceScore'];for($i=$__FOR_START_493919695__;$i < $__FOR_END_493919695__;$i+=1){ ?><img src="/Apps/Home/View/default/images/icon_score_yes.png"/><?php } ?>
							<?php echo ($shopInfo['details']['serviceScore']); ?>分
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	
	<div class='wst-shophome-area'>
		<div class='wst-shophome-nav'>
			<div class='header'>
				店铺提示
			</div>
			<div class='main'>
				<div style="font-weight:bolder;">您需要关注的店铺情况：</div>
				<div style="color:#55AAFF;">
					商品提示：
					<span>待审核商品（<span style="color:red;"><?php echo (intval($shopInfo['details']['waitGoodsCnt'])); ?></span>）</span>&nbsp;&nbsp;&nbsp;&nbsp;
					<span>仓库中商品（<span style="color:red;"><?php echo (intval($shopInfo['details']['waitSaleGoodsCnt'])); ?></span>）</span>&nbsp;&nbsp;&nbsp;&nbsp;
					<span>买家评价（<span style="color:red;"><?php echo (intval($shopInfo['details']['appraisesCnt'])); ?></span>）</span>
				</div>
			</div>
			<div class='current' >出售中的商品（<?php echo (intval($shopInfo['details']['onSaleGoodsCnt'])); ?>）&nbsp;&nbsp;&nbsp;&nbsp;<!-- 淘宝数据导入 --></div>
			<div class='header'>
				交易提示
			</div>
			<div class='main'>
				<div style="font-weight:bolder;">您需要立即处理的交易订单：</div>
				<div style="color:#55AAFF;">
					订单提示：
					<span>待受理订单（<span style="color:red;"><?php echo (intval($shopInfo['details']['waitHandleOrderCnt'])); ?></span>）</span>&nbsp;&nbsp;&nbsp;&nbsp;
					<span>待发货订单（<span style="color:red;"><?php echo (intval($shopInfo['details']['waitSendOrderCnt'])); ?></span>）</span>&nbsp;&nbsp;&nbsp;&nbsp;
					<span>待结束订单（<span style="color:red;"><?php echo (intval($shopInfo['details']['appraisesOrderCnt'])); ?></span>）</span>
				</div>
			</div>
			<div class='current'>周订单量（<?php echo (intval($shopInfo['details']['weekOrderCnt'])); ?>）&nbsp;&nbsp;&nbsp;&nbsp;周交易金额（<?php echo (intval($shopInfo['details']['weekOrderMoney'])); ?>）&nbsp;&nbsp;&nbsp;&nbsp;一个月订单量（<?php echo (intval($shopInfo['details']['monthOrderCnt'])); ?>）&nbsp;&nbsp;&nbsp;&nbsp;一个月交易金额（<?php echo (intval($shopInfo['details']['monthOrderMoney'])); ?>）&nbsp;&nbsp;&nbsp;&nbsp;</div>
			
			<div class='header' style='display:none'>
				支付帐号
			</div>
			<div class='main' style='display:none'>
				<div style="float:left;width:100px;height:100px;">
					<img class='lazyImg' data-original="" width="100" height="100"/>
				</div>
				<div style="float:left;width:400px;height:100px;padding-left:10px;">
					您的帐户余额：43349元<br/>
					<button style="width:80px;height:30px;background-color:#e23e3d;color:#ffffff;border:1px solid #ffffff;">帐户充值</button><br/>
					<div style="color:#55AAFF;">
						<span>支付帐号</span>&nbsp;&nbsp;&nbsp;&nbsp;<span>提现</span>&nbsp;&nbsp;&nbsp;&nbsp;<span>出入明细</span>&nbsp;&nbsp;&nbsp;&nbsp;
					</div>
				</div>
				<div class="wst-clear"></div>
			</div>
			
		</div>
		
		<div style="width:192px;float:left;min-height:400px;border-left:1px solid #cccccc;">
			<div style="height:36px;line-height:36px;font-weight:bolder;padding-left:10px;">
				平台联系方式
			</div>
			<div style="padding-left:10px;line-height:26px;">
				<div>电话：<?php echo ($shopInfo['shop']['userPhone']); ?></div>
				<div>邮箱：<?php echo ($shopInfo['shop']['userEmail']); ?></div>
				<div>服务时间：<?php echo ($shopInfo['shop']['serviceStartTime']); ?>-<?php echo ($shopInfo['shop']['serviceEndTime']); ?></div>
			</div>
		</div>
		<div class="wst-clear"></div>
	</div>
</div>

            </div>
          </div>
          <div style='clear:both;'></div>
          <br/>
          <div class='wst-footer'>
          	<div class="wst-footer-hp-box">
	<div class="wst-footer">
		<div class="wst-footer-hp-ck2">
			<div class="copyright">
				Copyright©2015 Powered By <a target="_blank" href="http://www.slarker.com">Slarker.com</a>
			</div>
		</div>
	</div>
</div>

          </div>
        </div>
        <object id="player" height="360" width="300" classid="CLSID:6BF52A52-394A-11d3-B153-00C04F79FAA6" style="display:none;"> 
			<param name="AUTOSTART" value="0"/>
			<param name="SHUFFLE" value="0"/>
			<param name="PREFETCH" value="0"/>
			<param name="NOLABELS" value="0"/>
			<param name="url" value=""/>
			<param name="CONTROLS" value="ImageWindow"/>
			<param name="CONSOLE" value="Clip1"/>
			<param name="LOOP" value="0"/>
			<param name="NUMLOOP" value="0"/>
			<param name="CENTER" value="0"/>
			<param name="MAINTAINASPECT" value="0"/>
			<param name="BACKGROUNDCOLOR" value="#000000"/>
		</object>
    </body>
	<script src="/Public/plugins/formValidator/formValidator-4.1.3.js"></script>
	<script src="/Public/js/common.js"></script>
	<script src="/Apps/Home/View/default/js/shopcom.js"></script>
	<script src="/Apps/Home/View/default/js/head.js"></script>
	<script src="/Apps/Home/View/default/js/common.js"></script>
	<script src="/Public/plugins/layer/layer.min.js"></script>
	<script src="/Apps/Home/View/default/js/audio.js"></script>
	<script src="/Public/plugins/bootstrap/js/bootstrap.min.js"></script>
	<script src="/Public/plugins/plugins/plugins.js"></script>
	<script type="text/javascript" src="/Apps/Home/View/default/js/goodsbatchupload.js"></script>
	<script type="text/javascript" src="/Public/plugins/webuploader/webuploader.js"></script>
<script>
	$(".liselect");
	function goSindex(){
		window.location.href = Think.U('Home/Shops/index');
	}
	function cleanCache(){
		$.post("<?php echo U('Home/Index/cleanAllCache');?>",{},function(data,textStatus){
			var json = WST.toJson(data);
			if(json.status==1) {
				WST.msg('缓存清除成功');
			};
		});
	}

</script>
</html>
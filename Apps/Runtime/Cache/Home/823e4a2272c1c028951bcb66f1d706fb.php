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
            
	<script>
	var statusMark = 0;
	$(function () {
		$('#tab').TabPanel({tab:statusMark,callback:function(tab){
			statusMark = tab;
			queryOrderPager(statusMark,0);
		}});
	});
	</script>
	<div class="wst-body" style="margin-bottom: 8px;">
		<div class='wst-page-header'>卖家中心 > 订单管理</div>
		<div class='wst-page-content' style="padding-top:10px;">
		   <div id='tab' class="wst-tab-box">
			<ul class="wst-tab-nav">
				<li id="wst-msg-li-0">待受理订单<span style="display:none;" class="wst-order-tips-box"></span></li>
				<li id="wst-msg-li-1">已受理订单<span style="display:none;"></span></li>
				<li id="wst-msg-li-2">打包中订单<span style="display:none;"></span></li>
				<li id="wst-msg-li-3">配送中订单<span style="display:none;"></span></li>
				<li id="wst-msg-li-4">已到货订单<span style="display:none;" class="wst-order-tips-box"></span></li>
				<li id="wst-msg-li-5">取消 / 拒收订单<span style="display:none;" class="wst-order-tips-box"></span></li>
                <li id="wst-msg-li-6">价格查询<span style="display:none;" class="wst-order-tips-box"></span></li>
			</ul>
			<div class="wst-tab-content" style='width:98%;'>
			    <!-- 待受理 -->
				<div class='wst-tab-item'>
					<div>
						<table class='wst-list' style="font-size:13px;">
							<thead>
								<tr>
									<th colspan="8" class="wst-form">
									订单号：<input type="text" id="orderNo_0" style='width:120px;' autocomplete="off"/>
									收货人：<input type="text" id="userName_0" style='width:120px;' autocomplete="off"/>
									收货地址：<input type="text" id="userAddress_0" style='width:120px;' autocomplete="off"/>
                                        <button class='wst-btn-query' onclick="queryOrderPager(0,0)">查询</button>
									<button class='wst-btn-query' style='width:80px;' onclick="batchShopOrderAccept()">批量受理</button>
									</th>
								</tr>
								<tr>
								    <th width='20'><input type='checkbox' onclick='WST.checkChks(this,".chk_0")'/></th>
									<th width='100'>订单号</th>
									<th width='100'>收货人</th>
									<th width='200'>收货地址</th>
									<th width='70'>订单金额</th>
									<th width='70'>实付金额</th>
									<th width='130'>下单时间</th>
									<th width='100'>操作</th>
								</tr>
							</thead>
							<tbody id="otbody0">
							</tbody>
							<tfoot>
								<tr>
									<td colspan='8' align='center' id="opage_0">
										<div id="wst-page-0" class='wst-page' style="float:right;padding-bottom:10px;"></div>
									</td>
								</tr>
							 </tfoot>
						</table>
					</div>
					<div style='clear:both;'></div>
				</div>
				<!-- 已受理 -->
				<div class='wst-tab-item' style="display:none;">
					<div>
						<table class='wst-list' style="font-size:13px;">
							<thead>
								<tr>
									<th colspan="8" class="wst-form">
									订单号：<input type="text" id="orderNo_1" style='width:120px;' autocomplete="off"/>
									收货人：<input type="text" id="userName_1" style='width:120px;' autocomplete="off"/>
									收货地址：<input type="text" id="userAddress_1" style='width:120px;' autocomplete="off"/>
									<button class='wst-btn-query' onclick="queryOrderPager(1,0)">查询</button>
									<button class='wst-btn-query' style='width:80px;' onclick="batchShopOrderProduce()">批量打包</button>
									</th>
								</tr>
								<tr>
								    <th width='20'><input type='checkbox' onclick='WST.checkChks(this,".chk_1")'/></th>
									<th width='100'>订单号</th>
									<th width='100'>收货人</th>
									<th width='200'>收货地址</th>
									<th width='70'>订单金额</th>
									<th width='70'>实付金额</th>
									<th width='130'>下单时间</th>
									<th width='100'>操作</th>
								</tr>
							</thead>
							<tbody id="otbody1">
							</tbody>
							<tfoot>
								<tr>
									<td colspan='8' align='center' id="opage_1">
										<div  id="wst-page-1" class="wst-page" style="float:right;padding-bottom:10px;"></div>
									</td>
								</tr>
							 </tfoot>
						</table>
					</div>
					<div style='clear:both;'></div>
				</div>
				<!-- 打包中 -->
				<div class='wst-tab-item' style="display:none;">
					<div>
						<table class='wst-list' style="font-size:13px;">
							<thead>
								<tr>
									<th colspan="8" class="wst-form">
									订单号：<input type="text" id="orderNo_2" style='width:120px;' autocomplete="off"/>
									收货人：<input type="text" id="userName_2" style='width:120px;' autocomplete="off"/>
									收货地址：<input type="text" id="userAddress_2" style='width:120px;' autocomplete="off"/>
									<button class='wst-btn-query' onclick="queryOrderPager(2,0)">查询</button>
									<button class='wst-btn-query' style='width:80px;' onclick="batchShopOrderDelivery()">批量配送</button>
									</th>
								</tr>
								<tr>
								    <th width='20'><input type='checkbox' onclick='WST.checkChks(this,".chk_2")'/></th>
									<th width='100'>订单号</th>
									<th width='100'>收货人</th>
									<th width='200'>收货地址</th>
									<th width='70'>订单金额</th>
									<th width='70'>实付金额</th>
									<th width='130'>下单时间</th>
									<th width='100'>操作</th>
								</tr>
							</thead>
							<tbody id="otbody2">
							</tbody>
							<tfoot>
								<tr>
									<td colspan='8' align='center' id="opage_2">
										<div  id="wst-page-2" class="wst-page" style="float:right;padding-bottom:10px;"></div>
									</td>
								</tr>
							 </tfoot>
						</table>
					</div>
					<div style='clear:both;'></div>
				</div>
				<!-- 配送中 -->
				<div class='wst-tab-item' style="display:none;">
					<div>
						<table class='wst-list' style="font-size:13px;">
							<thead>
								<tr>
									<th colspan="7" class="wst-form">
									订单号：<input type="text" id="orderNo_3" style='width:120px;' autocomplete="off"/>
									收货人：<input type="text" id="userName_3" style='width:120px;' autocomplete="off"/>
									收货地址：<input type="text" id="userAddress_3" style='width:120px;' autocomplete="off"/>
									<button class='wst-btn-query' onclick="queryOrderPager(3,0)">查询</button>
									</th>
								</tr>
								<tr>
									<th width='100'>订单号</th>
									<th width='100'>收货人</th>
									<th width='200'>收货地址</th>
									<th width='70'>订单金额</th>
									<th width='70'>实付金额</th>
									<th width='130'>下单时间</th>
									<th width='100'>操作</th>
								</tr>
							</thead>
							<tbody id="otbody3">
							</tbody>
							<tfoot>
								<tr>
									<td colspan='7' align='center' id="opage_3">
										<div  id="wst-page-3" class="wst-page" style="float:right;padding-bottom:10px;"></div>
									</td>
								</tr>
							 </tfoot>
						</table>
					</div>
					<div style='clear:both;'></div>
				</div>
				<!-- 已到货 -->
				<div class='wst-tab-item' style="display:none;">
					<div>
						<table class='wst-list' style="font-size:13px;">
							<thead>
								<tr>
									<th colspan="7" class="wst-form">
									订单号：<input type="text" id="orderNo_4" style='width:120px;' autocomplete="off"/>
									收货人：<input type="text" id="userName_4" style='width:120px;' autocomplete="off"/>
									收货地址：<input type="text" id="userAddress_4" style='width:120px;' autocomplete="off"/>
									<button class='wst-btn-query' onclick="queryOrderPager(4,0)">查询</button>
									</th>
								</tr>
								<tr>
									<th width='100'>订单号</th>
									<th width='100'>收货人</th>
									<th width='200'>收货地址</th>
									<th width='70'>订单金额</th>
									<th width='70'>实付金额</th>
									<th width='130'>下单时间</th>
									<th width='100'>操作</th>
								</tr>
							</thead>
							<tbody id="otbody4">
							<tr><td></td></tr>
							</tbody>
							<tfoot>
								<tr>
									<td colspan='7' align='center' id="opage_4">
										<div  id="wst-page-4" class="wst-page" style="float:right;padding-bottom:10px;"></div>
									</td>
								</tr>
							 </tfoot>
						</table>
					</div>
					<div style='clear:both;'></div>
				</div>
				<!-- 取消/拒收 -->
				<div class='wst-tab-item' style="display:none;">
					<div>
						<table class='wst-list' style="font-size:13px;">
							<thead>
								<tr>
									<th colspan="7" class="wst-form">
									订单号：<input type="text" id="orderNo_5" style='width:120px;' autocomplete="off"/>
									收货人：<input type="text" id="userName_5" style='width:120px;' autocomplete="off"/>
									收货地址：<input type="text" id="userAddress_5" style='width:120px;' autocomplete="off"/>
									<button class='wst-btn-query' onclick="queryOrderPager(5,0)">查询</button>
									</th>
								</tr>
								<tr>
									<th width='100'>订单号</th>
									<th width='100'>收货人</th>
									<th width='200'>取消/拒收原因</th>
									<th width='70'>订单金额</th>
									<th width='70'>实付金额</th>
									<th width='130'>下单时间</th>
									<th width='180'>操作</th>
								</tr>
							</thead>
							<tbody id="otbody5">
							<tr><td></td></tr>
							</tbody>
							<tfoot>
								<tr>
									<td colspan='7' align='center' id="opage_5">
										<div  id="wst-page-5" class="wst-page" style="float:right;padding-bottom:10px;"></div>
									</td>
								</tr>
							 </tfoot>
						</table>
					</div>
					<div style='clear:both;'></div>
				</div>
                <!--价格查询-->
                <div class='wst-tab-item' style="display:none;">
                    <div>
                        <table class='wst-list' style="font-size:13px;">
                            <thead>
                            <tr>
                                <th colspan="8" class="wst-form">
                                    订单金额：<input type="text" id="orderMoney_6" style='width:120px;' autocomplete="off"/>
                                    <button class='wst-btn-query' onclick="queryOrderPager(6,0)">查询</button>
                                </th>
                            </tr>
                            <tr>
                                <th width='20'><input type='hidden' onclick='WST.checkChks(this,".chk_2")'/></th>
                                <th width='100'>订单号</th>
                                <th width='100'>收货人</th>
                                <th width='200'>收货地址</th>
                                <th width='70'>订单金额</th>
                                <th width='70'>实付金额</th>
                                <th width='130'>下单时间</th>
                                <th width='100'>操作</th>
                            </tr>
                            </thead>
                            <tbody id="otbody6">
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan='8' align='center' id="opage_6">
                                    <div id="wst-page-6" class='wst-page' style="float:right;padding-bottom:10px;"></div>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div style='clear:both;'></div>
                </div>
			</div>
			</div>
		</div>
		<div style='clear:both;'></div>
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
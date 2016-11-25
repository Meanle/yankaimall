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
            
<div class="wst-body"> 
<div class='wst-page-header'>卖家中心 > 商品分类</div>
<div class='wst-page-content'>
   <div class='wst-tbar-group' style='text-align:right;'>
   	 <span></span>
   	 <a href='javascript:addGoodsCat(1);' style='margin-right:15px;'><span class='add btn'></span>新增</a>
   </div>
   <form autocomplete="off">
   <table id="cat_list_tab" class='wst-list wst-form'>
   <thead>
   <tr>
     <th>名称</th>
     <th width='60'>排序号</th>
     <th width='80' style="line-height: normal;">是否显示<br/><span style="font-weight:normal;color:red;">(双击可修改)</span></th>
     <th width="150">操作</th>
   </tr>
   </thead>
   <?php if(is_array($List)): $i = 0; $__LIST__ = $List;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tbody>
   <tr id='tr_<?php echo ($i); ?>' isLoad='1'>
     <td>
     <span class='wst-tree-open' onclick='javascript:loadGoodsCatChildTree(this,<?php echo ($vo["catId"]); ?>,"tr_<?php echo ($i); ?>")'>&nbsp;</span>
     <input type='text' style='width:400px;height:22px;' value='<?php echo ($vo['catName']); ?>' dataId="<?php echo ($vo["catId"]); ?>" onchange='javascript:editGoodsCatName(this)'/>
     </td>
     <td><input class='catsort' type='text' style='width:35px;' value="<?php echo ($vo['catSort']); ?>" dataId="<?php echo ($vo["catId"]); ?>" onchange='javascript:editGoodsCatSort(this)' onkeyup="javascript:WST.isChinese(this,1)" onkeypress="return WST.isNumberKey(event)"/></td>
     <?php if($vo['isShow']==0 ): ?><td style="cursor:pointer;" ondblclick="changeCatStatus(1,<?php echo ($vo['catId']); ?>,0)"><span class='wst-state_no'></span></td>
     <?php else: ?>
      <td style="cursor:pointer;" ondblclick="changeCatStatus(0,<?php echo ($vo['catId']); ?>,0)"><span class='wst-state_yes'></span></td><?php endif; ?>
     <td>
     <span onclick='javascript:addGoodsCat(this,<?php echo ($vo["catId"]); ?>,<?php echo ($i); ?>);' class='add btn' title='新增'></span>
     <span onclick="javascript:delGoodsCat(<?php echo ($vo['catId']); ?>,0)" class='del btn' title='删除'></span>&nbsp;
     </td>
   </tr>
   <?php if($vo['childNum'] > 0 ): if(is_array($vo['child'])): $i2 = 0; $__LIST__ = $vo['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($i2 % 2 );++$i2;?><tr id='tr_<?php echo ($i); ?>_<?php echo ($i2); ?>' class="tr_<?php echo ($i); ?>" isLoad='1'>
	     <td>
	     <span class="wst-tree-second">&nbsp;</span>
	     <input type='text' style='width:400px;height:22px;' value='<?php echo ($vo2['catName']); ?>' dataId="<?php echo ($vo2["catId"]); ?>" onchange='javascript:editGoodsCatName(this)'/>
	     </td>
	     <td><input class='catsort' type='text' style='width:35px;' value="<?php echo ($vo2['catSort']); ?>" dataId="<?php echo ($vo2["catId"]); ?>" onchange='javascript:editGoodsCatSort(this)' onkeyup="javascript:WST.isChinese(this,1)" onkeypress="return WST.isNumberKey(event)"/></td>
	     <?php if($vo2['isShow']==0 ): ?><td style="cursor:pointer;" onclick="changeCatStatus(1,<?php echo ($vo2['catId']); ?>,<?php echo ($vo['catId']); ?>)"><span class='wst-state_no'></span></td>
	     <?php else: ?>
	      <td style="cursor:pointer;" onclick="changeCatStatus(0,<?php echo ($vo2['catId']); ?>,<?php echo ($vo['catId']); ?>)"><span class='wst-state_yes'></span></td><?php endif; ?>
	     <td>
	     <a href="javascript:delGoodsCat(<?php echo ($vo2['catId']); ?>,0)" class='del btn' title='删除'></a>&nbsp;
	     </td>
	  </tr><?php endforeach; endif; else: echo "" ;endif; endif; ?>
   </tbody><?php endforeach; endif; else: echo "" ;endif; ?>
</table>
</form>
<div class='wst-tbar-group'>
     <button class='wst-btn-query' style='display:none;margin-top:5px;margin-left:400px;' type="button" onclick='javascript:batchSaveShopCats()'>保&nbsp;存</button>
     <button class='wst-btn-query' style='display:none;margin-top:5px;margin-left:5px;' type="button" onclick='javascript:location.reload()'>取&nbsp;消</button>
     <a style='float:right;margin-right:5px;' href='javascript:addGoodsCat(1);'><span class='add btn'></span>新增</a>
</div>
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
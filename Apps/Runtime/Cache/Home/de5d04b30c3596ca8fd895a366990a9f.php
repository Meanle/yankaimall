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
            
<style type="text/css">
#preview{border:1px solid #cccccc; background:#CCC;color:#fff; padding:5px; display:none; position:absolute;}
</style>
<script>
	$(document).ready(function(){
		$('.imgPreview').imagePreview();
		<?php if(!empty($shopCatId1)): ?>getShopCatListForGoods('<?php echo ($shopCatId1); ?>','<?php echo ($shopCatId2); ?>');<?php endif; ?>
	});
</script>
       <div class="wst-body"> 
       <div class='wst-page-header'>卖家中心 > 待审核商品</div>
       <div class='wst-page-content'>
        <div class='wst-tbar-query'>
        店铺分类：<select id='shopCatId1' autocomplete="off" onchange='javascript:getShopCatListForGoods(this.value,"<?php echo ($object['shopCatId2']); ?>")'>
	         <option value='0'>请选择</option>
	         <?php if(is_array($shopCatsList)): $i = 0; $__LIST__ = $shopCatsList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value='<?php echo ($vo['catId']); ?>' <?php if($shopCatId1 == $vo['catId'] ): ?>selected<?php endif; ?>><?php echo ($vo['catName']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
	     </select>
	     <select id='shopCatId2' autocomplete="off">
	         <option value='0'>请选择</option>
	     </select>
        商品：<input type='text' id='goodsName' autocomplete="off" value='<?php echo ($goodsName); ?>'/>
      <button class='wst-btn-query' onclick='javascript:queryPendding()'>查询</button>
        </div>
        <div class='wst-tbar-group'>
           <span></span>
           <a href='javascript:batchDel()'><span  class='del btn'></span>删除</a>
           <a href='javascript:sale(0)'><span class='unSale btn'></span>下架</a>
           <a href='javascript:goodsSet("isRecomm","queryUnSaleByPage")'><span class='recomm btn'></span>精选促销</a>
           <a href='javascript:goodsSet("isBest","queryUnSaleByPage")'><span class='hot btn'></span>今日疯抢</a>
           <a href='javascript:goodsSet("isNew","queryUnSaleByPage")'><span class='new btn'></span>超值热卖</a>
           <a href='javascript:goodsSet("isHot","queryUnSaleByPage")'><span class='hot btn'></span>热选品牌</a>
        </div>
        <table class='wst-list'>
           <thead>
             <tr>
               <th width='40'><input type='checkbox' onclick='javascript:WST.checkChks(this,".chk")'/></th>
               <th>商品名称</th>
               <th width="100">商品编号</th>
               <th width="80">价格</th>
               <th>精选促销</th>
               <th>今日疯抢</th>
               <th>超值热卖</th>
               <th>热选品牌</th>
               <th>上架</th>
               <th>销量</th>
               <th>库存</th>
               <th width='150'>操作</th>
             </tr>
           </thead>
           <tbody>
            <?php if(is_array($Page['root'])): $i = 0; $__LIST__ = $Page['root'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
               <td><input class='chk' type='checkbox' value='<?php echo ($vo['goodsId']); ?>'/></td>
               <td <?php if($vo['goodsThums'] != ''): ?>img='<?php echo ($vo['goodsThums']); ?>' class='imgPreview'<?php endif; ?>>
               <img class='lazyImg' data-original="/<?php echo ($vo['goodsThums']); ?>" height="50" width="50"/>
               <?php echo ($vo['goodsName']); ?>
               </td>
               <td style="cursor:pointer;" title='双击修改' ondblclick="javascript:toEditGoodsBase(1,<?php echo ($vo['goodsId']); ?>,0)">
               		<input id="ipt_1_<?php echo ($vo['goodsId']); ?>" onblur="javascript:editGoodsBase(1,<?php echo ($vo['goodsId']); ?>)" style="display:none;width:100%;border:1px solid red;width:40px;" maxlength="20"/>
	               	<span id="span_1_<?php echo ($vo['goodsId']); ?>" style="display: inline;"><?php echo ($vo['goodsSn']); ?></span>
					<img id="img_1_<?php echo ($vo['goodsId']); ?>" style="opacity: 0;display:none;" src="/Apps/Home/View/default/images/action_check.gif">
               </td>
               <td style="cursor:pointer;" title='双击修改' ondblclick="javascript:toEditGoodsBase(2,<?php echo ($vo['goodsId']); ?>,'<?php echo ($vo[attIsRecomm]); ?>')">               		
               		<input id="ipt_2_<?php echo ($vo['goodsId']); ?>" onkeyup="javascript:WST.isChinese(this,1)" onkeypress="return WST.isNumberdoteKey(event)" onblur="javascript:editGoodsBase(2,<?php echo ($vo['goodsId']); ?>)" style="display:none;width:100%;border:1px solid red;width:40px;" maxlength="10"/>
	               	<span id="span_2_<?php echo ($vo['goodsId']); ?>" style="display: inline;"><?php echo ($vo['shopPrice']); ?></span>
					<img id="img_2_<?php echo ($vo['goodsId']); ?>" style="opacity: 0;display:none;" src="/Apps/Home/View/default/images/action_check.gif">
               </td>
               <td style="cursor:pointer;" title='双击修改' ondblclick="javascript:changSaleStatus(<?php echo ($vo['goodsId']); ?>,1)">
               <input id="isRecomm_<?php echo ($vo['goodsId']); ?>" type="hidden" value="<?php echo ($vo[isRecomm]); ?>"/>
               <div id="isRecomm_div_<?php echo ($vo['goodsId']); ?>">
	               <?php if($vo['isRecomm'] == 1 ): ?><span class='wst-state_yes'></span>
	               <?php else: ?>
	               <span class='wst-state_no'></span><?php endif; ?>
               </div>
               </td>
               <td style="cursor:pointer;" title='双击修改' ondblclick="javascript:changSaleStatus(<?php echo ($vo['goodsId']); ?>,2)">
               <input id="isBest_<?php echo ($vo['goodsId']); ?>" type="hidden" value="<?php echo ($vo[isBest]); ?>"/>
               <div id="isBest_div_<?php echo ($vo['goodsId']); ?>">
	               <?php if($vo['isBest'] == 1 ): ?><span class='wst-state_yes'></span>
	               <?php else: ?>
	               <span class='wst-state_no'></span><?php endif; ?>
               </div>
               </td>
               <td style="cursor:pointer;" title='双击修改' ondblclick="javascript:changSaleStatus(<?php echo ($vo['goodsId']); ?>,3)">
               <input id="isNew_<?php echo ($vo['goodsId']); ?>" type="hidden" value="<?php echo ($vo[isNew]); ?>"/>
               <div id="isNew_div_<?php echo ($vo['goodsId']); ?>">
	               <?php if($vo['isNew'] == 1 ): ?><span class='wst-state_yes'></span>
	               <?php else: ?>
	               <span class='wst-state_no'></span><?php endif; ?>
               </div>
               </td>
               <td style="cursor:pointer;" title='双击修改' ondblclick="javascript:changSaleStatus(<?php echo ($vo['goodsId']); ?>,4)">
               <input id="isHot_<?php echo ($vo['goodsId']); ?>" type="hidden" value="<?php echo ($vo[isHot]); ?>"/>
               <div id="isHot_div_<?php echo ($vo['goodsId']); ?>">
	               <?php if($vo['isHot'] == 1 ): ?><span class='wst-state_yes'></span>
	               <?php else: ?>
	               <span class='wst-state_no'></span><?php endif; ?>
               </div>
               </td>
               <td style="cursor:pointer;" title='双击修改' ondblclick="javascript:changSaleStatus(<?php echo ($vo['goodsId']); ?>,5)">
               <input id="isSale_<?php echo ($vo['goodsId']); ?>" type="hidden" value="<?php echo ($vo[isSale]); ?>"/>
               <div id="isSale_div_<?php echo ($vo['goodsId']); ?>">
	               <?php if($vo['isSale'] == 1 ): ?><span class='wst-state_yes'></span>
	               <?php else: ?>
	               <span class='wst-state_no'></span><?php endif; ?>
               </div>
               </td>
               <td><?php echo ($vo['saleCount']); ?></td>
               <td style="cursor:pointer;" title='双击修改' ondblclick="javascript:toEditGoodsBase(3,<?php echo ($vo['goodsId']); ?>,'<?php echo ($vo[attIsRecomm]); ?>')" >
	               	<input id="ipt_3_<?php echo ($vo['goodsId']); ?>" onkeyup="javascript:WST.isChinese(this,1)" onkeypress="return WST.isNumberKey(event)" onblur="javascript:editGoodsBase(3,<?php echo ($vo['goodsId']); ?>)" style="display:none;width:100%;border:1px solid red;width:40px;" maxlength="6"/>
	               	<span id="span_3_<?php echo ($vo['goodsId']); ?>" style="display: inline;"><?php echo ($vo['goodsStock']); ?></span>
					<img id="img_3_<?php echo ($vo['goodsId']); ?>" style="opacity: 0;display:none;" src="/Apps/Home/View/default/images/action_check.gif">
               </td>
               <td>
               <a href="javascript:toViewGoods(<?php echo ($vo['goodsId']); ?>)" class='btn view' title='查看'></a>
               <a href="javascript:toEditGoods(<?php echo ($vo['goodsId']); ?>,'queryPenddingByPage')" class='btn edit' title='编辑'></a>
               <a href="javascript:delGoods(<?php echo ($vo['goodsId']); ?>)" class='btn del' title='删除'></a>
               &nbsp;
               </td>
             </tr><?php endforeach; endif; else: echo "" ;endif; ?>
             <tfoot>
             <tr>
                <td colspan='12' align='center'>
                <div class="wst-page" style="float:right;padding-bottom:10px;">
						<div id="wst-page-items"></div>
				</div>
                <script>
			    <?php if($Page['totalPage'] > 1): ?>$(document).ready(function(){
					laypage({
					    cont: 'wst-page-items',
					    pages: <?php echo ($Page['totalPage']); ?>, //总页数
					    skip: true, //是否开启跳页
					    skin: '#e23e3d',
					    groups: 3, //连续显示分页数
					    curr: function(){ //通过url获取当前页，也可以同上（pages）方式获取
					        var page = location.search.match(/p=(\d+)/);
					        return page ? page[1] : 1;
					    }(), 
					    jump: function(e, first){ //触发分页后的回调
					        if(!first){ //一定要加此判断，否则初始时会无限刷新
					        	var nuewurl = WST.splitURL("p");
					        	var ulist = nuewurl.split("?");
					        	if(ulist.length>1){
					        		location.href = nuewurl+'&p='+e.curr;
					        	}else{
					        		location.href = '?p='+e.curr;
					        	}
					            
					        }
					    }
					});
			    });<?php endif; ?>
				</script>
                </td>
             </tr>
             </tfoot>
           </tbody>
        </table>
        <div class='wst-tbar-group'>
           <span></span>
           <a href='javascript:batchDel()'><span  class='del btn'></span>删除</a>
           <a href='javascript:sale(0)'><span class='unSale btn'></span>下架</a>
           <a href='javascript:goodsSet("isRecomm","queryUnSaleByPage")'><span class='recomm btn'></span>精选促销</a>
           <a href='javascript:goodsSet("isBest","queryUnSaleByPage")'><span class='hot btn'></span>今日疯抢</a>
           <a href='javascript:goodsSet("isNew","queryUnSaleByPage")'><span class='new btn'></span>超值热卖</a>
           <a href='javascript:goodsSet("isHot","queryUnSaleByPage")'><span class='hot btn'></span>热选品牌</a>
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
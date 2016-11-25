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
            

<script src="/Public/plugins/kindeditor/kindeditor.js"></script>
<script src="/Public/plugins/kindeditor/lang/zh-CN.js"></script>

<link rel="stylesheet" type="text/css" href="/Public/plugins/webuploader/style.css" />
<style>


</style>   
<script>
var ablumInit = false;
$(function () {
	   $('#tab').TabPanel({tab:0,callback:function(no){
		    if(no==2 && !ablumInit)uploadAblumInit();
	   }});
	   $.formValidator.initConfig({
		   theme:'Default',mode:'AutoTip',formID:"myform",debug:true,submitOnce:true,onSuccess:function(){
			       editGoods('<?php echo ($umark); ?>','<?php echo ($p); ?>');
			       return false;
			},onError:function(msg){
		}});
	   $("#goodsSn").formValidator({onShow:"",onFocus:"",onCorrect:"输入正确"}).inputValidator({min:1,max:50,onError:"请输入商品编号"});
	   $("#goodsName").formValidator({onShow:"",onFocus:"",onCorrect:"输入正确"}).inputValidator({min:1,max:200,onError:"请输入商品名称"});
	   $("#marketPrice").formValidator({onShow:"",onFocus:"",onCorrect:"输入正确"}).inputValidator({min:1,max:50,onError:"请输入市场价格"});
	   $("#shopPrice").formValidator({onShow:"",onFocus:"",onCorrect:"输入正确"}).inputValidator({min:1,max:50,onError:"请输入店铺价格"});
	   $("#goodsStock").formValidator({onShow:"",onFocus:"",onCorrect:"输入正确"}).inputValidator({min:1,max:50,onError:"请输入库存"});
	   $("#goodsUnit").formValidator({onShow:"",onFocus:"",onCorrect:"输入正确"}).inputValidator({min:1,max:50,onError:"请输入商品单位"});
	   $("#goodsCatId3").formValidator({onFocus:"请选择商城分类"}).inputValidator({min:1,onError: "请选择完整商城分类"});
	   $("#shopCatId2").formValidator({onFocus:"请选择本店分类"}).inputValidator({min:1,onError: "请选择完整本店分类"});
	   
	   KindEditor.ready(function(K) {
			editor1 = K.create('textarea[name="goodsDesc"]', {
				height:'250px',
				width:"800px",
				allowFileManager : false,
				allowImageUpload : true,
				items:[
				        'source', '|', 'undo', 'redo', '|', 'preview', 'print', 'template', 'cut', 'copy', 'paste',
				        'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright',
				        'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
				        'superscript', 'clearhtml', 'quickformat', 'selectall', '|', 'fullscreen', '/',
				        'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',
				        'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|','image','multiimage','table', 'hr', 'emoticons', 'baidumap', 'pagebreak',
				        'anchor', 'link', 'unlink', '|', 'about'
				],
				afterBlur: function(){ this.sync(); }
			});
		});
	   <?php if($object['goodsId'] !=0 ): ?>getCatListForEdit("goodsCatId2",<?php echo ($object["goodsCatId1"]); ?>,0,<?php echo ($object["goodsCatId2"]); ?>);
	   getCatListForEdit("goodsCatId3",<?php echo ($object["goodsCatId2"]); ?>,1,<?php echo ($object["goodsCatId3"]); ?>);
	   getShopCatListForEdit(<?php echo ($object["shopCatId1"]); ?>,<?php echo ($object["shopCatId2"]); ?>);<?php endif; ?>
	   var uploading = null;
	   uploadFile({
	    	  server:Think.U('Home/Goods/uploadPic'),pick:'#goodImgPicker',
	    	  formData: {dir:'goods'},
	    	  accept: {
	    	        title: 'Images',
	    	        extensions: 'gif,jpg,jpeg,png',
	    	        mimeTypes: 'image/*'
	    	  },
	    	  callback:function(f){
	    		  layer.close(uploading);
	    		  var json = WST.toJson(f);
	    		  $('#goodsImgPreview').attr('src',WST.DOMAIN+"/"+json.file.savepath+json.file.savethumbname);
	    		  $('#goodsImg').val(json.file.savepath+json.file.savename);
	    		  $('#goodsThums').val(json.file.savepath+json.file.savethumbname);
	    		  $('#goodsImgPreview').show();
		      },
		      progress:function(rate){
		    	  uploading = WST.msg('正在上传图片，请稍后...');
		      }
	   });
});

function imglimouseover(obj){
	if(!$(obj).find('.file-panel').html()){
		$(obj).find('.setdel').addClass('trconb');
		$(obj).find('.setdel').css({"display":""});
	}
}

function imglimouseout(obj){
	
	$(obj).find('.setdel').removeClass('trconb');
	$(obj).find('.setdel').css({"display":"none"});
}

function imglidel(obj){
	if (confirm('是否删除图片?')) {
		$(obj).parent().remove("li");
		return;
	}
}

function imgmouseover(obj){
	$(obj).find('.wst-gallery-goods-del').show();
}
function imgmouseout(obj){
	$(obj).find('.wst-gallery-goods-del').hide();
}
function delImg(obj){
    $(obj).parent().remove();
}
</script>
       <div class="wst-body"> 
       <div class='wst-page-header'>卖家中心 > <?php if($object['goodsId'] ==0 ): ?>新增<?php else: ?>编辑<?php endif; ?>商品资料</div>
       <div class='wst-page-content'>
       <div id='tab' class="wst-tab-box">
		<ul class="wst-tab-nav">
	    	<li>商品信息</li>
	    	<li>属性</li>
	        <li>商品相册</li>
	    </ul>
    	<div class="wst-tab-content" style='width:99%;margin-bottom: 10px;'>
    	 
    	
    	<!-- 商品基础信息 -->
    	<div class='wst-tab-item' style="position: relative;style='display:none'">
	       <form name="myform" method="post" id="myform" autocomplete="off">
	        <input type='hidden' id='id' class='wstipt' value='<?php echo ($object["goodsId"]); ?>'/>
	      
	        <input type='hidden' id='goodsThumbs' value='<?php echo ($object["goodsThums"]); ?>'/>
	        <table class="wst-form" >
	           <tr>
	             <th width='120'>商品编号<font color='red'>*</font>：</th>
	             <td width='300'>
	             <input type='text' id='goodsSn' name='goodsSn' class="wst-ipt wstipt" value='<?php echo ($object["goodsSn"]); ?>' maxLength='25'/>
	             </td>
	             <td rowspan='6' valign='top'>
	               <div>
		           <img id='goodsImgPreview' class='lazyImg' data-original='<?php if($object['goodsImg'] =='' ): ?>/<?php echo ($CONF['goodsImg']); else: ?>/<?php echo ($object['goodsImg']); endif; ?>' height='152'/><br/>
	               </div>
	               <input type='hidden' id='goodsImg' class='wstipt' value='<?php echo ($object["goodsImg"]); ?>'/>
	               <input type='hidden' id='goodsThums' class='wstipt' value='<?php echo ($object["goodsThums"]); ?>'/>
             	   <div id="goodImgPicker" style='margin-left:0px;margin-top:5px;height:30px;overflow:hidden;width:100px;'>上传商品图片</div>
             	   <div>图片大小:150 x 150 (px)，格式为 gif, jpg, jpeg, png</div>
	             </td>
	           </tr>
	           <tr>
	             <th width='120'>商品名称<font color='red'>*</font>：</th>
	             <td><input type='text' id='goodsName' name='goodsName' class="wst-ipt wstipt" value='<?php echo ($object["goodsName"]); ?>' maxLength='100'/></td>
	           </tr>
	            <tr>
	             <th width='120'>市场价格<font color='red'>*</font>：</th>
	             <td>
	             	<input type='text' id='marketPrice' name='marketPrice' class="wstipt wst-ipt" value='<?php echo ($object["marketPrice"]); ?>' onkeypress="return WST.isNumberdoteKey(event)" onkeyup="javascript:WST.isChinese(this,1)" maxLength='10'/>
	             </td>
	           </tr>
	            <tr>
	             <th width='120'>店铺价格<font color='red'>*</font>：</th>
	             <td>
	             	<?php if($object["recommPrice"] > 0): ?><input type='text' id='shopPrice' name='shopPrice' disabled="disabled" class="wstipt wst-ipt" value='<?php echo ($object["recommPrice"]); ?>' onkeypress="return WST.isNumberdoteKey(event)" onkeyup="javascript:WST.isChinese(this,1)" maxLength='10'/>
	             	<?php else: ?>
	             		<input type='text' id='shopPrice' name='shopPrice' class="wstipt wst-ipt" value='<?php echo ($object["shopPrice"]); ?>' onkeypress="return WST.isNumberdoteKey(event)" onkeyup="javascript:WST.isChinese(this,1)" maxLength='10'/><?php endif; ?>
	             	
	             </td>
	           </tr>
	            <tr>
	             <th width='120'>商品库存<font color='red'>*</font>：</th>
	             <td><input type='text' id='goodsStock' name='goodsStock' class="wstipt wst-ipt" value='9999' onkeypress="return WST.isNumberKey(event)" onkeyup="javascript:WST.isChinese(this,1)" maxLength='25' <?php if(count($object['priceAttrs']) > 0 ): ?>disabled<?php endif; ?> /></td>
	           </tr>
	           <tr>
	             <th width='120'>单位<font color='red'>*</font>：</th>
	             <td><input type='text' id='goodsUnit' name='goodsUnit' class="wstipt wst-ipt" value='<?php echo ($object["goodsUnit"]); ?>'  maxLength='25'/></td>
	           </tr>
	           <tr>
	             <th width='120'>商品SEO关键字：</th>
	             <td colspan='3'>
	             <input type='text' style="width:788px" id='goodsKeywords' class='wstipt' name='goodsKeywords' value='<?php echo ($object["goodsKeywords"]); ?>' maxlength="100">
	             </td>
	           </tr>
	           <tr>
	             <th width='120'>商品信息：</th>
	             <td colspan='3'>
	             <textarea rows="2" style="width:788px" id='goodsSpec' class='wstipt' name='goodsSpec'><?php echo ($object["goodsSpec"]); ?></textarea>
	             </td>
	           </tr>
	           <tr>
	             <th width='120'>商品状态<font color='red'>*</font>：</th>
	             <td colspan='3'>
	             <label>
	             <input type='radio' id='isSale1' name='isSale' class='wstipt' <?php if($object['isSale'] ==1 ): ?>checked<?php endif; ?> value='1'/>上架
	             </label>
	             <label>
	             <input type='radio' id='isSale0' name='isSale' class='wstipt' <?php if($object['isSale'] ==0 ): ?>checked<?php endif; ?> value='0'/>下架
	             </label>
	             </td>
	           </tr>
	           <tr>
	             <th width='120'>商品属性：</th>
	             <td colspan='3'>
	             <label>
	             <input type='checkbox' id='isRecomm' name='isRecomm' class='wstipt' <?php if($object['isRecomm'] ==1 ): ?>checked<?php endif; ?> value='1'/>精选促销
	             </label>
	             <label>
	             <input type='checkbox' id='isBest' name='isBest' class='wstipt' <?php if($object['isBest'] ==1 ): ?>checked<?php endif; ?> value='1'/>今日疯抢
	             </label>
	             <label>
	             <input type='checkbox' id='isNew' name='isNew' class='wstipt' <?php if($object['isNew'] ==1 ): ?>checked<?php endif; ?> value='1'/>超值热卖
	             </label>
	             <label>
	             <input type='checkbox' id='isHot' name='isHot' class='wstipt' <?php if($object['isHot'] ==1 ): ?>checked<?php endif; ?> value='1'/>热选品牌
	             </label>
	             </td>
	           </tr>
	           <tr>
	             <th width='120'>商城分类<font color='red'>*</font>：</th>
	             <td colspan='3'>
	             <select id='goodsCatId1' class='wstipt' onchange='javascript:getCatListForEdit("goodsCatId2",this.value,0)'>
	                <option value=''>请选择</option>
	                <?php if(is_array($goodsCatsList)): $i = 0; $__LIST__ = $goodsCatsList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value='<?php echo ($vo['catId']); ?>' <?php if($object['goodsCatId1'] == $vo['catId'] ): ?>selected<?php endif; ?>><?php echo ($vo['catName']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
	             </select>
	             <select id='goodsCatId2' class='wstipt' onchange='javascript:getCatListForEdit("goodsCatId3",this.value,1);'>
	                <option value=''>请选择</option>
	             </select>
	             <select id='goodsCatId3' class='wstipt'>
	                <option value=''>请选择</option>
	             </select>
	             </td>
	           </tr>
	           <tr>
	             <th width='120'>本店分类<font color='red'>*</font>：</th>
	             <td colspan='3'>
	             <select id='shopCatId1' class='wstipt' onchange='javascript:getShopCatListForEdit(this.value,"<?php echo ($object['shopCatId2']); ?>")'>
	                <option value='0'>请选择</option>
	                <?php if(is_array($shopCatsList)): $i = 0; $__LIST__ = $shopCatsList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value='<?php echo ($vo['catId']); ?>' <?php if($object['shopCatId1'] == $vo['catId'] ): ?>selected<?php endif; ?>><?php echo ($vo['catName']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
	             </select>
	             <select id='shopCatId2' class='wstipt'>
	                <option value='0'>请选择</option>
	             </select>
	             </td>
	           </tr>
	           <tr>
	             <th width='120' align='right'>品牌：</th>
	             <td>
	             <select id='brandId' class='wstipt' dataVal='<?php echo ($object["brandId"]); ?>'>
	                <option value='0'>请选择</option>
	             </select>
	             </td>
	           </tr>
	           <tr>
	             <th width='120'>商品描述<font color='red'>*</font>：</th>
	             <td colspan='3'>
	             <textarea rows="2" cols="60" id='goodsDesc' class='wstipt' name='goodsDesc'><?php echo ($object["goodsDesc"]); ?></textarea>
	             </td>
	           </tr>
	           <tr>
	             <td colspan='3' style='padding-left:320px;'>
	                 <button class='wst-btn-query' type="submit">保&nbsp;存</button>
	                 <?php if($umark !='toEdit' ): ?><button class='wst-btn-query' type="button" onclick='javascript:location.href="<?php echo U('Home/Goods/'.$umark);?>"'>返&nbsp;回</button><?php endif; ?>
	             </td>
	           </tr>
	        </table>
	        </form>
	      </div>
	     
	      <div class='wst-tab-item'>
	      商品类型：<select id='attrCatId' class='wstipt' onchange='javascript:getAttrList(this.value)'>
	         <option value='0'>请选择</option>
	         <?php if(is_array($attributeCatsCatsList)): $i = 0; $__LIST__ = $attributeCatsCatsList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value='<?php echo ($vo["catId"]); ?>' <?php if($object['attrCatId'] == $vo['catId'] ): ?>selected<?php endif; ?>><?php echo ($vo["catName"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
	      </select>
	      <div>
	        <fieldset id='priceContainer' class='wst-goods-fieldset' <?php if(count($object['priceAttrs']) > 0): ?>style='display:block'<?php endif; ?>>
			    <legend>价格类型</legend>
			    <input type='hidden' class="hiddenPriceAttr" dataId='<?php echo ($object["priceAttrId"]); ?>' dataNo="<?php echo (count($object['priceAttrs'])); ?>" value='<?php echo ($object["priceAttrName"]); ?>'/>
			    <table class="wst-form wst-goods-price-table">
	             <thead><tr><th>属性</th><th>规格</th><th>价格</th><th>精选促销</th><th>库存</th><th>操作</th></tr></thead>
	             <tbody id="priceConent">
	             <?php if(is_array($object['priceAttrs'])): $i = 0; $__LIST__ = $object['priceAttrs'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr id='attr_<?php echo ($i); ?>'>
		              <td style="text-align:right"><?php echo ($vo['attrName']); ?>：</td>
		              <td><input type="text" id="price_name_<?php echo ($vo['attrId']); ?>_<?php echo ($i); ?>" value="<?php echo ($vo['attrVal']); ?>"/></td>
		              <td><input type="text" id="price_price_<?php echo ($vo['attrId']); ?>_<?php echo ($i); ?>" value="<?php echo ($vo['attrPrice']); ?>" onblur="checkAttPrice(<?php echo ($vo['attrId']); ?>,<?php echo ($i); ?>);" onkeypress="return WST.isNumberdoteKey(event)" onkeyup="javascript:WST.isChinese(this,1)" maxLength="10"/></td>
		              <td><input type="radio" id="price_isRecomm_<?php echo ($vo['attrId']); ?>_<?php echo ($i); ?>" name="price_isRecomm" onclick="checkAttPrice(<?php echo ($vo['attrId']); ?>,<?php echo ($i); ?>);" <?php if($vo['isRecomm'] == 1): ?>checked<?php endif; ?>/></td>
		              <td><input type="text" id="price_stock_<?php echo ($vo['attrId']); ?>_<?php echo ($i); ?>" onblur="getTstock();" value="<?php echo ($vo['attrStock']); ?>" onblur="javascript:statGoodsStaock()" onkeypress="return WST.isNumberdoteKey(event)" onkeyup="javascript:WST.isChinese(this,1)" maxLength="10"/></td>
		              <td>
		              <?php if($i == 1): ?><a title="新增" class="add btn" href="javascript:addPriceAttr()"></a>
		              <?php else: ?>
		              <a title="删除" class="del btn" href="javascript:delPriceAttr(<?php echo ($i); ?>)"></a><?php endif; ?>
		              </td>
		           </tr><?php endforeach; endif; else: echo "" ;endif; ?>
	             </tbody>
	            </table>
			</fieldset>
			<fieldset id='attrContainer' class='wst-goods-fieldset' <?php if(count($object['attrs']) > 0): ?>style='display:block'<?php endif; ?>>
			    <legend>属性类型</legend>
			    <table class="wst-form" style='width:100%'>
	              <tbody id='attrConent'>
	              <?php if(is_array($object['attrs'])): $i = 0; $__LIST__ = $object['attrs'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
		              <td style="width:80px;text-align:right" nowrap><?php echo ($vo['attrName']); ?>：</td>
		              <td>
		              <?php if($vo['attrType']==0){ ?>
		              <input type="text" style='width:70%;' class="attrList" id="attr_name_<?php echo ($vo['attrId']); ?>_<?php echo ($i); ?>" value="<?php echo ($vo['attrVal']); ?>" dataId="<?php echo ($vo['attrId']); ?>"/>
		              <?php }else if($vo['attrType']==2){ ?>
		              <select class="attrList" id="attr_name_<?php echo ($vo['attrId']); ?>_<?php echo ($i); ?>" dataId="<?php echo ($vo['attrId']); ?>">
		              <?php if(is_array($vo['opts']['txt'])): $i = 0; $__LIST__ = $vo['opts']['txt'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$attrvo): $mod = ($i % 2 );++$i;?><option value='<?php echo ($attrvo); ?>' <?php if($attrvo == $vo['attrVal']): ?>selected<?php endif; ?> ><?php echo ($attrvo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
		              </select>
		              <?php }else if($vo['attrType']==1){ ?>
		              <input type='hidden' class="attrList" dataId='<?php echo ($vo['attrId']); ?>' dataType="1"/>
		              <?php if(is_array($vo['opts']['txt'])): $i = 0; $__LIST__ = $vo['opts']['txt'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$attrvo): $mod = ($i % 2 );++$i;?><label><input type='checkbox' name="attrTxtChk_<?php echo ($vo['attrId']); ?>" value="<?php echo ($attrvo); ?>" <?php if($vo['opts']['val'][$attrvo] == 1): ?>checked<?php endif; ?>/><?php echo ($attrvo); ?></label>&nbsp;&nbsp;<?php endforeach; endif; else: echo "" ;endif; ?>
		              <?php } ?>
		              </td>
		             </tr><?php endforeach; endif; else: echo "" ;endif; ?>
	              </tbody>
	            </table>
			</fieldset>
			<div style='width:100%;text-align:center;'>
			<button class='wst-btn-query' type="button" onclick='javascript:$("#myform").submit()'>保&nbsp;存</button>
	        <?php if($umark !='toEdit' ): ?><button class='wst-btn-query' type="button" onclick='javascript:location.href="/index.php/Home/Goods/<?php echo ($umark); ?>"'>返&nbsp;回</button><?php endif; ?>
			</div>
	      </div>
	      </div>
	      
	      <!-- 相册 -->
	      <div class='wst-tab-item' style='display:none'>
	      <!-- 
	       <div><input type='text' id='galleryImgUpload'/></div>
	        -->
	       <div id='galleryImgs' class='wst-gallery-imgs'>
                  <div id="tt"></div>
                  <?php if(count($object['gallery']) == 0): ?><div id="wrapper">
                           <div id="container">
            <!--头部，相册选择和格式选择-->
			                 <div style="border-bottom:1px solid #dadada;padding:10px; ">
			                  		图片大小:800 x 800 (px)(格式为 gif, jpg, jpeg, png)
			           		 </div>
                              <div id="uploader">
                               <div class="queueList">
                                   <div id="dndArea" class="placeholder">
                                      <div id="filePicker"></div>
                                      </div>
                                   <ul class="filelist"></ul>
                               </div>
                             <div class="statusBar" style="display:none">
                               <div class="progress">
                                    <span class="text">0%</span>
                                    <span class="percentage"></span>
                               </div>
                                    <div class="info"></div>
                               <div class="btns">
                                 <div id="filePicker2" class="webuploader-containe webuploader-container"></div><div class="uploadBtn state-finish">开始上传</div>
                               </div>
                            </div>
                         </div>
                      </div>
                   </div>
               <?php else: ?>
               	<div id="wrapper">
                       <div id="container">
                          <div id="uploader">
                             <div class="queueList">
                                 <div id="dndArea" class="placeholder element-invisible">
                                    <div id="filePicker" class="webuploader-container"></div>
                                    </div>
                                 <ul class="filelist">
                                 	<?php if(is_array($object['gallery'])): $i = 0; $__LIST__ = $object['gallery'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li style="border: 1px solid rgb(59, 114, 165)" order="100" onmouseover="imglimouseover(this)" onmouseout="imglimouseout(this)">
	                                 		<input type="hidden" class="gallery-img" iv="<?php echo ($vo["goodsThumbs"]); ?>" v="<?php echo ($vo["goodsImg"]); ?>" />
	                                 		<img width="152" height="152" class='lazyImg' src="/<?php echo ($vo["goodsThumbs"]); ?>"><span class="setdef" style="display:none">默认</span><span class="setdel" onclick="imglidel(this)" style="display:none">删除</span>
                                 		</li><?php endforeach; endif; else: echo "" ;endif; ?>
                                 </ul>
                            </div>
                            <div class="statusBar" style="">
                               <div class="progress">
                                    <span class="text"></span>
                                    <span class="percentage"></span>
                               </div>
                               <div class="info"></div>
                               <div class="btns">
                                  <div id="filePicker2" class="webuploader-containe webuploader-container"></div>
                                  <div class="uploadBtn state-finish">开始上传</div>
                               </div>
                            </div>
                        </div>
                    </div>
                 </div><?php endif; ?>
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
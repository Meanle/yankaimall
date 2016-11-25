function toEditAddress(addressId){
	$("#consignee1").hide();
	$("#consignee2").show();
	changeAddress(addressId);
}
function changeAddress(addressId){

	$("#consigneeId").val(addressId);
	if(addressId>=1){
		loadAddress(addressId);
	}else{
		$("#consignee_add_userName").val("");
		$("#consignee_add_address").val("");
		$("#consignee_add_userPhone").val("");
		$("#consignee_add_userTel").val("");
		$("#consignee_add_zipCode").val("");
		
		var html = new Array();
		$("#consignee_add_countyId").val(0);
		
		var html = new Array();
		$("#consignee_add_CommunityId").empty();
		html.push("<option value='27' selected>默认</option>");
		$("#consignee_add_CommunityId").html(html.join(""));
	}
}

function editAddress(addressId){
	$("#seladdress_"+addressId).click();
}

function loadCommunitys(obj){
	var districtId = obj.value;
	if(districtId<1){
		var html = new Array();
		$("#consignee_add_CommunityId").empty();
		html.push("<option value='27' selected>默认</option>");
		$("#consignee_add_CommunityId").html(html.join(""));
		return;
	}
	
	jQuery.post(Think.U('Home/Communitys/getByDistrict') ,{areaId3:districtId},function(rsp){
		var json = WST.toJson(rsp);
		var html = new Array();
		$("#consignee_add_CommunityId").empty();
		html.push("<option value='27' selected>默认</option>");
		if(json.list && json.list.length>0){
			for(var i=0;i<json.list.length;i++){	    	
				html.push("<option value='"+json.list[i].communityId+"'>"+json.list[i].communityName+"</option>");    	
			}
		}
		$("#consignee_add_CommunityId").html(html.join(""));
	});
}

function loadAddress(addressId){
	$("#address_form").show();	
	jQuery.post(Think.U('Home/UserAddress/getUserAddress') ,{addressId:addressId},function(rsp) {
		console.info(rsp);
		var rs = WST.toJson(rsp);
		if(rs.status>0){
			var addressInfo = rs.address;
			$("#consignee_add_cityName").val(addressInfo.areaName);
			$("#consignee_add_userName").val(addressInfo.userName);
			$("#consignee_add_address").val(addressInfo.address);
			$("#consignee_add_userPhone").val(addressInfo.userPhone?addressInfo.userPhone:"");
			$("#consignee_add_userTel").val(addressInfo.userTel);
			$("#consignee_add_countyId").val(addressInfo.areaId1);
			if(addressInfo.isDefault==1){
			    $("#consignee_add_isDefault_1")[0].checked = true;
			}else{
				$("#consignee_add_isDefault_0")[0].checked = true;
			}
			var countys = addressInfo.area3List;
			var areaList = new Array();
			areaList.push("<option value='430408' selected='selected'>蒸湘区</option>");
			for(var i=0;i<countys.length;i++){
				var county = countys[i];				
				if(county.areaId == addressInfo.areaId3){
					areaList.push("<option value="+county.areaId+" >"+county.areaName+"</option>");
				}else{
					areaList.push("<option value="+county.areaId+" >"+county.areaName+"</option>");
				}
			}
			$("#consignee_add_countyId").html(areaList.join(""));
			
			var communitys = addressInfo.communitysList;
			var areaList = new Array();
			areaList.push("<option value='27' selected>默认</option>");
			for(var i=0;i<communitys.length;i++){
				var community = communitys[i];				
				if(community.communityId == addressInfo.communityId){
					areaList.push("<option value="+community.communityId+" selected='selected'>"+community.communityName+"</option>");
				}else{
					areaList.push("<option value="+community.communityId+" >"+community.communityName+"</option>");
				}
			}
			$("#consignee_add_CommunityId").html(areaList.join(""));
		}
	});
}

/**
 * 咖啡订单默认地址
 */
function saveCoffeeAddress(){
	var seladdress = jQuery('input:radio[name="seladdress"]:checked').val();
	var addressId = $("#consigneeId").val();
	//var userName = '00000000';
	var cityId = jQuery('#areaId2').val();
	var countyId = jQuery('#areaId3').val();
	var communityId = jQuery('#communityId').val();
	var address = '默认';
	//var userPhone = $('#get-user-phone').html();
	var userTel = ($('#get-user-tel').html())?$('#get-user-tel').html():'010-00000000';
	var isDefault = 1;
	var params = {};
	params.id = addressId;
	params.userName = jQuery.trim(userName);
	params.areaId2 = cityId;
	params.areaId3 = countyId;
	params.communityId = communityId;
	params.address = jQuery.trim(address);
	params.userPhone = jQuery.trim(userPhone);
	params.userTel = jQuery.trim(userTel);
	params.isDefault = isDefault;
	if(addressId<1 && $("#seladdress_0").attr("checked")==false){
		WST.msg("请选择收货地址", {icon: 5});
		return ;
	}
	if(params.userName==""){
		WST.msg("请输入收货人", {icon: 5});
		return ;
	}
	if(!WST.checkMinLength(params.userName,2)){
		WST.msg("收货人姓名长度必须大于1个汉字", {icon: 5});
		return ;
	}
	if(params.areaId2<1){
		WST.msg("请选择市", {icon: 5});
		return ;
	}
	if(params.areaId3<1){
		WST.msg("请选择区县", {icon: 5});
		return ;
	}
	if(params.communityId<1){
		WST.msg("请选择社区", {icon: 5});
		return ;
	}
	if(params.address==""){
		WST.msg("请输入详细地址", {icon: 5});
		return ;
	}
	if(userPhone=="" || userTel==""){
		WST.msg("请输入手机号码或固定电话", {icon: 5});
		return ;
	}
	if(userPhone!="" && !WST.isPhone(params.userPhone)){
		WST.msg("手机号码格式错误", {icon: 5});
		return ;
	}
	if(userTel!="" && !WST.isTel(params.userTel)){
		WST.msg("固定电话格式错误", {icon: 5});
		return ;
	}

	console.info(params);

	jQuery.post(Think.U('Home/UserAddress/edit'), params, function(data,textStatus){
		var json = WST.toJson(data);
		//console.info(json)

		if(json.status>0){
			$("#consignee1").show();
			$("#consignee2").hide();
			var addressInfo = new Array();
			addressInfo.push('<div>');
			addressInfo.push('<span style="font-weight: bold;">'+userName+'&nbsp;&nbsp;&nbsp;&nbsp;</span>');
			if(userPhone!=""){
				addressInfo.push(userPhone);
			}else{
				addressInfo.push(userTel);
			}
			addressInfo.push('</div>');
			addressInfo.push('<div>');
			addressInfo.push($("#consignee_add_cityName").val());
			addressInfo.push(jQuery("#consignee_add_countyId").find("option:selected").text());
			addressInfo.push(jQuery("#consignee_add_CommunityId").find("option:selected").text());
			addressInfo.push(address+"&nbsp;&nbsp;&nbsp;&nbsp;");
			addressInfo.push('</div>');
			$("#showaddinfo").html(addressInfo.join(""));

			if(addressId==0){
				$("#consigneeId").val(json.status);
				var addressInfo = new Array();
				addressInfo.push('<div id="caddress_'+json.status+'">');
				addressInfo.push('<label>');
				addressInfo.push('<input id="seladdress_'+json.status+'" onclick="changeAddress('+json.status+');" name="seladdress" type="radio" checked="checked" value="'+json.status+'"/>');
				addressInfo.push('<span style="font-weight: bold;"  id="radusername_'+json.status+'">'+userName+'&nbsp;&nbsp;&nbsp;&nbsp;</span>');
				addressInfo.push('<span id="radaddress_'+json.status+'">');
				addressInfo.push("&nbsp;&nbsp;&nbsp;&nbsp;"+$("#consignee_add_cityName").val());
				addressInfo.push(jQuery("#consignee_add_countyId").find("option:selected").text());
				addressInfo.push(jQuery("#consignee_add_CommunityId").find("option:selected").text());
				addressInfo.push(address);
				addressInfo.push("</span>");
				if(userPhone!=""){
					addressInfo.push(userPhone);
				}else{
					addressInfo.push(userTel);
				}

				addressInfo.push('<span class="optionspan" style="padding-left:50px;color: #999999">[<a onclick="javascript:editAddress('+json.status+');">修改</a>]</span>');
				addressInfo.push('<span class="optionspan" style="padding-left:10px;color: #999999">[<a onclick="javascript:delAddress('+json.status+');">删除</a>]</span>');
				addressInfo.push('</label>');
				addressInfo.push('</div>');
				$(addressInfo.join("")).insertAfter("#flagdiv");

			}else{
				$("#radusername_"+addressId).html(params.userName);
				var addressInfo = new Array();
				addressInfo.push("&nbsp;&nbsp;&nbsp;&nbsp;"+$("#consignee_add_cityName").val());
				addressInfo.push(jQuery("#consignee_add_countyId").find("option:selected").text());
				addressInfo.push(jQuery("#consignee_add_CommunityId").find("option:selected").text());
				addressInfo.push(params.address);
				$("#radaddress_"+addressId).html(addressInfo.join(""));
			}

		}else{
			WST.msg("收货人信息添加失败", {icon: 5});
		}
	});
}

/**
 * 实物订单保存地址
 */
function saveAddress(){
	var seladdress = jQuery('input:radio[name="seladdress"]:checked').val();
	var addressId = $("#consigneeId").val();
	var userName = jQuery('#consignee_add_userName').val();
	var cityId = jQuery('#consignee_add_cityId').val();
	var countyId = jQuery('#consignee_add_countyId').val() ? jQuery('#consignee_add_countyId').val() : '430408';
	var communityId = jQuery('#consignee_add_CommunityId').val();

	var address = jQuery('#consignee_add_address').val();
	var userPhone = jQuery('#consignee_add_userPhone').val();
	var userTel = ($('#get-user-tel').html())?$('#get-user-tel').html():'010-00000000';
    var isDefault = 1;
	var params = {};
	params.id = addressId;
	params.userName = userName;
	params.areaId2 = cityId;
	params.areaId3 = countyId;
	params.communityId = communityId;
	params.address = jQuery.trim(address);
	params.userPhone = userPhone;
	params.userTel = jQuery.trim(userTel);
	params.isDefault = isDefault;
	if(addressId<1 && $("#seladdress_0").attr("checked")==false){
		WST.msg("请选择收货地址", {icon: 5});
		return ;
	}
	if(params.userName==""){
		WST.msg("请输入收货人", {icon: 5});
		return ;		
	}
	if(!WST.checkMinLength(params.userName,2)){
		WST.msg("收货人姓名长度必须大于1个汉字", {icon: 5});
		return ;	
	}
	if(params.areaId2<1){
		WST.msg("请选择市", {icon: 5});
		return ;		
	}
	if(params.areaId3<1){
		WST.msg("请选择区县", {icon: 5});
		return ;		
	}
	if(params.communityId<1){
		WST.msg("请选择社区", {icon: 5});
		return ;		
	}
	if(params.address==""){
		WST.msg("请输入详细地址", {icon: 5});
		return ;		
	}
	if(userPhone=="" || userTel==""){
		WST.msg("请输入手机号码或固定电话", {icon: 5});
		return ;		
	}
	if(userPhone!="" && !WST.isPhone(params.userPhone)){
		WST.msg("手机号码格式错误", {icon: 5});
		console.info(params.userPhone + '   ' + userPhone);
		return ;		
	}
	if(userTel!="" && !WST.isTel(params.userTel)){
		WST.msg("固定电话格式错误", {icon: 5});
		return ;		
	}

	console.info(params);

	jQuery.post(Think.U('Home/UserAddress/edit'), params, function(data,textStatus){
		var json = WST.toJson(data);
		//console.info(json)
		
		if(json.status>0){
			$("#consignee1").show();
			$("#consignee2").hide();

			var addressInfo = new Array();			
			addressInfo.push('<div>');
			addressInfo.push('收件人姓名：<span class="get-user-addr" style="font-weight: bold;">'+userName+'</span><br />');
			if(userPhone!=""){
				addressInfo.push('联系电话：<span id="get-user-phone" class="get-user-addr">'+userPhone+'</span>');
			}else{
				addressInfo.push(userTel);
			}				
			addressInfo.push('</div>');
			addressInfo.push('<div style="margin-bottom: .5rem;">');
			addressInfo.push('收货地址：<span class="get-user-addr">'+$("#consignee_add_cityName").val());
			addressInfo.push(jQuery("#consignee_add_countyId").find("option:selected").text());
			addressInfo.push(jQuery("#consignee_add_CommunityId").find("option:selected").text());
			addressInfo.push(address);
			addressInfo.push('</span></div>');
			$("#showaddinfo").html(addressInfo.join(""));

			if(addressId==0){
				$("#consigneeId").val(json.status);
				var addressInfo = new Array();
				console.info(json);

				addressInfo.push('<div id="caddress_'+json.status+'">');										
				addressInfo.push('<label>');
				addressInfo.push('<input id="seladdress_'+json.status+'" onclick="changeAddress('+json.status+');" name="seladdress" type="radio" checked="checked" value="'+json.status+'"/>');
				addressInfo.push('<span style="font-weight: bold;"  id="radusername_'+json.status+'">'+userName+'</span>');
				addressInfo.push('<span id="radaddress_'+json.status+'">');
				addressInfo.push("收货地址：<span class='get-user-addr'>"+$("#consignee_add_cityName").val());
				addressInfo.push(address);	
				addressInfo.push("</span></span>");
				if(userPhone!=""){
					addressInfo.push(userPhone);
				}else{
					addressInfo.push(userTel);
				}
				
				addressInfo.push('<span class="optionspan" style="padding-left:50px;color: #999999">[<a onclick="javascript:editAddress('+json.status+');">修改</a>]</span>');
				addressInfo.push('<span class="optionspan" style="padding-left:10px;color: #999999">[<a onclick="javascript:delAddress('+json.status+');">删除</a>]</span>');
				addressInfo.push('</label>');
				addressInfo.push('</div>');
				$(addressInfo.join("")).insertAfter("#flagdiv");
				
			}else{

				/*<div id="caddress_218" style="margin-bottom: .5rem;">
				 <label>
				 <input id="seladdress_218" onclick="changeAddress(218);" name="seladdress" type="radio" checked="checked" value="218"> 使用默认地址
				 </label>
				 <span class="optionspan wst-opt-del get-user-addr">[<a onclick="javascript:delAddress(218);">删除</a>]</span>
				 <span class="optionspan wst-opt-upd get-user-addr">[<a onclick="javascript:editAddress(218);">修改</a>]</span><br>

				 收货人姓名：<span style="font-weight: bold; display: inline-block; float: right;" id="radusername_218">黄善政子</span><br>
				 联系电话： <span class="get-user-addr">17834957777</span><br>
				 <div id="radaddress_218">
				 收货地址：<span class="get-user-addr">湖南省 衡阳市 蒸湘区 明兴翰苑1栋3单元1508</span></div><br>
				 </div>*/

				$("#radusername_"+addressId).html(params.userName);
				var addressInfo = new Array();
				addressInfo.push("收货地址：<span class='get-user-addr'>"+$("#consignee_add_cityName").val());
				addressInfo.push(params.address+'</span>');
				$("#radaddress_"+addressId).html(addressInfo.join(""));
			}
			location.href = "";
		}else{
			WST.msg("收货人信息添加失败", {icon: 5});
		}
	});	
}
function addHour(hour){
    var d=new Date();
    d.setHours(d.getHours()+hour);
    var m=d.getMonth()+1;
    var year = d.getFullYear();
    var month = (m>=10?m:'0'+m);
    
    var day = (d.getDate()>=10)?d.getDate():"0"+d.getDate();
    var h = (d.getHours()>=10)?d.getHours():"0"+d.getHours();
    var min = (d.getMinutes()>=10)?d.getMinutes():"0"+d.getMinutes();
    return (year+'-'+month+'-'+day+" "+h+":"+min+":00");
  }

function delAddress(addressId){
	$.confirm('您确定删除该地址吗？','系统提示', function() {
		var ll = $.showPreloader();
		$.post(Think.U('Home/UserAddress/del') ,{id:addressId},function(response) {
			$.hidePreloader();
			if(response){
				$("#caddress_"+addressId).remove();
				$("#consigneeId").val(0);
				$("#seladdress_0").click();
			}else{
				WST.msg("删除失败", {icon: 5});
			}    
		});
	});
	
}
function submitOrder(){

	var display = $('.coffee-send').css('display');

	if(display != 'none') {
		$.showPreloader();
		$.post(Think.U('Home/Goods/checkGoodsStock'), {}, function(data) {

			var goodsInfo = [];
			if(data) {
				for(var i=0; i<data.length; i++) {
					goodsInfo.push(data[i]);
				}
			}

/*			if(jQuery('#remarks').val() == '') {
				WST.msg('请留下您的留言', {icon: 5});
			}*/

			for(var i=0;i<goodsInfo.length;i++){
			 var goods = goodsInfo[i];

			 if(goods.isSale<1){
			 WST.msg('商品'+goods.goodsName+'已下架，请返回重新选购!', {icon: 5});
			 return;
			 }else if(goods.goodsStock<=0){
			 WST.msg('商品'+goods.goodsName+'库存不足，请返回重新选购!', {icon: 5});
			 return;
			 }else if(goods.shopAtive==0){
			 WST.msg('商铺'+goods.shopName+'在休息中，不能下单!', {icon: 5});
			 return;
			 }

			 }

			var params = {};
			params.consigneeId = jQuery('#consigneeId').val();
			//console.info(params.consigneeId);
			/*if(!$("#consignee2").is(":hidden")){
			 WST.msg("请先保存收货人信息",{icon: 5});
			 return;
			 }*/
			 if(params.consigneeId<0){
			 WST.msg("请填写收货人地址", {icon: 5});
			 return;
			 }
			params.invoiceClient = $.trim($("#invoiceClient").val());
			var rdate = $("#requestdate").val();
			var rtime = $("#requesttime").val();
			var date = new Date();
			params.requireTime = date.getFullYear() + '-' + (date.getMonth()+1) + '-' + date.getDate()
				+ ' ' + (date.getHours()+3) + ':' + date.getMinutes() + ':' + date.getSeconds();
			params.payway = 1;
			params.payFrom = 1;
			var input = jQuery('input:radio');
			input.each(function() {
				if(jQuery(this).attr('checked') == 'checked') {
					params.payFrom = jQuery(this).attr('data-index');
					console.info(params.payFrom);
				}
			});
			params.needreceipt = 0;
			params.isself = 0;
			params.remarks = '座位号： ' + jQuery('.coffee-send em').html()+ ' 留言： ' +jQuery("#remarks").val();   //备注
			params.totalMoney = jQuery('#money').html();

			var d1 = params.requireTime;
			d1 = d1.replace(/-/g,"/");
			var date1 = new Date(d1);
			var d2 = addHour(1);
			d2 = d2.replace(/-/g,"/");
			var date2 = new Date(d2);
			params.isScorePay = 0;
			if($("#isScorePay").length>0){
				if($("#isScorePay").prop('checked')){
					params.isScorePay = 1;
				}
			}
			if(params.needreceipt==1 && params.invoiceClient==""){
                 WST.msg("请输入抬头", {icon: 5});
                 return ;
			 }
			 if(date1<date2){
                 WST.msg("亲，期望送达时间必须设定为下单时间1小时后哦！", {icon: 5});
                 return ;
			 }
			 if(!subCheckArea()){
                 WST.msg("您选的商品不在配送区域内！", {icon: 5});
                 return ;
			 }

			var ll = layer.msg('提交订单，请稍候...', {icon: 16,shade: [0.5, '#B3B3B3']});
            if (params.payFrom == 1){
                jQuery.post(Think.U('Home/Orders/submitOrder'), params, function(data) {
                    $.hidePreloader();
                    var json = WST.toJson(data);
                    console.info(JSON.stringify(json));
                    if(json.status==1){
                        if(params.payway==1){
                            location.href=Think.U('Home/Payments/toPay');
                        }else if(params.payway==2){
                            location.href=Think.U('Home/Payments/toBalancePay');
                        }else{
                            location.href=Think.U('Home/Orders/orderSuccess');
                        }
                    }else{
						alert(json.msg);
                    }
                });
            }else {
                jQuery.post(Think.U('Home/Orders/submitOrder'), params, function(data) {
                    $.hidePreloader();
                    var json = WST.toJson(data);
                    console.info(JSON.stringify(json));
                    if(json.status==1){
                        if(params.payway==1){
                            location.href=Think.U('Home/Payments/directBalancePay', '');
                        }else if(params.payway==2){
                        }else{
                            location.href=Think.U('Home/Orders/orderSuccess');
                        }
                    }else{
						alert(json.msg);
                    }
                });

            }

		});

	}else {
		$.alert('请选择座位号！');
	}
}


function getOrderInfo(orderId){
	window.location = Think.U('Home/orders/getOrderInfo','orderId='+orderId);
}

function getPayUrl(){
	
	var params = {};
	params.orderId = $.trim($("#orderId").val());
	params.payCode = $.trim($("#payCode").val());

	params.needPay = $.trim($("#needPay").val());
	if(params.payCode==""){
		WST.msg('请先选择支付方式', {icon: 5});
		return;
	}

	jQuery.post(Think.U('Home/Payments/get'+params.payCode+"URL"), params, function(data) {
		var json = WST.toJson(data);
        console.info(json);
		if(json.status==1){
			if(params.payCode=="weixin"){
				location.href = json.url;
			}else if(params.payCode=="Balance"){
                location.href = json.url;
            }else{
				window.open(json.url);
			}
		}else if(json.status==-2){
			var rlist = json.rlist;
			var garr = new Array();
			for(var i=0;i<rlist.length;i++){
				garr.push(rlist[i].goodsName+rlist[i].goodsAttrName);
				rlist[i].goodsAttrName
			}
			WST.msg('订单中商品【'+garr.join("，")+'】库存不足，不能进行支付。', {icon: 5});

		}else{
			WST.msg('您的订单已支付!', {icon: 5});
			setTimeout(function(){
				window.location = Think.U('Home/orders/queryDeliveryByPage');
			},1500);
		}
	});
}

$(function() {
	/*$('input:radio[name="needreceipt"]').click(function(){
		if($(this).val()==1){
			$("#invoiceClientdiv").show();
		}else{
			$("#invoiceClientdiv").hide();
		}		
	});
	
	$("#wst-order-details").click(function(){
		$("#wst-orders-box"). toggle(100);
	});*/
	
	
	$(".wst-payCode").click(function(){
		$(".wst-payCode-curr").removeClass().addClass("wst-payCode");
		$(this).removeClass().addClass("wst-payCode-curr");
		$("#payCode").val($(this).attr("data"));
	});
	
	$("#isScorePay").click(function(){
		var isself = $('input:radio[name="isself"]:checked').val();
		var totalMoney = (isself==1)?$(this).attr("gtotalMoney"):$(this).attr("totalMoney");
		if($("#isScorePay").prop('checked')){
			
			var scoreMoney = $(this).attr("scoreMoney");
			$("#totalMoney_span").html((totalMoney-scoreMoney).toFixed(2));
		}else{
			$("#totalMoney_span").html(totalMoney);
		}
	});

	/*$(function() {
		$('input:radio[name="needreceipt"]').click(function(){
			if($(this).val()==1){
				$("#invoiceClientdiv").show();
			}else{
				$("#invoiceClientdiv").hide();
			}
		});

		$("#wst-order-details").click(function(){
			$("#wst-orders-box"). toggle(100);
		});


		$(".wst-payCode").click(function(){
			$(".wst-payCode-curr").removeClass().addClass("wst-payCode");
			$(this).removeClass().addClass("wst-payCode-curr");
			$("#payCode").val($(this).attr("data"));
		});

		$("#isScorePay").click(function(){
			var isself = $('input:radio[name="isself"]:checked').val();
			var totalMoney = (isself==1)?$(this).attr("gtotalMoney"):$(this).attr("totalMoney");
			if($("#isScorePay").prop('checked')){

				var scoreMoney = $(this).attr("scoreMoney");
				$("#totalMoney_span").html((totalMoney-scoreMoney).toFixed(2));
			}else{
				$("#totalMoney_span").html(totalMoney);
			}
		});

		$('input:radio[name="isself"]').click(function(){
			$("#isScorePay").attr("disabled",true);
			if($(this).val()==0){//送货上门
				$("#totalMoney_span").html($("#totalMoney").val());
				$("[id^=tst_]").val("-1");
				$("[id^=showwarnmsg_]").show();
				$("[id^=deliveryMoney_span_]").each(function(){
					var dvids = $(this).attr("id").split("deliveryMoney_span_");
					$(this).html($("#deliveryMoney_"+dvids[1]).val());
				});
			}else{//自提
				$("#totalMoney_span").html($("#gtotalMoney").val());
				$("[id^=tst_]").val("1");
				$("[id^=showwarnmsg_]").hide();
				$("[id^=deliveryMoney_span_]").each(function(){
					var dvids = $(this).attr("id").split("deliveryMoney_span_");
					$(this).html("¥0");
				});
			}
			jQuery.post(Think.U("Home/Orders/checkUseScore"),{'isself':$(this).val()},function(data) {

				var json = WST.toJson(data);
				if(json.scoreMoney==0){
					$("#scorePayLab").hide();
				}else{
					$("#scorePayLab").show();
				}
				$("#isScorePay").attr("scoremoney",json.scoreMoney);
				$("#canUserScore").html(json.canUserScore);
				$("#scoreMoney").html(json.scoreMoney);
				$("#isScorePay").attr("disabled",false);
				$("#isScorePay").attr("checked",false);
			});
		});

	});*/
	
});




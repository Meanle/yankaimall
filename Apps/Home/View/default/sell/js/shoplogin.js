$(function(){
	getVerify();
	$('#chkRememberMe').change(function(){
		if($('#chkRememberMe:checked').val()){
			$("#rememberPwd").val(1);
		}else{
			$("#rememberPwd").val(0);
		}
	});
	$(document).keypress(function(e) { 
		   if(e.which == 13) {  
			   login();  
		   } 
	});
});
function whide(){
	setTimeout(function(){
		$("#wrong").css('display','none');
	}, 3000);
}
$("#loginbtn").next('p').css('display','none')
function login(){
	   var params = {};
	   params.loginName = $.trim($("input[name='txtuser']").val());
	   params.loginPwd = $.trim($("input[name='txtpwd']").val());
	   params.verify = $.trim($('#verify').val());
	   var rememberPwd = $("#rememberPwd").val();
	   if(params.loginName==''){
		   $("#wrong").css('display','block').html("请输入用户名!");
		   whide();
		   $('#loginName').focus();
		   return;
	   }
	   if(params.loginPwd==''){
		   $("#wrong").css('display','block').html("请输入密码!");
		   whide();
		   $('#loginPwd').focus();
		   return;
	   }
	   if(params.verify==""){
		   $("#wrong").css('display','block').html("验证码不能为空");
		   whide();
			return false;
	   }
	   $.post(Think.U('Home/Shops/checkLogin'),params,function(data,textStatus){
			var json = WST.toJson(data);
			if(json.status=='1'){
				location.href= Think.U('Home/Shops/index');
			}else if(json.status==-2){
				$("#wrong").css('display','block').html("验证码错误");
				whide();
				getVerify();
			}else{
				$("#wrong").css('display','block').html("账号或密码错误!");
				whide();
				getVerify();
			}
	   });
}
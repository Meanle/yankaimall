<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>修改资料</title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" href="/favicon.ico">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm.min.css" />
    <link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm-extend.min.css" />
    <link rel="stylesheet" href="/Apps/Home/View/default/css/iconfont.css"/>
    <link rel="stylesheet" href="/Apps/Home/View/default/css/app.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/plugins/webuploader/webuploader.css" />
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
<div class="page page-current">
    <a style="display: none;" href="http://www.wstmall.net">Powered&nbsp;By&nbsp;<strong><span style="color: #3366FF">WSTMall</span></strong></a>
    
<nav class="bar bar-tab">
    <a class="tab-item [index]" href="<?php echo U('Index/index');?>">
        <span class="icon iconfont">&#xe602;</span>
        <span class="tab-label">首页</span>
    </a>
    <a class="tab-item [classify]" href="<?php echo U('Index/classify');?>" data-transition='slide-in'>
        <span class="icon iconfont">&#xe639;</span>
        <span class="tab-label">分类</span>
    </a>
    <a id="cart" class="tab-item [cart]" href="<?php echo U('Cart/getCartInfo');?>" data-transition='slide-in'>
        <span class="icon iconfont">&#xe601;</span>
        <span class="tab-label" >购物车</span>
    </a>
    <a class="tab-item active" href="<?php echo U('Orders/queryByPage');?>" data-transition='slide-in'>
        <span class="icon iconfont">&#xe600;</span>
        <span class="tab-label">我的</span>
    </a>
</nav>

    <div class="content">

        <div class="page-info">
            <form name="myform" method="post" id="myform" autocomplete="off">
            <div class="list-block inset">

                    <ul>
                        <!-- Text inputs -->
                        <li class="align-top">
                            <div class="item-content">
                                <div class="item-media"><i class="icon icon-form-comment"></i></div>
                                <div class="item-inner">
                                    <!--<div class="item-title label">头像</div>-->
                                    <div class="item-input" style="position: relative;">
                                        <div style="margin-top: 0.3rem;">
                                            <img id='userPhotoPreview' class='lazyImg' data-original='<?php if($user['userPhoto'] =='' ): ?>/<?php echo ($CONF['goodsImg']); else: echo WSTImgPath($user['userPhoto']); endif; ?>' height='100'/><br/>
                                        </div>
                                        <input type='hidden' id='userPhoto' class='wstipt' value='<?php echo ($user["userPhoto"]); ?>'/>
                                        <div id="userPhotoPicker" style='margin-left:0px;margin-top:5px;height:30px;overflow:hidden;position: absolute;top: 0;height: 100px;opacity: 0;'>上传用户头像</div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item-content">
                                <div class="item-media"><i class="icon icon-form-name"></i></div>
                                <div class="item-inner">
                                    <div class="item-title label">昵称:</div>
                                    <div class="item-input">
                                        <input type='text' id='userName' name='userName' placeholder="您的昵称" value="<?php echo ($user['userName']); ?>"/>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item-content">
                                <div class="item-media"><i class="icon icon-form-email"></i></div>
                                <div class="item-inner">
                                    <div class="item-title label">邮箱:</div>
                                    <div class="item-input">
                                        <input type='email' placeholder="邮箱地址" id='userEmail' name='userEmail' value="<?php echo ($user['userEmail']); ?>" maxlength="25" />
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item-content">
                                <div class="item-media"><i class="icon icon-form-password"></i></div>
                                <div class="item-inner">
                                    <div class="item-title label">手机:</div>
                                    <div class="item-input">
                                        <div id='userPhone' style="padding-left: .25rem; color: #bfbfbf;">
                                            <?php if($user['userPhone']): echo ($user['userPhone']); ?>
                                                <?php else: ?>请修改手机处绑定<?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item-content">
                                <div class="item-media"><i class="icon icon-form-password"></i></div>
                                <div class="item-inner">
                                    <div class="item-title label">QQ</div>
                                    <div class="item-input">
                                        <input type='number' placeholder="QQ号码" id='userQQ' name='userQQ' value="<?php echo ($user['userQQ']); ?>"/>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item-content">
                                <div class="item-media"><i class="icon icon-form-password"></i></div>
                                <div class="item-inner">
                                    <div class="item-title label">生日</div>
                                    <div class="item-input">
                                            <?php if($user['userBirth']): ?><div id='userBirthDiv' style="padding-left: .25rem; color: #bfbfbf;"><?php echo ($user['userBirth']); ?></div>
                                                <input type="hidden" id="userBirth" name="userBirth" value="<?php echo ($user['userBirth']); ?>">
                                                <?php else: ?> <input id="userBirth" name="userBirth" type="date" placeholder="只能填写一次哦"><?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item-content">
                                <div class="item-media"><i class="icon icon-form-gender"></i></div>
                                <div class="item-inner">
                                    <div class="item-title label">性别</div>
                                    <div class="item-input">
                                        <select id="userSex" name="userSex">
                                            <option value="1" <?php if($user['userSex'] == 1): ?>selected<?php endif; ?>>男</option>
                                            <option value="2" <?php if($user['userSex'] == 2): ?>selected<?php endif; ?>>女</option>
                                            <option value="3" <?php if($user['userSex'] == 3): ?>selected<?php endif; ?>>保密</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>

            </div>
            <div class="content-padded">
                <div class="row">
                    <div class="col-50"><button class="button button-big button-fill" type="reset">重置</button></div>
                    <div class="col-50"><button class="button button-big button-fill" type="submit">提交</button></div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<script src="/Public/plugins/formValidator/formValidator-4.1.3.js"></script>
<script src="/Public/js/common.js"></script>
<script src="/Apps/Home/View/default/js/usercom.js"></script>
<script src="/Apps/Home/View/default/js/head.js"></script>
<script src="/Public/plugins/layer/layer.min.js"></script>
<script type="text/javascript" src="/Public/plugins/webuploader/webuploader.js"></script>
<script src="/Apps/Home/View/default/js/common.js"></script>
<script>
//    WST.msg('修改用户资料!');
    $(function () {
        $.formValidator.initConfig({
            theme:'Default',mode:'AutoTip',formID:"myform",debug:true,submitOnce:true,onSuccess:function(){
                editUser();
                return false;
            },onError:function(msg){
            }});
        $("#userName").formValidator({onShow:"",onFocus:"",onCorrect:""}).inputValidator({min:3,max:20,onError:""});
/*        $("#userPhone").inputValidator({min:3,max:25,onError:""}).regexValidator({
            regExp:"mobile",dataType:"enum",onError:""
        }).ajaxValidator({
            dataType : "json",
            async : true,
            url : Think.U('Home/Users/checkLoginKey'),
            success : function(data){
                var json = WST.toJson(data);
                if( json.status == "1" ) {
                    return true;
                } else {
                    return false;
                }
                return "";
            },
            buttons: $("#dosubmit"),
            onError : "",
            onWait : "请稍候..."
        }).defaultPassed().unFormValidator(true);*/
        $("#userEmail").inputValidator({min:0,max:25,onError:""}).regexValidator({
            regExp:"email",dataType:"enum",onError:""
        }).ajaxValidator({
            dataType : "json",
            async : true,
            url : Think.U('Home/Users/checkLoginKey'),
            success : function(data){
                var json = WST.toJson(data);
                if( json.status == "1" ) {
                    return true;
                } else {
                    return false;
                }
                return "该电子邮箱已被使用";
            },
            buttons: $("#dosubmit"),
            onError : "",
            onWait : "请稍候..."
        }).defaultPassed().unFormValidator(true);
        $("#userPhone").blur(function(){
            if($("#userPhone").val()==''){
                $("#userPhone").unFormValidator(true);
            }else{
                $("#userPhone").unFormValidator(false);
            }
        });
        $("#userEmail").blur(function(){
            if($("#userEmail").val()==''){
                $("#userEmail").unFormValidator(true);
            }else{
                $("#userEmail").unFormValidator(false);
            }
        });
        var uploading = null;
        uploadFile({
            server:Think.U('Home/users/uploadPic'),pick:'#userPhotoPicker',
            formData: {dir:'users'},
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,png',
                mimeTypes: 'image/*'
            },
            callback:function(f){
                layer.close(uploading);
                var json = WST.toJson(f);
                $('#userPhotoPreview').attr('src',WST.DOMAIN+"/"+json.file.savepath+json.file.savethumbname);
                $('#userPhoto').val(json.file.savepath+json.file.savename);
                $('#userPhotoPreview').show();
            },
            progress:function(rate){
                uploading = WST.msg('正在上传图片，请稍后...');
            }
        });
    });
</script>
</body>
</html>
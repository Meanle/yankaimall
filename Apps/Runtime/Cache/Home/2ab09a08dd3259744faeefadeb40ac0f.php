<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no"/>
    <title>订单详情</title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" href="/favicon.ico">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm.min.css">
    <link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm-extend.min.css">
    <link rel="stylesheet" href="/Apps/Home/View/default/css/iconfont.css"/>
    <link rel="stylesheet" href="/Apps/Home/View/default/css/app.css"/>
    <script src="/Public/js/jquery.min.js"></script>
    <script>
        var ThinkPHP = window.Think = {
            "ROOT": "",
            "APP": "/index.php",
            "PUBLIC": "/Public",
            "DEEP": "<?php echo C('URL_PATHINFO_DEPR');?>",
            "MODEL": ["<?php echo C('URL_MODEL');?>", "<?php echo C('URL_CASE_INSENSITIVE');?>", "<?php echo C('URL_HTML_SUFFIX');?>"],
            "VAR": ["<?php echo C('VAR_MODULE');?>", "<?php echo C('VAR_CONTROLLER');?>", "<?php echo C('VAR_ACTION');?>"],
            "DOMAIN": "<?php echo WSTDomain();?>",
            "CITY_ID": "<?php echo ($currArea['areaId']); ?>",
            "CITY_NAME": "<?php echo ($currArea['areaName']); ?>",
            "DEFAULT_IMG": "<?php echo WSTDomain();?>/<?php echo ($CONF['goodsImg']); ?>",
            "MALL_NAME": "<?php echo ($CONF['mallName']); ?>",
            "SMS_VERFY": "<?php echo ($CONF['smsVerfy']); ?>",
            "PHONE_VERFY": "<?php echo ($CONF['phoneVerfy']); ?>",
            "IS_LOGIN": "<?php echo ($WST_IS_LOGIN); ?>"
        };
    </script>
    <script src="/Public/js/think.js"></script>
    <script src="/Public/js/common.js"></script>
    <script src="/Public/plugins/layer/layer.min.js"></script>
    <script src="/Apps/Home/View/default/js/orders.js"></script>
    <style>
        #get-user-phone, #get-user-tel, #get-user-name, .get-user-addr {
            display: inline-block;
            float:right;
            max-width: 70%;
        }
        .addr-input {
            background-color: #fff;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: .2rem;
            color: #000;
            line-height: 140%;
        }
        .addr-textarea {
            border: 1px solid #d0cece;
            border-radius: .2rem;
            width: 100%;
            height: 5rem;
            resize: none;
            line-height: 1.4;
            padding: .4rem;
        }
        .wst-chkod-line35 {
            margin-bottom: .5rem;
        }
    </style>
</head>

<body>
<div class="page">
    <div class="content" id='detail-page'>
        <!-- 这里是页面内容区 -->
        <div class="page-check" id="pagecheck">
            <?php if(is_array($catgoods)): foreach($catgoods as $k1=>$vo1): ?><div class="list-block list-num">
                    <ul>
                        <li class="item-content">
                            <div class="item-media"><i class="icon icon-f7"></i></div>
                            <div class="item-inner">
                                <div class="item-title">
                                    <span>商品数量：</span>
                                    <span><?php echo ($vo1['totalCnt']); ?></span>
                                </div>
                                <div class="item-after coffee-price">￥ <?php echo ($vo1['totalMoney']); ?></div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="list-block media-list">
                    <?php if(is_array($vo1['shopgoods'])): foreach($vo1['shopgoods'] as $k2=>$vo2): ?><ul>
                            <li>
                                <a class="item-content">
                                    <div class="item-media"><img
                                            src="/<?php echo ($vo2['goodsThums']); ?>"
                                            width="80"></div>
                                    <div class="item-inner">
                                        <div class="item-title-row">
                                            <div class="item-title"><?php echo ($vo2['goodsName']); ?></div>
                                            <div class="item-after">
                                                <?php if(isValidVip() == 1): ?><span class="coffee-price">￥ <?php echo ($vo2['vipPrice']); ?></span>
                                                    <?php else: ?>
                                                    <span class="coffee-price">￥ <?php echo ($vo2['shopPrice']); ?></span><?php endif; ?>
                                                <span>&nbsp;x&nbsp;<?php echo ($vo2['cnt']); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul><?php endforeach; endif; ?>
                </div><?php endforeach; endif; ?>

            <?php if(count($addressList) != 0): ?><div id="consignee1" class="default-address card facebook-card"
                     style="margin-bottom: .7rem; padding-top: .5rem;"
                    <?php if(count($addressList) == 0): ?>style='display:none'<?php endif; ?> >
                    <div class="card-content">
                        <div>
                            <em class="wst-chkod-s1-title">收货人信息 </em>
                            <input type="hidden" id="paddressId" value="<?php echo ($addressList[0]['addressId']); ?>"/>
                            <span class="wst-chkod-s1-upd get-user-addr"><a
                                    href="javascript:toEditAddress(<?php echo ($addressList[0]['addressId']); ?>);">[修改]</a></span>
                        </div>
                        <?php if(is_array($addressList)): $k = 0; $__LIST__ = $addressList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$address): $mod = ($k % 2 );++$k; if($k == 1): ?><input type="hidden" id="consigneeId" name="consigneeId"
                                       value="<?php echo ($address['addressId']); ?>"/>
                                <div id="showaddinfo">
                                    <div>
                                        收件人姓名：<span style="font-weight: bold;" id="get-user-name"><?php echo ($address["userName"]); ?></span><br />
                                        <?php if($address['userPhone'] != ''): ?>联系电话：<span id="get-user-phone"><?php echo ($address["userPhone"]); ?></span>
                                            <?php else: ?>
                                            联系电话：<span id="get-user-tel"><?php echo ($address["userTel"]); ?></span><?php endif; ?>
                                    </div>
                                    <div style="margin-bottom: .5rem;">
                                        收货地址： <span class="get-user-addr"><?php echo ($address["areaName1"]); ?> <?php echo ($address["areaName2"]); ?> <?php echo ($address["address"]); ?></span><!--<?php echo ($address["areaName3"]); echo ($address["communityName"]); ?>-->
                                    </div>
                                </div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                        <?php if(count($addressList) == 0): ?><div id="showaddinfo"></div>
                            <input type="hidden" id="consigneeId" name="consigneeId"/><?php endif; ?>
                    </div>
                </div><?php endif; ?>

            <div id="consignee2" class="card facebook-card" style="<?php if( count($addressList) > 0 ): ?>display:none;<?php endif; ?>">
                <div class="card-content">
                    <div class="line-bg"></div>
                    <div>
                        <em class="wst-chkod-cg-title">收货人信息 </em>
                    </div>
                    <div>
                        <div id="userAddressDiv">
                            <div id="flagdiv" style="display: none;"></div>
                            <?php if(is_array($addressList)): $key = 0; $__LIST__ = $addressList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$address): $mod = ($key % 2 );++$key;?><div id="caddress_<?php echo ($address['addressId']); ?>" style="margin-bottom: .5rem;">
                                    <label>
                                        <input id="seladdress_<?php echo ($address['addressId']); ?>"
                                               onclick="changeAddress(<?php echo ($address['addressId']); ?>);" name="seladdress"
                                               type="radio"
                                        <?php if($key == 1): ?>checked="checked"<?php endif; ?>
                                        value="<?php echo ($address['addressId']); ?>"/> 请在下方修改该地址
                                    </label>
                                    <span class="optionspan wst-opt-del get-user-addr">[<a
                                            onclick="javascript:delAddress(<?php echo ($address['addressId']); ?>);">删除此地址</a>]</span><br />
<!--                                    <span class="optionspan wst-opt-upd get-user-addr">[<a
                                            onclick="javascript:editAddress(<?php echo ($address['addressId']); ?>);">修改</a>]</span>-->

                                    收货人姓名：<span style="font-weight: bold; display: inline-block; float: right;" id="radusername_<?php echo ($address['addressId']); ?>"><?php echo ($address["userName"]); ?></span><br />
                                    <?php if($address['userPhone'] != ''): ?>联系电话： <span class="get-user-addr"><?php echo ($address["userPhone"]); ?></span><br />
                                        <?php else: ?>
                                        联系电话： <span class="get-user-addr"><?php echo ($address["userTel"]); ?></span><br /><?php endif; ?>
                                    <div id="radaddress_<?php echo ($address['addressId']); ?>">
                                        收货地址：<span class="get-user-addr"><?php echo ($address["areaName1"]); ?> <?php echo ($address["areaName2"]); ?> <?php echo ($address["address"]); ?></span></div><br />
                                </div><?php endforeach; endif; else: echo "" ;endif; ?>
                        </div>

                        <!-- 新地址 -->
                        <div>
                            <label>
                                <input id="seladdress_0" name="seladdress" type="radio" value="0"
                                       onclick="changeAddress(0);"
                                <?php if(count($addressList) == 0): ?>checked="checked"<?php endif; ?>
                                /> 使用新地址
                            </label>
                        </div>
                    </div>
                    <div id="address_form" style="">
                        <input type='hidden' id='consignee_add_cityId' name='consignee_add_cityId'
                               value="<?php echo ($currArea['areaId']); ?>"/>
                        <input type='hidden' id='consignee_add_cityName' name='consignee_add_cityName'/>

                        <div class="wst-chkod-line35">
                            <div class="wst-chkod-cg-pp" style="float: left;">收货人：</div>
                            <div style="float: right;">
                                <input type="text" class="addr-input" style="width: 100%;" maxlength="50"
                                       name="consignee_add_userName" id="consignee_add_userName"/>
                            </div>
                            <div style="clear: both;"></div>
                        </div>
                        <div class="wst-chkod-line35">
                            <div class="wst-chkod-cg-ads">收货地址：</div>
                            <div class="wst-chkod-area-box">
                                <select name="consignee_add_countyId" id="consignee_add_countyId" class="adsipt"
                                        onchange="loadCommunitys(this);" hidden>
                                    <option value="430408" selected="selected">蒸湘区</option>
                                </select>
                                <select name="consignee_add_CommunityId" id="consignee_add_CommunityId" class="adsipt"
                                        onchange="checkArea();" hidden>
                                    <option value="27" selected="selected">默认</option>
                                </select>
                                <textarea type="text" class="addr-textarea" placeholder="请填写详细地址"
                                       name="consignee_add_address" id="consignee_add_address"></textarea>
                            </div>
                            <div style="clear: both;"></div>
                        </div>
                        <div class="wst-chkod-line35">
                            <div class="wst-chkod-cg-pno" style="display: inline-block;">手机号码：</div>
                            <div class="wst-chkod-cg-pno-box" style="display: inline-block; float: right;">
                                <input type="number" class="addr-input" maxlength="11" style="width: 100%;"
                                       name="consignee_add_userPhone" id="consignee_add_userPhone"
                                       onkeyup="javascript:WST.isChinese(this,1)"
                                       onkeypress="return WST.isNumberdoteKey(event)"/>
                               <!-- &nbsp;或&nbsp;&nbsp;&nbsp;&nbsp;
                                固定电话:<input type="text" class="input adsipt" style="width: 150px;" maxlength="15"
                                            name="consignee_add_userTel" id="consignee_add_userTel"/>(例：020-88888888)&nbsp;-->
                            </div>
                            <div style="clear: both;"></div>
                        </div>
                        <div class="wst-chkod-line35">
                            <div class="wst-chkod-cg-pno">是否默认地址：</div>
                            <div class="wst-chkod-cg-pno-box">
                                <label>
                                    <input type='radio' name='consignee_add_isDefault' id='consignee_add_isDefault_1'
                                           vallue='1'>是
                                </label>
                                <label>
                                    <input type='radio' name='consignee_add_isDefault' id='consignee_add_isDefault_0'
                                           vallue='0'>否
                                </label>
                            </div>
                            <div style="clear: both;"></div>
                        </div>
                    </div>

                    <div class="wst-checkout wst-chkod-sbx" id="checkout">
                        <ul>
                            <li onclick="saveAddress()">
                                <span class="button button-fill" id="saveConsigneeTitleDiv">保存地址</span>
                            </li>
                        </ul>
                        <div style="clear: both;"></div>
                    </div>


                </div>
            </div>

            <div class="card facebook-card">
                <div class="card-content">

                    <div class="coffee-message">
                        <div class="item-title">
                            附加留言
                        </div>
                        <div class="item-input">
                            <textarea id="remarks" placeholder="想说什么尽情倾诉吧！"></textarea>
                        </div>
                    </div>
            <div class="line-bg"></div>
            <div class="coffee-money">
                <div class="list-block list-num">
                    <ul>
                        <li class="item-content">
                            <div class="item-inner">
                                <div class="item-title">
                                    <span>订单金额</span>
                                </div>
                                <?php if(is_array($catgoods)): foreach($catgoods as $k1=>$vo1): ?><div class="item-after coffee-price">￥ <?php echo ($vo1['totalMoney']); ?></div><?php endforeach; endif; ?>
                            </div>
                        </li>
                        <li class="item-content">
                            <div class="item-inner">
                                <div class="item-title">
                                </div>
                                <div class="item-after coffee-price">
                                    <span class="jine">应付金额</span>
                                    <?php if(is_array($catgoods)): foreach($catgoods as $k1=>$vo1): ?><span id="money">￥ <?php echo ($vo1['totalMoney']); ?></span><?php endforeach; endif; ?>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="line-bg"></div>
            <div class="coffee-check">
                <div class="list-block media-list list-num">
                    <ul>
                        <li class="item-content">
                            <div class="item-inner">
                                <div class="item-title">
                                    <span>支付方式</span>
                                </div>
                            </div>
                        </li>

                        <li>
                            <label class="label-checkbox item-content">
                                <input type="radio" name="my-radio" data-index="1" checked="checked" id="wxPayWay">
                                <div class="item-media"><i class="icon icon-form-checkbox"></i></div>
                                <div class="item-inner">
                                    <div class="item-title-row">
                                        <div class="item-title">微信支付</div>
                                        <!--<div class="item-after">logo</div>-->
                                    </div>
                                    <div class="item-subtitle">精选促销安装5.0以上的版本</div>
                                </div>
                                <div class="pay wechatpay">
                                </div>
                            </label>
                        </li>
                        <li>
                            <label class="label-checkbox item-content">
                                <input type="radio" name="my-radio" data-index="2" id="blPayWay">
                                <div class="item-media"><i class="icon icon-form-checkbox"></i></div>
                                <div class="item-inner">
                                    <div class="item-title-row">
                                        <div class="item-title">余额支付</div>
                                    </div>
                                    <div class="item-subtitle">可用余额￥<span><?php echo ($data['money']); ?></span></div>
                                </div>
                                <div class="pay wepay"></div>
                            </label>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <p class="check_btn">
        <a class="button button-big button-fill button-verifer" data-transition='fade' id="getVer">生成订单</a>
    </p>
</div>
</div>
</div>
<script>
    $(function() {
        setTimeout(function() {
            $('#getVer').click(function() {
                if($('#consignee2').css('display') == 'block') {
                    $.alert('请先保存地址');
                }else {
                    submitOrder();
                }
            });
        }, 50);
    });
    jQuery.noConflict();
</script>
<!-- 默认必须要执行$.init(),实际业务里一般不会在HTML文档里执行，通常是在业务页面代码的最后执行 -->
<script type='text/javascript' src='/Apps/Home/View/default/js/zepto.min.js' charset='utf-8'></script>
<script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm.min.js' charset='utf-8'></script>
<script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm-extend.min.js' charset='utf-8'></script>
<script type="text/javascript" src="/Apps/Home/View/default/js/app.js"></script>


<script type="text/javascript">
    $.init();

    $(".pickseat ul li").click(function () {
        $(this).addClass('on').siblings().removeClass("on");
        $('.coffee-send').css('display', 'inline-block');
        var n = $(this).index() + 1;
        $(".coffee-send em").html(n);
    });

    jQuery('.label-checkbox').click(function() {
        jQuery(this).find('input').attr('checked', 'checked');
        jQuery(this).parent().siblings().find('input').removeAttr('checked');

        setTimeout(function() {
            if($('#wxPayWay').attr('checked') == 'checked') {
                $('#getVer').css('background', '#0894ec').removeAttr('onclick').html('生成订单')
                .click(function() {
                    if ($('#consignee2').css('display') == 'block') {
                        $.alert('请先保存地址');
                    } else {
                        submitOrder();
                    }
                });
            }else if($('#blPayWay').attr('checked') == 'checked') {
                if($('#no-more-1').length == 0 || $('#no-more-1').attr('index') == '999') {
                    $('#getVer').attr('onclick', 'checkSms()').unbind('click');
                }
            }
        }, 10);
        if($('#blPayWay').attr('checked') == 'checked') {
            if($('#no-more-1').length != 0 && $('#no-more-1').attr('index') != '999') {
                $('#getVer').css('background', '#bbb')
                        .removeAttr('onclick').html($('#no-more-1').val() + ' 秒后可重新发送');
            }
        }
    });

    function subCheckArea() {
        var communityId = $("#consignee_add_CommunityId").val();
        <?php if(is_array($shopColleges)): $key = 0; $__LIST__ = $shopColleges;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$shopCollege): $mod = ($key % 2 );++$key;?>var shopCollege = ',<?php echo ($shopCollege); ?>,';
            var idx = shopCollege.indexOf(","+communityId+",");
            if(idx==-1){
                $("#areaOk").val("0");
                WST.msg("店铺“"+$("#sp_<?php echo ($key-1); ?>").html()+"”中的商品不在配送区域内！");
                return false;
            }else{
                $("#areaOk").val("1");
            }<?php endforeach; endif; else: echo "" ;endif; ?>
        return true;
    }

    function timeCalter() {
        var second = 60;
        var text = $('#phone-text').length, btn = $('#getVer');
        setTimeout(function() {
            var f = setInterval(function() {

                if($('#no-more-1').length == 0) {
                    $('body').append('<input type="hidden" id="no-more-1" index="0"/>');
                }
                $('#no-more-1').attr('index', '0');

                if(second >= 0) {
                    if(text == 0) {
                        $('#phone-text').append('<span id="content"></span>');
                        text = $('#phone-text').length;
                    }

                    if($('#no-more-1').attr('index') == '0' && $('#blPayWay').attr('checked') == 'checked') {
                        btn.css('background', '#bbb')
                                .removeAttr('onclick').html(second+' 秒后可重新发送');
                    }else {
                        btn.css('background', '#0894ec').attr('onclick', 'submitOrder()').html('生成订单');
                    }
                    $('#content').html('('+second+'秒后可重新发送)');
                    $('#no-more-1').val(second);
                    second -= 1;

                }else {
                    $('#phone-text').html('已向您手机号<?php echo ($Phone); ?>发送支付验证码');
                    btn.css({
                        'background': '#0894ec',
                    }).attr('onclick', 'checkSms()').html('生成订单');
                    $('#no-more-1').attr('index', '999');
                    window.clearInterval(f);
                }
            }, 1000);
        }, 10);
    }

    function sendMsgAction(value, count) {
        if(value == '') {

            $.prompt('<p id="phone-text">已向您手机号<?php echo ($Phone); ?>发送支付验证码</p>',
                    function (value) {
                        reViewCode(value, count);
                    },
                    function (value) {
                        return false;
                    }
            );
        }else {
            $.prompt('请重新输入验证码',
                    function (value) {
                        reViewCode(value, count);
                        console.info(count);

                    },
                    function (value) {
                        return false;
                    }
            );
        }
    }

    function reViewCode(value, count) {
        if (count < 2) {
            $.ajax({
                url: '<?php echo U("Home/Users/true_sms");?>',
                type: 'post',
                data: {
                    tel: "<?php echo ($rs['userPhone']); ?>",
                    code: value,
                    id: "<?php echo ($rs['userId']); ?>",
                },
                success: function (json) {
                    if (json.code == 1) {
                        submitOrder();
                    } else {
                        $.alert(json.msg);
                        count += 1;
                        sendMsgAction(value, count);
                    }
                },
                error: function (json) {
                    alert(json.msg);
                }
            });
        } else {
            $.alert('您已输错超过三次，请重新获取验证码！');
            return false;
        }
    }

    function checkSms() {
        if($('#consignee2').css('display') == 'none') {
            var payway = 1;
            var input = jQuery('input:radio');
            input.each(function() {
                if(jQuery(this).attr('checked') == 'checked') {
                    payway = jQuery(this).attr('data-index');
                }
            });
            if(payway == 1){
                submitOrder();
                return;
            }
            var phone = "<?php echo ($rs['userPhone']); ?>";
            $.confirm('会员请先进行短信验证,更加安全',
                    function () {
                        timeCalter();
                        $.ajax({
                            url:'<?php echo U("Home/Users/sms");?>',
                            type:'post',
                            data:{
                                tel:phone
                            },
                            success:function(json){
                                console.log(json);
                                if(json.code == 0){
                                    $.alert(json.msg);
                                    return;
                                }
                                sendMsgAction('', 0);
                            },
                            error:function(json){
                                console.log(json);
                            }
                        });
                    },
                    function () {
                        return false;
                    }
            );
        }else {
            $.alert('请先保存地址');
        }
    }

</script>
</body>

</html>
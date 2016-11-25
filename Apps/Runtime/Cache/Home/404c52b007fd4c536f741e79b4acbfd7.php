<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo ($meta_title); ?></title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" href="favicon.ico"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm.min.css">
    <link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm-extend.min.css">
    <link rel="stylesheet" href="/Apps/Home/View/default/css/iconfont.css"/>
    <link rel="stylesheet" href="/Apps/Home/View/default/css/app.css"/>
    <link rel="stylesheet" href="/Apps/Home/View/default/css/oders.css"/>
    <script type='text/javascript' src="/Apps/Home/View/default/js/zepto.min.js" charset='utf-8'></script>
</head>
<body>


<div class="page">
    
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
        <div class="page-login">
            <div class="list-block inset">
                <ul>
                    <!-- Text inputs -->
                    <li>
                        <div class="item-content">
                            <div class="item-media"><i class="icon iconfont">&#xe618;</i></div>
                            <div class="item-inner">
                                <div class="item-input input-define">
                                    <input id="phonenum" <?php if($user['userPhone']): ?>value="<?php echo ($user['userPhone']); ?>"<?php else: ?>placeholder="手机号码"<?php endif; ?> oninput="javascript:changeNum();" onblur="javascript:isPhoneNum();" type="number">
                                    <label class="img" style="line-height: 2.15rem">
                                        <p id="getVer" class="notClick">点击获取验证码</p>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item-content">
                            <div class="item-media"><i class="icon iconfont">&#xe615;</i></div>
                            <div class="item-inner">
                                <div class="item-input">
                                    <input id="loginName" style="font-size: 0.6rem" name="loginName" onpaste="return false;" type="text" placeholder="请输入验证码">
                                </div>
                            </div>
                        </div>
                    </li>

                </ul>
            </div>
            <div class="content-block login-register">
                <p><a id="registsubmit" class="button button-big button-fill" onclick="edit();"  data-transition='fade'>确定修改</a></p>
            </div>
        </div>
    </div>
</div>
<script>
    function changeNum() {
        var phoneNum = $("#phonenum").val().toString().length;
        if(phoneNum == 11){
            var mobile = /^(13[0-9]{9}|17[0-9]{9}|15[012356789][0-9]{8}|18[0256789][0-9]{8}|147[0-9]{8}$)/;
            if(!mobile.test($("#phonenum").val())){
                $.toast('请输入正确的手机号码！');
                $("#phonenum").focus();
                return false;
            }
            $("#getVer").css('color','#0894ec');
            $("#getVer").removeClass('notClick');
        }
    }
    function isPhoneNum(){
        var phoneNum = $("#phonenum").val().toString().length;
        if(phoneNum != 11){
            $.toast('请输入正确的手机号码！');
            $("#phonenum").focus();
            return false;
        }
    }
    $("#getVer").click(function (){
        var tel = $('#phonenum').val();
        $.ajax({
            url:'<?php echo U("Home/Users/phoneIsUse");?>',
            type:'post',
            data:{
                tel:tel
            },
            success:function(json){
                var code = json.code;
                if(code){
                    //var tel = $('#phonenum').val();
                    $.ajax({
                        url:'<?php echo U("Home/Users/sms");?>',
                        type:'post',
                        data:{
                            tel:tel
                        },
                        success:function(json){
                            $.alert(json.msg);
                            if(json.code == 1){
                                $('#getVer').addClass('button-dark');
                                $('#getVer').attr('disabled','disabled');
                                var timing = 60;
                                var clock = setInterval(function(){
                                    $('#getVer').html( timing + '秒后重新获取');
                                    timing--;
                                    if(timing==0){
                                        clearInterval(clock);
                                        $('#getVer').html('获取验证码');
                                        $('#getVer').removeAttr('disabled');
                                    }
                                },1000);
                            }
                        },
                        error:function(json){
                            console.log(json);
                        }
                    });
                }else {
                    $.alert(json.msg);
                }
            },
            error:function(json){
                console.log(json);

            }
        });



    })

    function edit(){
        var id = "<?php echo session('WST_USER.userId') ?>";
        var code = $('#loginName').val();
        var tel = $('#phonenum').val();
        var phoneNum = $("#phonenum").val().toString().length;
        if(phoneNum == 11){
            var mobile = /^(13[0-9]{9}|17[0-9]{9}|15[012356789][0-9]{8}|18[0256789][0-9]{8}|147[0-9]{8}$)/;
            if(!mobile.test($("#phonenum").val())){
                $.toast('请输入正确的手机号码！');
                $("#phonenum").focus();
                return false;
            }
        }
        if(code.length!=4){$.alert('验证码格式错误')}
        $.ajax({
            url:'<?php echo U("Home/Users/true_sms");?>',
            type:'post',
            data:{
                tel:tel,
                code:code,
                id:id,
            },
            success:function(json){
                if(json.code==1){
                    alert(json.msg);
                    setTimeout(function(){
                        window.location.href = '<?php echo U("Orders/queryByPage");?>';
                    },1000);
                }else{
                    alert(json.msg);
                }
            },
            error:function(json){
                alert(json.msg);
                //window.location.href = '';
            }
        });
    }

</script>
<script>
    $.config = {router: false}          //关闭sui路由功能
</script>
<script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm.min.js' charset='utf-8'></script>
<script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm-extend.min.js' charset='utf-8'></script>
<!--<script type='text/javascript' src="/Apps/Home/View/default/js/back.js" charset='utf-8'></script>-->
<!-- 默认必须要执行$.init(),实际业务里一般不会在HTML文档里执行，通常是在业务页面代码的最后执行 -->
<script type="text/javascript">
    $.init();
//    给当前页面div.page加上page-current以显示
    $(function (){
        var page1st = $(".page").eq(0);
        page1st.addClass("page-current");
    });
    var a = '<?php echo U();?>';

 //        设置nav宽度，使得左右滑动
    var w =0;
    $(".scroll-fix li").each(function(){
        w+=parseInt($(this).width());
    });
    $(".scroll-fix").width(w+10);
</script>
</body>
</html>
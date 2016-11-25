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
    <header class="bar bar-nav">
        <h1 class="title">登录</h1>
    </header>
    
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
                                <div class="item-input">
                                    <input id="loginName" type="text" placeholder="用户名/邮箱">
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item-content">
                            <div class="item-media"><i class="icon iconfont">&#xe617;</i></div>
                            <div class="item-inner">
                                <div class="item-input">
                                    <input id="loginPwd" type="password" placeholder="密码">
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item-content">
                            <div class="item-media"><i class="icon iconfont">&#xe615;</i></div>
                            <div class="item-inner">
                                <div class="item-input input-define">
                                    <input id="verify" type="text" placeholder="请输入验证码">
                                    <label class="img">
                                        <img style='vertical-align:middle;cursor:pointer;height:39px;'
                                             class='verifyImg'
                                             src="<?php echo U('Admin/Base/getVerify');?>"
                                             title='刷新验证码' alt="点击刷新验证码" onclick='getVerify()'/>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="content-block login-register">
                <p><a id="loginsubmit" class="button button-big button-fill" onclick="checkLoginInfo();"
                      data-transition='fade'>登录</a></p>
                <p class='text-center content-padded'>
                    <a href="<?php echo U('Home/Users/regist');?>" class='pull-left'>免费注册</a>
                    <!--<a href="#" class='pull-right'>忘记密码？</a>-->
                </p>
            </div>
        </div>
    </div>
</div>
<script>

    function getVerify() {
        $('.verifyImg').attr('src', "<?php echo U('Home/Users/getVerify');?>" + '&rnd=' + Math.random());
    }

    function checkLoginInfo() {
        var loginName = $.trim($('#loginName').val());
        var loginPwd = $.trim($('#loginPwd').val());
        var verify = $.trim($('#verify').val());
        var rememberPwd = $("#rememberPwd").val();
        if (loginName == "" || loginPwd == "") {
            $.toast("用户名及密码不能为空");
            return false;
        }
        if (verify == "") {
            $.toast("验证码不能为空");
            return false;
        }
        $.post("<?php echo U('Home/Users/checkLogin');?>", {
            loginName: loginName,
            loginPwd: loginPwd,
            verify: verify,
            rememberPwd: rememberPwd
        }, function (data, textStatus) {
            //var json = WST.toJson(data);
            var json = JSON.parse(data);
            if (json.status == '1') {
                $.toast("登录成功");
                location.href = '<?php echo U("Orders/queryByPage");?>';
            } else if (json.status == '-1') {
                $.toast("验证码错误");
                getVerify();
            } else if (json.status == '-2') {
                $.toast("账号或密码错误");
                getVerify();
            }
        });
        return true;
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
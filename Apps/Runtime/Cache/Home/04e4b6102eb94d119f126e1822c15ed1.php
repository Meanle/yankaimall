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
                            <div class="item-media"><i class="icon iconfont">&#xe617;</i></div>
                            <div class="item-inner">
                                <div class="item-input">
                                    <input id='oldPass' name='oldPass' type="password" placeholder="请输入旧密码">
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item-content">
                            <div class="item-media"><i class="icon iconfont">&#xe617;</i></div>
                            <div class="item-inner">
                                <div class="item-input">
                                    <input id='newPass' name='newPass' type="password" placeholder="请输入新密码">
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item-content">
                            <div class="item-media"><i class="icon iconfont">&#xe616;</i></div>
                            <div class="item-inner">
                                <div class="item-input">
                                    <input id='reNewPass' onchange="checkPassWord()" name='reNewPass' type="password" placeholder="请确认密码">
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="content-block login-register">
                <p><a id="editpass" class="button button-big button-fill" onclick="editPass();"  data-transition='fade'>确定修改</a></p>
            </div>
        </div>
    </div>
</div>
<script>
    function checkPassWord() {
        var pass = $('#newPass').val(),
                rePass = $('#reNewPass').val();
        if(pass !== rePass) {
            $.toast('两次输入的密码不一致，请重试！');
            return false;
        }
    }

    function editPass(){
        var params = {};
        params.oldPass = $('#oldPass').val();
        params.newPass = $('#newPass').val();
        params.reNewPass = $('#reNewPass').val();
        $.toast('数据处理中，请稍候...');
        $.post(("<?php echo U('Home/Users/editPass');?>"), params, function (data, textStatus) {
//            var json = JSON.parse(data);
            if(data.status=='1'){
                $.toast("密码修改成功");
                location.href = '<?php echo U("Orders/queryByPage");?>';
            } else {
                $.toast("原密码不正确，请重试！");
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
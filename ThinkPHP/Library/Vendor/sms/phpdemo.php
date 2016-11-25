<?php
$now = gmdate("D, d M Y H:i:s") . " GMT";
header("Date: $now");
header("Expires: $now");
header("Last-Modified: $now");
header("Pragma: no-cache");
header("Cache-Control: no-store, no-cache, max-age=0, must-revalidate");

include_once("phpdemo_func.php");


////服务器参数设置
//    $svr_url = 'http://112.74.76.186:8030/service/httpService/httpInterface.do';   // 服务器接口路径
//    $svr_param = array();
//    $svr_param['username'] = 'JSM41401';    // 账号
//    $svr_param['password'] = 'a1gz4e4g';    // 密码
//    $svr_param['veryCode'] = 'bmlcn4r073qh';    // 通讯认证Key


// 1、获得余额
/*
    $post_data = $svr_param;
    $post_data['method'] = 'getAmount';
    $res = request_post($svr_url, $post_data);
    echo_xmlarr($res);
*/


// 2、发送即时普通短信
/*
    $post_data = $svr_param;
    $post_data['method'] = 'sendMsg';
    $post_data['mobile'] = '138xxxxxxxx';
    $post_data['content']= '您好！您本次验证码为：174687，请勿告知他人';
    $post_data['msgtype']= '1';       // 1-普通短信，2-模板短信
    $post_data['code']   = 'utf-8';   // utf-8,gbk
    $res = request_post($svr_url, $post_data);  // 如果账号开了免审，或者是做模板短信，将会按照规则正常发出，而不会进人工审核平台
    echo_xmlarr($res);
*/


// 3、发送及时模板短信
//  短信模板管理中增加一个模板，编号为JSM40004-0000，内容为：尊敬的@1@你好,您在江苏美圣网站（www.jsmsxx.com），注册的手机验证码为@2@，请在验证页面及时输入。
//  成功发送后，收到的信息形如：尊敬的包先生你好,您在江苏美圣网站（www.jsmsxx.com），注册的手机验证码为874382，请在验证页面及时输入。
/*
    $post_data = $svr_param;
    $post_data['method'] = 'sendMsg';
    $post_data['mobile'] = '138xxxxxxxx';
    $post_data['content']= '@1@=包先生,@2@='.rand(100000,999999);
    $post_data['msgtype']= '2';             // 1-普通短信，2-模板短信
    $post_data['tempid'] = 'JSM40004-0000'; // 模板编号
    $post_data['code']   = 'utf-8';         // utf-8,gbk
    $res = request_post($svr_url, $post_data);  // 如果账号开了免审，或者是做模板短信，将会按照规则正常发出，而不会进人工审核平台
    echo_xmlarr($res);
*/


// 4、获得状态报告
//  只能查询当天的，已获取的状态报告后续不会再获取
/*
    $post_data = $svr_param;
    $post_data['method'] = 'queryReport';
    $res = request_post($svr_url, $post_data);
    echo_xmlarr($res);
*/


// 5、获得上行短信
//  只能查询当天的，已获取的上行短信后续不会再获取
/*
    $post_data = $svr_param;
    $post_data['method'] = 'queryMo';
    $res = request_post($svr_url, $post_data);
    echo_xmlarr($res);
*/


?>
<?php

namespace Home\Action;

use Think\Controller;

/**
 * 微信支付
 */
class BalancePayAction extends BaseAction {
    function createBalancePay(){
        $pkey = base64_decode(I("pkey"));
        $pkeys = explode("@", $pkey);
        $pflag = true;
        if (count($pkeys) != 3) {
            $this->assign('out_trade_no', "");
        } else {
            $morders = D('Home/Orders');
            $obj ["uniqueId"] = $pkeys [1];
            $obj ["orderType"] = $pkeys [2];
            $data = $morders->getPayOrders($obj);
            $orders = $data ["orders"];
            $needPay = $data ["needPay"];
            if ($needPay > 0) {
                $user = M('users')->find(session('WST_USER.userId'));
                if (($user['balance'] - $needPay) < 0){
                    $pflag = false;
                }else{
                    $m = D('Home/Welfare');
                    $m->balancePay(session('WST_USER.userId'),$needPay);

                    $timeStamp = time();
                    $out_trade_no = $timeStamp;

                    $pm = D ( 'Home/Payments' );
                    // 商户订单号
                    $obj = array ();
                    $obj ["trade_no"] = $out_trade_no;
                    $obj ["out_trade_no"] = $pkeys [1];
                    $obj ["orderType"] = $pkeys [2];
                    $obj ["total_fee"] = $needPay * 100;
                    $obj ["userId"] = $user['userId'];
                    $obj ["payFrom"] = 2;
                    // 支付成功业务逻辑
                    $payments = $pm->complatePay ( $obj );
                    S ("$out_trade_no",$needPay * 100);

                }
            }
        }
        if ($pflag) {
            $this->display("default/coffee/pay_success");
        } else {
            $this->error('余额不足！！！');
        }
    }

    function balancePay($money){
        $m = D('Home/Welfare');
        $m->balancePay(session('WST_USER.userId'),$money);
    }
}
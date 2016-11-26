<?php
namespace Home\Action;
/**
 * 会员福利控制器
 */
class WelfareAction extends BaseAction
{
    /**
     * 初始化
     */
    private $wxpayConfig;
    private $wxpay;
    public function _initialize() {
        header ( "Content-type: text/html; charset=utf-8" );
        vendor('WxPay.WxQrcodePay');
        Vendor('WxPayHelper.WxPayHelper');

        $this->wxpayConfig = C ( 'WxPayConf' );
        $m = D ( 'Home/Payments' );
        $this->wxpay = $m->getPayment ( "weixin" );
        $this->wxpayConfig ['appid'] = $this->wxpay ['appId']; // 微信公众号身份的唯一标识
        $this->wxpayConfig ['appsecret'] = $this->wxpay ['appsecret']; // JSAPI接口中获取openid
        $this->wxpayConfig ['mchid'] = $this->wxpay ['mchId']; // 受理商ID
        $this->wxpayConfig ['key'] = $this->wxpay ['apiKey']; // 商户支付密钥Key
        $this->wxpayConfig ['notifyurl'] = $this->wxpayConfig ['NOTIFY_URL'];
        $this->wxpayConfig ['returnurl'] = "";
        // 初始化WxPayConf_pub
        $wxpaypubconfig = new \WxPayConf ( $this->wxpayConfig );
    }

    /***
     * 激活会员卡
     */
    function registerCard()
    {
        $m = D('Home/Welfare');
        $resCode = $m->activate();
        switch ($resCode) {
            case -3://账号或者密码不正确
                $this->error('账号或者密码不正确');
                break;
            case -2://未知错误
                $this->error('未知错误');
                break;
            case -1://用户id不对
                $this->error('用户id不对');
                break;
            case 0://未知错误
                $this->error('卡号已经被使用了');
                break;
            case 1://操作成功
                $this->success('黑金卡激活成功', U('Home/Users/govipEntityByPages'));
                break;
        }
    }

    /***
     * 微信支付购买会员卡
     */
    function buyCardWithWxPay()
    {
        $this->isUserLogin();

        //递交上来的参数
        $cardYear = I('cardYear');
        $wxOpenId = session('WST_USER.wxOpenId');
        $userId = session('WST_USER.userId');
        $fee = 1;
        if ($cardYear == 1) {
            $fee = 200;
        } else if ($cardYear == 2) {
            $fee = 400;
        } else if ($cardYear == 3) {
            $fee = 600;
        }

        $jsApi = new \JsApi();
        $unifiedOrder = new \UnifiedOrder();
        //自定义订单号，此处仅作举例
        $timeStamp = time();
        $out_trade_no = $timeStamp;
        $unifiedOrder->setParameter("openid", $wxOpenId);//商品描述
        $unifiedOrder->setParameter("body", "支付订单費用");//商品描述
        $unifiedOrder->setParameter("out_trade_no", $out_trade_no);//商户订单号
        $unifiedOrder->setParameter("attach", $userId . '@' . $cardYear);// 附加数据，用户id
        $unifiedOrder->setParameter("total_fee", $fee * 100);//总金额
        $unifiedOrder->setParameter("notify_url", WEB_HOST.'/index.php/Home/Welfare/notifyCard');//通知地址
        $unifiedOrder->setParameter("trade_type", "JSAPI");//交易类型
        $prepay_id = $unifiedOrder->getPrepayId();
        //=========步骤3：使用jsapi调起支付============
        $jsApi->setPrepayId($prepay_id);
        $jsApiParameters = $jsApi->getParameters();
        $this->assign("jsApiParameters", $jsApiParameters);
        $this->display("default/oders/jspay");
    }

    /***
     * 余额支付购买会员卡
     */
    function buyCardWithBalancePay()
    {
        $this->isUserLogin();

        //递交上来的参数
        $cardYear = I('cardYear');
        $wxOpenId = session('WST_USER.wxOpenId');
        $userId = session('WST_USER.userId');
        $fee = 1;
        if ($cardYear == 1) {
            $fee = 200;
        } else if ($cardYear == 2) {
            $fee = 400;
        } else if ($cardYear == 3) {
            $fee = 600;
        }

        $user = M('users')->find(session('WST_USER.userId'));
        if (($user['balance'] - $fee) < 0){
            $this->error('余额不足！！！');
        }

        $m = D('Home/Welfare');
        $m->balancePay(session('WST_USER.userId'), $fee);

        //先看看她是不是有卡了
        $usedCard = M('vip_card')->where(array('userId' => session('WST_USER.userId')))->find();
        if ($usedCard) {
            $this->error('你已经购买了会员卡');
        }

        //分配一张会员卡给她
//        $card = M('vip_card')->where(array('userId' => '','cartId'>'NO.000098288'))->find();
        $card = $m->getCard();

        M('vip_card')->where(array('cardId' => $card['cardId']))->save(array(
            'userId' => session('WST_USER.userId'),
            'cardYear' => $cardYear,
            'startTime' => date('Y-m-d H:i:s'),
            'endTime' => date('Y-m-d H:i:s', strtotime("+" . $cardYear . " year")),
            'isActivated' => 1,
        ));

        $this->success('购买黑金卡成功', U('Home/Users/govipEntityByPages'));
    }

    /****
     * 账户充值
     */
    function recharge()
    {
        $this->isUserLogin();
        //递交上来的参数
        $money = I('money');//充值多少钱
        $wxOpenId = session('WST_USER.wxOpenId');
        $userId = session('WST_USER.userId');

        $jsApi = new \JsApi();
        $unifiedOrder = new \UnifiedOrder();
        //自定义订单号，此处仅作举例
        $timeStamp = time();
        $out_trade_no = $timeStamp;
        $unifiedOrder->setParameter("openid", $wxOpenId);//商品描述
        $unifiedOrder->setParameter("body", "支付订单費用");//商品描述
        $unifiedOrder->setParameter("out_trade_no", $out_trade_no);//商户订单号
        $unifiedOrder->setParameter("attach", $userId."@".$money);// 附加数据，用户id
        $unifiedOrder->setParameter("total_fee", $money * 100);//总金额
        $unifiedOrder->setParameter("notify_url", WEB_HOST.'/index.php/Home/Welfare/notifyRecharge');//通知地址
        $unifiedOrder->setParameter("trade_type", "JSAPI");//交易类型
        $prepay_id = $unifiedOrder->getPrepayId();
        //=========步骤3：使用jsapi调起支付============
        $jsApi->setPrepayId($prepay_id);
        $jsApiParameters = $jsApi->getParameters();
        $this->assign("jsApiParameters", $jsApiParameters);
        $this->display("default/oders/jspay");
    }

    /***
     * 腾讯通知支付成功
     */
    function notifyCard()
    {
        // 使用通用通知接口
        $wxpayServer = new \Notify();
        // 存储微信的回调
        $xml = $GLOBALS ['HTTP_RAW_POST_DATA'];
        $wxpayServer->saveData($xml);
        // 验证签名，并回应微信。
        if ($wxpayServer->checkSign() == FALSE) {
            $wxpayServer->setReturnParameter("return_code", "FAIL"); // 返回状态码
            $wxpayServer->setReturnParameter("return_msg", "签名失败"); // 返回信息
        } else {
            $wxpayServer->setReturnParameter("return_code", "SUCCESS"); // 设置返回码
        }
        $returnXml = $wxpayServer->returnXml();
        // ==商户根据实际情况设置相应的处理流程，此处仅作举例=======
        if ($wxpayServer->checkSign() == TRUE) {
            if ($wxpayServer->data ["return_code"] == "FAIL") {
                // 此处应该更新一下订单状态，商户自行增删操作
            } elseif ($wxpayServer->data ["result_code"] == "FAIL") {
                // 此处应该更新一下订单状态，商户自行增删操作
            } else {
                // 此处应该更新一下订单状态，商户自行增删操作
                $order = $wxpayServer->getData();
                $trade_no = $order["transaction_id"];
                $total_fee = $order ["total_fee"];
                $pkey = $order ["attach"];
                $pkeys = explode("@", $pkey);
                $userId = $pkeys [0];
                $cardYear = $pkeys [1];


                //分配一张会员卡给她
                $card = M('vip_card')->where(array('userId' => ''))->find();
                M('vip_card')->where(array('cardId' => $card['cardId']))->save(array(
                    'userId' => $userId,
                    'cardYear' => $cardYear,
                    'startTime' => date('Y-m-d H:i:s'),
                    'endTime' => date('Y-m-d H:i:s', strtotime("+" . $cardYear . " year")),
                    'isActivated' => 1,
                ));

                echo "SUCCESS";
            }
        }
    }

    /***
     * 通知充值支付成功
     */
    function notifyRecharge()
    {

        // 使用通用通知接口
        $wxpayServer = new \Notify();
        // 存储微信的回调
        $xml = $GLOBALS ['HTTP_RAW_POST_DATA'];
        $wxpayServer->saveData($xml);
        // 验证签名，并回应微信。
        if ($wxpayServer->checkSign() == FALSE) {
            $wxpayServer->setReturnParameter("return_code", "FAIL"); // 返回状态码
            $wxpayServer->setReturnParameter("return_msg", "签名失败"); // 返回信息
        } else {
            $wxpayServer->setReturnParameter("return_code", "SUCCESS"); // 设置返回码
        }
        $returnXml = $wxpayServer->returnXml();
        // ==商户根据实际情况设置相应的处理流程，此处仅作举例=======
        if ($wxpayServer->checkSign() == TRUE) {
            if ($wxpayServer->data ["return_code"] == "FAIL") {
                // 此处应该更新一下订单状态，商户自行增删操作
            } elseif ($wxpayServer->data ["result_code"] == "FAIL") {
                // 此处应该更新一下订单状态，商户自行增删操作
            } else {
                // 此处应该更新一下订单状态，商户自行增删操作
                $order = $wxpayServer->getData();
                $trade_no = $order["transaction_id"];
                $total_fee = $order ["total_fee"];
                $pkey = $order ["attach"];
                $pkeys = explode("@", $pkey);
                $userId = $pkeys[0];
                $money = $pkeys[1];
                //用户完成充值
                $welfare = D('Home/Welfare');
                $welfare->recharge($userId, $money);
                echo "SUCCESS";
            }
        }
    }


    function goVipDay()
    {
        if (isValidVip() != 1) {
            $this->error('您不是VIP，请先购买VIP会员');
        }
        if (date("w") != M('sys_configs')
                ->where(array('fieldCode' => 'vipDay'))
                ->getField('fieldValue')[0]['fieldValue']
        ) {
            $this->error('今天不是会员日，你是从哪来的？');
        }
        $this->meta_title = 'VIP DAY';

        $areaId2 = $this->getDefaultCity();
        //获取分类
        $gcm = D('Home/GoodsCats');
        $catList = $gcm->getGoodsCatsAndGoodsForIndex($areaId2);
        $this->assign('catList', $catList);

        $this->display("default/mine/isvip");
    }

    function goBirthDay()
    {
        $user = M('users')->find(session('WST_USER.userId'));
        $userBirths = explode('-', $user['userBirth']);
        $userBirth = $userBirths[1] . '-' . $userBirths[2];
        if ($userBirth != date("m-d")) {
            $this->error('您不是今天生日');
        }

        $this->meta_title = '生日快乐';

        $areaId2 = $this->getDefaultCity();
        //获取分类
        $gcm = D('Home/GoodsCats');
        $catList = $gcm->getGoodsCatsAndGoodsForIndex($areaId2);
        $this->assign('catList', $catList);

        $this->display("default/mine/isbirthvip");
    }
}
<?php
namespace Home\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:
 * 联系QQ:707563272
 * ============================================================================
 * 会员服务类
 */
class WelfareModel extends BaseModel
{
    /****
     * @param string $data
     * @return int return -2;//未知错误 return -1;//没有传用户id过来 return 0;//卡号已经被使用了 return 1;//添加成功
     */
    function activate()
    {
        $data = I();//获得会员卡卡号密码
        $datacardId = "NO." . $data['cardId'];
        if (!session('WST_USER.userId')) {
            return -1;//没有传用户id过来
        }
        if ($datacardId) {
            //表示激活会员卡
            //判断会员卡号是不是已经被使用了
            $card = M('vip_card')
                ->where(array(
                    'cardId' => $datacardId,
                    'cardPassword' => $data['cardPassword'],
                ))
                ->find();
            if (!$card) {
                return -3;
            }
            if ($card['userId']) {
                return 0;//卡号已经被使用了
            }

            $primaryKeyId = M('vip_card')->where(array(
                'cardId' => $datacardId,
                'cardPassword' => $data['cardPassword'],
            ))->save(array(
                'userId' => session('WST_USER.userId'),
                'cardYear' => 1,
                'endTime' => date('Y-m-d H:i:s', strtotime("+1 year")),
                'isActivated' => 1,
            ));
            return 1;//添加成功
        }
        return -2;//未知错误
    }

    function buy()
    {
        $data = I();//获得会员卡卡号密码

        if (session('WST_USER.userId')) {
            return -1;//没有传用户id过来
        }
        if ($data['cardId']) {
            return 0;//卡号已经被使用了
        }
        //支付流程
        $primaryKeyId = M('vip_card')->save(array(
            'userId' => session('WST_USER.userId'),
            'cardId' => $data['cardId'],
            'cardPassword' => $data['cardPassword'],
            'cardYear' => $data['cardYear'],
            'endTime' => date('Y-m-d H:i:s', strtotime("+" . $data['cardYear'] . " year")),
            'isActivated' => 1,
        ));
        if ($primaryKeyId) {
            return 1;//添加成功
        }


        return -2;//未知错误
    }

    function recharge($userId, $money)
    {
        $sql = "UPDATE __PREFIX__users SET balance = balance + $money WHERE userId = $userId";
        $this->execute($sql);
    }

    function balancePay($userId, $money)
    {

        $sql = "UPDATE __PREFIX__users SET balance = balance - $money WHERE userId = $userId";
        $this->execute($sql);
    }


    function getCard()
    {
        $sql = "SELECT * FROM wst_vip_card WHERE cardId > 'NO.000098884' AND cardId < 'NO.000098886' AND userId = '' ";
        $card = $this->queryRow($sql);
        return $card;
    }
}
<?php
namespace Home\Action;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:
 * 联系QQ:707563272
 * ============================================================================
 * 订单控制器
 */
class OrdersAction extends BaseAction {
	/**
	 * 获取待付款的订单列表
	 */
	public function queryByPage(){
        $USER = session('WST_USER');
        if (empty($USER) || ($USER['userId']=='')){
            $this->meta_title = '用户登录';
            $this->display("default/login");
        }else{
            $USER = session('WST_USER');
            session('WST_USER.loginTarget','User');
            //判断会员等级
            $rm = D('Home/UserRanks');
            $USER["userRank"] = $rm->getUserRank();
            session('WST_USER',$USER);
            //获取订单列表
            $morders = D('Home/Orders');
            $obj["userId"] = (int)$USER['userId'];
            $orderList = $morders->queryByPage($obj);
            $statusList = $morders->getUserOrderStatusCount($obj);
            $um = D('Home/Users');
            $user = $um->getUserById(array("userId"=>session('WST_USER.userId')));
            $this->meta_title = '个人中心';
            $this->assign("user", $user);
            $this->assign("userScore",$user['userScore']);
            $this->assign("umark","queryByPage");
            $this->assign("orderList",$orderList);
            $this->assign("statusList",$statusList);
            //判断是不是会员
            if (isValidVip() == 1) {
                $this->assign('vipcard', 1);
            }
            //判断是不是会员日
            $showVipDayEntrance = (date("w") == M('sys_configs')
                    ->where(array('fieldCode' => 'vipDay'))
                    ->getField('fieldValue')[0]['fieldValue']
            ) && session('WST_USER.isVip');
            $this->assign('isVipDay', $showVipDayEntrance);

            $this->display("default/settings");
            return;
        }

	}
	/**
	 * 获取待付款的订单列表
	 */
	public function queryPayByPage(){
		$this->isUserLogin();
        $this->meta_title='我的';
		$USER = session('WST_USER');
		$morders = D('Home/Orders');
		self::WSTAssigns();
		$obj["userId"] = (int)$USER['userId'];
		$payOrders = $morders->queryPayByPage($obj);
		$this->assign("umark","queryPayByPage");
		$this->assign("payOrders",$payOrders);
		$this->display("default/oders/oders");
	}
    /**
	 * 获取待发货的订单列表
	 */
	public function queryDeliveryByPage(){
        $this->meta_title=' 我的订单';
		$this->isUserLogin();
		$USER = session('WST_USER');
		$morders = D('Home/Orders');
		self::WSTAssigns();
		$obj["userId"] = (int)$USER['userId'];
		$deliveryOrders = $morders->queryDeliveryByPage($obj);
		$this->assign("umark","queryDeliveryByPage");
		$this->assign("receiveOrders",$deliveryOrders);
        $this->ajaxReturn($deliveryOrders,'JSON');
	}
    /**
     * 进入实物订单页面
     */
    public function goqueryEntityByPage(){
        $this->assign("type",I("type"));
        $type = I("type");
        $this->meta_title='我的订单';
        $this->display("default/oders/odersentity");
    }

    public function goqueryEntityByPages(){
        $this->meta_title=' 实物订单';
        $this->display("default/oders/odercoffee_sentity");
    }

    /**
     * 进入我的收藏页面
     */
    public function gocollectEntityByPages(){
        $this->display("default/mine/collect");
    }

    /**
     * 进入我的积分商城
     */
    public function gointegralByPages(){
        $ads = D('Home/Ads');
        $areaId2 = $this->getDefaultCity();
        //获取分类
        $gcm = D('Home/GoodsCats');
        $catList = $gcm->getGoodsCatsAndGoodsForIndex($areaId2);
        $this->assign('catList',$catList);

        $catAds = $ads->getAdsByCat($areaId2);
        $this->assign('catAds',$catAds);
        $this->assign('ishome',1);
        $this->display("default/mine/integral");
    }
    /**
     * 进入积分等级
     */
    public function goRanksPage(){
        $this->meta_title='积分等级';
        $this->display("default/mine/int-rules");
    }
    /**
     * 进入积分规则
     */
    public function goRulesPage(){
        $this->meta_title='积分规则';
        $this->display("default/mine/int-rules");
    }

    /**
     * 查询代付款订单
     */
    public function queryEntityByPage(){
        $this->isUserLogin();
        $USER = session('WST_USER');
        $morders = D('Home/Orders');
        self::WSTAssigns();
        $obj["userId"] = (int)$USER['userId'];
        $deliveryOrders = $morders->queryPayByPage($obj);
        $this->ajaxReturn($deliveryOrders,'JSON');
    }
    /**
	 * 获取退款订单列表
	 */
	public function queryRefundByPage(){
		$this->isUserLogin();
		$USER = session('WST_USER');
		$morders = D('Home/Orders');
		self::WSTAssigns();
		$obj["userId"] = (int)$USER['userId'];
		$refundOrders = $morders->queryRefundByPage($obj);
		$this->assign("umark","queryRefundByPage");
		$this->assign("receiveOrders",$refundOrders);
		$this->display("default/users/orders/list_refund");
	}
    /**
	 * 获取收货的订单列表
	 */
	public function queryReceiveByPage(){
		$this->isUserLogin();
		$USER = session('WST_USER');
		$morders = D('Home/Orders');
		self::WSTAssigns();
		$obj["userId"] = (int)$USER['userId'];
		$receiveOrders = $morders->queryReceiveByPage($obj);
        $this->ajaxReturn($receiveOrders,'JSON');
	}
	
	/**
	 * 获取已取消订单
	 */
	public function queryCancelOrders(){
		$this->isUserLogin();
		$USER = session('WST_USER');
		$morders = D('Home/Orders');
		self::WSTAssigns();
		$obj["userId"] = (int)$USER['userId'];
		$receiveOrders = $morders->queryCancelOrders($obj);
		$this->assign("umark","queryCancelOrders");
		$this->assign("receiveOrders",$receiveOrders);
		$this->display("default/users/orders/list_cancel");
	}
    
	/**
	 * 获取待评价订单
	 */
    public function queryAppraiseByPage(){
    	$this->isUserLogin();
    	$USER = session('WST_USER');
    	$morders = D('Home/Orders');
    	self::WSTAssigns();
    	$obj["userId"] = (int)$USER['userId'];
		$appraiseOrders = $morders->queryAppraiseByPage($obj);
        $this->ajaxReturn($appraiseOrders,'JSON');
	}

    public function getfeedbackDetails(){
        $this->display("default/mine/feedback");
    }


	/**
	 * 获取待完成订单
	 */
	public function queryCompleteOrders(){
		$this->isUserLogin();
        $this->meta_title='已完成订单';
		$USER = session('WST_USER');
		$morders = D('Home/Orders');
		self::WSTAssigns();
		$obj["userId"] = (int)$USER['userId'];
		$appraiseOrders = $morders->queryCompleteOrders($obj);
        $this->ajaxReturn($appraiseOrders,'JSON');
	}
	
	/**
	 * 订单詳情-买家专用
	 */
	public function getOrderInfo(){
		$this->isUserLogin();
		$USER = session('WST_USER');
		$morders = D('Home/Orders');
		$obj["userId"] = (int)$USER['userId'];
		$obj["orderId"] = (int)I("orderId");
		$rs = $morders->getOrderDetails($obj);
		$data["orderInfo"] = $rs;
		$this->assign("orderInfo",$rs);
		$this->display("default/order_details");
	}
	
	/**
	 * 取消订单
	 */
    public function orderCancel(){
    	$this->isUserLogin();
    	$USER = session('WST_USER');
    	$morders = D('Home/Orders');
    	$obj["userId"] = (int)$USER['userId'];
    	$obj["orderId"] = (int)I("orderId");
		$rs = $morders->orderCancel($obj);
		$this->ajaxReturn($rs);
	} 
	
	/**
	 * 用户确认收货订单
	 */
    public function orderConfirm(){
    	$this->isUserLogin();
    	$USER = session('WST_USER');
    	$morders = D('Home/Orders');
    	$obj["userId"] = (int)$USER['userId'];
    	$obj["orderId"] = (int)I("orderId");
    	$obj["type"] = (int)I("type");
		$rs = $morders->orderConfirm($obj);
		$this->ajaxReturn($rs);
	} 
	
	/**
	 * 核对订单信息
	 */
	public function checkCoffeeOrderInfo(){
		$this->isUserLogin();
		$maddress = D('Home/UserAddress');
		$mcart = D('Home/Cart');
		$rdata = $mcart->getPayCart();	
	    if($rdata["cartnull"]==1){
			$this->assign("fail_msg",'不能提交空商品的订单!');
            $this->error("还没有选择商品，请重试");
			exit();
		}
		$catgoods = $rdata["cartgoods"];
		$shopColleges = $rdata["shopColleges"];
		$startTime = $rdata["startTime"];
		$endTime = $rdata["endTime"];
		$gtotalMoney = $rdata["gtotalMoney"];//商品总价（去除配送费）
		$totalMoney = $rdata["totalMoney"];//商品总价（含配送费）
		$totalCnt = $rdata["totalCnt"];

		$userId = session('WST_USER.userId');
		//获取地址列表
        $areaId2 = $this->getDefaultCity();
		$addressList = $maddress->queryByUserAndCity($userId,$areaId2);
		$this->assign("addressList",$addressList);
		$this->assign("areaId2",$areaId2);
		//支付方式
		$pm = D('Home/Payments');
		$payments = $pm->getList();
		$this->assign("payments",$payments);
		
		//获取当前市的县区
		$m = D('Home/Areas');
		$areaList2 = $m->getDistricts($areaId2);
		$this->assign("areaList2",$areaList2);
		if($endTime==0){
			$endTime = 24;
			$cstartTime = (floor($startTime))*4;
			$cendTime = (floor($endTime))*4;
		}else{
			$cstartTime = (floor($startTime)+1)*4;
			$cendTime = (floor($endTime)+1)*4;
		}
		if(floor($startTime)<$startTime){
			$cstartTime = $cstartTime + 2;
		}
		if(floor($endTime)<$endTime){
			$cendTime = $cendTime + 2;
		}
		$baseScore = WSTOrderScore();
		$baseMoney = WSTScoreMoney();
		$this->assign("startTime",$cstartTime);
		$this->assign("endTime",$cendTime);
		$this->assign("shopColleges",$shopColleges);
		$this->assign("catgoods",$catgoods);
		$this->assign("gtotalMoney",$gtotalMoney);
		$this->assign("totalMoney",$totalMoney);
		$um = D('Home/Users');
		$user = $um->getUserById(array("userId"=>session('WST_USER.userId')));
        $data['money'] = $user['balance'];
        $this->assign('data', $data);
        $this->assign('userInfo', $user['userPhone']);
		$this->assign("userScore",$user['userScore']);
		$useScore = $baseScore*floor($user["userScore"]/$baseScore);
		$scoreMoney = $baseMoney*floor($user["userScore"]/$baseScore);
		if($totalMoney<$scoreMoney){//订单金额小于积分金额
			$useScore = $baseScore*floor($totalMoney/$baseMoney);
			$scoreMoney = $baseMoney*floor($totalMoney/$baseMoney);
		}
		$this->assign("canUserScore",$useScore);
		$this->assign("scoreMoney",$scoreMoney);

        $this->selectPhone();

		$this->display('default/coffee/coffeecheck');
	}

    /**
     * 检查实物订单
     */
    public function checkOrderInfo(){
        $this->isUserLogin();
        $maddress = D('Home/UserAddress');
        $mcart = D('Home/Cart');
        $rdata = $mcart->getPayCart();
        $this->assign('rdata',$rdata);
        if($rdata["cartnull"]==1){
            $this->assign("fail_msg",'不能提交空商品的订单!');
            $this->error("购物车还没有勾选商品");
            exit();
        }
        $catgoods = $rdata["cartgoods"];
        $shopColleges = $rdata["shopColleges"];
        $startTime = $rdata["startTime"];
        $endTime = $rdata["endTime"];
        $gtotalMoney = $rdata["gtotalMoney"];//商品总价（去除配送费）

        $totalMoney = $rdata["totalMoney"];//商品总价（含配送费）

        $totalCnt = $rdata["totalCnt"];

        $userId = session('WST_USER.userId');
        //获取地址列表
        $areaId2 = $this->getDefaultCity();
        $addressList = $maddress->queryByUserAndCity($userId,$areaId2);
        $this->assign("addressList",$addressList);
        $this->assign("areaId2",$areaId2);
        //支付方式
        $pm = D('Home/Payments');
        $payments = $pm->getList();
        $this->assign("payments",$payments);

        //获取当前市的县区
        $m = D('Home/Areas');
        $areaList2 = $m->getDistricts($areaId2);
        $this->assign("areaList2",$areaList2);
        if($endTime==0){
            $endTime = 24;
            $cstartTime = (floor($startTime))*4;
            $cendTime = (floor($endTime))*4;
        }else{
            $cstartTime = (floor($startTime)+1)*4;
            $cendTime = (floor($endTime)+1)*4;
        }
        if(floor($startTime)<$startTime){
            $cstartTime = $cstartTime + 2;
        }
        if(floor($endTime)<$endTime){
            $cendTime = $cendTime + 2;
        }
        $baseScore = WSTOrderScore();
        $baseMoney = WSTScoreMoney();
        $this->assign("startTime",$cstartTime);
        $this->assign("endTime",$cendTime);
        $this->assign("shopColleges",$shopColleges);
        $this->assign("catgoods",$catgoods);
        $this->assign("gtotalMoney",$gtotalMoney);
        $this->assign("totalMoney",$totalMoney);
        $um = D('Home/Users');
        $user = $um->getUserById(array("userId"=>session('WST_USER.userId')));
        $data['money'] = $user['balance'];
        $this->assign('data', $data);
        $this->assign("userScore",$user['userScore']);
        $useScore = $baseScore*floor($user["userScore"]/$baseScore);
        $scoreMoney = $baseMoney*floor($user["userScore"]/$baseScore);
        if($totalMoney<$scoreMoney){//订单金额小于积分金额
            $useScore = $baseScore*floor($totalMoney/$baseMoney);
            $scoreMoney = $baseMoney*floor($totalMoney/$baseMoney);
        }
        $this->assign("canUserScore",$useScore);
        $this->assign("scoreMoney",$scoreMoney);
        $this->selectPhone();
        $this->display('default/order_check');
    }

    /**
     * 查询手机号码
     */
    public function selectPhone(){
        $m = D('Home/Users');
        $rs = $m->phoneOfUser($_SESSION['WSTMALL']['WST_USER']['userId']);
        $this->assign('rs',$rs);
        if(strlen($rs['userPhone']) == 11){
            $this->assign('Phone',substr($rs['userPhone'],0,3).'****'.substr($rs['userPhone'],7,10));
        }
    }

	/*
	 * 积分商城
	 * */
	public function checkIntegralOrder() {
	    $this->isUserLogin();
        $maddress = D('Home/UserAddress');
        $mcart = D('Home/Cart');
        $rdata = $mcart->getPayCart();
        if($rdata["cartnull"]==1){
            $this->assign("fail_msg",'不能提交空商品的订单!');
            $this->display('default/order_fail');
            exit();
        }
        $catgoods = $rdata["cartgoods"];
        $shopColleges = $rdata["shopColleges"];
        $startTime = $rdata["startTime"];
        $endTime = $rdata["endTime"];
        $gtotalMoney = $rdata["gtotalMoney"];//商品总价（去除配送费）
        $totalMoney = $rdata["totalMoney"];//商品总价（含配送费）
        $totalCnt = $rdata["totalCnt"];

        $userId = session('WST_USER.userId');
        //获取地址列表
        $areaId2 = $this->getDefaultCity();
        $addressList = $maddress->queryByUserAndCity($userId,$areaId2);
        $this->assign("addressList",$addressList);
        $this->assign("areaId2",$areaId2);
        //支付方式
        $pm = D('Home/Payments');
        $payments = $pm->getList();
        $this->assign("payments",$payments);

        //获取当前市的县区
        $m = D('Home/Areas');
        $areaList2 = $m->getDistricts($areaId2);
        $this->assign("areaList2",$areaList2);
        if($endTime==0){
            $endTime = 24;
            $cstartTime = (floor($startTime))*4;
            $cendTime = (floor($endTime))*4;
        }else{
            $cstartTime = (floor($startTime)+1)*4;
            $cendTime = (floor($endTime)+1)*4;
        }
        if(floor($startTime)<$startTime){
            $cstartTime = $cstartTime + 2;
        }
        if(floor($endTime)<$endTime){
            $cendTime = $cendTime + 2;
        }
        $baseScore = WSTOrderScore();
        $baseMoney = WSTScoreMoney();
        $this->assign("startTime",$cstartTime);
        $this->assign("endTime",$cendTime);
        $this->assign("shopColleges",$shopColleges);
        $this->assign("catgoods",$catgoods);
        $this->assign("gtotalMoney",$gtotalMoney);
        $this->assign("totalMoney",$totalMoney);
        $um = D('Home/Users');
        $user = $um->getUserById(array("userId"=>session('WST_USER.userId')));
        $this->assign("userScore",$user['userScore']);
        $useScore = $baseScore*floor($user["userScore"]/$baseScore);
        $scoreMoney = $baseMoney*floor($user["userScore"]/$baseScore);
        if($totalMoney<$scoreMoney){//订单金额小于积分金额
            $useScore = $baseScore*floor($totalMoney/$baseMoney);
            $scoreMoney = $baseMoney*floor($totalMoney/$baseMoney);
        }
        $this->assign("canUserScore",$useScore);
        $this->assign("scoreMoney",$scoreMoney);
        $this->display('default/mine/integralcheck');
    }

    public function updateStatus() {
        $cart = D('Home/Cart');
        $data = $cart->updateStatus();
        $this->ajaxReturn($data);
    }
	
	public function checkUseScore(){
		$mcart = D('Home/Cart');
		$rdata = $mcart->getPayCart();
		if((int)I("isself")){
			$totalMoney = $rdata["gtotalMoney"];//商品总价（去除配送费）
		}else{
			$totalMoney = $rdata["totalMoney"];//商品总价（含配送费）
		}
		
		$baseScore = WSTOrderScore();
		$baseMoney = WSTScoreMoney();
		$um = D('Home/Users');
		$user = $um->getUserById(array("userId"=>session('WST_USER.userId')));
		$useScore = $baseScore*floor($user["userScore"]/$baseScore);
		$scoreMoney = $baseMoney*floor($user["userScore"]/$baseScore);
		if($totalMoney<$scoreMoney){//订单金额小于积分金额
			$useScore = $baseScore*floor($totalMoney/$baseMoney);
			$scoreMoney = $baseMoney*floor($totalMoney/$baseMoney);
		}
		$rs["canUserScore"] = $useScore;
		$rs["scoreMoney"] = $scoreMoney;
		$this->ajaxReturn($rs);
	}
	
	/**
	 * 提交订单信息
	 * 
	 */
	public function submitOrder(){	
		$this->isUserLogin();
		session("WST_ORDER_UNIQUE",null);
		$morders = D('Home/Orders');
		$rs = $morders->submitOrder();
		$this->ajaxReturn($rs);
	}
	/**
	 * 显示下单结果
	 */
	public function orderSuccess(){
		$this->isUserLogin();
		$morders = D('Home/Orders');
		$this->assign("orderInfos",$morders->getOrderListByIds());
		$this->display('default/coffee/order_success');
	}
	
	/**
	 * 检查是否已支付
	 */
	public function checkOrderPay(){
		$morders = D('Home/Orders');
		$USER = session('WST_USER');
		$obj["userId"] = (int)$USER['userId'];
		$rs = $morders->checkOrderPay($obj);
		$this->ajaxReturn($rs);
	}
	
	
	/**
	 * 订单詳情
	 */
	public function getOrderDetails(){
		$this->isUserLogin();
        $this->meta_title = '订单详情';
		$USER = session('WST_USER');
		$morders = D('Home/Orders');
		$obj["userId"] = (int)$USER['userId'];
		$obj["shopId"] = (int)$USER['shopId'];
		$obj["orderId"] = (int)I("orderId");
		$rs = $morders->getOrderDetails($obj);
		$data["orderInfo"] = $rs;
		$this->assign("orderInfo",$rs);
//	    $this->ajaxReturn($rs);
        $this->display('default/oders/orderdetails');
	}
    /**
     * 店铺查看订单詳情
     */
    public function getOrderShopDetails(){
        $this->isUserLogin();
        $this->meta_title = '订单详情';
        $USER = session('WST_USER');
        $morders = D('Home/Orders');

        $obj["userId"] = (int)$USER['userId'];
        $obj["shopId"] = (int)$USER['shopId'];
        $obj["orderId"] = (int)I("orderId");
        $rs = $morders->getOrderDetails($obj);
        $data["orderInfo"] = $rs;
        $this->assign("orderInfo",$rs);
//	    $this->ajaxReturn($rs);
        $this->display('default/shops/orders/details');
    }

    /**
     * coffee订单
     */
    public function getCoffeeOrderDetails(){
        $this->isUserLogin();
        $USER = session('WST_USER');
        $morders = D('Home/Orders');
        self::WSTAssigns();
        $obj["userId"] = (int)$USER['userId'];
        $orderList = $morders->queryByPage($obj);
        $this->assign("orderList",$orderList);
        $this->display("default/oders/oderscoffee");
    }
	
	/*************************************************************************/
	/********************************商家訂單管理*****************************/
	/*************************************************************************/
	/**
	 * 跳转到商家订单列表
	*/
	public function toShopOrdersList(){
		$this->isShopLogin();
        $this->meta_title='订单管理';
		$morders = D('Home/Orders');
		$this->assign("umark","toShopOrdersList");		
		$this->display("default/shops/orders/list");
	}
	/**
	 * 获取商家订单列表
	*/
	public function queryShopOrders(){
		$this->isShopLogin();
		$USER = session('WST_USER');
		$morders = D('Home/Orders');
		$obj["shopId"] = (int)$USER["shopId"];
		$obj["userId"] = (int)$USER['userId'];
		$orders = $morders->queryShopOrders($obj);
		
		$this->ajaxReturn($orders);
	}
	/**
	 * 商家受理订单
	 */
    public function shopOrderAccept(){
    	$this->isShopLogin();
    	$USER = session('WST_USER');
    	$morders = D('Home/Orders');
    	$obj["userId"] = (int)$USER['userId'];
    	$obj["shopId"] = (int)$USER['shopId'];
    	$obj["orderId"] = (int)I("orderId");
		$rs = $morders->shopOrderAccept($obj);
		$this->ajaxReturn($rs);
	} 
    /**
	 * 商家批量受理订单
	 */
    public function batchShopOrderAccept(){
    	$this->isShopLogin();
    	$morders = D('Home/Orders');
		$rs = $morders->batchShopOrderAccept($obj);
		$this->ajaxReturn($rs);
	}
	/**
	 * 商家生产订单
	 */
    public function shopOrderProduce(){
    	$this->isShopLogin();
    	$USER = session('WST_USER');
    	$morders = D('Home/Orders');
    	$obj["userId"] = (int)$USER['userId'];
    	$obj["shopId"] = (int)$USER['shopId'];
    	$obj["orderId"] = (int)I("orderId");
		$rs = $morders->shopOrderProduce($obj);
		$this->ajaxReturn($rs);
	} 
	public function batchShopOrderProduce(){
    	$this->isShopLogin();
    	$morders = D('Home/Orders');
		$rs = $morders->batchShopOrderProduce($obj);
		$this->ajaxReturn($rs);
	} 
	/**
	 * 商家发货配送订单
	 */
    public function shopOrderDelivery(){
    	$this->isShopLogin();
    	$USER = session('WST_USER');
    	$morders = D('Home/Orders');
    	$obj["userId"] = (int)$USER['userId'];
    	$obj["shopId"] = (int)$USER['shopId'];
    	$obj["orderId"] = (int)I("orderId");
        $obj['senderName'] = I('senderName');
        $obj['senderPhone'] = I('senderPhone');
		$rs = $morders->shopOrderDelivery($obj);
		$this->ajaxReturn($rs);
	}
	
    /**
	 * 商家发货配送订单
	 */
    public function batchShopOrderDelivery(){
    	$this->isShopLogin();
    	$morders = D('Home/Orders');
		$rs = $morders->batchShopOrderDelivery($obj);
		$this->ajaxReturn($rs);
	}
	
	/**
	 * 商家确认收货订单
	 */
    public function shopOrderReceipt(){
    	$this->isShopLogin();
    	$USER = session('WST_USER');
    	$morders = D('Home/Orders');
    	$obj["userId"] = (int)$USER['userId'];
    	$obj["shopId"] = (int)$USER['shopId'];
    	$obj["orderId"] = (int)I("orderId");
		$rs = $morders->shopOrderReceipt($obj);
		$this->ajaxReturn($rs);
	} 
	
	/**
	 * 商家同意拒收/不同意拒收
	 */
	public function shopOrderRefund(){
		$this->isShopLogin();
		$USER = session('WST_USER');
    	$morders = D('Home/Orders');
    	$obj["userId"] = (int)$USER['userId'];
    	$obj["shopId"] = (int)$USER['shopId'];
    	$obj["orderId"] = (int)I("orderId");
		$rs = $morders->shopOrderRefund($obj);
		$this->ajaxReturn($rs);
	}
	
	/**
	 * 获取用户订单消息提示
	 */
	public function getUserMsgTips(){
		$this->isUserLogin();
		$morders = D('Home/Orders');
		$USER = session('WST_USER');
		$obj["userId"] = (int)$USER['userId'];
		$statusList = $morders->getUserOrderStatusCount($obj);
		$this->ajaxReturn($statusList);
	}
	
	/**
	 * 获取店铺订单消息提示
	 */
	public function getShopMsgTips(){
		$this->isShopLogin();
		$morders = D('Home/Orders');
		$USER = session('WST_USER');
		$obj["shopId"] = (int)$USER['shopId'];
		$obj["userId"] = (int)$USER['userId'];
		$statusList = $morders->getShopOrderStatusCount($obj);
		$this->ajaxReturn($statusList);
	}
	
}
<?php
namespace Home\Action;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:
 * 联系QQ:707563272
 * ============================================================================
 * 购物车控制器
 */
class CartAction extends BaseAction {
	/**
	 * 跳到购物车列表
	 */
    public function toCart(){
   		$m = D('Home/Cart');
		$cartInfo = $m->getCartInfo();
   		$pnow = (int)I("pnow",0);
   		$this->assign('cartInfo',$cartInfo);
   		$this->display('default/cart_pay_list');

    }
    
    /**
     * 添加商品到购物车(ajax)
     */
	public function addToCartAjax(){
   		$m = D('Home/Cart');
   		$rs = $m->addToCart();
   		$this->ajaxReturn($rs);

    }
    /**
     * 修改购物车商品
     * 
     */
    public function changeCartGoods(){
    	$m = D('Home/Cart');
   		$res = $m->addToCart();
   		echo "{status:1}";
    }
    
	/**
	 * 获取购物车信息
	 * 
	 */
	public function getCartInfo() {
		$m = D('Home/Cart');
		$cartInfo = $m->getCartInfo();
		$axm = (int)I("axm",0);
		if($axm ==1){
			echo json_encode($cartInfo);
		}else{
            $m->unCheckGoods(0);
            $this->assign('sessions',session('WST_USER.loginName'));
			$this->assign('cartInfo',$cartInfo);
            $this->assign("isvip", isValidVip());
			$this->display('default/havecarts');
		}
	}

    /**
     * 获取coffee购物车信息
     *
     */
    public function getCoffeeCartInfo() {
        $m = D('Home/Cart');
        $m->unCheckGoods(1);
        $cartInfo = $m->getCoffeeCartInfo();
        $axm = (int)I("axm",0);
        if($axm ==1){
            echo json_encode($cartInfo);
        }else{
            $this->assign('cartInfo',$cartInfo);
            $this->display('default/coffee/coffeecheck');
        }
    }
	
	/**
	 * 获取购物车商品数量
	 */
	public function getCartGoodCnt(){
		echo json_encode(array("goodscnt"=>WSTCartNum()));
	}
    
	/**
	 * 检测购物车中商品库存
	 * 
	 */
	public function checkCartGoodsStock(){
		$m = D('Home/Cart');
		$res = $m->checkCatGoodsStock();
		echo json_encode($res);

	}
	
	
	
	/**
	 * 删除购物车中的商品
	 * 
	 */
	public function delCartGoods(){	
		$m = D('Home/Cart');	
		$res = $m->delCartGoods();
        $axm = (int)I("axm",0);
        if($axm ==1){
            $cartInfo = $m->getCoffeeCartInfo();
            echo json_encode($cartInfo);
        }else{
            $cartInfo = $m->getCartInfo();
            echo json_encode($cartInfo);
        }
	}
	
	
	/**
	 * 修改购物车中的商品数量
	 * 
	 */
	public function changeCartGoodsNum(){
		
		$data = array();
		$data['goodsId'] = (int)I('goodsId');
		$data['isBook'] = (int)I('isBook');
		$data['goodsAttrId'] = (int)I('goodsAttrId');
		$goods = D('Home/Goods');
		$goodsStock = $goods->getGoodsStock($data);
		$num = (int)I("num");
		if($goodsStock["goodsStock"]>=$num){
			$num = $num>100?100:$num;
		}else{
			$num = (int)$goodsStock["goodsStock"];
		}
		$m = D('Home/Cart');
		$rs = $m->changeCartGoodsnum(abs($num));
		$this->ajaxReturn($goodsStock);
		
	}
	
	/**
	 *去购物车结算
	 * 
	 */
	public function toCatpaylist(){	
		$m = D('Home/Cart');
		$cartInfo = $m->getCartInfo();
		$this->assign("cartInfo",$cartInfo);
		
		$this->display('default/cat_pay_list');
	}
	
}
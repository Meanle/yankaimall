<?php
 namespace Admin\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:
 * 联系QQ:707563272
 * ============================================================================
 * 店铺分类服务类
 */
class ShopsCatsModel extends BaseModel {
	 /**
	  * 获取列表
	  */
	  public function queryByList($shopId,$parentId){
		 return $this->where('shopId='.(int)$shopId.' and catFlag=1 and parentId='.(int)$parentId)->select();
	  }
	 
};
?>
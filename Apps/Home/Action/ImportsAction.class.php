<?php
 namespace Home\Action;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:
 * 联系QQ:707563272
 * ============================================================================
 * 数据导入控制器
 */
class ImportsAction extends BaseAction{
	/**
	 * 数据导入首页
	 */
    public function index(){
    	$this->isShopLogin();
        $this->meta_title = '数据导入';
    	$this->assign("umark","Imports");
    	$this->display('default/shops/import');
	}
};
?>
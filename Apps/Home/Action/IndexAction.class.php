<?php
namespace Home\Action;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:
 * 联系QQ:707563272
 * ============================================================================
 * 首页控制器
 */
class IndexAction extends BaseAction
{

//    public function __construct(){
//        parent::__construct();
//        //初始化系统信息
//        $USER = session('WST_USER');
//        if (!$USER){
//            session("local",$_SERVER["REQUEST_URI"]);
//            redirect(U('Entrepreneurs/login_request'));
//        }
//	}

    /**
     * 获取首页信息
     *
     */
    public function index()
    {
        $this->meta_title = '雁凯跨境馆 | yankaimall.com';
        $ads = D('Home/Ads');
        $areaId2 = $this->getDefaultCity();
        //获取分类
        $gcm = D('Home/GoodsCats');
        $catList = $gcm->getGoodsCatsAndGoodsForIndex($areaId2);
        $this->assign('catList', $catList);

        $catList1 = $gcm->getGoodsCatsAndGoodsForIndexs($areaId2,1);
        $this->assign('catList1', $catList1);
        $catList2 = $gcm->getGoodsCatsAndGoodsForIndexs($areaId2,2);
        $this->assign('catList2', $catList2);
        $catList3 = $gcm->getGoodsCatsAndGoodsForIndexs($areaId2,3);
        $this->assign('catList3', $catList3);
        $catList4 = $gcm->getGoodsCatsAndGoodsForIndexs($areaId2,4);
        $this->assign('catList4', $catList4);

        //分类广告
        $catAds = $ads->getAdsByCat($areaId2);
        $this->assign('catAds', $catAds);
        $this->assign('ishome', 1);

        $user = M('users')->find(session('WST_USER.userId'));
        $userBirths = explode('-', $user['userBirth']);
        $userBirth = $userBirths[1] . '-' . $userBirths[2];
        $isBirthday = 0;
        if ($userBirth == date("m-d")) {
            $isBirthday = 1;
        }
        $this->assign('isBirthday', $isBirthday);
        $isVipday = 0;
        if (isValidVip() == 1 && date("w") == M('sys_configs')
                ->where(array('fieldCode' => 'vipDay'))
                ->getField('fieldValue')[0]['fieldValue']
        ) {
            $isVipday = 1;
        }

        $this->assign('isVipday', $isVipday);
        if (I("changeCity")) {
            echo $_SERVER['HTTP_REFERER'];
        } else {
            $this->display("default/index");
        }
    }
    /**
     * 获取分类信息
     *
     */
    public function classify()
    {
        $this->meta_title = '商品分类 | 雁凯跨境馆';
        $ads = D('Home/Ads');
        $areaId2 = $this->getDefaultCity();
        //获取分类
        $gcm = D('Home/GoodsCats');
        $catList = $gcm->getGoodsCatsAndGoodsForIndex($areaId2);
        $this->assign('catList', $catList);
        //分类广告
        $catAds = $ads->getAdsByCat($areaId2);
        $this->assign('catAds', $catAds);
        $this->assign('ishome', 1);
        $this->display("default/classify/classify");
    }
    /**
     * 此大分类所有商品
     *
     */
    public function classifyone()
    {
        $this->meta_title = '美容彩妆 | 雁凯跨境馆';
        $this->display("default/classify/classifyone");
    }
    /**
     * 某大分类里面的小分类商品
     *
     */
    public function classifytwo()
    {
        $this->meta_title = '面部护理 | 雁凯跨境馆';
        $this->display("default/classify/classifytwo");
    }

    public function goodscart()
    {
        $this->meta_title = '购物车 | 雁凯跨境馆';
        $this->display("default/havecarts");
    }

    public function coffee()
    {
        $this->meta_title = '咖啡馆 | 雁凯跨境馆';
        $ads = D('Home/Ads');
        $areaId2 = $this->getDefaultCity();
        //获取分类
        $gcm = D('Home/GoodsCats');
        $catList = $gcm->getGoodsCatsAndGoodsForIndex($areaId2);
        $this->assign('catList', $catList);

        //获取购物车的数据
        $m = D('Home/Cart');
        $this->assign("cartInfo", $m->getCoffeeCartInfo());

        $m = D('Home/Users');
        $rs = $m->phoneOfUser($_SESSION['WSTMALL']['WST_USER']['userId']);
        $this->assign('rs', $rs);
        if (strlen($rs['userPhone']) == 11) {
            $this->assign('Phone', substr($rs['userPhone'], 0, 3) . '****' . substr($rs['userPhone'], 7, 10));
        }


        $this->display("default/coffee/coffee");
    }

    public function settings()
    {
        $this->meta_title = '我的';
        $USER = session('WST_USER');

        if ($USER) {
            $this->display("default/settings");
        } else {
            $this->display("default/login");
        }

    }

    /**
     * 进入专题页面
     */
    public function gospecialPage()
    {
        $this->display("default/special/special");
    }

    /**
     * 待付款
     */
    public function odercoffee()
    {
        $this->display("default/oders/oderscoffee");
    }

    /**
     * 广告记数
     */
    public function access()
    {
        $ads = D('Home/Ads');
        $ads->statistics((int)I('id'));
    }

    /**
     * 切换城市
     */
    public function changeCity()
    {
        $m = D('Home/Areas');
        $areaId2 = $this->getDefaultCity();
        $provinceList = $m->getProvinceList();
        $cityList = $m->getCityGroupByKey();
        $area = $m->getArea($areaId2);
        $this->assign('provinceList', $provinceList);
        $this->assign('cityList', $cityList);
        $this->assign('area', $area);
        $this->assign('areaId2', $areaId2);
        $this->display("default/change_city");
    }

    /**
     * 跳到用户注册协议
     */
    public function toUserProtocol()
    {
        $this->display("default/user_protocol");
    }

    /**
     * 修改切换城市ID
     */
    public function reChangeCity()
    {
        $this->getDefaultCity();
    }
    /**
     * 清除缓存
     */
    public function cleanAllCache(){
        $this->isLogin();
        $rv = array('status'=>-1);
        $rv['status'] = WSTDelDir(C('WST_RUNTIME_PATH'));
        WSTDelDir(MY_CACHE_PATH);
        $this->ajaxReturn($rv);
    }
    public function cache_clear() {
        $this->WSTDelDir(TEMP_PATH);
    }
}
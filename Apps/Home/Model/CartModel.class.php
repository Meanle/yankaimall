<?php
namespace Home\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:
 * 联系QQ:707563272
 * ============================================================================
 * 购物车服务类
 */
class CartModel extends BaseModel
{

    /**
     * 添加[正常]j商品到购物车
     */
    public function addToCart()
    {
        $rd = array('status' => -1);
        $m = M('cart');
        //判断一下该商品是否正常	出售
        $userId = (int)session('WST_USER.userId');
        $goodsId = (int)I("goodsId");
        $goodsAttrId = (int)I("goodsAttrId");
        $goods = D('Home/Goods')->getGoodsSimpInfo($goodsId, $goodsAttrId);
        if (empty($goods)) return array('status' => -1, 'msg' => '找不到指定的商品!');
        if ($goods['goodsStock'] <= 0) return array('status' => -1, 'msg' => '对不起，商品' . $goods['goodsName'] . '库存不足!');
        $goodsCnt = ((int)I("gcount") > 0) ? (int)I("gcount") : 1;
        $isCheck = 1;
        $rs = false;
        $sql = "select * from __PREFIX__cart where userId=$userId and goodsId=$goodsId and goodsAttrId=$goodsAttrId";
        $row = $this->queryRow($sql);
        if ($row["cartId"] > 0) {
            $data = array();
            $data["goodsCnt"] = $row["goodsCnt"] + $goodsCnt;
            $rs = $m->where("userId=$userId and goodsId=$goodsId and goodsAttrId=$goodsAttrId")->save($data);

        } else {
            $data = array();
            $data["userId"] = $userId;
            $data["goodsId"] = $goodsId;
            $data["isCheck"] = $isCheck;
            $data["goodsAttrId"] = $goodsAttrId;
            $data["goodsCnt"] = $goodsCnt;
            $rs = $m->add($data);
        }
        if (false !== $rs) {
            $rd['status'] = 1;
        }
        return $rd;
    }

    /**
     * 获取商品信息
     */
    public function getGoodsInfo($goodsId, $goodsAttrId = 0)
    {
        $sql = "SELECT g.attrCatId,g.goodsId,g.goodsSn,g.goodsName,g.goodsThums,g.shopId,g.marketPrice,g.shopPrice,g.goodsStock,g.bookQuantity,g.isBook,sp.shopName,sp.shopAtive
				FROM __PREFIX__goods g ,__PREFIX__shops sp WHERE g.shopId=sp.shopId AND goodsFlag=1 and isSale=1 and goodsStatus=1 and g.goodsId = $goodsId";
        $goodslist = $this->queryRow($sql);
        //如果商品有价格属性的话则获取其价格属性
        if (!empty($goodslist) && $goodslist['attrCatId'] > 0) {
            $sql = "select ga.id,ga.attrPrice,ga.attrStock,a.attrName,ga.attrVal,ga.attrId from __PREFIX__attributes a,__PREFIX__goods_attributes ga
			        where a.attrId=ga.attrId and a.catId=" . $goodslist['attrCatId'] . " and a.isPriceAttr=1 
			        and ga.goodsId=" . $goodslist['goodsId'] . " and id=" . $goodsAttrId;
            $priceAttrs = $this->queryRow($sql);
            if (!empty($priceAttrs)) {
                $goodslist['attrId'] = $priceAttrs['attrId'];
                $goodslist['goodsAttrId'] = $priceAttrs['id'];
                $goodslist['attrName'] = $priceAttrs['attrName'];
                $goodslist['attrVal'] = $priceAttrs['attrVal'];
                $goodslist['shopPrice'] = $priceAttrs['attrPrice'];
                $goodslist['goodsStock'] = $priceAttrs['attrStock'];
            }
        }
        $goodslist['goodsAttrId'] = (int)$goodslist['goodsAttrId'];
        return $goodslist;
    }

    /**
     * 获取购物车信息
     */
    public function getCartInfo()
    {
        $mgoods = D('Home/Goods');
        $userId = (int)session('WST_USER.userId');
        $totalMoney = 0;
        $cartgoods = array();
        $sql = "select * from __PREFIX__cart where userId = $userId";
        $shopcart = $this->query($sql);
        for ($i = 0; $i < count($shopcart); $i++) {
            $cgoods = $shopcart[$i];
            $goodsId = (int)$cgoods["goodsId"];
            $goodsAttrId = (int)$cgoods["goodsAttrId"];
            //区分购物车中coffe的商品
            $sql = "SELECT  gc.catName
					FROM __PREFIX__goods g, __PREFIX__goods_cats gc
					WHERE g.goodsId = $goodsId AND gc.catId = g.goodsCatId2";
            $catName = $goods = $this->queryRow($sql);
            if ($catName['catName'] != '咖啡馆') {
                $sql = "SELECT  g.goodsThums,g.goodsId,g.shopPrice,g.isBook,g.goodsName,g.shopId,g.goodsStock,g.shopPrice,g.activePrice,g.isNew,g.isBest,g.isHot,g.isRecomm,g.attrCatId,shop.shopName,shop.qqNo,shop.deliveryType,shop.shopAtive,
					shop.shopTel,shop.shopAddress,shop.deliveryTime,shop.isInvoice, shop.deliveryStartMoney,
					shop.deliveryFreeMoney,shop.deliveryMoney ,g.goodsSn,shop.serviceStartTime,shop.serviceEndTime,cast((g.shopPrice * if(gc.discount=0,1,gc.discount)) as decimal(10,2)) as vipPrice 
					FROM __PREFIX__goods g left join __PREFIX__goods_cats gc on gc.catId=g.goodsCatId3, __PREFIX__shops shop
					WHERE g.goodsId = $goodsId AND g.shopId = shop.shopId AND g.goodsFlag = 1 and g.isSale=1 and g.goodsStatus=1 ";
                $goods = $this->queryRow($sql);
                if ($goods == null) continue;
                //如果商品有价格属性的话则获取其价格属性
                if (!empty($goods) && $goods['attrCatId'] > 0) {

                    $sql = "select ga.id,ga.attrPrice,ga.attrStock,a.attrName,ga.attrVal,ga.attrId from __PREFIX__attributes a,__PREFIX__goods_attributes ga
			             where a.attrId=ga.attrId and a.catId=" . $goods['attrCatId'] . " and a.isPriceAttr=1 
			             and ga.goodsId=" . $goodsId . " and id=" . $goodsAttrId;
                    $priceAttrs = $this->queryRow($sql);
                    if (!empty($priceAttrs)) {
                        $goods['goodsAttrId'] = $priceAttrs['id'];
                        $goods['attrName'] = $priceAttrs['attrName'];
                        $goods['attrVal'] = $priceAttrs['attrVal'];
                        $goods['shopPrice'] = $priceAttrs['attrPrice'];
                        $goods['goodsStock'] = $priceAttrs['attrStock'];
                    }
                }
                //如果new，recommen，best，hot=0
                if($goods ['isNew']==1 || $goods ['isBest']==1 || $goods['isHot']==1 || $goods['isRecomm']==1) {
                    $goods ['shopPrice'] = $goods ['activePrice'];
                    $goods ['vipPrice'] = $goods ['activePrice'];
                }


                $goods['goodsAttrId'] = (int)$goods['goodsAttrId'];

                if ($goods["isBook"] == 1) {
                    $goods["goodsStock"] = $goods["goodsStock"] + $goods["bookQuantity"];
                }
                $goods["cnt"] = $cgoods["goodsCnt"];
                $goods["ischk"] = $cgoods["isCheck"];
                if ($goods["ischk"] == 1) {
                    if(isValidVip() == 1){
                        $totalMoney += $goods["cnt"] * $goods["vipPrice"];
                    }else{
                        $totalMoney += $goods["cnt"] * $goods["shopPrice"];
                    }
                    $cartgoods[$goods["shopId"]]["ischk"] = 1;
                }

                $cartgoods[$goods["shopId"]]["shopgoods"][] = $goods;
                $cartgoods[$goods["shopId"]]["deliveryFreeMoney"] = $goods["deliveryFreeMoney"];//店铺免运费最低金额
                $cartgoods[$goods["shopId"]]["deliveryMoney"] = $goods["deliveryMoney"];//店铺配送费
                $cartgoods[$goods["shopId"]]["deliveryStartMoney"] = $goods["deliveryStartMoney"];//店铺配送费
                $cartgoods[$goods["shopId"]]["totalCnt"] = $cartgoods[$goods["shopId"]]["totalCnt"] + $cgoods["goodsCnt"];
                $cartgoods[$goods["shopId"]]["totalMoney"] = $cartgoods[$goods["shopId"]]["totalMoney"] + (($goods["ischk"] == 1) ? $goods["cnt"] * $goods["shopPrice"] : 0);
            }
        }

        $cartInfo = array();
        $cartInfo["gtotalMoney"] = $totalMoney;

        foreach ($cartgoods as $key => $cshop) {
            if ($cshop["totalMoney"] < $cshop["deliveryFreeMoney"] && $cshop["ischk"] == 1) {
                $totalMoney = $totalMoney + $cshop["deliveryMoney"];
            }
        }

        $cartInfo["totalMoney"] = $totalMoney;
        $cartInfo["cartgoods"] = $cartgoods;
        return $cartInfo;

    }

    /**
     * 获取coffee购物车信息
     */
    public function getCoffeeCartInfo()
    {
        $mgoods = D('Home/Goods');
        $userId = (int)session('WST_USER.userId');
        $totalMoney = 0;
        $cartgoods = array();
        $sql = "select * from __PREFIX__cart where userId = $userId";
        $shopcart = $this->query($sql);
        for ($i = 0; $i < count($shopcart); $i++) {
            $cgoods = $shopcart[$i];
            $goodsId = (int)$cgoods["goodsId"];
            $goodsAttrId = (int)$cgoods["goodsAttrId"];
            //区分购物车中coffe的商品
            $sql = "SELECT  gc.catName
					FROM __PREFIX__goods g, __PREFIX__goods_cats gc
					WHERE g.goodsId = $goodsId AND gc.catId = g.goodsCatId2";
            $catName = $goods = $this->queryRow($sql);
            if ($catName['catName'] == '咖啡馆') {
                $sql = "SELECT  g.goodsThums,g.goodsId,g.shopPrice,g.isBook,g.goodsName,g.shopId,g.goodsStock,g.shopPrice,g.attrCatId,shop.shopName,shop.qqNo,shop.deliveryType,shop.shopAtive,
					shop.shopTel,shop.shopAddress,shop.deliveryTime,shop.isInvoice, shop.deliveryStartMoney,
					shop.deliveryFreeMoney,shop.deliveryMoney ,g.goodsSn,shop.serviceStartTime,shop.serviceEndTime,cast((g.shopPrice * if(gc.discount=0,1,gc.discount)) as decimal(10,2)) as vipPrice 
					FROM __PREFIX__goods g left join __PREFIX__goods_cats gc on gc.catId=g.goodsCatId3, __PREFIX__shops shop
					WHERE g.goodsId = $goodsId AND g.shopId = shop.shopId AND g.goodsFlag = 1 and g.isSale=1 and g.goodsStatus=1 ";
                $goods = $this->queryRow($sql);
                if ($goods == null) continue;
                //如果商品有价格属性的话则获取其价格属性
                if (!empty($goods) && $goods['attrCatId'] > 0) {

                    $sql = "select ga.id,ga.attrPrice,ga.attrStock,a.attrName,ga.attrVal,ga.attrId from __PREFIX__attributes a,__PREFIX__goods_attributes ga
			             where a.attrId=ga.attrId and a.catId=" . $goods['attrCatId'] . " and a.isPriceAttr=1 
			             and ga.goodsId=" . $goodsId . " and id=" . $goodsAttrId;
                    $priceAttrs = $this->queryRow($sql);
                    if (!empty($priceAttrs)) {
                        $goods['goodsAttrId'] = $priceAttrs['id'];
                        $goods['attrName'] = $priceAttrs['attrName'];
                        $goods['attrVal'] = $priceAttrs['attrVal'];
                        $goods['shopPrice'] = $priceAttrs['attrPrice'];
                        $goods['goodsStock'] = $priceAttrs['attrStock'];
                    }
                }
                $goods['goodsAttrId'] = (int)$goods['goodsAttrId'];

                if ($goods["isBook"] == 1) {
                    $goods["goodsStock"] = $goods["goodsStock"] + $goods["bookQuantity"];
                }
                $goods["cnt"] = $cgoods["goodsCnt"];
                $goods["ischk"] = $cgoods["isCheck"];
                if ($goods["ischk"] == 1) {
                    if(isValidVip() == 1){
                        $totalMoney += $goods["cnt"] * $goods["vipPrice"];
                    }else{
                        $totalMoney += $goods["cnt"] * $goods["shopPrice"];
                    }
                    $cartgoods[$goods["shopId"]]["ischk"] = 1;
                }

                $cartgoods[$goods["shopId"]]["shopgoods"][] = $goods;
                $cartgoods[$goods["shopId"]]["deliveryFreeMoney"] = $goods["deliveryFreeMoney"];//店铺免运费最低金额
                $cartgoods[$goods["shopId"]]["deliveryMoney"] = $goods["deliveryMoney"];//店铺配送费
                $cartgoods[$goods["shopId"]]["deliveryStartMoney"] = $goods["deliveryStartMoney"];//店铺配送费
                $cartgoods[$goods["shopId"]]["totalCnt"] = $cartgoods[$goods["shopId"]]["totalCnt"] + $cgoods["goodsCnt"];
                $cartgoods[$goods["shopId"]]["totalMoney"] = $cartgoods[$goods["shopId"]]["totalMoney"] + (($goods["ischk"] == 1) ? $goods["cnt"] * $goods["shopPrice"] : 0);
            }
        }

        $cartInfo = array();
        $cartInfo["gtotalMoney"] = $totalMoney;

        foreach ($cartgoods as $key => $cshop) {
            if ($cshop["totalMoney"] < $cshop["deliveryFreeMoney"] && $cshop["ischk"] == 1) {
                $totalMoney = $totalMoney + $cshop["deliveryMoney"];
            }
        }

        $cartInfo["totalMoney"] = $totalMoney;
        $cartInfo["cartgoods"] = $cartgoods;
        return $cartInfo;

    }

    public function getPayCart()
    {

        $userId = (int)session('WST_USER.userId');
        $mgoods = D('Home/Goods');
        $maddress = D('Home/UserAddress');
        $sql = "select * ,cast((g.shopPrice * if(gc.discount=0,1,gc.discount)) as decimal(10,2)) as vipPrice
                from __PREFIX__cart wstc left join __PREFIX__goods g on g.goodsId=wstc.goodsId left join __PREFIX__goods_cats gc on gc.catId=g.goodsCatId3
                where userId = $userId and isCheck=1 and goodsCnt>0";
        $shopcart = $this->query($sql);
        $cartgoods = array();
        $shopColleges = array();
        $startTime = 0;
        $endTime = 24;

        $gtotalMoney = 0;//商品总价（去除配送费）
        $totalMoney = 0;//商品总价（含配送费）
        $totalCnt = 0;

        if (empty($shopcart)) {
            $rdata["cartnull"] = 1;
            return $rdata;
        }
        $paygoods = array();
        //foreach($shopcart as $key=>$cgoods){
        for ($i = 0; $i < count($shopcart); $i++) {
            $cgoods = $shopcart[$i];
            $obj["goodsId"] = (int)$cgoods["goodsId"];
            $obj["goodsAttrId"] = (int)$cgoods["goodsAttrId"];

            $paygoods[] = $obj["goodsId"];
            $goods = $mgoods->getGoodsForCheck($obj);
            if ($goods["isBook"] == 1) {
                $goods["goodsStock"] = $goods["goodsStock"] + $goods["bookQuantity"];
            }
            $goods["ischk"] = $cgoods["isCheck"];
            $goods["cnt"] = $cgoods["goodsCnt"];
            $goods["vipPrice"] = $cgoods["vipPrice"];
            $totalCnt += $cgoods["goodsCnt"];

            //如果new，recommen，best，hot=0
            if($goods['isNew']==1 || $goods['isBest']==1 || $goods['isHot']==1 || $goods['isRecomm']==1) {
                $goods['shopPrice'] = $goods['activePrice'];
                $goods['vipPrice'] = $goods['activePrice'];
            }

            $totalMoney += $goods["cnt"] * $goods["shopPrice"];
            $gtotalMoney += $goods["cnt"] * $goods["shopPrice"];

            $ommunitysId = $maddress->getShopCommunitysId($goods["shopId"]);
            $shopColleges[$goods["shopId"]] = $ommunitysId;
            if ($startTime < $goods["startTime"]) {
                $startTime = $goods["startTime"];
            }
            if ($endTime > $goods["endTime"]) {
                $endTime = $goods["endTime"];
            }
            $cartgoods[$goods["shopId"]]["shopgoods"][] = $goods;
            $cartgoods[$goods["shopId"]]["deliveryFreeMoney"] = $goods["deliveryFreeMoney"];//店铺免运费最低金额
            $cartgoods[$goods["shopId"]]["deliveryMoney"] = $goods["deliveryMoney"];//店铺配送费
            $cartgoods[$goods["shopId"]]["deliveryStartMoney"] = $goods["deliveryStartMoney"];//店铺配送费
            $cartgoods[$goods["shopId"]]["totalCnt"] = $cartgoods[$goods["shopId"]]["totalCnt"] + $cgoods["goodsCnt"];
            if(isValidVip()==1){
                $cartgoods[$goods["shopId"]]["totalMoney"] = $cartgoods[$goods["shopId"]]["totalMoney"] + ($goods["cnt"] * $goods["vipPrice"]);

            }else{
                $cartgoods[$goods["shopId"]]["totalMoney"] = $cartgoods[$goods["shopId"]]["totalMoney"] + ($goods["cnt"] * $goods["shopPrice"]);

            }

        }

        foreach ($cartgoods as $key => $cshop) {
            if ($cshop["totalMoney"] < $cshop["deliveryFreeMoney"]) {
                $totalMoney = $totalMoney + $cshop["deliveryMoney"];
            }
        }
        session('WST_PAY_GOODS', $paygoods);
        $rdata["totalMoney"] = $totalMoney;
        $rdata["totalCnt"] = $totalCnt;
        $rdata["gtotalMoney"] = $gtotalMoney;
        $rdata["cartgoods"] = $cartgoods;
        $rdata["shopColleges"] = $shopColleges;
        $rdata["startTime"] = $startTime;
        $rdata["endTime"] = $endTime;
//        dump($totalMoney);die;
        return $rdata;
    }

    /**
     * 检测购物车中商品库存
     */
    public function checkCatGoodsStock()
    {

        $mgoods = D('Home/Goods');
        $userId = (int)session('WST_USER.userId');
        $cartgoods = array();
        $sql = "select * from __PREFIX__cart where userId = $userId";
        $shopcart = $this->query($sql);

        for ($i = 0; $i < count($shopcart); $i++) {
            $cgoods = $shopcart[$i];
            $goodsId = (int)$cgoods["goodsId"];
            $goodsAttrId = (int)$cgoods["goodsAttrId"];

            $obj = array();
            $obj["goodsId"] = $goodsId;
            $obj["goodsAttrId"] = $goodsAttrId;
            $goods = $mgoods->getGoodsStock($obj);
            if ($goods["isBook"] == 1) {
                $goods["goodsStock"] = $goods["goodsStock"] + $goods["bookQuantity"];
            }
            $goods['goodsAttrId'] = $goodsAttrId;
            $goods["cnt"] = $cgoods["goodsCnt"];
            $goods["stockStatus"] = ($goods["goodsStock"] >= $goods["cnt"]) ? 1 : 0;
            $cartgoods[] = $goods;
        }

        return $cartgoods;

    }

    /**
     * 核对商品信息
     */
    public function checkGoodsStock()
    {

        $mgoods = D('Home/Goods');
        $userId = (int)session('WST_USER.userId');
        $cartgoods = array();
        $sql = "select * from __PREFIX__cart where userId = $userId and isCheck=1 ";
        $shopcart = $this->query($sql);

        for ($i = 0; $i < count($shopcart); $i++) {
            $cgoods = $shopcart[$i];
            $goodsId = (int)$cgoods["goodsId"];
            $goodsAttrId = (int)$cgoods["goodsAttrId"];

            $goods = $mgoods->getGoodsInfo($goodsId, $goodsAttrId);
            if ($goods["isBook"] == 1) {
                $goods["goodsStock"] = $goods["goodsStock"] + $goods["bookQuantity"];
            }
            $goods['goodsAttrId'] = $goodsAttrId;
            $goods["cnt"] = $cgoods["goodsCnt"];
            $cartgoods[] = $goods;
        }

        return $cartgoods;

    }


    /**
     * 删除购物车中的商品
     */
    public function delCartGoods()
    {
        $rd = array('status' => -1);
        $userId = (int)session('WST_USER.userId');
        $goodsId = (int)I("goodsId");
        $goodsAttrId = (int)I("goodsAttrId");
        $sql = "delete from __PREFIX__cart where userId=$userId and goodsId=$goodsId and goodsAttrId=$goodsAttrId";
        $rs = $this->execute($sql);
        if (false !== $rs) {
            $rd['status'] = 1;
        }
        return $rd;

    }

    /**
     * 修改购物车中的商品数量
     *
     */
    public function changeCartGoodsnum($goodsCnt)
    {

        $rd = array('status' => -1);
        $m = M('cart');
        //判断一下该商品是否正常	出售
        $userId = (int)session('WST_USER.userId');
        $goodsId = (int)I("goodsId");
        $goodsAttrId = (int)I("goodsAttrId");

        //$goodsCnt = abs((int)I("num"));
        $isCheck = (int)I("ischk", 0);
        $sql = "select * from __PREFIX__cart where userId=$userId and goodsId=$goodsId and goodsAttrId=$goodsAttrId";
        $row = $this->queryRow($sql);
        if ($row["cartId"] > 0) {
            $data = array();
            $data["isCheck"] = $isCheck;
            $data["goodsCnt"] = $goodsCnt;
            $rs = $m->where("userId=$userId and goodsId=$goodsId and goodsAttrId=$goodsAttrId")->save($data);
            if (false !== $rs) {
                $rd['status'] = 1;
            }
        }
        return $rd;
    }

    /***
     * 取消勾选一类商品
     * @param $isCoffeeCart 是不是咖啡购物车
     */
    public function unCheckGoods($isCoffeeCart)
    {
        if ($isCoffeeCart) {
            //取消勾选所有的实物
            $sql = "UPDATE wst_cart SET isCheck = 0 WHERE goodsId not in (select a.goodsid from (select c.goodsid from wst_cart c, wst_goods g, wst_goods_cats gc where c.goodsId = g.goodsId and g.goodsCatId2 = gc.catId and gc.catName = '咖啡馆') a)";
            $this->execute($sql);
            $sql = "UPDATE wst_cart SET isCheck = 1 WHERE goodsId in (select a.goodsid from (select c.goodsid from wst_cart c, wst_goods g, wst_goods_cats gc where c.goodsId = g.goodsId and g.goodsCatId2 = gc.catId and gc.catName = '咖啡馆') a)";
            $this->execute($sql);
        } else {
            //取消勾选所有的咖啡
            $sql = "UPDATE wst_cart SET isCheck = 0 WHERE goodsId in (select a.goodsid from (select c.goodsid from wst_cart c, wst_goods g, wst_goods_cats gc where c.goodsId = g.goodsId and g.goodsCatId2 = gc.catId and gc.catName = '咖啡馆') a)";
            $this->execute($sql);
            $sql = "UPDATE wst_cart SET isCheck = 1 WHERE goodsId not in (select a.goodsid from (select c.goodsid from wst_cart c, wst_goods g, wst_goods_cats gc where c.goodsId = g.goodsId and g.goodsCatId2 = gc.catId and gc.catName = '咖啡馆') a)";
            $this->execute($sql);
        }
    }

}
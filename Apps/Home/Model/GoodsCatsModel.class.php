<?php
namespace Home\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:
 * 联系QQ:707563272
 * ============================================================================
 * 商品分类服务类
 */
class GoodsCatsModel extends BaseModel {
   /**
	* 获取列表
	*/
	public function queryByList($pid = 0){
	    $m = M('goods_cats');
	    $rs = $m->where('catFlag=1 and parentId='.$pid)->select(); 
		return $rs;
	}
    /**
     * 获取商品分类及商品
     */
	public function getGoodsCatsAndGoodsForIndex($areaId2){
		$cats = S("WST_CACHE_GOODS_CAT_GOODS_WEB_".$areaId2);
		if(!$cats){
			//取出前十个被精选促销的一级分类,上限10层,可通过修改排序来调整顺序
			$sql = "select catId,catName from __PREFIX__goods_cats WHERE parentId = 0 AND isShow =1 AND isFloor = 1 AND catFlag = 1 order by catSort asc limit 10";
			$rs1 = $this->query($sql);
			$cats = array();
			//取出所有一级分类下对应的被精选促销的二级分类,上限8个
			for ($i = 0; $i < count($rs1); $i++) {
				$cat1Id = $rs1[$i]["catId"];
				$sql = "select catId,catName from __PREFIX__goods_cats WHERE parentId = $cat1Id AND isShow =1 AND isFloor = 1 AND catFlag = 1 order by catSort asc limit 8";
				$rs2 = $this->query($sql);
				$cats2 = array();
				for ($j = 0; $j < count($rs2); $j++) {
					//取出二级分类下对应的被精选促销的三级分类的前10个,可通过修改排序来调整顺序
					$cat2Id = $rs2[$j]["catId"];
					$sql = "select catId,catName from __PREFIX__goods_cats WHERE parentId = $cat2Id AND isShow =1  AND isFloor = 1 AND catFlag = 1 order by catSort asc";
					$rs3 = $this->query($sql);
					$cats3 = array();
					for ($k = 0; $k < count($rs3); $k++) {
						$cats3[] = $rs3[$k];
					}
					$rs2[$j]["catChildren"] = $cats3;
			
					//查询二级分类下的商品
					$sql = "SELECT sp.shopName, g.saleCount , sp.shopId , g.goodsId , g.goodsName,g.goodsImg, g.goodsCatId3, g.goodsThums,g.shopPrice, g.goodsSn,ga.id goodsAttrId,ga.attrPrice,cast((g.shopPrice * if(gc.discount=0,1,gc.discount)) as decimal(10,2)) as vipPrice 
							FROM __PREFIX__goods g left join __PREFIX__goods_cats gc on gc.catId=g.goodsCatId3 left join __PREFIX__goods_attributes ga on g.goodsId=ga.goodsId and ga.isRecomm=1, __PREFIX__shops sp
							WHERE g.shopId = sp.shopId AND sp.shopStatus = 1 AND g.goodsFlag = 1 AND g.isSale = 1 AND g.goodsStatus = 1 AND g.goodsCatId2 = $cat2Id AND sp.areaId2=$areaId2
							ORDER BY gc.catSort desc limit 100";
					$grs = $this->query($sql);
					foreach ($grs as $gkey => $v){
						if(intval($v['goodsAttrId'])>0)$grs[$gkey]['shopPrice'] = $v['attrPrice'];
					}
					$rs2[$j]["goods"] = $grs;
					$cats2[] = $rs2[$j];
				}
			
				//查询二级分类下的商品
				$sql = "SELECT sp.shopName, g.saleCount , sp.shopId , g.goodsId , g.goodsName,g.goodsImg, g.goodsCatId3, g.goodsThums,g.shopPrice, g.goodsSn,ga.id goodsAttrId,ga.attrPrice,(g.shopPrice * if(gc.discount=0,1,gc.discount))as decimal(10,2)) as vipPrice
						FROM __PREFIX__goods g left join __PREFIX__goods_cats gc on gc.catId=g.goodsCatId3 left join __PREFIX__goods_attributes ga on g.goodsId=ga.goodsId and ga.isRecomm=1, __PREFIX__shops sp
						WHERE g.shopId = sp.shopId AND sp.shopStatus = 1 AND g.goodsFlag = 1 AND g.isAdminBest = 1 AND g.isSale = 1 AND g.goodsStatus = 1 AND g.goodsCatId1 = $cat1Id AND sp.areaId2=$areaId2
						ORDER BY gc.catSort desc limit 100";
				$jgrs = $this->query($sql);
			    foreach ($jgrs as $gkey => $v){
					if(intval($v['goodsAttrId'])>0)$jgrs[$gkey]['shopPrice'] = $v['attrPrice'];
				}
				$rs1[$i]["jpgoods"] = $jgrs;
				$rs1[$i]["catChildren"] = $cats2;
				$cats[] = $rs1[$i];
			}
			S("WST_CACHE_GOODS_CAT_GOODS_WEB_".$areaId2,$cats,31536000);
		}
		//获取每个分类精选促销的店铺
		if($cats){
			$recommendShops = S("WST_CACHE_RECOMM_SHOP_".$areaId2);
		    if(!$recommendShops){
		    	$recommendShops = array();
				//获取楼层精选促销商店
				foreach ($cats as $key =>$v){
					$obj["areaId2"] = $areaId2;
					$obj["goodsCatId1"] = $v['catId'];
					$rs = self::getRecommendShops($obj);
					$recommendShops[$obj["goodsCatId1"]] =$rs;
				}
				S("WST_CACHE_RECOMM_SHOP_".$areaId2,$recommendShops,86400);
		    }
		    foreach ($cats as $key =>$v){
		    	$cats[$key]['recommendShops'] = $recommendShops[$v['catId']];
		    }
		}
		return $cats;
	}

    public function getGoodsCatsAndGoodsForIndexs($areaId2,$sum){

            //取出前十个被精选促销的一级分类,上限10层,可通过修改排序来调整顺序
            $sql = "select catId,catName from __PREFIX__goods_cats WHERE parentId = 0 AND isShow =1 AND isFloor = 1 AND catFlag = 1 order by catSort asc limit 10";
            $rs1 = $this->query($sql);
            $cats = array();
            //取出所有一级分类下对应的被精选促销的二级分类,上限8个
            for ($i = 0; $i < count($rs1); $i++) {
                $cat1Id = $rs1[$i]["catId"];
                $sql = "select catId,catName from __PREFIX__goods_cats WHERE parentId = $cat1Id AND isShow =1 AND isFloor = 1 AND catFlag = 1 order by catSort asc limit 8";
                $rs2 = $this->query($sql);
                $cats2 = array();
                for ($j = 0; $j < count($rs2); $j++) {
                    //取出二级分类下对应的被精选促销的三级分类的前10个,可通过修改排序来调整顺序
                    $cat2Id = $rs2[$j]["catId"];
                    $sql = "select catId,catName from __PREFIX__goods_cats WHERE parentId = $cat2Id AND isShow =1  AND isFloor = 1 AND catFlag = 1 order by catSort asc";
                    $rs3 = $this->query($sql);
                    $cats3 = array();
                    for ($k = 0; $k < count($rs3); $k++) {
                        $cats3[] = $rs3[$k];
                    }
                    $rs2[$j]["catChildren"] = $cats3;

                    //查询二级分类下的商品
                    if ($sum == 1){
                        $sql = "SELECT sp.shopName, g.saleCount , sp.shopId , g.goodsId , g.goodsName,g.goodsImg, g.goodsCatId3, g.goodsThums,g.shopPrice, g.marketPrice,g.activePrice, g.goodsSn,ga.id goodsAttrId,ga.attrPrice,cast((g.shopPrice * if(gc.discount=0,1,gc.discount)) as decimal(10,2)) as vipPrice 
							FROM __PREFIX__goods g left join __PREFIX__goods_cats gc on gc.catId=g.goodsCatId3 left join __PREFIX__goods_attributes ga on g.goodsId=ga.goodsId and ga.isRecomm=1, __PREFIX__shops sp
							WHERE  g.isBest = 1 AND g.shopId = sp.shopId AND sp.shopStatus = 1 AND g.goodsFlag = 1 AND g.isSale = 1 AND g.goodsStatus = 1 AND g.goodsCatId2 = $cat2Id AND sp.areaId2=$areaId2
							ORDER BY gc.catSort desc limit 100";
                    }elseif ($sum == 2){
                        $sql = "SELECT sp.shopName, g.saleCount , sp.shopId , g.goodsId , g.goodsName,g.goodsImg, g.goodsCatId3, g.goodsThums,g.shopPrice, g.marketPrice,g.activePrice, g.goodsSn,ga.id goodsAttrId,ga.attrPrice,cast((g.shopPrice * if(gc.discount=0,1,gc.discount)) as decimal(10,2)) as vipPrice 
							FROM __PREFIX__goods g left join __PREFIX__goods_cats gc on gc.catId=g.goodsCatId3 left join __PREFIX__goods_attributes ga on g.goodsId=ga.goodsId and ga.isRecomm=1, __PREFIX__shops sp
							WHERE g.isHot = 1 AND g.shopId = sp.shopId AND sp.shopStatus = 1 AND g.goodsFlag = 1 AND g.isSale = 1 AND g.goodsStatus = 1 AND g.goodsCatId2 = $cat2Id AND sp.areaId2=$areaId2
							ORDER BY gc.catSort desc limit 100";
                    }elseif ($sum == 3){
                        $sql = "SELECT sp.shopName, g.saleCount , sp.shopId , g.goodsId , g.goodsName,g.goodsImg, g.goodsCatId3, g.goodsThums,g.shopPrice, g.marketPrice, g.activePrice,g.goodsSn,ga.id goodsAttrId,ga.attrPrice,cast((g.shopPrice * if(gc.discount=0,1,gc.discount)) as decimal(10,2)) as vipPrice 
							FROM __PREFIX__goods g left join __PREFIX__goods_cats gc on gc.catId=g.goodsCatId3 left join __PREFIX__goods_attributes ga on g.goodsId=ga.goodsId and ga.isRecomm=1, __PREFIX__shops sp
							WHERE g.isRecomm = 1 AND g.shopId = sp.shopId AND sp.shopStatus = 1 AND g.goodsFlag = 1 AND g.isSale = 1 AND g.goodsStatus = 1 AND g.goodsCatId2 = $cat2Id AND sp.areaId2=$areaId2
							ORDER BY gc.catSort desc limit 100";
                    }else{
                        $sql = "SELECT sp.shopName, g.saleCount , sp.shopId , g.goodsId , g.goodsName,g.goodsImg, g.goodsCatId3, g.goodsThums,g.shopPrice, g.marketPrice,g.activePrice ,g.goodsSn,ga.id goodsAttrId,ga.attrPrice,cast((g.shopPrice * if(gc.discount=0,1,gc.discount)) as decimal(10,2)) as vipPrice 
							FROM __PREFIX__goods g left join __PREFIX__goods_cats gc on gc.catId=g.goodsCatId3 left join __PREFIX__goods_attributes ga on g.goodsId=ga.goodsId and ga.isRecomm=1, __PREFIX__shops sp
							WHERE g.isNew = 1 AND g.shopId = sp.shopId AND sp.shopStatus = 1 AND g.goodsFlag = 1 AND g.isSale = 1 AND g.goodsStatus = 1 AND g.goodsCatId2 = $cat2Id AND sp.areaId2=$areaId2
							ORDER BY gc.catSort desc limit 100";
                    }
                    $grs = $this->query($sql);
                    foreach ($grs as $gkey => $v){
                        if(intval($v['goodsAttrId'])>0)$grs[$gkey]['shopPrice'] = $v['attrPrice'];
                        $grs[$gkey]['shopPrice'] = $v['activePrice'];
                    }
                    $rs2[$j]["goods"] = $grs;
                    $cats2[] = $rs2[$j];
                }

                //查询二级分类下的商品
                if ($sum == 1){
                    $sql = "SELECT sp.shopName, g.saleCount , sp.shopId , g.goodsId , g.goodsName,g.goodsImg, g.goodsCatId3, g.goodsThums,g.shopPrice,g.activePrice, g.marketPrice, g.goodsSn,ga.id goodsAttrId,ga.attrPrice,(g.shopPrice * if(gc.discount=0,1,gc.discount))as decimal(10,2)) as vipPrice
						FROM __PREFIX__goods g left join __PREFIX__goods_cats gc on gc.catId=g.goodsCatId3 left join __PREFIX__goods_attributes ga on g.goodsId=ga.goodsId and ga.isRecomm=1, __PREFIX__shops sp
						WHERE g.isBest = 1 AND g.shopId = sp.shopId AND sp.shopStatus = 1 AND g.goodsFlag = 1 AND g.isAdminBest = 1 AND g.isSale = 1 AND g.goodsStatus = 1 AND g.goodsCatId1 = $cat1Id AND sp.areaId2=$areaId2
						ORDER BY gc.catSort desc limit 100";
                }elseif ($sum == 2){
                    $sql = "SELECT sp.shopName, g.saleCount , sp.shopId , g.goodsId , g.goodsName,g.goodsImg, g.goodsCatId3, g.goodsThums,g.shopPrice,g.activePrice, g.marketPrice, g.goodsSn,ga.id goodsAttrId,ga.attrPrice,(g.shopPrice * if(gc.discount=0,1,gc.discount))as decimal(10,2)) as vipPrice
						FROM __PREFIX__goods g left join __PREFIX__goods_cats gc on gc.catId=g.goodsCatId3 left join __PREFIX__goods_attributes ga on g.goodsId=ga.goodsId and ga.isRecomm=1, __PREFIX__shops sp
						WHERE  g.isHot = 1 AND g.shopId = sp.shopId AND sp.shopStatus = 1 AND g.goodsFlag = 1 AND g.isAdminBest = 1 AND g.isSale = 1 AND g.goodsStatus = 1 AND g.goodsCatId1 = $cat1Id AND sp.areaId2=$areaId2
						ORDER BY gc.catSort desc limit 100";
                }elseif ($sum == 3){
                    $sql = "SELECT sp.shopName, g.saleCount , sp.shopId , g.goodsId , g.goodsName,g.goodsImg, g.goodsCatId3, g.goodsThums,g.shopPrice,g.activePrice,g.marketPrice, g.goodsSn,ga.id goodsAttrId,ga.attrPrice,(g.shopPrice * if(gc.discount=0,1,gc.discount))as decimal(10,2)) as vipPrice
						FROM __PREFIX__goods g left join __PREFIX__goods_cats gc on gc.catId=g.goodsCatId3 left join __PREFIX__goods_attributes ga on g.goodsId=ga.goodsId and ga.isRecomm=1, __PREFIX__shops sp
						WHERE g.isRecomm = 1 AND g.shopId = sp.shopId AND sp.shopStatus = 1 AND g.goodsFlag = 1 AND g.isAdminBest = 1 AND g.isSale = 1 AND g.goodsStatus = 1 AND g.goodsCatId1 = $cat1Id AND sp.areaId2=$areaId2
						ORDER BY gc.catSort desc limit 100";
                }else{
                    $sql = "SELECT sp.shopName, g.saleCount , sp.shopId , g.goodsId , g.goodsName,g.goodsImg, g.goodsCatId3, g.goodsThums,g.shopPrice,g.activePrice,g.marketPrice, g.goodsSn,ga.id goodsAttrId,ga.attrPrice,(g.shopPrice * if(gc.discount=0,1,gc.discount))as decimal(10,2)) as vipPrice
						FROM __PREFIX__goods g left join __PREFIX__goods_cats gc on gc.catId=g.goodsCatId3 left join __PREFIX__goods_attributes ga on g.goodsId=ga.goodsId and ga.isRecomm=1, __PREFIX__shops sp
						WHERE g.isNew = 1 AND g.shopId = sp.shopId AND sp.shopStatus = 1 AND g.goodsFlag = 1 AND g.isAdminBest = 1 AND g.isSale = 1 AND g.goodsStatus = 1 AND g.goodsCatId1 = $cat1Id AND sp.areaId2=$areaId2
						ORDER BY gc.catSort desc limit 100";
                }
                $jgrs = $this->query($sql);
                foreach ($jgrs as $gkey => $v){
                    if(intval($v['goodsAttrId'])>0)$jgrs[$gkey]['shopPrice'] = $v['attrPrice'];
                    $grs[$gkey]['shopPrice'] = $v['activePrice'];
                }
                $rs1[$i]["jpgoods"] = $jgrs;
                $rs1[$i]["catChildren"] = $cats2;
                $cats[] = $rs1[$i];
            }

        return $cats;
    }

	
    /**
	 * 获取每个楼层精选促销的商店
	 *
	 */
	public function getRecommendShops($obj){
		$areaId2 = $obj["areaId2"];
		$goodsCatId1 = $obj["goodsCatId1"];
		$sql = "SELECT  COUNT(odr.orderId) as shopcnt, shop.shopId,shop.shopName,shop.shopImg FROM __PREFIX__shops shop
					LEFT JOIN __PREFIX__orders odr ON shop.shopId = odr.shopId
					WHERE shop.goodsCatId1 = $goodsCatId1 AND shopFlag = 1 AND shopStatus = 1 AND shopAtive = 1 AND shop.areaId2 = $areaId2
					GROUP BY shop.shopId ORDER BY shopcnt DESC limit 4 ";
		$recommendShops = $this->query($sql);
		return $recommendShops;
	}
};
?>
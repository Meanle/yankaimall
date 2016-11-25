<?php

namespace Home\Action;

class NewsAction extends BaseAction {


    public function MessageReceive() {
        $echoStr = $_GET["echostr"];
        if ($echoStr){
            $weixin = A('Weixin');
            $weixin->valid();
        }else{
            $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            if (!empty($postStr)) {

                //开发阶段编写日志文件用来测试
                $user = S('user');
                $user[] = array(
                    'time' => date("Y-m-d H:i:s"),
                    'content' => $postStr
                );
                S('user', $user);
//            $uesr = $postObj->FromUserName;
//            $user_S = S($uesr);
//

                $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $RX_TYPE = trim($postObj->MsgType);
                switch ($RX_TYPE) {
                    case "text":
                        $resultStr = $this->receiveText($postObj);
                        break;
                    case "image":
                        $resultStr = $this->receiveImage($postObj);
                        break;
                    case "location":
                        $resultStr = $this->receiveLocation($postObj);
                        break;
                    case "voice":
                        $resultStr = $this->receiveVoice($postObj);
                        break;
                    case "video":
                        $resultStr = $this->receiveVideo($postObj);
                        break;
                    case "shortvideo":
                        $resultStr = $this->receiveShortVideo($postObj);
                        break;
                    case "link":
                        $resultStr = $this->receiveLink($postObj);
                        break;
                    case "event":
                        $resultStr = $this->receiveEvent($postObj);
                        break;
                    default:
                        $resultStr = $this->transmitText($postObj, "unknow msg type: " . $RX_TYPE);
                        break;
                }
                echo $resultStr;
                exit;
            } else {
                echo $this->transmitText($postObj, "你好像不是微信来的哦");
                exit;
            }
        }



    }

    //接收文本消息
    private function receiveText($object) { 
        $keyword = trim($object->Content);
        if ($keyword == 1) {
            $user = S($object->FromUserName);
            if ($user == 1) {
                S($object->FromUserName, 2);
                return $this->transmitText($object, '您好，请发送视频（注意不是小视频而是视频文件哦）');
            } else {
                S($object->FromUserName, NULL);
                return $this->transmitText($object, '您好，您的操作顺序有问题');

            }
        }
        $url = "http://api.qingyunke.com/api.php?key=free&appid=0&msg=" . $keyword;
        $output = file_get_contents($url, $keyword);
        $contentArray = json_decode($output, true);
        $resultStr = $this->transmitText($object, $keyword);
        return $resultStr;
    }


    //接收事件，关注等
    private function receiveEvent($object) {
        switch ($object->Event) {
            case "subscribe":
                $content = '';  //关注后回复内容
                $contentStr = $this->transmitText($object, $content);
                break;
            case "unsubscribe":
                $contentStr = "";
                break;
            case "CLICK":
                $contentStr = $this->receiveClick($object);    //点击事件
                break;
            case "LOCATION":
                M('user')
                    ->where("openid='%s'", array($object->FromUserName))
                    ->save(array('address_coord' => $object->Longitude.','.$object->Latitude));
                $contentStr = '';
                break;
            default:
                $contentStr = "receive a new event: " . $object->Event;
                break;
        }

        return $contentStr;
    }

    //接收图片
    private function receiveImage($object) {
        $contentStr = "你发送的是图片，地址为：" . $object->PicUrl;
        Qiniufetch($object->PicUrl, $contentStr);
        $resultStr = $this->transmitText($object, $contentStr);
        return $resultStr;
    }


    //接收语音
    private function receiveVoice($object) {
        $contentStr = "你发送的是语音，媒体ID为：" . $object->MediaId;
        $resultStr = $this->transmitText($object, $contentStr);
        return $resultStr;
    }

    //接收视频
    private function receiveVideo($object) {
        $user = S($object->FromUserName);
        if ($user != 2) return $this->transmitText($object, '您好，您的操作顺序有问题');
        $UrlStr = "http://file.api.weixin.qq.com/cgi-bin/media/get?access_token=" . Getaccess_tooken() . "&media_id=" . $object->MediaId;
        $contentStr = "你发送的是视频，下载链接为：" . $UrlStr;
        $QiuniuURL = "";
        if (Qiniufetch($UrlStr, $QiuniuURL)) {
            $contentStr = '用户' . $object->FromUserName . '的视频上传成功 ' . $contentStr . ' 已经转存到七牛，地址为:' . $QiuniuURL;
        } else {
            $contentStr = $contentStr . ' 转存到七牛失败，错误消息为:' . $QiuniuURL;
        }
        $resultStr = $this->transmitText($object, $contentStr);
        return $resultStr;
    }

    //接收短视频
    private function receiveShortVideo($object) {
        $contentStr = "你发送的是短视频，下载链接为：" . "http://file.api.weixin.qq.com/cgi-bin/media/get?access_token=" . Getaccess_tooken() . "&media_id=" . $object->MediaId;
        $resultStr = $this->transmitText($object, $contentStr);
        return $resultStr;
    }

    //位置消息
    private function receiveLocation($object) {
        $contentStr = "你发送的是位置，纬度为：" . $object->Location_X . "；经度为：" . $object->Location_Y . "；缩放级别为：" . $object->Scale . "；位置为：" . $object->Label;
        $resultStr = $this->transmitText($object, $contentStr);
        return $resultStr;
    }

    //链接消息
    private function receiveLink($object) {
        $contentStr = "你发送的是链接，标题为：" . $object->Title . "；内容为：" . $object->Description . "；链接地址为：" . $object->Url;
        $resultStr = $this->transmitText($object, $contentStr);
        return $resultStr;
    }


    //点击菜单消息
    private function receiveClick($object) {
        switch ($object->EventKey) {
            case "1":
                $contentStr = "猫咪酱个性DIY服装，
我们专业定制个性【班服，情侣装，亲子装等，有长短T恤，卫衣，长短裤】 
来图印制即可，给你温馨可爱的TA，
有事可直接留言微信";
                break;

            case "2":


                $contentStr = "你点击了菜单: " . $object->EventKey;
                break;

            case "3":
                $contentStr = "是傻逼";
                break;

            default:
                $contentStr = "你点击了菜单: " . $object->EventKey;
                break;
        }


        //两种回复
        if (is_array($contentStr)) {
            $resultStr = $this->transmitNews($object, $contentStr);
        } else {
            $resultStr = $this->transmitText($object, $contentStr);
        }
        return $resultStr;
    }

    //回复文本消息
    private function transmitText($object, $content) {
        $textTpl = "<xml>
        <ToUserName><![CDATA[%s]]></ToUserName>
        <FromUserName><![CDATA[%s]]></FromUserName>
        <CreateTime>%s</CreateTime>
        <MsgType><![CDATA[text]]></MsgType>
        <Content><![CDATA[%s]]></Content>
        </xml>";
        $resultStr = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time(), $content);
        return $resultStr;
    }


    //回复图文
    private function transmitNews($object, $arr_item) {
        if (!is_array($arr_item))
            return;
        $itemTpl = "    <item>
        <Title><![CDATA[%s]]></Title>
        <Description><![CDATA[%s]]></Description>
        <PicUrl><![CDATA[%s]]></PicUrl>
        <Url><![CDATA[%s]]></Url>
     </item>";
        $item_str = "";
        foreach ($arr_item as $item)
            $item_str .= sprintf($itemTpl, $item['Title'], $item['Description'], $item['PicUrl'], $item['Url']);
        $newsTpl = "<xml>
        <ToUserName><![CDATA[%s]]></ToUserName>
        <FromUserName><![CDATA[%s]]></FromUserName>
        <CreateTime>%s</CreateTime>
        <MsgType><![CDATA[news]]></MsgType>
        <Content><![CDATA[]]></Content>
        <ArticleCount>%s</ArticleCount>
        <Articles>
        $item_str</Articles>
        </xml>";
        $resultStr = sprintf($newsTpl, $object->FromUserName, $object->ToUserName, time(), count($arr_item));
        return $resultStr;
    }


    //音乐消息
    private function transmitMusic($object, $musicArray, $flag = 0) {
        $itemTpl = "<Music>
        <Title><![CDATA[%s]]></Title>
        <Description><![CDATA[%s]]></Description>
        <MusicUrl><![CDATA[%s]]></MusicUrl>
        <HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
        </Music>";
        $item_str = sprintf($itemTpl, $musicArray['Title'], $musicArray['Description'], $musicArray['MusicUrl'], $musicArray['HQMusicUrl']);
        $textTpl = "<xml>
        <ToUserName><![CDATA[%s]]></ToUserName>
        <FromUserName><![CDATA[%s]]></FromUserName>
        <CreateTime>%s</CreateTime>
        <MsgType><![CDATA[music]]></MsgType>
        $item_str
        <FuncFlag>%d</FuncFlag>
        </xml>";
        $resultStr = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time(), $flag);
        return $resultStr;
    }

//    /**
//     * 此接口为设置菜单接口，使用之后请注释
//     */
//    public function memu()
//    {
//
//        $data = array(
//            'button' => array(
//                array(
//                    'name' =>'创业者',
//                    'sub_button' => array(
//                        array('type' =>'click','name' =>'成为创业者','key' => 'YH_CWCYZ'),
//                        array('type' =>'pic_photo_or_album','name' =>'上传介绍视频','key' => 'CYZ_VIOD'),
//                    ),
//                ),
//                array('name' =>'微信网站', 'key' => 'YH_WEB', 'type' => 'view','url' =>C('NOW_URL').'/Weixin/Entrepreneurs/login_request')
//
//            ),
//        );
//
//        $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".Getaccess_tooken();
//        //echo json_encode($data);
//        echo JX_curl($url,$data);
//    }
}
<?php

namespace Iamzz\Dingtalk\Tests\MsgType;

use Iamzz\Dingtalk\MsgType\Link;
use PHPUnit\Framework\TestCase;

/**
 * Class LinkTest
 * @package Iamzz\Dingtalk\Tests\MsgType
 */
class LinkTest extends TestCase
{

    public function testToJson()
    {
        //不带picUrl测试
        $title = '时代的火车向前开';
        $text = '这个即将发布的新版本，创始人xx称它为红树林。而在此之前，每当面临重大升级，产品经理们都会取一个应景的代号，这一次，为什么是红树林';
        $messageUrl = 'https://www.dingtalk.com/s?__biz=MzA4NjMwMTA2Ng==&mid=2650316842&idx=1&sn=60da3ea2b29f1dcc43a7c8e4a7c97a16&scene=2&srcid=09189AnRJEdIiWVaKltFzNTw&from=timeline&isappinstalled=0&key=&ascene=2&uin=&devicetype=android-23&version=26031933&nettype=WIFI';
        $linkObject = new Link($title, $text, $messageUrl);
        $expectedJson = '{"msgtype": "link", "link": {"text": "这个即将发布的新版本，创始人xx称它为红树林。而在此之前，每当面临重大升级，产品经理们都会取一个应景的代号，这一次，为什么是红树林", "title": "时代的火车向前开", "messageUrl": "https://www.dingtalk.com/s?__biz=MzA4NjMwMTA2Ng==&mid=2650316842&idx=1&sn=60da3ea2b29f1dcc43a7c8e4a7c97a16&scene=2&srcid=09189AnRJEdIiWVaKltFzNTw&from=timeline&isappinstalled=0&key=&ascene=2&uin=&devicetype=android-23&version=26031933&nettype=WIFI"}}';
        static::assertJsonStringEqualsJsonString($expectedJson, $linkObject->toJson());

        //带picUrl测试
        $linkObject = new Link($title, $text, $messageUrl);
        $linkObject->setPicUrl('https://ding-doc.oss-cn-beijing.aliyuncs.com/images/1216/1570679827267-6243216b-d1c3-48b7-9b1e-0f0b4211b50b.png');
        $expectedJson = '{"msgtype": "link", "link": {"text": "这个即将发布的新版本，创始人xx称它为红树林。而在此之前，每当面临重大升级，产品经理们都会取一个应景的代号，这一次，为什么是红树林", "title": "时代的火车向前开", "messageUrl": "https://www.dingtalk.com/s?__biz=MzA4NjMwMTA2Ng==&mid=2650316842&idx=1&sn=60da3ea2b29f1dcc43a7c8e4a7c97a16&scene=2&srcid=09189AnRJEdIiWVaKltFzNTw&from=timeline&isappinstalled=0&key=&ascene=2&uin=&devicetype=android-23&version=26031933&nettype=WIFI","picUrl":"https://ding-doc.oss-cn-beijing.aliyuncs.com/images/1216/1570679827267-6243216b-d1c3-48b7-9b1e-0f0b4211b50b.png"}}';
        static::assertJsonStringEqualsJsonString($expectedJson, $linkObject->toJson());
    }
}

<?php

namespace Iamzzcn\Tests;

use Iamzzcn\Dingding;
use Iamzzcn\MsgType\Link;
use Iamzzcn\MsgType\MessageInterface;
use Iamzzcn\MsgType\Text;
use PHPUnit\Framework\TestCase;

/**
 * dingding测试类
 * Class DingdingTest
 * @package Iamzzcn\Tests
 */
class DingdingTest extends TestCase
{
    private $token = '4e545098b3b0f09cc34d6755dfb78fd86b0528d8bf557e2c7e47ae7ed5b45aae';
    private $secret = 'SEC72e4cfc3e4e60f8a3f9b35425924f1dd7f0677e1aed367cfa7098e24ba44f22e';

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testSend()
    {
        $dd = new Dingding($this->token, $this->secret);

        $textObject = new Text('我就是我, 是不一样的烟火');
        $this->assertInstanceOf(MessageInterface::class, $textObject);
        $this->assertIsBool($dd->send($textObject));

        $title = '时代的火车向前开';
        $text = '这个即将发布的新版本，创始人xx称它为红树林。而在此之前，每当面临重大升级，产品经理们都会取一个应景的代号，这一次，为什么是红树林';
        $messageUrl = 'https://www.dingtalk.com/s?__biz=MzA4NjMwMTA2Ng==&mid=2650316842&idx=1&sn=60da3ea2b29f1dcc43a7c8e4a7c97a16&scene=2&srcid=09189AnRJEdIiWVaKltFzNTw&from=timeline&isappinstalled=0&key=&ascene=2&uin=&devicetype=android-23&version=26031933&nettype=WIFI';
        $linkObject = new Link($title, $text, $messageUrl);
        $this->assertInstanceOf(MessageInterface::class, $linkObject);
        $this->assertIsBool($dd->send($linkObject));
    }
}
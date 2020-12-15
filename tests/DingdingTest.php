<?php

namespace Iamzz\Tests;

use GuzzleHttp\Exception\GuzzleException;
use Iamzz\Dingding;
use Iamzz\MsgType\ActionCard;
use Iamzz\MsgType\FeedCard;
use Iamzz\MsgType\Link;
use Iamzz\MsgType\Markdown;
use Iamzz\MsgType\MessageInterface;
use Iamzz\MsgType\Text;
use PHPUnit\Framework\TestCase;

/**
 * dingding测试类
 * Class DingdingTest
 *
 * @package Iamzz\Tests
 */
class DingdingTest extends TestCase
{
    private $token = '4e545098b3b0f09cc34d6755dfb78fd86b0528d8bf557e2c7e47ae7ed5b45aae';
    private $secret = 'SEC72e4cfc3e4e60f8a3f9b35425924f1dd7f0677e1aed367cfa7098e24ba44f22e';

    /**
     * @throws GuzzleException
     */
    public function testSend()
    {
        $dd = new Dingding($this->token, $this->secret);
        //text
        $message = new Text('我就是我, {a}是不一样的烟火');
        $message->setAtMobiles(['a' => '188xxxx8888']);
        $message->setIsAll(true);
        static::assertInstanceOf(MessageInterface::class, $message);
        static::assertIsBool($dd->send($message));
        //link
        $title = '时代的火车向前开';
        $text = '这个即将发布的新版本，创始人xx称它为红树林。而在此之前，每当面临重大升级，产品经理们都会取一个应景的代号，这一次，为什么是红树林';
        $messageUrl = 'https://www.dingtalk.com/s?__biz=MzA4NjMwMTA2Ng==&mid=2650316842&idx=1&sn=60da3ea2b29f1dcc43a7c8e4a7c97a16&scene=2&srcid=09189AnRJEdIiWVaKltFzNTw&from=timeline&isappinstalled=0&key=&ascene=2&uin=&devicetype=android-23&version=26031933&nettype=WIFI';
        $message = new Link($title, $text, $messageUrl);
        static::assertInstanceOf(MessageInterface::class, $message);
        static::assertIsBool($dd->send($message));
        //markdown
        $title = '杭州天气';
        $text = "#### 杭州天气 {a} \n> 9度，西北风1级，空气良89，相对温度73%\n> ![screenshot](https://img.alicdn.com/tfs/TB1NwmBEL9TBuNjy1zbXXXpepXa-2400-1218.png)\n> ###### 10点20分发布 [天气](https://www.dingtalk.com) \n";
        $message = new Markdown($title, $text);
        $message->setAtMobiles(['a' => '188xxxx8888']);
        static::assertInstanceOf(MessageInterface::class, $message);
        static::assertIsBool($dd->send($message));
        //整体跳转ActionCard类型
        $title = '乔布斯 20 年前想打造一间苹果咖啡厅，而它正是 Apple Store 的前身';
        $text = "![screenshot](https://gw.alicdn.com/tfs/TB1ut3xxbsrBKNjSZFpXXcXhFXa-846-786.png)\n ### 乔布斯 20 年前想打造的苹果咖啡厅\n Apple Store 的设计正从原来满满的科技感走向生活化，而其生活化的走向其实可以追溯到 20 年前苹果一个建立咖啡馆的计划";
        $buttons = [
            '阅读全文' => 'https://www.dingtalk.com/',
        ];
        $message = new ActionCard($title, $text, $buttons);
        static::assertInstanceOf(MessageInterface::class, $message);
        static::assertIsBool($dd->send($message));
        //独立跳转ActionCard类型
        $buttons = [
            '阅读全文1' => 'https://www.dingtalk.com/',
            '阅读全文2' => 'https://www.dingtalk.com/',
        ];
        $message = new ActionCard($title, $text, $buttons);
        static::assertInstanceOf(MessageInterface::class, $message);
        static::assertIsBool($dd->send($message));
        $message = new ActionCard($title, $text, $buttons, true);
        static::assertInstanceOf(MessageInterface::class, $message);
        static::assertIsBool($dd->send($message));
        //feed card
        $feedCardData = [
            [
                'title'      => '时代的火车向前开1',
                'messageURL' => 'https://www.dingtalk.com/',
                'picURL'     => 'https://img.alicdn.com/tfs/TB1NwmBEL9TBuNjy1zbXXXpepXa-2400-1218.png',
            ],
            [
                'title'      => '时代的火车向前开2',
                'messageURL' => 'https://www.dingtalk.com/',
                'picURL'     => 'https://img.alicdn.com/tfs/TB1NwmBEL9TBuNjy1zbXXXpepXa-2400-1218.png',
            ],
        ];
        $message = new FeedCard($feedCardData);
        static::assertInstanceOf(MessageInterface::class, $message);
        static::assertIsBool($dd->send($message));
    }
}
<?php

namespace Iamzz\Dingtalk\Tests\MsgType;

use Iamzz\Dingtalk\MsgType\Text;
use PHPUnit\Framework\TestCase;

/**
 * Class TextTest
 * @package Iamzz\Dingtalk\Tests\MsgType
 */
class TextTest extends TestCase
{

    public function testToJson()
    {
        //基础text类型消息测试
        $textObject = new Text('我就是我, 是不一样的烟火');
        $expectedJson = '{"msgtype": "text", "text": {"content": "我就是我, 是不一样的烟火"}}';
        static::assertJsonStringEqualsJsonString($expectedJson, $textObject->toJson());

        //带有@功能消息测试
        $textObject = new Text('我就是我, 是不一样的烟火{a}');
        $textObject->setAtMobiles([
            'a' => '188xxxx8888'
        ]);
        $expectedJson = '{"msgtype": "text", "text": {"content": "我就是我, 是不一样的烟火@188xxxx8888"},"at":{"atMobiles":["188xxxx8888"]}}';
        static::assertJsonStringEqualsJsonString($expectedJson, $textObject->toJson());

        //带有@所有的消息测试
        $textObject = new Text('我就是我, 是不一样的烟火');
        $textObject->setIsAll(true);
        $expectedJson = '{"msgtype": "text", "text": {"content": "我就是我, 是不一样的烟火"},"at":{"isAtAll":true}}';
        static::assertJsonStringEqualsJsonString($expectedJson, $textObject->toJson());

        //带有@某个人和@所有人消息测试
        $textObject = new Text('我就是我, 是不一样的烟火{a}');
        $textObject->setAtMobiles([
            'a' => '188xxxx8888'
        ]);
        $textObject->setIsAll(true);
        $expectedJson = '{"msgtype": "text", "text": {"content": "我就是我, 是不一样的烟火@188xxxx8888"},"at":{"atMobiles":["188xxxx8888"],"isAtAll":true}}';
        static::assertJsonStringEqualsJsonString($expectedJson, $textObject->toJson());
    }
}

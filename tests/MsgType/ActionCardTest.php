<?php

namespace Iamzz\Dingtalk\Tests\MsgType;

use Iamzz\Dingtalk\MsgType\ActionCard;
use PHPUnit\Framework\TestCase;

/**
 * Class ActionCardTest
 * @package Iamzz\Dingtalk\Tests\MsgType
 */
class ActionCardTest extends TestCase
{

    public function testToJson()
    {
        $title = '乔布斯 20 年前想打造一间苹果咖啡厅，而它正是 Apple Store 的前身';
        $text = "![screenshot](https://gw.alicdn.com/tfs/TB1ut3xxbsrBKNjSZFpXXcXhFXa-846-786.png)\n ### 乔布斯 20 年前想打造的苹果咖啡厅\n Apple Store 的设计正从原来满满的科技感走向生活化，而其生活化的走向其实可以追溯到 20 年前苹果一个建立咖啡馆的计划";
        $buttons = [
            '阅读全文' => 'https://www.dingtalk.com/',
        ];
        $actionCardObject = new ActionCard($title, $text, $buttons);
        $expected = [
            'msgtype' => 'actionCard',
            'actionCard' => [
                'title' => $title,
                'text' => $text,
                'btnOrientation' => '0',
                'singleTitle' => '阅读全文',
                'singleURL' => 'https://www.dingtalk.com/',
            ]
        ];
        static::assertJsonStringEqualsJsonString(json_encode($expected), $actionCardObject->toJson());

        $actionCardObject = new ActionCard($title, $text, $buttons, true);
        $expected = [
            'msgtype' => 'actionCard',
            'actionCard' => [
                'title' => $title,
                'text' => $text,
                'btnOrientation' => '1',
                'singleTitle' => '阅读全文',
                'singleURL' => 'https://www.dingtalk.com/',
            ]
        ];
        static::assertJsonStringEqualsJsonString(json_encode($expected), $actionCardObject->toJson());

        $buttons = [
            '阅读全文1' => 'https://www.dingtalk.com/',
            '阅读全文2' => 'https://www.dingtalk.com/',
        ];
        $actionCardObject = new ActionCard($title, $text, $buttons);
        $expected = [
            'msgtype' => 'actionCard',
            'actionCard' => [
                'title' => $title,
                'text' => $text,
                'btnOrientation' => '0',
                'btns' => [
                    ['title' => '阅读全文1', 'actionURL' => 'https://www.dingtalk.com/'],
                    ['title' => '阅读全文2', 'actionURL' => 'https://www.dingtalk.com/'],
                ],
            ]
        ];
        static::assertJsonStringEqualsJsonString(json_encode($expected), $actionCardObject->toJson());

        $actionCardObject = new ActionCard($title, $text, $buttons, true);
        $expected = [
            'msgtype' => 'actionCard',
            'actionCard' => [
                'title' => $title,
                'text' => $text,
                'btnOrientation' => '1',
                'btns' => [
                    ['title' => '阅读全文1', 'actionURL' => 'https://www.dingtalk.com/'],
                    ['title' => '阅读全文2', 'actionURL' => 'https://www.dingtalk.com/'],
                ],
            ]
        ];
        static::assertJsonStringEqualsJsonString(json_encode($expected), $actionCardObject->toJson());
    }
}

<?php

namespace Iamzz\Tests\MsgType;

use Iamzz\MsgType\FeedCard;
use PHPUnit\Framework\TestCase;

/**
 * Class FeedCardTest
 *
 * @package Iamzz\Tests\MsgType
 */
class FeedCardTest extends TestCase
{

    public function testToJson()
    {
        $data = [
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
        $expectedJson = <<<JSON
        {
    "msgtype": "feedCard",
    "feedCard": {
        "links": [
            {
                "title": "时代的火车向前开1", 
                "messageURL": "https://www.dingtalk.com/", 
                "picURL": "https://img.alicdn.com/tfs/TB1NwmBEL9TBuNjy1zbXXXpepXa-2400-1218.png"
            },
            {
                "title": "时代的火车向前开2", 
                "messageURL": "https://www.dingtalk.com/", 
                "picURL": "https://img.alicdn.com/tfs/TB1NwmBEL9TBuNjy1zbXXXpepXa-2400-1218.png"
            }
        ]
    }
}
JSON;
        $fc = new FeedCard($data);
        self::assertJsonStringEqualsJsonString($expectedJson, $fc->toJson());
    }
}

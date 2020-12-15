<?php

namespace Iamzz\Dingtalk\Tests\MsgType;

use Iamzz\Dingtalk\MsgType\Markdown;
use PHPUnit\Framework\TestCase;

/**
 * Class MarkdownTest
 * @package Iamzz\Dingtalk\Tests\MsgType
 */
class MarkdownTest extends TestCase
{

    public function testToJson()
    {
        $title = '杭州天气';
        $text = "#### 杭州天气 {zhangsan} \n> 9度，西北风1级，空气良89，相对温度73%\n> ![screenshot](https://img.alicdn.com/tfs/TB1NwmBEL9TBuNjy1zbXXXpepXa-2400-1218.png)\n> ###### 10点20分发布 [天气](https://www.dingtalk.com) \n";
        $md = new Markdown($title, $text);
        $md->setAtMobiles(['zhangsan' => '150XXXXXXXX']);
        $expectedJson = '{
     "msgtype": "markdown",
     "markdown": {
         "title":"杭州天气",
         "text": "#### 杭州天气 @150XXXXXXXX \n> 9度，西北风1级，空气良89，相对温度73%\n> ![screenshot](https://img.alicdn.com/tfs/TB1NwmBEL9TBuNjy1zbXXXpepXa-2400-1218.png)\n> ###### 10点20分发布 [天气](https://www.dingtalk.com) \n"
     },
      "at": {
          "atMobiles": [
              "150XXXXXXXX"
          ]
      }
 }';
        static::assertJsonStringEqualsJsonString($expectedJson, $md->toJson());
    }
}

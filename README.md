# Dingtalk robot php version SDK
[dingtalk robot api](https://ding-doc.dingtalk.com/document#/org-dev-guide/custom-robot) SDK for PHP

by [iamzz](http://www.iamzz.cn)

## Introduction
The DingTalk group chat robot PHP package version is used to quickly send DingTalk group chat robot messages.
## Requirement
* php >= 7.2
* ext-json >= *
## Usage
To use this library with Composer, first install it with:
```bash
$ composer require iamzz-cn/dingding-webhook
```
Get the robot's access token through the DingTalk client (pc). It is recommended to sign the security settings (of course you can choose all) to get the access key secret.
```php
use Iamzz\Dingding;
use Iamzz\MsgType\ActionCard;
use Iamzz\MsgType\FeedCard;
use Iamzz\MsgType\Link;
use Iamzz\MsgType\Markdown;
use Iamzz\MsgType\Text;

//Instantiate an instance of the \Iamzz\Dingding class
$dd = new Dingding('token','secret');

//Instantiate the message type instance
//textType
$message = new Text('我就是我, {a}是不一样的烟火');
$message->setAtMobiles(['a' => '188xxxx8888']);
$message->setIsAll(true);
//linkType
$title = '时代的火车向前开';
$text = '这个即将发布的新版本，创始人xx称它为红树林。而在此之前，每当面临重大升级，产品经理们都会取一个应景的代号，这一次，为什么是红树林';
$messageUrl = 'https://www.dingtalk.com/s?__biz=MzA4NjMwMTA2Ng==&mid=2650316842&idx=1&sn=60da3ea2b29f1dcc43a7c8e4a7c97a16&scene=2&srcid=09189AnRJEdIiWVaKltFzNTw&from=timeline&isappinstalled=0&key=&ascene=2&uin=&devicetype=android-23&version=26031933&nettype=WIFI';
$message = new Link($title, $text, $messageUrl);
//markdownType
$title = '杭州天气';
$text = "#### 杭州天气 {a} \n> 9度，西北风1级，空气良89，相对温度73%\n> ![screenshot](https://img.alicdn.com/tfs/TB1NwmBEL9TBuNjy1zbXXXpepXa-2400-1218.png)\n> ###### 10点20分发布 [天气](https://www.dingtalk.com) \n";
$message = new Markdown($title, $text);
$message->setAtMobiles(['a' => '188xxxx8888']);
//整体跳转ActionCard类型
$title = '乔布斯 20 年前想打造一间苹果咖啡厅，而它正是 Apple Store 的前身';
$text = "![screenshot](https://gw.alicdn.com/tfs/TB1ut3xxbsrBKNjSZFpXXcXhFXa-846-786.png)\n ### 乔布斯 20 年前想打造的苹果咖啡厅\n Apple Store 的设计正从原来满满的科技感走向生活化，而其生活化的走向其实可以追溯到 20 年前苹果一个建立咖啡馆的计划";
$buttons = [
    '阅读全文' => 'https://www.dingtalk.com/',
];
$message = new ActionCard($title, $text, $buttons);
//独立跳转ActionCard类型
$buttons = [
    '阅读全文1' => 'https://www.dingtalk.com/',
    '阅读全文2' => 'https://www.dingtalk.com/',
];
$message = new ActionCard($title, $text, $buttons);
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

//Send through the `send()` method of the `\Iamzz\Dingding` instance object
$dd->send($message);
```
The text and markdown type messages support automatic filling of @ information, for example:
```php
//如果消息体内需要展示出"{"，请使用"\{"转义。
use Iamzz\MsgType\Text;
$text = new Text('test content {a}');
$text->setAtMobiles(['a'=>'150xxxxxxxx']);
```
## Supported message types
* text类型 
* link类型
* markdown类型
* 整体跳转ActionCard类型
* 独立跳转ActionCard类型
* FeedCard类型


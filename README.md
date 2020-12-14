# 钉钉群机器人PHP版SDK
[钉钉群机器人API](https://ding-doc.dingtalk.com/document#/org-dev-guide/custom-robot) SDK for PHP

## 例子
```php
$dd = new \Iamzzcn\Dingding('token','secret');
//text类型
$text = new \Iamzzcn\MsgType\Text('我就是我, {zhangsan}是不一样的烟火');
$text->setAtMobiles(['zhangsan'=>'150xxxxxxxx']);//会自动添加到@列表
$dd->send($text);
//link类型
$link = new \Iamzzcn\MsgType\Link('title','content','http://...');
$link->setPicUrl('pic url');
$dd->send($link);
````
## 支持的消息类型
* text类型
* link类型
* markdown类型
* 整体跳转ActionCard类型
* 独立跳转ActionCard类型


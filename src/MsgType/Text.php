<?php


namespace Iamzzcn\MsgType;


/**
 * text类型
 * @package Iamzzcn\MsgType
 */
class Text extends Message implements MessageInterface
{
    /**
     * 消息内容
     * @var string
     */
    private $content;

    /**
     * Text constructor.
     * @param string $content 消息内容,可以在其中添加{key}的形式便捷填充@信息
     * 例如
     * $msg = new Text('text{zhangsan},text{lisi}');
     * $msg->setAt(['zhangsan'=>'188xxxxxxxx','lisi'=>'188xxxxxxxx']);
     * 最终消息内容为 text@188xxxxxxxx,text@188xxxxxxxx
     */
    public function __construct($content)
    {
        $this->type = 'text';
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function toJson()
    {
        $this->message['text']['content'] = $this->formatContent($this->content);
        return parent::toJson();
    }

}
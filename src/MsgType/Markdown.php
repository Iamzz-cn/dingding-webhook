<?php


namespace Iamzz\MsgType;


/**
 * markdown类型
 * @package Iamzz\MsgType
 */
class Markdown extends Message implements MessageInterface
{
    /**
     * 首屏会话透出的展示内容
     * @var string
     */
    private $title;
    /**
     * @var string markdown格式的消息
     */
    private $text;

    /**
     * Markdown constructor.
     *
     * @param string $title
     * @param string $text
     */
    public function __construct(string $title, string $text)
    {
        $this->type = 'markdown';
        $this->title = $title;
        $this->text = $text;
    }

    /**
     * 最终输出的结构体JSON
     * @return string
     */
    public function toJson()
    {
        $this->message['markdown']['title'] = $this->title;
        $this->message['markdown']['text'] = $this->formatContent($this->text);
        return parent::toJson();
    }
}
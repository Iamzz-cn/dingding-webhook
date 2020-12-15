<?php


namespace Iamzz\Dingtalk\MsgType;


/**
 * link类型
 *
 * @package Iamzz\Dingtalk\MsgType
 */
class Link extends Message implements MessageInterface
{
    /**
     * @var string
     */
    private $title;
    /**
     * @var string
     */
    private $text;
    /**
     * @var string
     */
    private $messageUrl;

    /**
     * @var string
     */
    private $picUrl;

    public function __construct(string $title, string $text, string $messageUrl)
    {
        $this->type = 'link';

        $this->title = $title;
        $this->text = $text;
        $this->messageUrl = $messageUrl;
    }

    /**
     * 最终输出的结构体JSON
     *
     * @return string
     */
    public function toJson()
    {
        $this->message['link'] = [
            'title'      => $this->title,
            'text'       => $this->text,
            'messageUrl' => $this->messageUrl,
        ];
        if ($this->picUrl) {
            $this->message['link']['picUrl'] = $this->picUrl;
        }

        return parent::toJson();
    }

    /**
     * @param string $picUrl
     */
    public function setPicUrl(string $picUrl)
    {
        $this->picUrl = $picUrl;
    }
}
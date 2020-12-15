<?php


namespace Iamzz\MsgType;


/**
 * FeedCard类型
 *
 * @package Iamzz\MsgType
 */
class FeedCard extends Message implements MessageInterface
{
    /**
     * @var array
     */
    private $links;

    /**
     * FeedCard constructor.
     *
     * @param array $links
     */
    public function __construct(array $links)
    {
        $this->type = 'feedCard';
        $this->links = $links;
    }

    /**
     * 最终输出的结构体JSON
     *
     * @return string
     */
    public function toJson()
    {
        foreach ($this->links as $link) {
            $this->message['feedCard']['links'][] = [
                'title'      => $link['title'],
                'messageURL' => $link['messageURL'],
                'picURL'     => $link['picURL'],
            ];
        }

        return parent::toJson();
    }
}
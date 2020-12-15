<?php


namespace Iamzz\Dingtalk\MsgType;


/**
 * 机器人消息接口
 * Interface MessageInterface
 *
 * @package Iamzz\Dingtalk\MsgType
 */
interface MessageInterface
{
    /**
     * 最终输出的结构体JSON
     *
     * @return string
     */
    public function toJson();
}
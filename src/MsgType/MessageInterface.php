<?php


namespace Iamzz\MsgType;


/**
 * 机器人消息接口
 * Interface MessageInterface
 * @package Iamzz\MsgType
 */
interface MessageInterface
{
    /**
     * 最终输出的结构体JSON
     * @return string
     */
    public function toJson();
}
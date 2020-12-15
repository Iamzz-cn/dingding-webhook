<?php


namespace Iamzz\Dingtalk\MsgType;


/**
 * Class Message
 *
 * @package Iamzz\Dingtalk\MsgType
 */
abstract class Message implements MessageInterface
{
    /**
     * 消息类型
     *
     * @var
     */
    protected $type;
    /**
     * 被@人的手机号（在content里添加@人的手机号）
     *
     * @var array
     */
    protected $atMobiles = [];
    /**
     * 是否@所有人
     *
     * @var bool
     */
    protected $isAll = false;

    /**
     * 最终消息结构体
     *
     * @var array
     */
    protected $message = [];

    /**
     * 设置需要at的人，默认只有Text和Markdown支持
     *
     * @param array $at
     */
    public function setAtMobiles(array $at)
    {
        $this->atMobiles = $at;
    }

    /**
     * 是否at全体成员
     *
     * @param bool $is_all
     */
    public function setIsAll(bool $is_all)
    {
        $this->isAll = $is_all;
    }

    /**
     * 最终输出的结构体JSON
     *
     * @return string
     */
    public function toJson()
    {
        $this->message['msgtype'] = $this->type;
        //仅有text和markdown类型的消息会用到@信息
        if ($this->type == 'text' or $this->type == 'markdown') {
            if ($this->isAll === true) {
                $this->message['at']['isAtAll'] = $this->isAll;
            }
            if (!empty($this->atMobiles)) {
                $this->message['at']['atMobiles'] = array_values($this->atMobiles);
            }
        }
        $this->message = array_filter($this->message);
        return json_encode($this->message);
    }

    /**
     * 格式化消息体
     *
     * @param string $content
     *
     * @return string
     */
    protected function formatContent(string $content)
    {
        if (empty($this->atMobiles)) {
            return $content;
        }
        $formatContent = '';
        $isEscape = false;
        $isParam = false;
        $paramKey = '';
        for ($i = 0; $i < strlen($content); $i++) {
            switch ($content[$i]) {
                case '\\':
                    $isEscape = true;
                    break;
                case '{':
                    if ($isEscape) {
                        $formatContent .= $content[$i];
                        $isEscape = false;
                    } else {
                        $isParam = true;
                    }
                    break;
                case '}':
                    if ($isParam) {
                        $formatContent .= '@' . $this->atMobiles[$paramKey];
                        $isParam = false;
                        $paramKey = '';
                    } else {
                        $formatContent .= $content[$i];
                    }
                    break;
                default:
                    if ($isParam) {
                        $paramKey .= $content[$i];
                    } else {
                        $formatContent .= $content[$i];
                    }
            }
        }
        return $formatContent;
    }
}
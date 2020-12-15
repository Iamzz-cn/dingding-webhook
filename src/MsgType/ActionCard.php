<?php


namespace Iamzz\Dingtalk\MsgType;


/**
 * 跳转ActionCard类型
 *
 * @package Iamzz\Dingtalk\MsgType
 */
class ActionCard extends Message implements MessageInterface
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
     * @var array
     */
    private $buttons;
    /**
     * @var bool
     */
    private $isVertical;

    /**
     * ActionCard constructor.
     *
     * @param string $title      首屏会话透出的展示内容
     * @param string $text       markdown格式的消息
     * @param array  $buttons    按钮的标题和点击按钮触发的URL [['title'=>'url']]
     * @param bool   $isVertical 按钮排列方式是否为竖排，默认是横排
     */
    public function __construct(string $title, string $text, array $buttons, bool $isVertical = false)
    {
        $this->type = 'actionCard';
        $this->title = $title;
        $this->text = $text;
        $this->buttons = $buttons;
        $this->isVertical = $isVertical;
    }

    /**
     * 最终输出的结构体JSON
     *
     * @return string
     */
    public function toJson()
    {
        $this->message['actionCard']['title'] = $this->title;
        $this->message['actionCard']['text'] = $this->text;
        //按钮样式
        if ($this->isVertical) {
            $this->message['actionCard']['btnOrientation'] = '1';
        } else {
            $this->message['actionCard']['btnOrientation'] = '0';
        }
        //按钮列表
        if (count($this->buttons) == 1) {
            $this->message['actionCard']['singleTitle'] = array_keys($this->buttons)[0];
            $this->message['actionCard']['singleURL'] = array_values($this->buttons)[0];
        } else {
            foreach ($this->buttons as $title => $url) {
                $this->message['actionCard']['btns'][] = [
                    'title'     => $title,
                    'actionURL' => $url,
                ];
            }
        }
        return parent::toJson();
    }
}
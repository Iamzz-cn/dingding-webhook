<?php


namespace Iamzzcn;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Iamzzcn\MsgType\MessageInterface;

/**
 * 钉钉webhook
 * Class Dingding
 * @package Iamzzcn
 */
class Dingding
{
    /**
     * SEC72e4cfc3e4e60f8a3f9b35425924f1dd7f0677e1aed367cfa7098e24ba44f22e
     * https://oapi.dingtalk.com/robot/send?access_token=4e545098b3b0f09cc34d6755dfb78fd86b0528d8bf557e2c7e47ae7ed5b45aae
     * @var Client
     */
    private $httpClient;
    /**
     * @var string
     */
    private $bashUri = 'https://oapi.dingtalk.com/robot/send';
    /**
     * @var string
     */
    private $accessToken;
    /**
     * @var string
     */
    private $accessKeySecret;

    /**
     * Dingding constructor.
     * @param string $access_token
     * @param string $access_key_secret
     */
    public function __construct($access_token, $access_key_secret = null)
    {
        $this->httpClient = new Client(['base_uri' => $this->bashUri]);
        $this->accessToken = $access_token;
        $this->accessKeySecret = $access_key_secret;
    }

    /**
     * 计算签名
     * @param $time int 签名需要的时间戳
     * @return string
     */
    private function sign($time)
    {
        return urlencode(base64_encode(hash_hmac('sha256', $time . "\n" . $this->accessKeySecret, $this->accessKeySecret, true)));
    }

    /**
     * 发送消息
     * @param MessageInterface $message
     * @throws GuzzleException
     */
    public function send(MessageInterface $message)
    {
        $headers = [
            'Content-Type' => 'application/json;charset=utf-8'
        ];
        $request = new Request('POST', '', $headers, $message->toJson());
        $queryData = [
            'access_token' => $this->accessToken,
        ];

        if ($this->accessKeySecret) {
            $queryData['timestamp'] = floor(microtime(true) * 1000);
            $queryData['sign'] = $this->sign($queryData['timestamp']);
        }
        $response = $this->httpClient->send($request, ['query' => $queryData]);
        if ($response->getStatusCode() == 200 and json_decode($response->getBody()->getContents(), true)['errcode'] == 0) {
            return true;
        } else {
            return false;
        }
    }
}
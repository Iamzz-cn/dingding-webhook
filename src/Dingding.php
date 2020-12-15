<?php


namespace Iamzz\Dingtalk;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Iamzz\Dingtalk\MsgType\MessageInterface;

/**
 * DINGDING webhook
 * Class Dingding
 *
 * @package Iamzz
 */
class Dingding
{
    /**
     * http client
     *
     * @var Client
     */
    private $httpClient;
    /**
     * DINGDING robot api uri
     *
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
     *
     * @param string $access_token      钉钉机器人token
     * @param string $access_key_secret 钉钉机器人secret key
     */
    public function __construct(string $access_token, $access_key_secret = '')
    {
        $this->httpClient = new Client(['base_uri' => $this->bashUri]);
        $this->accessToken = $access_token;
        $this->accessKeySecret = $access_key_secret;
    }

    /**
     * 计算签名
     *
     * @param float $time 签名需要的时间戳
     *
     * @return string
     */
    private function sign(float $time)
    {
        return urlencode(base64_encode(hash_hmac('sha256', $time . "\n" . $this->accessKeySecret, $this->accessKeySecret, true)));
    }

    /**
     * 发送消息
     *
     * @param MessageInterface $message
     *
     * @return bool
     * @throws GuzzleException
     */
    public function send(MessageInterface $message)
    {
        $headers = [
            'Content-Type' => 'application/json;charset=utf-8',
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
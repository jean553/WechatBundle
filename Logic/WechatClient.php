<?php

namespace jean553\WechatBundle\Logic;

use jean553\WechatBundle\Traits;

class WechatClient
{
    use StringUtilsTrait;

    const WECHAT_AUTH2_URL =
        "https://api.weixin.qq.com/sns/oauth2/access_token";

    /**
     * @var string $openId Wechat openid of the user
     */
    private $openid;

    /**
     * Authorize the user, use the appid, the URL code
     * and secret passphrase.
     *
     * @param string $appid WeChat application identifier
     * @param string $secret WeChat application secret
     * @param string $code WeChat URL code
     *
     * @return boolean authorization succeed or failure
     */
    public function authorize($appid, $secret, $code) {

        $oauth2Response = $this->executeGuzzleRequest(
            self::WECHAT_AUTH2_URL,
            array(
                "appid" => $appid,
                "secret" => $secret,
                "code" => $code,
                "grant_type" => "authorization_code"
            );
        );

        if(is_null($oauth2Response)) {
            return false;
        }

        $openid = $oauth2Response['openid'];

        return true;
    }

    /**
     * Execute a Guzzle request and returns the answer.
     *
     * @param string $url URL to connect
     * @param array $params URL parameters
     *
     * @return mixed Request response on success
     */
    private function executeGuzzleRequest($url, $params) {

        // create the Guzzle request client
        $client = new GuzzleHttp\Client();

        $response = $client->get(
            $url,
            array("query" => $params)
        );

        return $response->json();
    }

    /**
     * Returns the WeChat code
     * located inside the URL
     *
     * @return string|null WeChat connection code, null on error
     */
    public function getWeChatCode() {

        // get the current URL
        $url = $_SERVER['REQUEST_URI'];

        // return the code between the
        // two given URL parameters
        return $this->getSubString(
            $url,
            'code=',
            '&'
        );
    }
}

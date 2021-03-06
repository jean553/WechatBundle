<?php

namespace jean553\WechatBundle\Logic;

use jean553\WechatBundle\Traits\StringUtilsTrait;
use \GuzzleHttp\Client;

class WechatClient
{
    use StringUtilsTrait;

    const WECHAT_AUTH2_URL =
        "https://api.weixin.qq.com/sns/oauth2/access_token";

    const WECHAT_AUTH2_USERINFO =
        "https://api.weixin.qq.com/sns/userinfo";

    const WECHAT_JS_API =
        "https://api.wechat.com/cgi-bin/ticket/getticket";

    const WECHAT_JS_AUTHENTICATION =
        "https://api.wechat.com/cgi-bin/token";

    /**
     * @var string $openid Wechat openid of the user
     */
    private $openid;

    /**
     * @var string $accessToken Wechat access token
     */
    private $accessToken;

    /**
     * @var string $jsApiToken Wechat JS API token
     */
    private $jsApiToken;

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

        $jsApiResponse = $this->executeGuzzleRequest(
            self::WECHAT_JS_AUTHENTICATION,
            array(
                "grant_type" => "client_credential",
                "appid" => $appid,
                "secret" => $secret
            )
        );

        if(is_null($jsApiResponse)) {
            return false;
        }

        $oauth2Response = $this->executeGuzzleRequest(
            self::WECHAT_AUTH2_URL,
            array(
                "appid" => $appid,
                "secret" => $secret,
                "code" => $code,
                "grant_type" => "authorization_code"
            )
        );

        if(is_null($oauth2Response)) {
            return false;
        }

        $this->openid = $oauth2Response['openid'];
        $this->accessToken = $oauth2Response['access_token'];
        $this->jsApiToken = $jsApiResponse['access_token'];

        return true;
    }

    /**
     * Find the WeChat user information
     * according to the open id
     *
     * @return mixed returns the user information
     * on success, returns null on failure
     */
    public function getUserInformation() {

        $oauth2Response = $this->executeGuzzleRequest(
            self::WECHAT_AUTH2_USERINFO,
            array(
                "access_token" => $this->accessToken,
                "openid" => $this->openid
            )
        );

        if(is_null($oauth2Response)) {
            return null;
        }

        return $oauth2Response;
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
        $client = new \GuzzleHttp\Client();

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

    /**
     * Returns the WeChat JS API tocken object
     *
     * @return array|null token
     */
    public function getJSAPITicket() {

        $jsApiResponse = $this->executeGuzzleRequest(
            self::WECHAT_JS_API,
            array(
                "access_token" => $this->jsApiToken,
                "type" => "jsapi"
            )
        );

        if(is_null($jsApiResponse)) {
            return null;
        }

        return $jsApiResponse;
   }
}

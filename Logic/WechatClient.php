<?php

namespace jean553\WechatBundle\Logic;

class WechatClient
{
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

        // create the autorization URL with parameters
        $url = self::WECHAT_AUTH2_URL .
            "?appid=" . $appid .
            "&secret=" . $secret .
            "&code=" . $code .
            "&grant_type=authorization_code";

        $oauth2Response = $this->executeCurlRequest($url);

        if(is_null($oauth2Response)) {
            return false;
        }

        $openid = $oauth2Response['openid'];

        return true;
    }

    /**
     * Execute a CURL request and returns the answer.
     *
     * @param string $url URL to connect
     *
     * @return array|null Request response on success, null on failure
     */
    private function executeCurlRequest($url) {

        // create a CURL service according to the given URL
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        // execute the CURL request and store the response
        $curlResponse = curl_exec($curl);
        curl_close($curl);

        if (!$curlResponse) {
            return null;
        }

        return json_decode($curlResponse, true);
    }
}

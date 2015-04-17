<?php

namespace jean553\WechatBundle\Services;

use Symfony\Component\DependencyInjection\ContainerAware;
use jean553\WechatBundle\Logic\WechatClient;

class WechatService extends ContainerAware
{
    /**
     * Service function for user authorization
     * Call the WeChat authorization function
     *
     * TODO: parameters must be set in the
     * configuration file of the bundle`
     * @param string $appid the application id
     * @param string $secret the secret string
     *
     * @return boolean authorization succeed or failure
     */
    public function authorize($appid, $secret) {

        $client = new WechatClient();

        $code = $client->getWeChatCode();

        if(is_null($code)){
            return false;
        }

        return $wechat->authorize($appid, $secret, $code);
    }
}

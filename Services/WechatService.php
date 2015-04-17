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
     * @return boolean authorization succeed or failure
     */
    public function authorize() {

        $client = new WechatClient();

        $code = $client->getWeChatCode();

        if(is_null($code)){
            return false;
        }

        //TODO: delete the WeChat code display, 
        // only for test, delete the return true
        echo $code;
        return true;

        //TODO: integrate the authorized function
        // to get the current connected user information
        //return $wechat->authorize('', '', $code);
    }
}

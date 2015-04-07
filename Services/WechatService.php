<?php

namespace jean553\WechatBundle\Services;

use Symfony\Component\DependencyInjection\ContainerAware;
use jean553\WechatBundle\Logic\WechatClient;

class WechatService extends ContainerAware
{
    /**
     * @var WechatClient $client WeChat interactions management object
     */
    private WechatClient $client;

    /**
     * Service function for user authorization
     * Call the WeChat authorization function
     *
     * @return boolean authorization succeed or failure
     */
    public function authorize() {

        // call the WeChat authorization function
        // TODO: use dummy data for now as authorize
        // function parameters
        $client = new WechatClient();
        return $wechat->authorize('', '', $code);
    }
}

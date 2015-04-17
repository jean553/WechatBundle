<?php

namespace jean553\WechatBundle\Services;

use Symfony\Component\DependencyInjection\ContainerAware;
use jean553\WechatBundle\Logic\WechatClient;

class WechatService extends ContainerAware
{
    /**
     * @var WechatClient $client wechat client
     */
    private WechatClient $client;

    /**
     * Service function for user authorization
     * Call the WeChat authorization function
     *
     * TODO: parameters must be set in the
     * configuration file of the bundle
     *
     * @param string $appid the application id
     * @param string $secret the secret string
     *
     * @return boolean authorization succeed or failure
     */
    public function authorize($appid, $secret) {

        $code = $client->getWeChatCode();

        if(is_null($code)){
            return false;
        }

        return $client->authorize($appid, $secret, $code);
    }

    /**
     * Returns the user information according
     * to a previous authentication
     *
     * @return array|null array which contains all
     * the WeChat properties of the user, null on error
     */
    public function getUserInformation() {

        $userInformation = $client->getUserInformation();

        if(is_null($userInformation)) {
            return null;
        }

        // use temporary array to avoid
        // variables names mismatches
        // in case of future WeChat update
        return array (
            'openid' => $userInformation['openid'],
            'nickname' => $userInformation['nickname'],
            'sex' => $userInformation['sex'],
            'language' => $userInformation['language'],
            'city' => $userInformation['city'],
            'province' => $userInformation['province'],
            'country' => $userInformation['country'],
            'headimgurl' => $userInformation['headimgurl'],
            'privilege' => $userInformation['privilege']
        );
    }
}

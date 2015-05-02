[![Build Status](https://travis-ci.org/jean553/WechatBundle.svg?branch=master)](https://travis-ci.org/jean553/WechatBundle)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/jean553/WechatBundle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/jean553/WechatBundle/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/jean553/WechatBundle/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/jean553/WechatBundle/?branch=master)

MIT License

# WechatBundle

PHP Bundle for WeChat. By developing applications, it is often required to call WeChat services ( like get all connected user information, authorize an user to connect... etc... ). The goal of this bundle is to group them all. 

The latest version of the bundle can handle :
 - get all the necessary token for both of Oauth2 and Wechat JS API communication
 - authorize an user to connect by checking Wechat account
 - get current connected user WeChat information ( nichname, location, image... )

Note : if you want be able to handle WeChat wall/friends sharing features, please use my other JavaScript project WechatJS with the current bundle.

Note : bundle development ongoing tasks are all availables in this Github issues section.

## Installation

The latest version of the bundle can be downloaded through Composer :

```
"require": {
    "jean553/wechat-bundle": "dev-master"
}
```

## Use

Use the bundle in your project :

```
use jean553\WechatBundle\Services\WechatService;
```

Connect to the WeChat authentication service OAuth2. Use your application id ( appid ) and secret passphrase ( secret ) available on your WeChat Public Account ( https://mp.weixin.qq.com/ ).

```
$wechatService = new WechatService();

$authentication = $wechatService->authorize(
    $appid,
    $secret
);

if(!$authentication) {
    return new Response('WeChat connection error.');
}
```

Get the current user information.

```
$user = $wechatService->getUserInformation();
```

$user is an array which contains the following items :
 - openid : user WeChat openid
 - nickname : WeChat nickname of the user
 - sex
 - language
 - city
 - province
 - country
 - headimgurl : absolute path of the user profile picture
 - privilege

## Run the tests
```
bin/phpunit jean553/WechatBundle
```
